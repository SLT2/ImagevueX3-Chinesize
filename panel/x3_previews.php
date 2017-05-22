<?php

# preview image tool

if(!isset($core)){
	require_once 'filemanager_core.php';
	$core = new filemanager_core();
}

if ($core->isLogin() and isset($_SERVER['HTTP_X_REQUESTED_WITH']) and strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {

	# vars
	define("IMAGE_DEFAULT", $x3_config["image_default"]);

	Class Preview {

	  static $images_cache;
	  static $changes = 0;

	  static function format($dir, $image = false, $class = 'neutral', $json = false){
	  	$short_dir = '<a href="' . $dir . '">' . str_replace('../content/', '', $dir) . '</a>';
	  	if($image) {
	  		$image = str_replace('../content/', '', $image);
	  		$path = strpos($image, '/') === false ? $dir . '/' . $image : '../content/' . $image;
	  		$img_link = '<a href="' . $path . '" target=_blank>' . $image . '</a>';
	  		$src = '<img src="' . str_replace('../content/', '../render/w100-c1:1-q90/', $path) . '" />';
	  	} else {
	  		$img_default = 'Default <a href="../content/' . IMAGE_DEFAULT . '" target=_blank>' . IMAGE_DEFAULT . '</a> will be used.';
	  		$src = '<img src="../render/w100-c1:1-q90/' . IMAGE_DEFAULT . '" />';
	  	}
	  	if($image && $json) {
	  		$file = $dir . '/page.json';
	  		if(is_writable($file)) {
	  			self::$changes ++;
		  		$json["image"] = $image;
		  		$save = (phpversion() < 5.4) ? json_encode($json) : json_encode($json, JSON_UNESCAPED_UNICODE);
		  		$fp = fopen($file, 'w');
			    fwrite($fp, $save);
			    fclose($fp);
			    return '<tr class=success><td class=dir>' . $short_dir .'</td><td class=msg><i class="fa fa-check"></i> Updated preview</td><td class=image>' . $img_link . $src . '</td></tr>';
	  		} else {
	  			return '<tr class=error><td class=dir>' . $short_dir . '</td><td class=msg><i class="fa fa-ban"></i> is not writeable!</td><td class=image>&nbsp;</td></div>';
	  		}
	  	} else if($image && $class === 'error'){
	  		return '<tr class=error><td class=dir>' . $short_dir . '</td><td class=msg><i class="fa fa-ban"></i> Cannot locate</td><td class=image>' . $img_link . '</td></tr>';
	  	} else if($image){
	  		return '<tr class=neutral><td class=dir>' . $short_dir . '</td><td class=msg><i class="fa fa-check"></i> Image already set</td><td class=image>' . $img_link . $src . '</td></tr>';
	  	} else {
	  		return '<tr class=neutral><td class=dir>' . $short_dir . '</td><td class=msg><i class="fa fa-ban"></i> No image to set</td><td class=image>' . $img_default . $src . '</td></tr>';
	  	}
	  }

	  static function get_images($dir){
	  	if(isset(self::$images_cache[$dir])) {
	  		return self::$images_cache[$dir];
	  	} else {
	  		$files = glob($dir."/*.*", GLOB_NOSORT);
				$files = array_filter($files, function($val){
		  		return in_array(strtolower(pathinfo($val, PATHINFO_EXTENSION)), array('jpg','jpeg','png','svg','gif'));
		  	});
		  	natcasesort($files);
		  	self::$images_cache[$dir] = $files;
		  	return self::$images_cache[$dir];
	  	}
	  }

	  static function get_last_child($directory){
	  	$dirs = glob($directory.'/[!_]?*', GLOB_ONLYDIR|GLOB_NOSORT);
	  	$dir = count($dirs) > 0 ? end($dirs) : false;
	  	return $dir;
	  }

	  static function url_to_file_path($url) {
	    $file_path = '../content';
	    $url_parts = explode('/', trim($url,'/'));
	    foreach($url_parts as $u) {
	    	if(preg_match('/^_/', $u)) return false;
	    	$dirs = glob($file_path . '/*'.$u, GLOB_ONLYDIR|GLOB_NOSORT);
	    	$count = count($dirs);
	    	if(count($dirs) > 0) {
	    		for ($i=0; $i < $count; $i++) {
	    			$name = basename($dirs[$i]);
	    			if($name === $u) {
	    				$dir = $dirs[$i];
	    				break;
	    			} else {
	    				$explode = explode('.', $name);
		    			$name = isset($explode[1]) ? $explode[1] : $explode[0];
		    			if($name === $u){
		    				$dir = $dirs[$i];
		    				break;
		    			}
	    			}
	    		}
		    	if(isset($dir)) {
		    		$file_path .=  '/'.basename($dir);
		    	} else {
		    		return false;
		    	}
	    	} else {
	    		return false;
	    	}
	    }
	    return $file_path;
	  }

		static function check($directory){
			$menu = '';
			$dirs = glob($directory.'/[!_]?*', GLOB_ONLYDIR|GLOB_NOSORT);
			if(count($dirs) > 0){
				foreach($dirs as $dir){

					# JSON must exist
					$json_file = $dir . '/page.json';
		    	if(file_exists($json_file)) {
		    		$json_content = file_get_contents($json_file);
		    		$json = (isset($json_content) && !empty($json_content)) ? json_decode($json_content, TRUE) : array();

		    		// image is defined
			    	if(isset($json["image"])) {

			    		// set default jpg extension
			    		if(!preg_match('/^.*\.(jpg|jpeg|png|gif)$/i', $json["image"])) $json["image"] .= '.jpg';

			    		// relative to folder
			    		if(strpos($json["image"], '/') === false){
			    			$path = $dir.'/'.$json["image"];

			    			// path is correct!
			    			if(file_exists($path)) {
			    				$menu .= self::format($dir, $json["image"]);

			    			// set to 'preview.jpg' if exists
			    			} else if(file_exists($dir . '/preview.jpg')){
			    				$menu .= self::format($dir, 'preview.jpg', 'success', $json);

			    			// File don't exist
			    			} else {
			    				$images = self::get_images($dir);

					    		// set to first image in folder
					    		if(count($images) > 0){
					    			$first = basename(current($images));
					    			$menu .= self::format($dir, $first, 'success', $json);

					    		// check if assets
					    		} else if(isset($json["gallery"]) && isset($json["gallery"]["assets"])){
					    			$path = self::url_to_file_path($json["gallery"]["assets"]);

					    			if($path) {
					    				$images = self::get_images($path);

					    				// images exist in assets
					    				if(count($images)){
					    					$image = $path . '/' . $json["image"];

					    					// image is defined relative to assets
					    					if(file_exists($image)) {
					    						$menu .= self::format($dir, $image, 'success', $json);

					    					// first image from assets
					    					} else {
					    						$image = current($images);
					    						$menu .= self::format($dir, $image, 'success', $json);
					    					}

					    				// no images in assets
					    				} else {
					    					$menu .= self::format($dir, $json["image"], 'error');
					    				}

					    			// Assets folder doesnt exist
					    			} else {
					    				$menu .= self::format($dir, $json["image"], 'error');
					    			}

					    		// ignore if no images and not assets
					    		} else {
					    			$menu .= self::format($dir, $json["image"], 'error');
					    		}
			    			}

			    		// root relative
			    		} else {

			    			// path is correct!
			    			if(file_exists('../content/'.$json["image"])) {
			    				$menu .= self::format($dir, $json["image"]);

			    			// root path image does not exist
			    			} else {
			    				$menu .= self::format($dir, $json["image"], 'error');
			    			}
			    		}

			    	// set to 'preview.jpg' if exists
			    	} else if(file_exists($dir . '/preview.jpg')){
			    			$menu .= self::format($dir, 'preview.jpg', 'success', $json);

			    	// get first image or assets
		    		} else {

		    			// get images
		    			$images = self::get_images($dir);

		    			// set to first image in folder
			    		if(count($images) > 0){
			    			$first = basename(current($images));
			    			$menu .= self::format($dir, $first, 'success', $json);

			    		// check if assets
			    		} else if(isset($json["gallery"]) && isset($json["gallery"]["assets"])){
			    			$path = self::url_to_file_path($json["gallery"]["assets"]);

			    			if($path) {
			    				$images = self::get_images($path);

			    				// images exist in assets
			    				if(count($images)){
			    					$image = current($images);
			    					$menu .= self::format($dir, $image, 'success', $json);

			    				// no images in assets
			    				} else {
			    					$menu .= self::format($dir);
			    				}

			    			// Assets folder doesnt exist
			    			} else {
			    				$menu .= self::format($dir);
			    			}

			    		// no images, not assets
			    		} else {
			    			$last_child = self::get_last_child($dir);

			    			// child folders?
			    			if($last_child) {

			    				// look for preview.jpg
			    				if(file_exists($last_child . '/preview.jpg')){
			    					$menu .= self::format($dir, $last_child . '/preview.jpg', 'success', $json);

			    				// get images in last child
			    				} else {
			    					$images = self::get_images($last_child);

				    				// child has images
				    				if(count($images) > 0) {
				    					$image = current($images);
				    					$menu .= self::format($dir, $image, 'success', $json);

				    				// no images in child
				    				} else {
				    					$menu .= self::format($dir);
				    				}
			    				}

			    			// no images, no children
			    			} else {
			    				$menu .= self::format($dir);
			    			}
			    		}
			    	}

						# child tree
						$menu .= Preview::check($dir);
					}

				}
			}
			return $menu;
		}
	}

	$content = file_exists('../content/'.IMAGE_DEFAULT) ? '' : '<div class="alert alert-danger" role="alert"><strong>Important!</strong> Your default preview image <code>' . IMAGE_DEFAULT . '</code> does not exist. Go to <em>Settings › Page › Details › Default Preview Image</em>, and make sure you set a path to a valid image file.</div>';

	$table = '<table><tr><th>Folder</th><th>Status</th><th>Preview Image</th>' . Preview::check('../content') . '</table>';
	if(Preview::$changes > 0) $core->touchme();
	$content .= '<div class=changes>[' . Preview::$changes . ' changes]</div>' . $table;
	echo $content;
}
?>