<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

if(!isset($core)){
	require_once 'filemanager_core.php';
	$core = new filemanager_core();
}

if ($core->isLogin() and isset($_SERVER['HTTP_X_REQUESTED_WITH']) and strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {

	// Vars
	$config_folder = '../config';
	$config_user = '../config/config.user.json';
	$config_default = '../app/config.defaults.json';

	// JSON output
	header('Content-Type: application/json; charset=utf-8');

	// Function to filter differences in defaults vs save
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

	// Return current settings
	if(isset($_POST['get_settings'])) {

		// echo json_encode($x3_config);

		// Clone settings
		$clone = new ArrayObject($x3_config);

		// get basedir
		$basedir_str = ini_get('open_basedir');

		// exclude sensitive data
		$exclude_path = '../../panel_settings_exclude.php';
		if(file_exists($exclude_path) && empty($basedir_str)) {
			require_once($exclude_path);
		}

		// echo
		echo json_encode($clone);

	// Save page settings
	} else if(isset($_POST['page_settings']) && isset($_POST['path'])) {

		if(!$core->touchme()){
			echo $core->touchme_error();
		} else {
			// Vars
			$save_path = str_replace('../../content','../content', $_POST['path']);
			$page = get_magic_quotes_gpc() ? json_decode(stripslashes($_POST['page_settings']), TRUE) : json_decode($_POST['page_settings'], TRUE);

			// If inject setting
			if(isset($_POST['inject']) && $_POST['inject']) {
				$current = array();
				if(file_exists($save_path)){
					$current_content = file_get_contents($save_path);
					if(!empty($current_content)) $current = json_decode($current_content, TRUE);
				}
				$diff = array_replace_recursive($current, $page);

			// Page settings
			} else {
				$diff = (object)arrayRecursiveDiff($page, $x3_config);
			}

			$save = (phpversion() < 5.4) ? json_encode($diff) : json_encode($diff, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

			// Save it!
			if(!file_exists($save_path)) {
				if(fopen($save_path, "w")){
					if(!is_writable($save_path)) {
						echo '{ "error": "File '. $save_path .' is not writeable" }';
					} else {
						if(file_put_contents($save_path, $save)){
							echo '{ "success": true }';
						} else {
							echo '{ "error": "Can\'t save to file ' . $save_path . '." }';
						}
					}
				} else {
					echo '{ "error": "Can\'t create ' . $save_path . '" }';
				}
			} else if(file_put_contents($save_path, $save)){
				echo '{ "success": true }';
			} else {
				echo '{ "error": "Can\'t save to file ' . $save_path . '." }';
			}
		}

	// Save settings
	} else if(isset($_POST['settings'])) {

		// Render config
		function render($config_user, $config_default){

			// Save user config (only differences from default)
			$default = json_decode(file_get_contents($config_default), TRUE);
			$user = get_magic_quotes_gpc() ? json_decode(stripslashes($_POST['settings']), TRUE) : json_decode($_POST['settings'], TRUE);
			$diff = (object)arrayRecursiveDiff($user, $default);
			$save = (phpversion() < 5.4) ? json_encode($diff) : json_encode($diff, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

			// Write data
			if(file_put_contents($config_user, $save)){
				echo '{ "success": true }';
			} else {
				echo '{ "error": "Can\'t save config." }';
			}
		}

		if(!$core->touchme()){
			echo $core->touchme_error();
		} else {
			// Make sure config is writeable
			if(!file_exists($config_folder)) {
				echo '{ "error": "Folder ' . $config_folder . ' does not exist" }';
			} else if(!file_exists($config_user)) {
				if(!is_writable($config_folder)) {
					echo '{ "error": "Folder ' . $config_folder . ' is not writeable" }';
				} else if(fopen($config_user, "w")){
					if(!is_writable($config_user)) {
						echo '{ "error": "File '. $config_user .' is not writeable" }';
					} else {
						render($config_user, $config_default);
					}
				} else {
					echo '{ "error": "Failed to create '. $config_user .'" }';
				}
			} else if(!is_writable($config_user)) {
				echo '{ "error": "File '. $config_user .' is not writeable" }';
			} else {
				render($config_user, $config_default);
			}
		}




	/*} else if(isset($_POST['mailtest'])) {

		//SMTP needs accurate times, and the PHP time zone MUST be set
		//This should be done in your php.ini, but this is how to do it if you don't have access to that
		date_default_timezone_set('Etc/UTC');

		require 'filemanager_assets/PHPMailer/PHPMailerAutoload.php';

		//Create a new SMTP instance
		$smtp = new SMTP;

		//$smtp->SMTPAuth = true;
		//$smtp->SMTPSecure = 'tls'; // tls, ssl or empty

		//Enable connection-level debug output
		//$smtp->do_debug = SMTP::DEBUG_CONNECTION;

		try {
		//Connect to an SMTP server
		    if ($smtp->connect($_POST['host'], $_POST['port'])) {
		        //Say hello
		        if ($smtp->hello($_POST['host'])) { //Put your host name in here
		            //Authenticate
		            if ($smtp->authenticate($_POST['username'], $_POST['password'])) {
		                //echo "Connected ok!";
		                echo '{ "success": "Connected!" }';
		            } else {
		                throw new Exception('Authentication failed: ' . $smtp->getLastReply());
		            }
		        } else {
		            throw new Exception('HELO failed: '. $smtp->getLastReply());
		        }
		    } else {
		        throw new Exception('Connect failed');
		    }
		} catch (Exception $e) {
		    //echo 'SMTP error: '. $e->getMessage(), "\n";
		    echo '{ "error": ' . json_encode($e->getMessage()) . ' }';
		}
		//Whatever happened, close the connection.
		$smtp->quit(true);*/




	} else {
  	echo '{ "error": "No request parameters?" }';
	}
}

