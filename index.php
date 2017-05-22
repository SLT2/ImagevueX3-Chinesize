<?php

// PHP < 5.3
if(version_compare(PHP_VERSION, '5.3.0', '<')){
	include './app/x3.php-outdated.php';

// OK
} else {
	$time_pre = microtime(true);

	# Global paths
	class Config {
	  public static $root_folder = './';
	  public static $app_folder = './app';
	  public static $content_folder = './content';
	  public static $templates_folder = './templates';
	  public static $cache_folder = './app/_cache';
	  public static $extensions_folder = './extensions';
	}

	# Includes
	include './app/cache.inc.php';
	include './app/helpers.inc.php';
	include './app/stacey.inc.php';
	include './app/x3.config.inc.php';
	include './app/asset-types/page.inc.php';

	# Set global X3 Config
	$x3_config = getX3Config();

	# Diagnostics or start App
	if((!$x3_config["settings"]["diagnostics"] && !isset($_GET["diagnostics"])) || (isset($_GET["diagnostics"]) && $_GET["diagnostics"] == 'false')){
		new Stacey($_GET);
	} else {
		require_once './app/x3.diagnostics.php';
	}

}

?>
