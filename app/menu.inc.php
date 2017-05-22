<?php

Class Menu {

  static $images_cache;
  static $root;
  static $hide = false;
  static $win;

  static function check_menu($content){

  	# set $root
  	if(!isset(self::$root)) self::$root = rtrim(dirname($_SERVER['PHP_SELF']), '/') . '/';
  	if(!isset(self::$win)) self::$win = strtoupper(substr(PHP_OS, 0, 3)) === 'WIN' ? true : false;

  	global $x3_config;
  	$menu = $x3_config["settings"]["menu_super"] ? self::simple_dir_tree($content) : self::dir_tree($content);
  	return $menu;
  }

  static function write_menu($root = false){

  	# set $root
  	self::$root = !$root ? rtrim(dirname($_SERVER['PHP_SELF']), '/') . '/' : $root;

  	# vars
  	$cache_dir = './app/_cache/pages';
  	$cache_file = $cache_dir . '/menu';
  	$content = './content';

  	# Make sure page cache folder is writeable, or error
		if(!is_writable($cache_dir)) throw new RuntimeException("Unable to write in the cache directory ".$cache_dir);

		$menu = self::check_menu($content);
		$fp = fopen($cache_file, 'w');
    fwrite($fp, $menu);
    fclose($fp);
    return $menu;

  }

  static function get_menu(){

  	# set $root
  	if(!isset(self::$root)) self::$root = rtrim(dirname($_SERVER['PHP_SELF']), '/') . '/';
  	if(!isset(self::$win)) self::$win = strtoupper(substr(PHP_OS, 0, 3)) === 'WIN' ? true : false;

  	# vars
  	global $x3_config;
  	$cache_dir = Config::$cache_folder.'/pages';
  	$cache_file = $cache_dir . '/menu';

  	# Look for menu.html
  	if($x3_config["settings"]["menu_manual"]){

  		# return menu.html if exists
  		if(file_exists($cache_file)){
	  		return file_get_contents($cache_file);

	  	# create menu.html, cache and output
	  	} else {
	  		return self::write_menu();
	  	}

	  # Create cached menu
  	} else {
  		$cache = new Cache("./services/menu", "./templates/menu.html");
	    if($cache->expired()) {
	      # render page & create new cache
	      return $cache->create("services/menu", "./services/menu", false, false);
	    } else {
	      # render the existing cache
	      return $cache->render();
	    }
  	}
  }

  static function get_images($dir, $sort = true){

  	if(self::$hide === false){
  		global $x3_config;
    	$hide = $x3_config['settings']['hide_images'];
    	if($hide === 'double') {
    		self::$hide = '(?!__)';
    	} else if($hide === 'single'){
    		self::$hide = '(?!_)';
    	} else {
    		self::$hide = '';
    	}
  	}
  	$hide = self::$hide;

  	if(isset(self::$images_cache[$dir])) {
  		return self::$images_cache[$dir];
  	} else {
  		$files = glob($dir."/*.*", GLOB_NOSORT);
			$files = array_filter($files, function($val) use($hide) {
	  		//return in_array(strtolower(pathinfo($val, PATHINFO_EXTENSION)), array('jpg','jpeg','png','svg','gif'));
	  		return preg_match('/^' . $hide . '(?:[^.\n]*\.)*(?<!^preview\.|^thumb\.)(?:jpe?g|png|gif)$/i', basename($val));
	  	});
	  	if($sort) natcasesort($files);
	  	self::$images_cache[$dir] = $files;
	  	return self::$images_cache[$dir];
  	}
  }

  static function get_preview($dir, $path, $default){

  	# vars
  	global $x3_config;

  	# image is set
		if(!empty($path)){

			$image = trim($path, '/');

			# full path is defined
			if(strpos($path, '/') !== false){
				$preview = './content/' . $image;

			# file in current dir
			} else {
				$preview = $dir . '/' . $image;
			}

		# image is undefined
		/*} else if($x3_config["settings"]["menu_images"]){

			# first image in folder
			$files = self::get_images($dir);
			if(count($files) > 0) {
				$preview = current($files);
			}*/

		# preview.jpg
		} else if(file_exists($dir . '/preview.jpg')){
			$preview = $dir . '/preview.jpg';

		# empty preview
		} else {
			$preview = '';
		}

		# Add default jpg extension
		if(!empty($preview) && !preg_match('/^.*\.(jpg|jpeg|png|gif)$/i', $preview)) $preview .= '.jpg';

		# Set default if empty or file doesn't exist
		if(empty($preview) || !file_exists($preview)) $preview = './content/' . $default;

		# Finally, trim the dot.
		$preview = trim($preview, '.');

		# Set attribute and return
		return 'preview:' . $preview . ';';
  }

  static function simple_dir_tree($directory){
		$menu = '';
		$dirs = glob($directory.'/[0-9]*.?*', GLOB_ONLYDIR|GLOB_NOSORT);
		if(count($dirs) > 0){
			natcasesort($dirs);
			foreach($dirs as $dir){

		    # name:
				$name = preg_replace('/\d+?\./', '', basename($dir));
				$name = ucwords(preg_replace('/[-_]/', ' ', $name));

				# url
				$url = self::$root . str_replace('index/', '', preg_replace(array('/\d+?\./', '/(\.+\/)*content\/*/'), '', $dir) . '/');
				if(self::$win) $url = str_replace('\\', '', $url);

				# child tree
				$tree = self::simple_dir_tree($dir);

				# output
				if(empty($tree)){
					$menu .= '<li><a href="'.$url.'" class="needsclick">' . $name . '</a></li>';
				} else {
					$menu .= '<li class="has-dropdown"><a href="'.$url.'" class="node needsclick">' . $name . '</a><ul class=dropdown>' . $tree . '</ul></li>';
				}
			}
		}
		return $menu;
	}

  static function dir_tree($directory, $reverse = false, $limit = 0, $mega_children = false, $carousel_count = false, $carousel_date = false, $first_level = true){
		$menu = '';

		# Set $root
		//if(!isset(self::$root)) self::$root = rtrim(dirname(substr(__DIR__, strlen($_SERVER['DOCUMENT_ROOT']))), '/').'/';
		//if(!isset(self::$root)) self::$root = rtrim(dirname($_SERVER['PHP_SELF']), '/') . '/';

		# Glob diretories starting from $dir
		$dirs = glob($directory.'/[0-9]*.?*', GLOB_ONLYDIR|GLOB_NOSORT);

		if(count($dirs) > 0){

			# sorting
			natcasesort($dirs);
			if($reverse) $dirs = array_reverse($dirs);
			if($limit > 0) $dirs = array_slice($dirs, 0, min(count($dirs), $limit));

			# loop dirs
			foreach($dirs as $dir){

				$set_mega_children = false;
				$set_carousel_count = false;
				$set_carousel_date = false;

				# JSON
				$json_file = $dir . '/page.json';
	    	if(file_exists($json_file)) $json_content = file_get_contents($json_file);
	    	$json = (isset($json_content) && !empty($json_content)) ? json_decode($json_content, TRUE) : array();

		    # Vars merge
		    global $x3_config;
		    $vars = array_replace_recursive($x3_config, $json);

		    # vars
		    $data_options = '';
		    $data_data = '';

		    # menu
		    $m = $vars['menu'];

		    # output unless hidden
				if(!$m['hide']){

					# label
					if(isset($vars['label'])){
						//$label = htmlspecialchars(strip_tags($vars['label']));
						$label = strip_tags($vars['label'], '<i><span><em><strong><b><small><img>');
					} else {
						$label = preg_replace('/\d+?\./', '', basename($dir));
						$label = ucwords(preg_replace('/[-_]/', ' ', $label));
					}

					# MEGA, unless hidden or children hidden or not topbar
					if(!$m['hide_children'] && $m['type'] !== 'normal' && strpos($vars['style']['layout']['layout'], 'topbar') !== false && $first_level) {

						# attribute vars
						$type = 'mega:' . $m['type'] . ';';
						$items = '';
						$crop = '';
						$carousel_amount = '';
						$list = '';
						$title = '';
						$description = '';
						$width = '';
						$preview = '';

						# mega data
						if($m['type'] === 'data'){
							$items = 'items:' . $m['data_items'] . ';';
							$data_items = explode(',', $m['data_items']);
							$data_data .= '<div class=hide>';
							if(!empty($data_items)) {
								foreach($data_items as &$value) {
									if($value === 'social' || $value == 'icon-buttons'){
										$data_data .= '<div class=menu-icon-buttons></div>';
									} else if($value === 'contactform'){
										$data_data .= preg_replace('/<!--.*?-->/s', '', trim(str_replace('<xinput', '<input', $vars['back']['custom']['contact_widget'])));
									} else if($value === 'hr'){
										$data_data .= '<hr>';
									}
								}
							}
							$data_data .= '</div>';

							# force hide children if data
							$m['hide_children'] = true;

							# set width;
							$width = 'width:' . $m['width'] . ';';

						# mega carousel
						} else if($m['type'] === 'carousel'){
							$items = 'items:' . $m['carousel_items'] . ';';
							if($m['crop']['enabled']) $crop = 'crop:' . $m['crop']['crop'][0] . ',' . $m['crop']['crop'][1] . ';';
							$carousel_amount = 'carousel_amount:' . $m['carousel_amount'] . ';';

							# mega children carousel
							$set_mega_children = 'carousel';

							# future count
							if(strpos($m['carousel_items'], 'amount') !== false) $set_carousel_count = true;

							# future date
							if(strpos($m['carousel_items'], 'date') !== false) $set_carousel_date = true;

						# mega list
						} else if($m['type'] === 'list'){
							if(!empty($m['list'])) $list = 'list:' . $m['list'] . ';';

							$title = empty($vars['title']) ? $label : htmlspecialchars(strip_tags($vars['title']));
							$title = 'title:' . $title . ';';
							//$title = 'title:' . $vars['title'] . ';';
							$description = empty($vars['description']) ? '' : htmlspecialchars(strip_tags($vars['description']));
							$description = 'description:' . $description . ';';

							# mega children list
							$set_mega_children = 'list';

							$preview = self::get_preview($dir, $vars['image'], $vars['image_default']);
						}

						# compile data-options
						$data_options = ' data-options="' . $type . $items . $crop . $carousel_amount . $list . $title . $description . $width . $preview . '"';

					# mega children
					} else if(!empty($mega_children)){

						$type = 'mega:;';
						$date = '';
						$preview = '';
						$amount = '';

						# date
						if($mega_children === 'carousel' && $carousel_date) {
							$date = empty($vars['date']) ? filemtime($dir) : strtotime($vars['date']);
							//$date = empty($vars['date']) ? filemtime($dir) : $vars['date'];
							$date = $vars['settings']['date_format'] === 'timeago' ? 'timeago:' . date('c', $date) : date($vars['settings']['date_format'], $date);
							$date = 'date:' . $date . ';';
						}

						# amount
						if($mega_children === 'carousel' && $carousel_count) $amount = 'amount:' . count(self::get_images($dir, false)) . ';';

						# preview
						/*if($mega_children === 'carousel' || $mega_children === 'list')*/
						$preview = self::get_preview($dir, $vars['image'], $vars['image_default']);

						# title
						$title = empty($vars['title']) ? $label : htmlspecialchars(strip_tags($vars['title']));
						$description = empty($vars['description']) ? '' : htmlspecialchars(strip_tags($vars['description']));

						# set data-options
						$data_options = ' data-options="' . $type . 'title:' . $title . ';description:' . $description . ';' . $preview . $date . $amount . '"';

						# stop further child iteration if carousel mega_children
						if($mega_children === 'carousel') $m['hide_children'] = true;

						# mega children list
						if($mega_children === 'list') $set_mega_children = 'list';
					}

					# url
					$url = self::$root . str_replace('index/', '', preg_replace(array('/\d+?\./', '/(\.+\/)*content\/*/'), '', $dir) . '/');
					if(self::$win) $url = str_replace('\\', '', $url);

					# children
					$tree = $m['hide_children'] ? null : self::dir_tree($dir, $m['reverse'], $m['limit'], $set_mega_children, $set_carousel_count, $set_carousel_date, false);

					# <li> class
					$classes = array();
					if(!empty($tree)) array_push($classes, 'has-dropdown');
					if($m['click_toggle']) array_push($classes, 'clicktoggle');
					if($m['hide_children_mobile']) array_push($classes, 'hide-children-mobile');
					if(!empty($m['classes'])) $classes = array_merge($classes, explode(',', $m['classes']));
					$classes = empty($classes) ? '' : ' class="' . implode(' ', $classes) . '"';

					# <a> class
					$link_classes = array('needsclick');
					if(!empty($tree)) array_push($link_classes, 'node');
					if($m['nolink']) array_push($link_classes, 'nolink');

					# <a> link
					$link = $vars['link'];
					$target = '';
					$data_popup = '';
					$data_popup_content = '';
					$data_popup_class = '';
					$data_popup_window = '';

					# x3 popup content
					if($link['content'] && $link['target'] === 'x3_popup'){
						if(!empty($link['popup_class'])) $data_popup_class = ' data-popup-class="' . $link['popup_class'] . '"';
						$data_popup_content = ' data-popup-content="' . htmlspecialchars($vars['content']) . '"';
						$url = '#';

					# link
					} else if(!empty($link['url'])){
						$link_url = trim($link['url']);
						$ext = pathinfo($link_url, PATHINFO_EXTENSION);
						$ext = !empty($ext);
						$abs = strpos(strtolower($link_url), 'http') === 0;

						# add root path if relative url
						if($link_url[0] !== '/' && !$abs) {
							$url = $ext ? self::$root . trim($dir, './') . '/' . $link_url : $url . rtrim($link_url, '/') . '/';

						# Ensure trailing slash for root-relative urls
						} else if(!$ext && $link_url[0] === '/'){
							$url = rtrim($link_url, '/') . '/';

						# Update $url
						} else {
							$url = $link_url;
						}

						# Detect link target
						if($link['target'] !== 'auto') {

							# popup window
							if($link['target'] === 'popup') {
								$data_popup_window = ' data-popup-window="' . $url . ',' . $link['width'] . ',' . $link['height'] . '"';

							# x3 popup
							} else if($link['target'] === 'x3_popup') {
								if($link['content']){
									if(!empty($link['popup_class'])) $data_popup_class = ' data-popup-class="' . $link['popup_class'] . '"';
									$data_popup_content = ' data-popup-content="' . htmlspecialchars($vars['content']) . '"';
									$url = '#';
								} else {
									$data_popup = ' data-popup';
								}

							# custom target
							} else {
								$target = ' target="' . $link['target'] . '"';
							}

						# Open blank if auto, and absolute or extension
						} else if($abs || $ext){
							$target = ' target="_blank"';
						}

						# detect no-ajax
						if($ext) array_push($link_classes, 'no-ajax');

						# append is-link to class
						array_push($link_classes, 'is-link');
					}

					# compile link classes
					$link_classes = empty($link_classes) ? '' : ' class="' . implode(' ', $link_classes) . '"';

					# subtree
					$tree = empty($tree) ? '' : '<ul class=dropdown>' . $tree . '</ul>';

					# output
					$menu .= '<li' . $classes . $data_options . '><a href="'.$url.'"'.$link_classes.$target.$data_popup.$data_popup_content.$data_popup_class.$data_popup_window. '>' . $label . '</a>' . $data_data . $tree . '</li>';
				}
			}
		}
		return $menu;
	}
}

?>