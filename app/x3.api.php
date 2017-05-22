<?php

// x3.api.php

if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])
	&& $_SERVER["REQUEST_METHOD"] == "POST"
	&& strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
	&& isset($_POST['action']) && $_POST['action'] === 'audio'
	&& isset($_SERVER['HTTP_REFERER'])
	&& strpos($_SERVER['HTTP_REFERER'],$_SERVER['HTTP_HOST']) !== false
	) {

	header('Content-Type: application/json');
	chdir('../content/custom/audio');
	$files = glob('*.mp3');
	echo json_encode($files, JSON_FORCE_OBJECT);
}

?>