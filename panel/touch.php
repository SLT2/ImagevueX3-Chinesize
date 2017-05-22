<?php

// core
require_once 'filemanager_core.php';
$core = new filemanager_core();

// vars
$file = '../content';
$success = 'Updated!';
$error = 'Cannot update file ' . $file . '. Check file permissions!';
$denied = '<strong>Permission denied</strong><br>You need to <a href=./>login</a> to access this feature.';

// ajax
if($core->isLogin()){
	if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest' && isset($_POST['touch'])) {

		header('Content-Type: application/json');
		if(touch($file)) {
			echo '{ "success": true }';
		} else {
			echo '{ "error": "' . $error . '" }';
		}

	// direct access
	} else {
		if(touch($file)) {

			# echo success
			echo $success;
			flush();

			# build data file
			chdir('../');
			include './app/data.inc.php';
			Data::make();

		} else {
			echo $error;
		}
	}
} else {
	echo $denied;
}

?>