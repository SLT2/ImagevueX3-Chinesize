<?php


// Make full dir tree menu
$menu = '';
$data = array();
function make_dir_tree($directory){
	global $menu;
	global $data;
	global $store_data;
	$dirs = glob($directory, GLOB_ONLYDIR|GLOB_NOSORT);
	if(count($dirs) > 0){
		$menu .= "<ul>";
		natcasesort($dirs);
		foreach($dirs as $dir){
			$name = str_replace(trim($directory, "*"),"", $dir);
			//$menu .= "<li><a href='$dir'>".$name."</a>";
			$menu .= "<li><a href='#' data-href='$dir' rel='nofollow'>".$name."</a>";
			make_dir_tree($dir."/*");
			$menu .= "</li>";

			# data
			if($store_data) $data[preg_replace(array('/\d+?\./', '/(\.+\/)*content\/*/'), '', $dir)] = str_replace('../../', './', $dir);
		}
		$menu .= "</ul>";
	}
}


if(!isset($core)){
	require_once '../filemanager_core.php';
	$core = new filemanager_core();
}

if($core->isLogin() and isset($_SERVER['HTTP_X_REQUESTED_WITH']) and strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
	$dir = '../../content/*';
	if(isset($_POST['dir'])) $dir = $_POST['dir'].'*';


	$store_data = $dir === '../../content/*';


	make_dir_tree($dir);
	echo $menu;
	flush();

	# data
	if(is_writable('../../app/_cache/pages')) {
		if($store_data){
			$json = phpversion() < 5.4 ? json_encode($data) : json_encode($data, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
			file_put_contents('../../app/_cache/pages/data.json', $json);
		} else {
			chdir('../../');
			include './app/data.inc.php';
			Data::make();
		}
	}
}



?>