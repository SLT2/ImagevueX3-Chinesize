<?php

# Display ALL errors to detect any server issues
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);

# X3 config
if(empty($x3_config)) {
	require_once "x3.config.inc.php";
	global $x3_config;
	$x3_config = getX3Config();
}

# Vars
$file_path = dirname(dirname(__FILE__));
$link_path = dirname($_SERVER['PHP_SELF']) == '/' ? '' : dirname($_SERVER['PHP_SELF']);
$rewrite_base = empty($link_path) ? '/' : $link_path;
$cache_folders = array('pages/','images/rendered/','images/request/');
$server_protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443 || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) ? "https://" : "http://";
define('ABSOLUTE', (string)$server_protocol.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']));
$critical = (string)"";
$warning = (string)"";
$info = (string)"";
$output = (string)"";
$basedir_str = ini_get('open_basedir');
$open_basedir = !empty($basedir_str);

# Get Apache Modules
ob_start();
phpinfo(INFO_MODULES);
global $phpinfo;
$phpinfo = ob_get_clean();


### FUNCTIONS ###


# session_save_path starting with strainge chars
function x3_session_save_path() {
	$s = session_save_path();
	//$s = '4;/gah/phpsessions'; // /gah/phpsessions
	//$s = '/home/12345/data/tmp'; // /home/12345/data/tmp
	if(!empty($s) && strpos($s, '/') !== false && strpos($s, '/') !== 0) {
		$s2 = strstr($s, '/');
		return $s2;
	} else {
		return $s;
	}
}

# Check php ini on
function checkPhpIniOn($name){
	$value = ini_get($name);
	if (empty($value)) {
		return false;
	}
	return ((integer)$value == 1 || strtolower($value) == 'on');
}

# http file exists
function httpFileExists($file){
	$headers = @get_headers($file);
	if(strpos(strtolower($headers[0]), '404 not found') === false) {
		return true;
	}
	return false;
}

# Get server env
function getServerEnv($env){
	return !empty($_SERVER[$env]) ? $_SERVER[$env] : 'undefined';
}

# Checks if has Apache Module
function hasApacheModule($module){
	global $phpinfo;
	if(function_exists('apache_get_modules')) {
		return in_array($module, apache_get_modules());
	} else if(strpos($phpinfo, $module) !== false){
		return true;
	}
	return false;
}

# Checks if has mod_rewrite
function hasModRewrite(){
	if(hasApacheModule('mod_rewrite')) {
		return true;
	} else if(function_exists('shell_exec') && strpos(shell_exec('/usr/local/apache/bin/apachectl -l'), 'mod_rewrite') !== false) {
		return true;
	} else if(file_exists('./public/css/diagnostics.css') && httpFileExists(ABSOLUTE.'/css/diagnostics.css')){
		return true;
	}
	return false;
}

# Checks that mod_rewrite is actually working as expected by X3, based on the htaccess rules
function modRewriteWorking(){
	// make sure file is there
	if(file_exists('./public/css/diagnostics.css')){

		// load by http without 'public', should rewrite
		if(httpFileExists(ABSOLUTE.'/css/diagnostics.css')) {
			return true;

		// mod_rewrite seems to fail
		} else {
			return false;
		}

	// if file is not there, can't perform test
	} else {
		return true;
	}
}

# Add link to attempt to path htaccess with rewriteBase
function patchHtaccesslink(){
	global $x3_config;
	if(file_exists('./.htaccess') && is_writable('./.htaccess') && $x3_config["settings"]["diagnostics"]) {
		return '<br><br><a href="?htaccess_patch">Click here</a> to attempt to patch this automatically.';
	}
	return false;
}

# Function determines if cache folders exist
function cacheExists($f, $file_path){
	$exists = true;
	foreach ($f as &$value) {
    if(!file_exists($file_path.'/app/_cache/'.$value)){
    	$exists = false;
    	break;
    }
	}
	return $exists;
}

# Function determines if cache folders are writeable
function cacheWriteable($f, $file_path){
	$writeable = true;
	foreach ($f as &$value) {
    if(!is_writable($file_path.'/app/_cache/'.$value)){
    	$writeable = false;
    	break;
    }
	}
	return $writeable;
}

# Add item to output
function addItem($status, $title, $description){
	$str = "<div class=\"x3-diagnostics-item x3-diagnostics-".$status."\">";
	if(!empty($title)) $str .= "<strong>".$title."</strong>";
	$str .= "<div class=x3-diagnostics-description>".$description."</div></div>";
	return $str;
}

# Add info to output
function addInfo($title, $description, $state = ''){
	if($state === false) {
		$class = 'bad';
	} else if($state === true){
		$class = 'good';
	} else {
		$class = '';
	}
	return '<tr class='.$class.'><td class=info-title>'.$title.'</td><td class=info-description>'.$description.'</td></tr>';
}

# infoheader function for info table
function infoHeader($header){
	return '<tr class=info-header><td colspan=2>'.$header.'</td></tr>';
}


### CACHE INITIALIZATION ###


# Check that /app/_cache exists
if(!file_exists($file_path.'/app/_cache') && !@mkdir($file_path.'/app/_cache', 0777, true)){
	$critical .= addItem("danger", "Missing Cache Folder", "It seems you are missing the required <code>/app/_cache/</code> folder, and we could not create it automatically. This folder is required so that X3 can save resized images and cache pages.");
}

# Check that /app/_cache is writeable
if(file_exists($file_path.'/app/_cache') && !is_writable($file_path.'/app/_cache')){
	$critical .= addItem("danger", "Cache folder not writeable", "You need to set write permissions on the <code>/app/_cache/</code> folder. This folder needs to be writeable so that X3 can save resized images and cache pages.");
}

# Check if cache folders exist
if(!cacheExists($cache_folders, $file_path)){
	$myfile = $file_path.'/app/_cache/';

	# Create cache folders if they don't exist
	foreach ($cache_folders as &$value) {
    if(!file_exists($myfile.$value)){
    	if(!mkdir($myfile.$value, 0777, true)) {
    		$critical .= addItem("danger", "Can\'t create cache folders", "Can\'t create cache folders inside <code>/app/_cache</code>. Either related to <code>safe_mode</code> or permissions.");
    		break;
			}
    }
	}

	# Check that all newly created cache folders are writeable
	if(!cacheWriteable($cache_folders, $file_path)){
		$critical .= addItem("danger", "Cache folders not writeable", "One or more of the folders in your <code>/app/_cache/</code> folder are not writeable. The cache folders need to be writeable so that X3 can save resized images and cache pages.");
	};

# Check that all cache folders are writeable
} else if(!cacheWriteable($cache_folders, $file_path)){
	$critical .= addItem("danger", "Cache folders not writeable", "One or more of the folders in your <code>/app/_cache/</code> folder are not writeable. The cache folders need to be writeable so that X3 can save resized images and cache pages.");
}


### CRITICAL ###


# Check htaccess allowed
$htaccess_allowed = true;
$htaccess_allowed_checked = false;
if(isset($_SERVER['SERVER_SOFTWARE']) && strpos(strtolower($_SERVER['SERVER_SOFTWARE']), 'apache') !== false && file_exists($file_path.'/.htaccess') && file_exists($file_path.'/config/.htaccess') && file_exists($file_path.'/config/readme.txt') && function_exists('get_headers')) {
	$test_response = @get_headers(ABSOLUTE.'/config/readme.txt');
	if(!empty($test_response)) {
		$htaccess_allowed_checked = true;
		if(strpos($test_response[0], '403') === false && file_exists('./public/css/diagnostics.css') && !httpFileExists(ABSOLUTE.'/css/diagnostics.css')) {
			$critical .= addItem("danger", "Apache .htaccess AllowOverride None", "It seems your Apache config <a href='https://httpd.apache.org/docs/2.4/mod/core.html#allowoverride' target=_blank>AllowOverride</a> is set to <code>AllowOverride None</code>, which does not allow rules from <code>.htaccess</code> files. X3 depends on custom rules set in the <code>.htaccess</code> file to rewrite and create nice URL's for your X3 website. You need to set <code>AllowOverride All</code>.<br>Read more in <a href='http://stackoverflow.com/questions/18740419/how-to-set-allowoverride-all' target=_blank>this post</a>.");
			$htaccess_allowed = false;
		}
	}
}

# Check PHP version
if(phpversion() < 5.3) {
	$critical .= addItem("danger", "PHP Version 5.3+ required", "Imagevue X3 requires PHP 5.3 or higher, and you are currently running PHP version ".phpversion().".");
}

# Check config is populated
if(empty($x3_config) || empty($x3_config["settings"])) {
	$critical .= addItem("danger", "Invalid X3 Config", "The X3 configuration object seems to be empty. Did you upload all files?");
}

# Check that .htaccess exists
if(!file_exists($file_path.'/.htaccess')){
	$critical .= addItem("danger", "Missing .htaccess", "It seems you are missing the required <code>.htaccess</code> file in your root directory. If you can\'t see it, you can rename <strong>disabled.htaccess</strong> to <strong>.htaccess</strong>.");
# Attempting to patch .htaccess with rewriteBase
} else if(isset($_GET["htaccess_patch"]) && !modRewriteWorking() && is_writable('./.htaccess') && $x3_config["settings"]["diagnostics"]){
	if(file_put_contents('./.htaccess', PHP_EOL.'RewriteBase '.$rewrite_base, FILE_APPEND)){
		if(modRewriteWorking()){
			$warning .= addItem("success", "Successfully patched .htaccess!", "Patching the root .htaccess file with the following line seems to fix mod_rewrite for your server:<br><br><code>RewriteBase " . $rewrite_base . "</code><br><br>* You should take note that your server requires the rule above when upgrading X3.");
		} else {
			$warning .= addItem("danger", "Patch failed.", "Although the patch was successfully applied to the .htaccess file, it does not seem to have any effect on mod_rewrite :(");
		}
	} else {
		$warning .= addItem("danger", "Cannot patch .htaccess", "It seems our script is not allowed to write to the root <strong>.htaccess</strong>. You can try to edit it by opening the file in a text editor, and appending the line:<br><code>RewriteBase " . $rewrite_base . "</code>");
	}
# Mod rewrite detected, but not working as expected
} else if(hasModRewrite() && !modRewriteWorking() && $htaccess_allowed){
	$warning .= addItem("warning", "Mod_rewrite not working as expected", "Although we have successfully detected the <a href=http://httpd.apache.org/docs/current/mod/mod_rewrite.html target=_blank>mod_rewrite</a> extension on your server, it does not seem to be working as expected. This extension is necessary in X3 for links to work, and for resized images to load. There is a good chance you simply need to add the following line to your root <strong>.htaccess</strong> file:<br><br><code>RewriteBase " . $rewrite_base . "</code>" . patchHtaccesslink());
# Can't detect mod_rewrite at all
} else if(!hasModRewrite() && $htaccess_allowed){
	$critical .= addItem("danger", "Can't detect mod_rewrite", "We cannot seem to detect the <a href=http://httpd.apache.org/docs/current/mod/mod_rewrite.html target=_blank>mod_rewrite</a> extension on your server. This extension is necessary in X3 for links to work, and for resized images to load. There is a small chance your server has this extension, but we cannot detect it - You can check for this extension by going to <a href=".$link_path."/panel/ target=_blank>Panel</a> › tools › phpinfo, and searching the text for \"mod_rewrite\". If you are 100% certain your server has mod_rewrite, you can try to to add the following line to your root <strong>.htaccess</strong> file:<br><br><code>RewriteBase " . $rewrite_base . "</code>");
}

# Check for APP/CONFIG.DEFAULTS.JSON
if(!file_exists($file_path.'/app/config.defaults.json')){
	$critical .= addItem("danger", "Missing config.defaults.json file", "Where is your <code>/app/config.defaults.json</code> file? This file contains default X3 settings, and is strictly required.");
}

# Check for content folder
if(!file_exists($file_path.'/content')){
	$critical .= addItem("danger", "Where is your content folder?", "Where did your <code>/content</code> folder go?");
}

# GD Extension
if(!extension_loaded('gd') || !function_exists('gd_info')){
	$critical .= addItem("danger", "Missing PHP GD Extension", "Your server PHP is missing the <a href=http://php.net/manual/en/image.installation.php target=_blank>GD Extension</a>, which is required by X3 to resize images.");
}

# Mcrypt is required for non-DB
if(!extension_loaded('mcrypt') && !$x3_config["back"]["panel"]["use_db"]){
	$critical .= addItem("danger", "Missing PHP Mcrypt extension", "Your server PHP is missing the <a href=http://php.net/manual/en/book.mcrypt.php target=_blank>Mcrypt extension</a>, required to encrypt login to the X3 <a href=".$link_path."/panel/ target=_blank>Admin Panel</a>. You can still use the X3 admin panel, if you enable the database-version.");
}

# Check default preview image is set
if(empty($x3_config["image_default"])){
	$critical .= addItem("danger", "Missing Default Preview Image", "You have not set a default preview image for your pages. Login to the <a href=".$link_path."/panel/ target=_blank>Panel</a>, go to <em>Settings › Page › Details › Default Preview Image</em>, and make sure you set a path to a valid image file.");

} else if(!file_exists('./content/'.$x3_config["image_default"])){
	$critical .= addItem("danger", "Default Preview Image does not exist", "The image <strong>" . $x3_config["image_default"] . "</strong>, which you have as default preview image, does not exist. Go to <a href=".$link_path."/panel/ target=_blank>Panel</a> › <em>Settings › Page › Details › Default Preview Image</em>, and set a path to a valid image file.");
}

# Check session_save_path
$session_save_path_result = 'neutral'; // for usage in values list
if(!$open_basedir){
	$session_save_path = x3_session_save_path();//session_save_path();
	if(!empty($session_save_path)) {
		if(!file_exists($session_save_path)) {
			$critical .= addItem("danger", "PHP session.save-path directory does not exist.", "Your server <a href=http://php.net/manual/en/session.configuration.php#ini.session.save-path target=_blank>session.save_path</a> is set to <code>" . $session_save_path . "</code>, but this directory does not exist. Without a correctly set path, you will not be able to login to the panel, because X3 cannot save the login-session. The <code>session.save_path</code> is set from your server php.ini file.<br><br><em>Contact your host!</em>");
			$session_save_path_result = false;
		} else if(!is_writable($session_save_path)){
			$critical .= addItem("danger", "PHP session.save-path directory is not writeable.", "Your server <a href=http://php.net/manual/en/session.configuration.php#ini.session.save-path target=_blank>session.save_path</a> is set to <code>" . $session_save_path . "</code>, but this directory is not writeable. If the session.save-path directory is not writeable, you will not be able to login to the panel, because X3 cannot save the login-session. The <code>session.save_path</code> is set from your server php.ini file.<br><br><em>Contact your host!</em>");
			$session_save_path_result = false;
		}
	}
}



### WARNING ###

# Recommend upgrading PHP 5.3
if(phpversion() < 5.4 && phpversion() >= 5.3) {
	$warning .= addItem("warning", "Deprecated PHP Version 5.3", "Your server is running an old <strong>PHP version ".phpversion()."</strong>. Although X3 supports the PHP 5.3 branch, you should check in your hosting control panel if you can upgrade to a newer version of PHP (5.5+).<br><em>* Upgrading your PHP will ensure best compatibility, security and performance.</em>");
}

# Check database panel login
if($x3_config["back"]["panel"]["use_db"]) {
	if(empty($x3_config["back"]["panel"]["db_host"]) || empty($x3_config["back"]["panel"]["db_user"]) || empty($x3_config["back"]["panel"]["db_pass"]) || empty($x3_config["back"]["panel"]["db_name"])){
		$warning .= addItem("warning", "Missing database details", "You have enabled the database-version of the panel, but one or more database connection details are empty!");
	} else if(function_exists('mysqli_connect')){

		# DB vars
		$dbname = $x3_config["back"]["panel"]["db_name"];
		$dbuser = $x3_config["back"]["panel"]["db_user"];
		$dbpass = $x3_config["back"]["panel"]["db_pass"];
		$dbhost = $x3_config["back"]["panel"]["db_host"];

		# Check DB connection
		# https://www.daniweb.com/programming/web-development/code/434480/using-phpmysqli-with-error-checking
		$connection = @new mysqli($dbhost, $dbuser, $dbpass, $dbname);
		if($connection->connect_errno) {
			$msg = (string)$connection->connect_error;

			# Fail DB HOST
			if(strtolower($msg) === 'no such file or directory'){
				$warning .= addItem("warning", "Panel Database Connection Fail", "Failed to connect to Database HOST <strong>\"" . $dbhost . "\"</strong> (" . $msg . "). Try the X3 <a href=./panel/db_check.php target=_blank>Database connection checker</a>.");

			# Generic DB connection error
			} else {
				$warning .= addItem("warning", "Panel Database Connection Fail", "Failed to connect to Database, with given error: <strong>" . $connection->connect_error . "</strong>. Try the X3 <a href=./panel/db_check.php target=_blank>Database connection checker</a>.");
			}
		} else {
			# Check if is installed
			$query = 'SELECT * FROM `filemanager_db` ORDER BY `id` LIMIT 1';
			$result = $connection->query($query);

			if(!$result) {
				$warning .= addItem("warning", "X3 Panel DB not installed", "Although successfully connected to the database \"" . $dbname . "\", you do not seem to have installed the X3 database panel. Try the <a href=".$link_path."/panel/install/ target=_blank>X3 Panel Install</a> script.");
			} else {
				$fetch = $result->fetch_object();
				if(empty($fetch)) {
					$warning .= addItem("warning", "X3 Panel DB not installed", "Although successfully connected to the database \"" . $dbname . "\", you do not seem to have installed the X3 database panel. Try the <a href=".$link_path."/panel/install/ target=_blank>X3 Panel Install</a> script.");
				}
				$result->close();
			}

			# close connection
			$connection->close();
		}

	}

# Check default panel login
} else if($x3_config["back"]["panel"]["username"] === "admin" && $x3_config["back"]["panel"]["password"] === "admin") {
	$warning .= addItem("warning", "Default Panel Login", "It seems you are using the default Panel login. Please go to <a href=".$link_path."/panel/ target=_blank>X3 Panel</a> › settings › panel, and change the username- and password to secure your website.");
}

# Check that /CONTENT/ folder is writeable
if(file_exists($file_path.'/content') && !is_writeable($file_path.'/content')){
	$warning .= addItem("warning", "Content folder is not writeable", "Your main <code>/content</code> folder is not writeable. You need to set write permissions on this folder if you want to use the X3 Panel to manage your website.");
}

# Check that /config exists
if(!file_exists($file_path.'/config')){
	$warning .= addItem("warning", "Missing config Folder", "Where is your root <code>config</code> folder? This folder should be in your X3 root, and is meant to contain your custom settings and folder passwords.");
} else {
	# Check that config/.htaccess exists
	if(!file_exists($file_path.'/config/.htaccess')){
		$warning .= addItem("warning", "Missing config/.htaccess File", "Where is your <code>config/.htaccess</code> file? This file is necessary to protect your configuration settings from being visible public.");
	}
	# Check that config/ is writeable
	if(!is_writeable($file_path.'/config')) {
		$warning .= addItem("warning", "Config folder is not writeable", "Your root <code>config/</code> folder is not writeable. You need to set permissions on this folder so that the X3 panel can store user settings and folder-passwords here.");
	}
}

# Check for /PANEL
if(!file_exists($file_path.'/panel')){
	$warning .= addItem("warning", "Missing Panel", "The <code>/panel/</code> admin folder seems to be missing. Did you intentionally rename it? <strong>Ok</strong>");
}

# Check preload vs app/_cache/site.json
if($x3_config["settings"]["preload"] && !file_exists($file_path.'/content/site.json') && file_exists($file_path.'/app/_cache/')){
	$warning .= addItem("warning", "Missing Site Object", "You have enabled the <strong>preload</strong> option, but you have not created the required <strong>site object</strong>. If you want to keep the preload option enabled, go to <a href=".$link_path."/panel/ target=_blank>Panel</a> › tools › preload, and create site object.");
}

# Safe Mode
if(ini_get('safe_mode')){
	$warning .= addItem("warning", "PHP Safe Mode On", "Your server is running <a href=http://php.net/manual/en/features.safe-mode.php target=_blank>PHP Safe Mode</a>. This feature will most likely prevent the X3 <a href=".$link_path."/panel/ target=_blank>Admin Panel</a> from being able to save changes, and is therefore not supported. Safe Mode was deprecated as of PHP 5.3.0 and removed as of PHP 5.4.0.");
}

# Suhosin
if(extension_loaded('suhosin')){
	$warning .= addItem("warning", "Suhosin detected!", "Your server seems to be running the <a href=http://suhosin.org/ target=_blank>Suhosin</a> PHP security extension. Depending on how Suhosin is configured on your server, it could prevent X3 from working properly. If you are lucky, it will behave nicely.");
}

# Non-Apache warning
if(isset($_SERVER['SERVER_SOFTWARE']) && strpos(strtolower($_SERVER['SERVER_SOFTWARE']), 'apache') === false){
	$warning .= addItem("warning", "Non-Apache Server", "It seems you are running a different server than standard <a href=https://httpd.apache.org/ target=_blank>Apache</a>. Imagevue X3 normally works fine under other environments like Win IIS and Nginx, but the custom <code>.htaccess</code> file currently only works correctly for Apache. Therfore, there is a fair chance that links and images in your X3 website will not work. We hope to offer config-conversions of the .htaccess file for other servers soon. Your Server Software:<br><br><code>".$_SERVER['SERVER_SOFTWARE']."</code>");
}

# Open basedir warning
if($open_basedir){
	$warning .= addItem("warning", "PHP open_basedir restriction", "Your server seems to have PHP <a href=http://php.net/manual/en/ini.core.php#ini.open-basedir target=_blank>open_basedir</a> restriction. X3 will still work, but it will not be able to flush expired html/php cache files. The open_basedir setting is primarily used to prevent PHP scripts from accessing files in another user's account ... Unfortunately, it also mistakingly prevents the X3 PHP script from deleting it's own html/php cache files.");
}



### EXTENDED ###

if(isset($_GET["diagnostics"])) {

	# PHPinfo
	$info .= addInfo('PHP Version', phpversion(), phpversion() >= 5.3);

	# PHP TESTS
	//$info .= infoHeader('Tests');

	# Safe Mode
	$safe_mode = ini_get('safe_mode');
	$info .= addInfo('Safe Mode', $safe_mode ? 'on' : 'off', !$safe_mode);

	# Open Basedir
	//$open_basedir = ini_get('open_basedir') ? true : false;
	$info .= addInfo('Open Basedir', $open_basedir ? 'on' : 'off', !$open_basedir);

	# UTF-8
	$utf8 = function_exists('preg_match') && @preg_match('/^.$/u', 'ñ') && @preg_match('/^\pL$/u', 'ñ');
	$info .= addInfo('UTF-8 Support', $utf8 ? 'on' : 'off', $utf8);

	# php file uploads
	$file_uploads = checkPhpIniOn('file_uploads');
	$info .= addInfo('PHP File Uploads', $file_uploads ? 'on' : 'off', $file_uploads);

	# SMTP
	$smtp = strlen(ini_get('SMTP')) > 0;
	$info .= addInfo('SMTP', $smtp ? 'on' : 'off', $smtp);

	# htaccess AllowOverride
	if($htaccess_allowed_checked) $info .= addInfo('.htaccess <small>AllowOverride</small>', $htaccess_allowed ? 'All' : 'None', $htaccess_allowed ? true : false);


	# PHP EXTENSIONS
	$info .= infoHeader('PHP Extensions');

	# GD extension
	$gd_extension = extension_loaded('gd') && function_exists('gd_info');
	$info .= addInfo('GD Extension', $gd_extension ? 'on' : 'off', $gd_extension);

	# mysqli
	$mysqli_extension = function_exists('mysqli_connect');
	$info .= addInfo('Mysqli Extension', $mysqli_extension ? 'on' : 'off', $mysqli_extension);

	# mcrypt
	$mcrypt_extension = extension_loaded('mcrypt');
	$info .= addInfo('Mcrypt Extension', $mcrypt_extension ? 'on' : 'off', $mcrypt_extension);

	# iconv
	$iconv_extension = extension_loaded('iconv');
	$info .= addInfo('Iconv Extension', $iconv_extension ? 'on' : 'off', $iconv_extension);

	# mbstring
	$mbstring_extension = extension_loaded('mbstring');
	$info .= addInfo('Mbstring Extension', $mbstring_extension ? 'on' : 'off', $mbstring_extension);

	# exif
	$exif_extension = extension_loaded('exif');
	$info .= addInfo('Exif Extension', $exif_extension ? 'on' : 'off', $exif_extension);


	# MODS
	$info .= infoHeader('Apache Mods');

	# Mod Rewrite
	$has_modrewrite = hasModRewrite();
	$info .= addInfo('Mod Rewrite', $has_modrewrite ? 'on' : 'undetectable', $has_modrewrite);

	# Mod Deflate
	$mod_deflate = hasApacheModule('mod_deflate');
	$info .= addInfo('Mod Deflate', $mod_deflate ? 'on' : 'undetectable', $mod_deflate);

	# Mod Setenvif
	$mod_setenvif = hasApacheModule('mod_setenvif');
	$info .= addInfo('Mod Setenvif', $mod_setenvif ? 'on' : 'undetectable', $mod_setenvif);

	# Mod Mime
	$mod_mime = hasApacheModule('mod_mime');
	$info .= addInfo('Mod Mime', $mod_mime ? 'on' : 'undetectable', $mod_mime);

	# Mod Headers
	$mod_headers = hasApacheModule('mod_headers');
	$info .= addInfo('Mod Headers', $mod_headers ? 'on' : 'undetectable', $mod_headers);

	# Mod Security
	$mod_security = hasApacheModule('mod_security');
	$info .= addInfo('Mod Security', $mod_security ? 'on' : 'off');


	# VALUES
	$info .= infoHeader('Values');

	# memory limit
	$info .= addInfo('PHP Memory Limit', ini_get('memory_limit'), ini_get('memory_limit'));

	# php upload max file size
	$info .= addInfo('Upload Max File Size', ini_get('upload_max_filesize'), ini_get('upload_max_filesize'));

	# Max file uploads
	$info .= addInfo('Max File Uploads', ini_get('max_file_uploads'), ini_get('max_file_uploads'));

	# Post max size
	$info .= addInfo('Post Max Size', ini_get('post_max_size'), ini_get('post_max_size'));

	# Max input vars
	$info .= addInfo('Max Input Vars', ini_get('max_input_vars'), ini_get('max_input_vars'));

	# Time Zone
	$tz = ini_get('date.timezone');
	$info .= addInfo('Default Timezone', empty($tz) ? 'Not specified' : date_default_timezone_get(), empty($tz) ? false : 'neutral');

	# session_save_path
	$session_save_path = x3_session_save_path();//session_save_path()
	$info .= addInfo('Session Save Path', empty($session_save_path) ? '<em>empty</em>' : $session_save_path, $session_save_path_result);


	# VARIABLES
	$info .= infoHeader('Variables');

	# Server Name
	$info .= addInfo('SERVER_NAME', getServerEnv('SERVER_NAME'), getServerEnv('SERVER_NAME') !== 'undefined' ? '' : false);

	# Document Root
	$info .= addInfo('DOCUMENT_ROOT', getServerEnv('DOCUMENT_ROOT'), getServerEnv('DOCUMENT_ROOT') !== 'undefined' ? '' : false);

	# Script Name
	$info .= addInfo('SCRIPT_NAME', getServerEnv('SCRIPT_NAME'), getServerEnv('SCRIPT_NAME') !== 'undefined' ? '' : false);

	# Script Filename
	$info .= addInfo('SCRIPT_FILENAME', getServerEnv('SCRIPT_FILENAME'), getServerEnv('SCRIPT_FILENAME') !== 'undefined' ? '' : false);

	# Server Software
	$info .= addInfo('SERVER_SOFTWARE', getServerEnv('SERVER_SOFTWARE'), getServerEnv('SERVER_SOFTWARE') !== 'undefined' ? '' : false);

}



### OUTPUT ###

if(!empty($critical)) $output .= "<h2>Critical Issues</h2>".$critical;
if(!empty($warning)) $output .= "<h2>Warnings</h2>".$warning;

# OK!
if(empty($output)) {
	if(isset($_GET["diagnostics"])){
		$output .= addItem("success", "Everything seems to be OK!", "Nothing to report here.");
	} else {
		$output .= addItem("success", "Everything seems to be OK!", "Go to your <a href=".$link_path."/panel/ target=_blank>Panel</a> › settings › settings and disable diagnostics.");
	}

# Only warnings
} else if(empty($critical)){
	$output = addItem("success", "Server OK", "There are no critical issues, but we recommend resolving the warnings below if possible. Once satisfied, you may proceed to <a href=".$link_path."/panel/ target=_blank>Panel</a> › settings › settings and disable diagnostics.") . $output;

# Only Critical
} else if(empty($warning)){
	$output = addItem("neutral", null, "Once critical issues are resolved, proceed to <a href=".$link_path."/panel/ target=_blank>Panel</a> › settings › settings and disable diagnostics.") . $output;

# Both Critical and Warnings
} else {
	$output = addItem("neutral", null, "Once critical issues are resolved, proceed to <a href=".$link_path."/panel/ target=_blank>Panel</a> › settings › settings and disable diagnostics.") . $output;
}

# Extended diagnostics
if(!empty($info)) $output .= "<h2>Extended Diagnostics</h2><table class=info>".$info."</table>";


### HTML ###


?>
<head>
<title>X3 Diagnostics</title>
<meta name="robots" content="noindex, nofollow">
<link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400italic,600' rel='stylesheet' type='text/css'>
<style><!--
<?php echo file_get_contents($file_path."/public/css/diagnostics.css"); ?>
--></style>
</head>
<body>
	<div class=x3-diagnostics>
		<h1>X3 Diagnostics <?php echo (class_exists("Stacey")) ? "<small>v.".Stacey::$version."</small>" : ""; ?></h1>
		<div class=x3-diagnostics-wrapper>
			<?php echo $output; ?>
		</div>
	</div>
</body>