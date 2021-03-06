<?php

# Stacey 1119224838
Class Stacey {

  static $version = '0.21.4';

  var $route;

  function handle_redirects() {
    # rewrite any calls to /index or /app back to /
    if(preg_match('/^\/?(index|app)\/?$/', $_SERVER['REQUEST_URI'])) {
      header('HTTP/1.1 301 Moved Permanently');
      header('Location: ../');
      return true;
    }
    # add trailing slash if required
    if(!preg_match('/\/$/', $_SERVER['REQUEST_URI']) && !preg_match('/[\.\?\&][^\/]+$/', $_SERVER['REQUEST_URI'])) {
      header('HTTP/1.1 301 Moved Permanently');
      header('Location:'.$_SERVER['REQUEST_URI'].'/');
      return true;
    }
    return false;
  }

  function php_fixes() {
    $tz = ini_get('date.timezone');
    if(empty($tz)) date_default_timezone_set('Europe/Zurich');
  }

  function set_content_type($template_file) {
    # split by file extension
    preg_match('/\.([\w\d]+?)$/', $template_file, $split_path);

    switch ($split_path[1]) {
    	case 'html':
        # set html/utf-8 charset header
        header("Content-type: text/html; charset=utf-8");
        break;
    	case 'json':
        # set json/utf-8 charset header
        header('Content-type: application/json; charset=utf-8');
        break;
      /*case 'txt':
        # set text/utf-8 charset header
        header("Content-type: text/plain; charset=utf-8");
        break;*/
      case 'atom':
        # set atom+xml/utf-8 charset header
        # header("Content-type: application/atom+xml; charset=utf-8");
        header("Content-type: application/xml; charset=utf-8"); // X3 Changed this, because the above dont gzip/accept
        break;
      case 'rss':
        # set rss+xml/utf-8 charset header
        header("Content-type: application/rss+xml; charset=utf-8");
        break;
      /*case 'rdf':
        # set rdf+xml/utf-8 charset header
        header("Content-type: application/rdf+xml; charset=utf-8");
        break;*/
      case 'xml':
        # set xml/utf-8 charset header
        header("Content-type: text/xml; charset=utf-8");
        break;
      /*case 'css':
        # set text/css charset header
        header('Content-type: text/css; charset=utf-8');
        break;*/
      default:
        # set html/utf-8 charset header
        header("Content-type: text/html; charset=utf-8");
    }
  }

  function etag_expired($cache) {
    header('Etag: "'.$cache->hash.'"');
    # Safari incorrectly caches 304s as empty pages, so don't serve it 304s
    if(isset($_SERVER['HTTP_USER_AGENT']) && strpos($_SERVER['HTTP_USER_AGENT'], 'Safari') !== false) return true;
    # Check for a local cache
    if(isset($_SERVER['HTTP_IF_NONE_MATCH']) && stripslashes($_SERVER['HTTP_IF_NONE_MATCH']) == '"'.$cache->hash.'"') {
      # local cache is still fresh, so return 304
      header("HTTP/1.0 304 Not Modified");
      header('Content-Length: 0');
      return false;
    } else {
      return true;
    }
  }

  function render($file_path, $template_file) {
  	global $time_pre;
    $cache = new Cache($file_path, $template_file);
    # set any custom headers
    $this->set_content_type($template_file);
    header('Generator: Imagevue X3 v'.Stacey::$version);
    # if etag is still fresh, return 304 and don't render anything
    if(!$this->etag_expired($cache)) return;
    # if cache has expired
    $html = $template_file === './templates/page.html' || $template_file === './templates/file.html';
    if($cache->expired()) {
      # render page & create new cache
      echo $cache->create($this->route, $file_path, true);
      if($html) {
      	echo PHP_EOL . '<!-- Page creation time: ' . (microtime(true) - $time_pre) . ' seconds -->';
      	//echo Helpers::$bugme;
      }
    } else {
      # render the existing cache
      echo $cache->render();
      if($html) {
      	echo PHP_EOL . '<!-- Cache output time: ' . (microtime(true) - $time_pre) . ' seconds -->';
      	//echo Helpers::$bugme;
      }
    }
  }

	// X3 Protect
	function protect($template_file){

		# strictly for demo password
		if($this->route === 'examples/features/password') {
			$this->setAuth(array('username' => 'guest', 'password' => 'guest'), Page::template_type($template_file));
			return;
		}

		# require passwords config
		include './config/protect.php';

		# get object
		global $protect_ob;
    $protect_ob = json_decode($protect, true);

    # Only continue if access is not empty
    if(empty($protect_ob) || empty($protect_ob["access"])) return;

    # get access object
    $x3_access = $protect_ob["access"];

    // Collapse grouped access links
    foreach ($x3_access as $key => $value) {
    	if(substr_count($key, ',') > 0){
    		$keys = explode(",", $key);
    		foreach ($keys as $url) {
    			if(!array_key_exists($url, $x3_access)) $x3_access[$url] = $value;
    		}
    		unset($x3_access[$key]);
    	}
    }

    // Sort by amount of slashes (folder deep on top)
    uksort($x3_access, function($a, $b){
    	return (substr_count($a,'/') < substr_count($b,'/')) ? 1 : -1;
		});

    if(!empty($x3_access)){
    	$broke = false;
    	$route = $this->route;

    	// Check equal links first
	  	foreach ($x3_access as $key => $value) {
	  		$keys = explode(",", $key);
	  		foreach ($keys as $url) {
	  			$item = rtrim($url,"/*");
		  		if($item == $route){
		  			$this->setAuth($value, Page::template_type($template_file));
		  			$broke = true;
		  			break 2;
		  		}
	  		}
			}

			// Check recursive
			if(!$broke) {
				foreach ($x3_access as $key => $value) {
		  		$keys = explode(",", $key);
		  		foreach ($keys as $url) {
		  			$item = rtrim($url,"/*");
			  		if(substr($route, 0, strlen($item)) === $item){
			  			$this->setAuth($value, Page::template_type($template_file));
			  			break 2;
			  		}
		  		}
				}
			}
    }
	}

  function create_page($file_path) {

    # return a 404 if a matching folder doesn't exist
    if(!file_exists($file_path)) throw new Exception('404');

    # register global for the path to the page which is currently being viewed
    global $current_page_file_path;
    $current_page_file_path = $file_path;

    # register global for the template for the page which is currently being viewed
    global $current_page_template_file;

    # Set template name: file or page, or 404 if in array.
    $template_name = is_file($file_path) ? 'file' : (in_array($file_path, array('./content/custom','./content/custom/favicon','./content/custom/logo')) ? '404' : 'page');

  	# Set current template file
    $current_page_template_file = Page::template_file($template_name);

    # error out if template file doesn't exist (or glob returns an error)
    if(empty($template_name) || $template_name == '404') throw new Exception('404');

    # Check auth protect
    $this->protect($current_page_template_file);

  	# render page
  	$this->render($file_path, $current_page_template_file);
  }

  // X3 set auth
  function setAuth($value, $template){
  	include "./app/auth.inc.php";
  	$username = empty($value["username"]) ? null : $value["username"];
		$password = empty($value["password"]) ? null : $value["password"];
		$users = empty($value["users"]) ? null : $value["users"];
		if(!empty($password) || !empty($users)) new BasicAuth($username, $password, $users, $template);
  }

  // X3 Service routes
  function x3Services(){
  	# Global X3 routes
  	global $x3_config;
		global $x3_service;
		global $x3_service_templates;
		$x3_service = array("services/site", "services/menu", "services/video");
		$x3_service_templates = array("site.json", "menu.html", "video.html");

		// Sitemap?
		if($x3_config["settings"]["sitemap"]) {
			array_unshift($x3_service, "sitemap");
			array_unshift($x3_service_templates, "sitemap.xml");
		}

		// Feed?
		if($x3_config["settings"]["feed"]) {
			array_unshift($x3_service, "feed");
			array_unshift($x3_service_templates, "feed.atom");
		}

  }

  // X3 Find File
  function x3FindFile($file_path, $name){
  	$files = array_keys(Helpers::list_files($file_path, '/'.$name.'\.(jpg|jpeg|png|gif)/i', false, false));
  	return end($files);
  }

  function __construct($get) {
  	# Create X3 Service routes
  	$this->x3Services();
    # sometimes when PHP release a new version, they do silly things - this function is here to fix them
    $this->php_fixes();
    # it's easier to handle some redirection through php rather than relying on a more complex .htaccess file to do all the work
    if($this->handle_redirects()) return;
    # strip any leading or trailing slashes from the passed url
    $key = key($get);

    # if the key isn't a URL path, then ignore it
    if (!preg_match('/\//', $key)) $key = false;
    $key = preg_replace(array('/\/$/', '/^\//'), '', $key);
    # store file path for this current page
    $this->route = isset($key) ? $key : 'index';
    # TODO: Relative root path is set incorrectly (missing an extra ../)
    # strip any trailing extensions from the url
    $this->route = preg_replace('/[\.][\w\d]+?$/', '', $this->route);
    # $this->route = preg_replace('/[\.|\_][\w\d]+?$/', '', $this->route); // 0.8
    //$this->route = str_replace('_json','',$this->route); // X3 hack for non-rewrite non-htaccess
    #$this->route = preg_replace('/_json$/', '', $this->route);

    # Get X3 Route services
    global $x3_service;
		global $x3_service_templates;

		# Double underscore always 404
    if(strpos(basename($this->route), '__') === 0) {
    	$this->not_found();

		# X3 Service Route
    } else if(in_array($this->route, $x3_service)) {

    	# load data.json
    	Helpers::load_data();

    	$file_path = "./" . $this->route;
	    global $current_page_file_path;
	    $current_page_file_path = $file_path;
	    global $current_page_template_file;
	    $current_page_template_file = "./templates/" . $x3_service_templates[array_search($this->route, $x3_service)];
	    $this->protect($current_page_template_file);
    	$this->render($file_path, $current_page_template_file);

    # X3 Page
    } else {

    	# load data.json
    	Helpers::load_data();

    	$file_path = Helpers::url_to_file_path($this->route, true);

    	# X3 Check if file_path is file
	    if(empty($file_path) && basename($this->route) !== 'preview') {

	    	// If index
	    	$dirname = dirname($this->route);
	    	$file_route = ($dirname === '.' || empty($dirname)) ? '' : $dirname;

	    	// make sure parent is folder
	    	$file_path = Helpers::url_to_file_path($file_route, true);

	    	// If is folder path, look for file
	    	if(!empty($file_path)) {

	    		# file name without extension
	    		$name = basename($key);

	    		// Search file
	    		$file = $this->x3FindFile($file_path, $name);
	    		// Check for file names with spaces (replace _underscore with empty space)
	    		if(empty($file) && strpos($name, '_') !== false) {
	    			$file = $this->x3FindFile($file_path, str_replace('_',' ',$name));
	    			// Check for file names with dots (replace _underscore with dot)
	    			if(empty($file)) $file = $this->x3FindFile($file_path, str_replace('_','.',$name));
	    		}

	    		// Make file_path if $file is not empty
	    		$file_path = empty($file) ? null : $file_path.'/'.$file;
	    	}
	    }

	    # Check if path is empty, return 404
	    if(empty($file_path)) {
	    	$this->not_found();

	    # Try create page
	    } else {
		    try {
		      # create and render the current page
		      $this->create_page($file_path);
		    } catch(Exception $e) {
		      if($e->getMessage() == "404") {
		        $this->not_found();
		      } else {
		        echo '<h3>'.$e->getMessage().'</h3>';
		      }
		    }
	    }

    }
  }

  # Page not found
  function not_found(){
  	# return 404 headers
    header('HTTP/1.0 404 Not Found');
    if(file_exists(Config::$content_folder.'/custom/404')) {
      $this->route = 'custom/404';
      $this->create_page(Config::$content_folder.'/custom/404');
    } else {
    	echo "<h1>Not Found</h1><p>The requested URL " . $u . " was not found on this server.</p>";
    }
  }
}
?>
