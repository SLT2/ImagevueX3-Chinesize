<?php

Class Page {

  var $url_path;
  var $file_path;
  var $template_name;
  var $template_file;
  var $template_type;
  var $data;
  var $all_pages;

  function __construct($url, $content = false, $file_path, $current_page = false) {

  	// Special X3
  	global $x3_service;
    global $x3_service_templates;

  	if(in_array($url, $x3_service)) {
  		$this->template_name = basename($url);
	    $this->template_file = "./templates/" . $x3_service_templates[array_search($url, $x3_service)];
	    $is_file = false;
    } else {

    	# is file?
			$is_file = is_file($file_path) ? true : false;

			# store url and converted file path
	    $this->file_path = ($is_file ? $file_path : Helpers::url_to_file_path($url));

	    $this->template_name = $is_file ? 'file' : 'page';

	    $this->template_file = $current_page ? self::template_file($this->template_name) : './templates/page.html';

    }
    $this->url_path = $url;

    //$this->template_type = self::template_type($this->template_file);
    $this->template_type = $current_page ? self::template_type($this->template_file) : 'html';

    # create/set all content variables
    PageData::create($this, $content, $current_page, $is_file);
  }

  function parse_template() {
    $data = TemplateParser::parse($this->data, $this->template_file);
    return $data;
  }

  # magic variable assignment
  function __set($name, $value) {
    $this->data[strtolower($name)] = $value;
  }

  static function template_type($template_file) {
    preg_match('/\.([\w\d]+?)$/', $template_file, $ext);
    return isset($ext[1]) ? $ext[1] : false;
  }

  static function template_file($template_name) {
  	$segment = explode('/', $_SERVER['REQUEST_URI']);
  	$last_segment = end($segment);
  	if(stripos($last_segment, '.json') !== false) {
  		$ext = 'json';
  	} else {
  		$ext = 'html';
  	}
  	return Config::$templates_folder.'/'.$template_name.'.'.$ext;
  	/*if(empty($last_segment) || strpos($last_segment, '.') === false) {
  		$ext = array('html');
  	} else {
  		$ext = explode('.', $last_segment);
  	}
  	return Config::$templates_folder.'/'.$template_name.'.'.end($ext);*/
  }

}

?>
