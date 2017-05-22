<?php
if (!isset($core))
{
	require_once 'filemanager_core.php';
	$core = new filemanager_core();
    require_once 'filemanager_language.php';
}
if ($core->isLogin())
{
	$core->adminInfo();
?>
<body>

<div class="container">
    <!-- Static navbar -->
    <div class="navbar navbar-inverse" role="navigation" style="z-index: 0;">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <a class="navbar-brand<?php if( $core->db_use ): ?> editProfile<?php endif;?>" href="javascript:;" data-html="true" data-title="" data-delay="0" data-container="body" data-toggle="popover" data-placement="bottom" data-content="" data-trigger="manual"><?php language_filter("Welcome");?>  <?php echo $core->admin_firstname." ".$core->admin_lastname;?></a>
            </div>

            <form class="navbar-form navbar-right" action="javascript:;" onsubmit="return false;" role="search">
                <div class="input-group top_search_input">
                    <span class="input-group-addon top_search_btn" onclick="search = $('#searchInput').val(); if(search == '') {alert('<?php language_filter("Please write a file name", false, true)?>'); return false;} page = 1; loading_from_file = false; countShow = 'all'; if( typeof (here) == 'undefined' ) here='<?php echo ROOT_DIR_NAME;?>'; showFileManager(here); $('#searchInput').val('');"><i class="glyphicon glyphicon-search"></i></span>
                    <input type="text" class="form-control" placeholder="Search files/folders" id="searchInput">
                </div>
            </form>

            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <!--<li class="active" id="homeMenu"><a href="javascript:;"><?php /*language_filter("Backup Files");*/?></a></li>-->
                    <li class="active" id="fileManager"><a href="javascript:;"><?php language_filter("File Manager");?></a></li>
                    <li id="setting"><a href="javascript:;"><?php language_filter("General Setting");?></a></li>
                    <!--<li id="addUser"><a href="javascript:;" ><?php /*language_filter("Add User");*/?></a></li>-->
                    <?php if( $core->db_use ): ?><li id="users"><a href="javascript:;" ><?php language_filter("Users");?></a></li><?php endif;?>
                    <!--<li id="tickets"><a href="javascript:;" onclick="show_what = 'all'; ticket_page = 1;"><?php /*language_filter("Tickets");*/?></a></li>-->
                    <?php if( $core->db_use ): ?><li id="editProfile"><a href="javascript:;"><?php language_filter("Edit Profile");?></a></li><?php endif;?>
                    <li><a href="logout.php"><?php language_filter("Logout");?></a></li>
                </ul>
            </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
    </div>
    <?php
}
else
{
	header("Location: .");
}
?>
