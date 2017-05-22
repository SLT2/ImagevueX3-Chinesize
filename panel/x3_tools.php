<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

if(!isset($core)){
	require_once 'filemanager_core.php';
	$core = new filemanager_core();
}

if ($core->isLogin() and isset($_SERVER['HTTP_X_REQUESTED_WITH']) and strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {

	# Cache site object
	if(isset($_POST['site_object'])) {

		$folder = '../content/';
		$file = '../content/site.json';
		header('Content-Type: application/json');

		// render
		function render($file){

			# vars
			$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443 || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) ? "https://" : "http://";
			$path = $protocol . $_SERVER['HTTP_HOST'] . rtrim(dirname(dirname($_SERVER['REQUEST_URI'])), '/') . '/services/site.json';
			$file = '../content/site.json';

			# load site.json url
			if(function_exists('curl_version')) {
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $path);
				curl_setopt($ch, CURLOPT_HEADER, 0);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_FRESH_CONNECT, TRUE);
				$site = curl_exec($ch);
				curl_close($ch);
			} else {
				$site = @file_get_contents($path);
			}

			if($site === false) {
				echo '{ "error": "Your server does not allow curl or file_get_contents for Url." }';
			} else {
				if(file_put_contents($file, $site)){
					echo '{ "success": true }';
				} else {
					echo '{ "error": "Can\'t write to ' . $file . '" }';
				}
			}
		}

		# Check writeable
		if(!file_exists($file)) {
			if(!is_writable($folder)) {
				echo '{ "error": "Folder ' . $folder . ' is not writeable" }';
			} else if(fopen($file, "w")){
				if(!is_writable($file)) {
					echo '{ "error": "File '. $file .' is not writeable" }';
				} else {
					if(!$core->touchme()){
						echo $core->touchme_error();
					} else {
						render($file);
					}
				}
			} else {
				echo '{ "error": "Failed to create '. $file .'" }';
			}
		} else if(!is_writable($file)) {
			echo '{ "error": "File '. $file .' is not writeable" }';
		} else {
			if(!$core->touchme()){
				echo $core->touchme_error();
			} else {
				render($file);
			}
		}

	# Bust page cache
	} else if(isset($_POST['touch'])){

		// vars
		$dir = '/app/_cache/pages';
		$path = '..' . $dir;
		$success = true;
		header('Content-Type: application/json');

		if(!file_exists($path)){
			echo '{ "error": "' . $dir . ' does not exist." }';
		} else if(!is_writable($path)){
			echo '{ "error": "Cannot delete files in folder ' . $dir . '" }';
		} else {
			$files = glob($path.'/*', GLOB_NOSORT);
			if(count($files) === 0){
				echo '{ "success": "Cache is already empty!" }';
			} else {
				foreach($files as $file){
				  if(is_file($file) && !@unlink($file)) {
			      $success = false;
			      break;
				  }
				}
				if($success) {
					echo '{ "success": "Page cache deleted." }';
				} else if(!$core->touchme()){
					echo $core->touchme_error();
				} else {
					echo '{ "warning": "Cannot delete files in ' . $dir . '. Likely you have open_basedir restriction in effect. Cache has nevertheless be invalidated, so new cache files will be created." }';
				}
			}
		}

	# Reset Settings
	} else if(isset($_POST['reset_settings'])){
		$file = '../config/config.user.json';
		header('Content-Type: application/json');

		if(!$core->touchme()){
			echo $core->touchme_error();
		} else {
			if(!file_exists($file)) {
				echo '{ "success": "already" }';
			} else if(!is_writable($file)){
				echo '{ "error": "Can\'t delete ' . $file . '" }';
			} else if(unlink($file)){
				echo '{ "success": true }';
			} else {
				echo '{ "error": "Can\'t delete ' . $file . '" }';
			}
		}

	# Get phpinfo
	} else if(isset($_POST['phpinfo'])){

		header('Content-Type: text/html; charset=utf-8');
		$cannot = '<div class="alert alert-danger" role="alert">The phpinfo() function does not seem to be available from this server :(</div>';

		# Check that function exists
		if(function_exists('phpinfo')) {
			ob_start(); phpinfo(); $s = ob_get_contents(); ob_end_clean();

			# Check if tidy extension is available
			if(extension_loaded('tidy')) {
				$tidy = tidy_parse_string($s);
				$mybody = $tidy->Body();
				$body = $mybody->value;

			# Else preg_match it
			} else if(preg_match('/(?:<body[^>]*>)(.*)<\/body>/isU', $s, $matches)) {
				$body = $matches[1];
			} else {
				$body = $cannot;
			}
		} else {
			$body = $cannot;
		}

		# output $body
		$output = empty($body) ? $cannot : $body;
		echo $output;

	# Get custom templates gallery/folder JSON
	} else if(isset($_POST['get_templates'])){
		header('Content-Type: application/json');
		$custom_templates_file = '../config/custom-setting-templates.json';
		if(file_exists($custom_templates_file) && is_readable($custom_templates_file)){
			$custom_templates_content = file_get_contents($custom_templates_file);
			if(!empty($custom_templates_content)) {
				$out = $custom_templates_content;
			} else {
				$out = '{}';
			}
		} else {
			$out = '{}';
		}
		echo $out;

	# Save custom templates
	} else if(isset($_POST['save_template'])){
		header('Content-Type: application/json');
		$post = get_magic_quotes_gpc() ? stripslashes($_POST['save_template']) : $_POST['save_template'];
		$config_folder = '../config';
		$custom_templates_file = '../config/custom-setting-templates.json';
		$template = json_decode($post, TRUE);


		// Function to filter differences in defaults vs save
		/* DIFF SCHEIT
		function arrayRecursiveDiff($aArray1, $aArray2) {
		  $aReturn = array();
		  foreach ($aArray1 as $mKey => $mValue) {
		    if (array_key_exists($mKey, $aArray2)) {
		      if (is_array($mValue)) {
		        $aRecursiveDiff = arrayRecursiveDiff($mValue, $aArray2[$mKey]);
		        if (count($aRecursiveDiff)) { $aReturn[$mKey] = $aRecursiveDiff; }
		      } else {
		        if ($mValue != $aArray2[$mKey]) {
		          $aReturn[$mKey] = $mValue;
		        }
		      }
		    } else {
		      $aReturn[$mKey] = $mValue;
		    }
		  }
		  return $aReturn;
		}
		$template = arrayRecursiveDiff($template, $x3_config["folders"]);
		*/

		if(file_exists($custom_templates_file)){
			if(is_readable($custom_templates_file) && is_writable($custom_templates_file)) {
				$current_content = file_get_contents($custom_templates_file);
				$current_templates = empty($current_content) ? array() : json_decode($current_content, TRUE);
				$new = array_merge_recursive($current_templates, $template);
				$save = phpversion() < 5.4 ? json_encode($new) : json_encode($new, JSON_PRETTY_PRINT);
				if(file_put_contents($custom_templates_file, $save)) {
					echo '{"success": true}';
				} else {
					echo '{"fail": "Failed to write to '.$custom_templates_file.'"}';
				}
			} else {
				echo '{"fail": "Cannot write to '.$custom_templates_file.'"}';
			}
		} else if(is_writable($config_folder)){
			if(file_put_contents($custom_templates_file, phpversion() < 5.4 ? json_encode($template) : json_encode($template, JSON_PRETTY_PRINT))) {
				echo '{"success": true}';
			} else {
				echo '{"fail": "Failed to write to '.$custom_templates_file.'"}';
			}
		} else {
			echo '{"fail": "Failed to write to '.$config_folder.'"}';		}
	}
}



?>