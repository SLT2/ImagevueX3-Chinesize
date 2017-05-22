<?php

Class Helpers {

  static $file_cache;
  static $use_data = true;
  static $data;
  //static $bugme = '';

  static function load_data() {

  	# check if $use_data and $data is empty
  	if(self::$use_data && empty(self::$data)){

  		# load it
  		if(file_exists(Config::$cache_folder . '/pages/data.json')) {
				self::$data = json_decode(file_get_contents(Config::$cache_folder . '/pages/data.json'), true);
				if(empty(self::$data)) self::$use_data = false;

			# try to create
			} else {
				include './app/data.inc.php';
				self::$data = Data::make();
				if(!self::$data) self::$use_data = false;
	  	}
  	}
  }

  static function redirect($val) {
  	$val = trim($val);
		if(strpos($val,'http') === 0) {
  		$location = $val;
  	} else {
  		$uri = $val[0] !== '/' ? $_SERVER['REQUEST_URI'] : ''; // is relative to current path
  		$location = PROTOCOL.$_SERVER['HTTP_HOST'].$uri.$val;
  	}
  	header("HTTP/1.1 301 Moved Permanently");
  	header("Location: ".$location, true, 301);
		exit();
  }

  static function file_path_to_url($file_path) {
    $url = preg_replace(array('/\d+?\./', '/(\.+\/)*content\/*/'), '', $file_path);
    return $url ? $url : 'index';
  }

  static function url_to_file_path($url, $folders_only = true) {

  	# if the url is empty, we're looking for the index page
	  $url = empty($url) ? 'index': $url;

  	# $use_data
  	if(self::$use_data){
  		if(preg_match('/^_/', $url) || strpos($url,'/_') !== false) return false;
    	return isset(self::$data[$url]) ? self::$data[$url] : false;

    # old-school
  	} else {

	    $file_path = Config::$content_folder;
	    # Split the url and recursively unclean the parts into folder names
	    $url_parts = explode('/', $url);
	    foreach($url_parts as $u) {
	      # Look for a folder at the current path that doesn't start with an underscore
	      if(preg_match('/^_/', $u)) return false;
	      $matches = array_keys(Helpers::list_files($file_path, '/^(\d+?\.)?'.$u.'$/', $folders_only, false));
	      //if(!preg_match('/^_/', $u)) $matches = array_keys(Helpers::list_files($file_path, '/^(\d+?\.)?'.$u.'$/', $folders_only, false));

	      # No matches means a bad url
	      if(empty($matches)) return false;
	      else $file_path .=  '/'.$matches[0];
	    }
	    return $file_path;
  	}
  }
  static function file_cache($dir = false) {
    if(!isset(self::$file_cache[$dir])) self::build_file_cache($dir);

    if($dir && !isset(self::$file_cache[$dir])) return array();
    return $dir ? self::$file_cache[$dir] : self::$file_cache;
  }

  static function build_file_cache($dir = '.') {
    # build file cache
    $files = glob($dir.'/*', GLOB_NOSORT);
    $files = is_array($files) ? $files : array();
    foreach($files as $path) {
      $file = basename($path);
    	$is_dir = is_dir($path);
    	//self::$bugme .= PHP_EOL . '<!-- ' . $path . ' -->';
      self::$file_cache[$dir][] = array(
        'path' => $path,
        'file_name' => $file,
        'is_folder' => $is_dir ? 1 : 0
      );
    }
  }

  static function list_files($dir, $regex, $folders_only = false, $sort = true) {
    $files = array();

    # $use_data
    if($folders_only && self::$use_data) {
    	$results = preg_grep('/' . preg_quote($dir, '/') . '\/\d+?\.[^\/]+$/', self::$data);
    	if(count($results) > 0) {
    		foreach ($results as $file) {
	    		$files[basename($file)] = $file;
	    	}
    	}

    } else {
    	foreach(self::file_cache($dir) as $file) {
	      # if file matches regex, continue
	      if(isset($file['file_name']) && preg_match($regex, $file['file_name'])) {
	        # if $folders_only is true and the file is not a folder, skip it
	        if($folders_only && !$file['is_folder']) continue;
	        # otherwise, add file to results list
	        $files[$file['file_name']] = $file['path'];
	      }
	    }
    }

    # sort list in reverse-numeric order
    if($sort) natcasesort($files);
    return $files;
  }

  static function site_last_modified() {

  	# content touch
  	$content = filemtime(Config::$content_folder);

		# app updated
		$app = filemtime(Config::$app_folder.'/stacey.inc.php');

		# touch file (optional)
    $touch = Config::$root_folder.'config/touch.txt';
    $touch_time = file_exists($touch) ? filemtime($touch) : 0;

    # global parent config (optional)
    $basedir_str = ini_get('open_basedir');
    $global_json = dirname(dirname(dirname(__FILE__))).'/global.json';
    $global_json_time = empty($basedir_str) && file_exists($global_json) ? filemtime($global_json) : 0;

    # updated
    $updated = max($content, $app, $touch_time, $global_json_time);
    return strval(date('c', $updated));
  }

  static function translate_named_entities($string) {
    $mapping = array('&'=>'&#38;','&apos;'=>'&#39;', '&minus;'=>'&#45;', '&circ;'=>'&#94;', '&tilde;'=>'&#126;', '&Scaron;'=>'&#138;', '&lsaquo;'=>'&#139;', '&OElig;'=>'&#140;', '&lsquo;'=>'&#145;', '&rsquo;'=>'&#146;', '&ldquo;'=>'&#147;', '&rdquo;'=>'&#148;', '&bull;'=>'&#149;', '&ndash;'=>'&#150;', '&mdash;'=>'&#151;', '&tilde;'=>'&#152;', '&trade;'=>'&#153;', '&scaron;'=>'&#154;', '&rsaquo;'=>'&#155;', '&oelig;'=>'&#156;', '&Yuml;'=>'&#159;', '&yuml;'=>'&#255;', '&OElig;'=>'&#338;', '&oelig;'=>'&#339;', '&Scaron;'=>'&#352;', '&scaron;'=>'&#353;', '&Yuml;'=>'&#376;', '&fnof;'=>'&#402;', '&circ;'=>'&#710;', '&tilde;'=>'&#732;', '&Alpha;'=>'&#913;', '&Beta;'=>'&#914;', '&Gamma;'=>'&#915;', '&Delta;'=>'&#916;', '&Epsilon;'=>'&#917;', '&Zeta;'=>'&#918;', '&Eta;'=>'&#919;', '&Theta;'=>'&#920;', '&Iota;'=>'&#921;', '&Kappa;'=>'&#922;', '&Lambda;'=>'&#923;', '&Mu;'=>'&#924;', '&Nu;'=>'&#925;', '&Xi;'=>'&#926;', '&Omicron;'=>'&#927;', '&Pi;'=>'&#928;', '&Rho;'=>'&#929;', '&Sigma;'=>'&#931;', '&Tau;'=>'&#932;', '&Upsilon;'=>'&#933;', '&Phi;'=>'&#934;', '&Chi;'=>'&#935;', '&Psi;'=>'&#936;', '&Omega;'=>'&#937;', '&alpha;'=>'&#945;', '&beta;'=>'&#946;', '&gamma;'=>'&#947;', '&delta;'=>'&#948;', '&epsilon;'=>'&#949;', '&zeta;'=>'&#950;', '&eta;'=>'&#951;', '&theta;'=>'&#952;', '&iota;'=>'&#953;', '&kappa;'=>'&#954;', '&lambda;'=>'&#955;', '&mu;'=>'&#956;', '&nu;'=>'&#957;', '&xi;'=>'&#958;', '&omicron;'=>'&#959;', '&pi;'=>'&#960;', '&rho;'=>'&#961;', '&sigmaf;'=>'&#962;', '&sigma;'=>'&#963;', '&tau;'=>'&#964;', '&upsilon;'=>'&#965;', '&phi;'=>'&#966;', '&chi;'=>'&#967;', '&psi;'=>'&#968;', '&omega;'=>'&#969;', '&thetasym;'=>'&#977;', '&upsih;'=>'&#978;', '&piv;'=>'&#982;', '&ensp;'=>'&#8194;', '&emsp;'=>'&#8195;', '&thinsp;'=>'&#8201;', '&zwnj;'=>'&#8204;', '&zwj;'=>'&#8205;', '&lrm;'=>'&#8206;', '&rlm;'=>'&#8207;', '&ndash;'=>'&#8211;', '&mdash;'=>'&#8212;', '&lsquo;'=>'&#8216;', '&rsquo;'=>'&#8217;', '&sbquo;'=>'&#8218;', '&ldquo;'=>'&#8220;', '&rdquo;'=>'&#8221;', '&bdquo;'=>'&#8222;', '&dagger;'=>'&#8224;', '&Dagger;'=>'&#8225;', '&bull;'=>'&#8226;', '&hellip;'=>'&#8230;', '&permil;'=>'&#8240;', '&prime;'=>'&#8242;', '&Prime;'=>'&#8243;', '&lsaquo;'=>'&#8249;', '&rsaquo;'=>'&#8250;', '&oline;'=>'&#8254;', '&frasl;'=>'&#8260;', '&euro;'=>'&#8364;', '&image;'=>'&#8465;', '&weierp;'=>'&#8472;', '&real;'=>'&#8476;', '&trade;'=>'&#8482;', '&alefsym;'=>'&#8501;', '&larr;'=>'&#8592;', '&uarr;'=>'&#8593;', '&rarr;'=>'&#8594;', '&darr;'=>'&#8595;', '&harr;'=>'&#8596;', '&crarr;'=>'&#8629;', '&lArr;'=>'&#8656;', '&uArr;'=>'&#8657;', '&rArr;'=>'&#8658;', '&dArr;'=>'&#8659;', '&hArr;'=>'&#8660;', '&forall;'=>'&#8704;', '&part;'=>'&#8706;', '&exist;'=>'&#8707;', '&empty;'=>'&#8709;', '&nabla;'=>'&#8711;', '&isin;'=>'&#8712;', '&notin;'=>'&#8713;', '&ni;'=>'&#8715;', '&prod;'=>'&#8719;', '&sum;'=>'&#8721;', '&minus;'=>'&#8722;', '&lowast;'=>'&#8727;', '&radic;'=>'&#8730;', '&prop;'=>'&#8733;', '&infin;'=>'&#8734;', '&ang;'=>'&#8736;', '&and;'=>'&#8743;', '&or;'=>'&#8744;', '&cap;'=>'&#8745;', '&cup;'=>'&#8746;', '&int;'=>'&#8747;', '&there4;'=>'&#8756;', '&sim;'=>'&#8764;', '&cong;'=>'&#8773;', '&asymp;'=>'&#8776;', '&ne;'=>'&#8800;', '&equiv;'=>'&#8801;', '&le;'=>'&#8804;', '&ge;'=>'&#8805;', '&sub;'=>'&#8834;', '&sup;'=>'&#8835;', '&nsub;'=>'&#8836;', '&sube;'=>'&#8838;', '&supe;'=>'&#8839;', '&oplus;'=>'&#8853;', '&otimes;'=>'&#8855;', '&perp;'=>'&#8869;', '&sdot;'=>'&#8901;', '&lceil;'=>'&#8968;', '&rceil;'=>'&#8969;', '&lfloor;'=>'&#8970;', '&rfloor;'=>'&#8971;', '&lang;'=>'&#9001;', '&rang;'=>'&#9002;', '&loz;'=>'&#9674;', '&spades;'=>'&#9824;', '&clubs;'=>'&#9827;', '&hearts;'=>'&#9829;', '&diams;'=>'&#9830;');
    foreach (get_html_translation_table(HTML_ENTITIES, ENT_QUOTES) as $char => $entity){
      $mapping[$entity] = '&#' . ord($char) . ';';
    }
    return str_replace(array_keys($mapping), $mapping, $string);
  }

}

?>