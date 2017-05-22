<?php
if (!isset($core))
{
    require_once '../filemanager_user_core.php';
    $core = new filemanager_user_core();
    $core->userInfo();
    $core->create_user_panel($core->user_id);
    require_once '../filemanager_language_user.php';
}
if ($core->isLogin())
{
?>
<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="<?php language_filter("charset")?>">
      <title><?php language_filter("title");?></title>
      <meta name="robots" content="noindex">
      <meta name="googlebot" content="noindex">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="icon" href="../content/custom/favicon/favicon.png">

      <!-- CSS Stylesheets -->
        <link href='https://cdn.jsdelivr.net/bootstrap/3.0.0/css/bootstrap.min.css' rel='stylesheet' />
        <link href='https://cdn.jsdelivr.net/fontawesome/4.6.1/css/font-awesome.min.css' rel='stylesheet'>
        <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700|Source+Sans+Pro:400,700,700italic,600,600italic,400italic&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
        <link href='filemanager_css/x3.panel.css?v=<?php echo $x3_config["x3_panel_version"]; ?>' rel='stylesheet' />

       	<?php
	      	/* <!-- load custom panel.css from parent of X3 installation if exists --> */
	      	if(file_exists('../../../panel.css')) echo '<style><!--' . file_get_contents('../../../panel.css') . '--></style>';
	      	/* <!-- load custom custom.css from panel folder if exists --> */
	      	if(file_exists('../custom.css'))echo '<style><!--' . file_get_contents('../custom.css') . '--></style>';
	      	/* <!-- load /config/panel.css if exists --> */
	      	if(file_exists('../../config/panel.css'))echo '<style><!--' . file_get_contents('../../config/panel.css') . '--></style>';
      	?>


      <style>
          body {
              padding-top: 20px;
              padding-bottom: 20px;
              direction: <?php echo $language["direction"];?>;
          }
      </style>
  </head>
<?php
}
else
{
    header("Location: .");
}
?>
