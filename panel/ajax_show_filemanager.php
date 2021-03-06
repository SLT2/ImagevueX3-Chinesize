<?php
if (!isset($core))
{
	require_once 'filemanager_core.php';
	$core = new filemanager_core();
    require_once 'filemanager_language.php';
}
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest')
{
    if ($core->isLogin())
    {
        if(isset($_POST["showFilemanager"]) and $core->role == "admin")
        {
            $core->adminInfo();
            if ($_POST["showFilemanager"] == $core->admin_id)
            {
                $show_root = true;
                $path = ROOT_DIR_NAME;
                if( !is_dir(ROOT_DIR_NAME) )
                {
                    mkdir(ROOT_DIR_NAME);
                }
                $post_path = $_POST["my_dir_path"];
                if($_POST["root"] == 0 && file_exists($post_path))
                {
                    $show_root = false;
                    $path = $_POST["my_dir_path"];
                }
                if(isset($_POST["sort_type"]))
                {
                    $sort_with = '$_POST["sort_type"]';
                }
                else
                {
                    $sort_with = 'name';
                }

                $page = 1;
                $countShow = "all";
                $search = '';
                if(isset($_POST["search"]))
                {
                    $search = $_POST["search"];
                }

                $path = $core->dir_file_clear_str( $path );
                $root = new filemanager_show_from_root($show_root, $path, $sort_with, $search);
                $navigation_url = str_replace("ajax_show_filemanager.php", "navigate.php", $root->curPageURL());
                $fullCount = count($root->root_files_folders);
                $core->page($page, $fullCount, $countShow);
                $have_action = $_POST["have_action"];
                $_folder_name = explode( "/", $path );
                $folder_name = end( $_folder_name );
                $page_id = str_replace("/", "_", str_replace(".", "_", str_replace("../", "", $path)));
    ?>

                <div class="row x3-manager" id="page_<?php if($search != "") { echo 'search'; } else { echo $page_id; } ?>">
                    <div class="col-md-12">
                        <ol class="breadcrumb">
                        <?php
                        $exp = explode("/", $path);

                        for($j = 0; $j < count($exp); $j++)
                        {
                            if($exp[$j] == "")
                            {
                                unset($exp[$j]);
                            }
                        }
                        $exp = array_values($exp);
                        $back_link = '';
                        $exp_count = count($exp);
                        $_home_dir_name = explode("/", ROOT_DIR_NAME);
                        $home_dir_name = end( $_home_dir_name );
                        for($j = 0; $j < $exp_count; $j++)
                        {
                            if($exp[$j] != "")
                            {
                                $back[] = $exp[$j];
                                for($k = 0; $k < count($back); $k++)
                                {
                                    $back_link .= $back[$k].'/';
                                }
                                unset($back);
                                if($j == ($exp_count - 1))
                                {
                                    if($exp[$j] == "..")
                                        echo '';
                                    elseif($exp[$j] == $home_dir_name)
                                        echo '<li class="active">'.language_filter("Home", true).'</li>';
                                    else
                                        echo '<li class="active">'.$exp[$j].'</li>';
                                }
                                else
                                {
                                    if($exp[$j] == "..")
                                    {
                                        echo '';
                                    }
                                    elseif($exp[$j] == $home_dir_name)
                                    {
                                        echo '<li><a href="javascript:;" onclick="loading_from_file = false; showFileManager(\'\')">'.language_filter("Home", true).'</a></li>';
                                    }
                                    else
                                    {
                                        echo '<li><a href="javascript:;" onclick="loading_from_file = false; showFileManager(\''.$back_link.'\')">'.$exp[$j].'</a></li>';
                                    }
                                }

                            }
                        }
                            $folder_title = $exp[$exp_count - 1];
                            if($folder_title == $home_dir_name) $folder_title = "Content";
                            $folder_name = $folder_title;
                            if($search != "") $folder_title = language_filter("Search results for", true)." ".$search;
                          ?>
                    </ol>

                       <div class="manage_box_show">
                           <div class="col-md-3">
                           <div id=menu-container>
                               <h3><?php language_filter( "Folder_Menu" );?></h3><hr />
                               <div id="show_left_sidebar_box">
                                   <div id="show_left_sidebar"></div>
                               </div>
                           </div>
                           </div>

                            <div class="col-md-9">
                                <div class="current-folder-btns" <?php if( $search != "" ){ ?> style="display: none" <?php }?>>
                                    <div class="btn-group btn-group-sm">
                                        <button type="button" class="btn btn-default btn-group-filemanager" <?php if( $show_root or $folder_name == "" ) { echo 'disabled="disabled"'; } else {?>onclick="rename_dir('<?php echo addslashes($path);?>', '<?php echo addslashes($folder_name);?>', 'first'); $('#showConf').modal('show');"<?php }?>><?php language_filter("Rename");?></button>
                                        <button type="button" class="btn btn-default btn-group-filemanager" <?php if( $show_root or $folder_name == "" ) { echo 'disabled="disabled"'; } else {?>onclick="rename_dir('<?php echo addslashes($path);?>', '<?php echo addslashes($folder_name);?>', 'move'); $('#showConf').modal('show');"<?php }?>><?php language_filter("Move");?></button>
                                        <button type="button" class="btn btn-default btn-group-filemanager" <?php if( $show_root or $folder_name == "" ) { echo 'disabled="disabled"'; } else {?>onclick="copy_dir('<?php echo addslashes($path);?>', '<?php echo addslashes($folder_name);?>', 'first'); $('#showConf').modal('show');"<?php }?>><?php language_filter("Copy");?></button>
                                        <button type="button" class="btn btn-default  btn-group-filemanager" <?php if( $show_root or $folder_name == "" ) { echo 'disabled="disabled"'; } else {?>onclick="remove_dir('<?php echo addslashes($path);?>', '<?php echo addslashes($folder_name);?>', 'first'); $('#showConf').modal('show');"<?php }?> title="<?php language_filter("Remove");?>"><?php language_filter("Delete");?></button>
                                    </div>
                                    <button type="button" class="btn btn-info btn-group-filemanager btn-sm" onclick="showUploader('<?php echo addslashes($path);?>')" data-toggle="modal" data-target="#uploader"><span class="glyphicon glyphicon-chevron-up"></span> &nbsp;<?php language_filter("Upload");?></button>
                                    <button type="button" class="btn btn-info btn-group-filemanager btn-sm" data-toggle="modal" data-target="#newFolder"><span class="glyphicon glyphicon-plus"></span> &nbsp;<?php language_filter("New Folder");?></button>
                                </div>
                                <h3><?php echo $folder_title;?></h3>
                                <hr />
                                <ul class="nav nav-tabs" id="myTab">
                                    <?php if( $search == "" ){ ?><li class="active"><a href="#page" data-toggle="tab" onclick="/*setTimeout(function(){editor.refresh();},0);setTimeout(function(){editor.refresh();},100);*/"><?php language_filter("Settings");?></a></li><?php }?>
                                    <li><a href="#gallery" data-toggle="tab"><?php language_filter("Gallery");?></a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="page">
                                        <div>

                                            <div class="row x3-page-settings">
																                <div class="container"></div>
																            </div>

                                        </div>
                                    </div>
                                    <div class="tab-pane" id="gallery">
                                        <?php
                                        //if($search == '')
                                        //{
                                        ?>
                                        <div <?php if($fullCount == '') { echo 'style="display: none;"';};?> class=manage-list-buttons>
                                        		

                                        		<div class="col-md-5 list-actions">

                                        				<button class="btn btn-default btn-sm" id="select_all" onclick="select_all();" data-title="<?php language_filter("Select All");?>" data-select="<?php language_filter("Select All");?>" data-unselect="<?php language_filter("Unselect All")?>"><span class="glyphicon glyphicon-check"></span></button>

                                        				<button type="button" class="btn btn-default btn-sm btn-view" data-title="<?php language_filter("Change_List_View");?>"><span class="glyphicon glyphicon-list"></span></button>

																								<button type="button" class="btn btn-default btn-sm btn-sort" data-sortby="<?php language_filter("Sort by");?>" data-date="<?php language_filter("Sort date");?>" data-sort="<?php language_filter("Sort name");?>" data-filesize="<?php language_filter("Sort size");?>"  data-custom="Custom"><span class="glyphicon glyphicon-sort-by-alphabet"></span></button>

                                                <span class="button-helper"></span>
                                               

                                        			</div>

                                            <div class="col-md-7 text-right selected-actions">
                                        				<span class=selected-text data-lang="<?php language_filter("selected_Folders_Files")?>">0 <?php language_filter("selected_Folders_Files")?></span>
                                                <div class="btn-group btn-group-sm">
                                                    <button type="button" class="btn btn-default btn-group-filemanager" onclick="$('#container_id_tree2').html('<div class=\'alert alert-info\'><center><b><?php language_filter("Choose your target directory.", false, true);?></b></center></div>'); if(selected == '' || selected == null) alert('<?php language_filter("Please select files and folders", false, true);?>'); else $('#moveSelected').modal('show');"><?php language_filter("Move");?></button>
                                                    <button type="button" class="btn btn-default btn-group-filemanager" onclick="$('#container_id_tree3').html('<div class=\'alert alert-info\'><center><b><?php language_filter("Choose your target directory.", false, true);?></b></center></div>'); if(selected == '' || selected == null) alert('<?php language_filter("Please select files and folders", false, true);?>'); else $('#copySelected').modal('show');"><?php language_filter("Copy");?></button>
                                                    <button type="button" class="btn btn-default btn-group-filemanager" onclick="if(selected == '' || selected == null) alert('<?php language_filter("Please select files and folders", false, true);?>'); else $('#newzipFile').modal('show');"><?php language_filter("Zip");?></button>
                                                    <button type="button" class="btn btn-default btn-group-filemanager" onclick="if(selected == '' || selected == null) alert('<?php language_filter("Please select files and folders", false, true);?>'); else check_selected_files_folders();"><?php language_filter("Delete");?></button>
                                                    <?php /* commented
                                                    <!-- <button type="button" class="btn btn-default btn-group-filemanager" onclick="if(selected == '' || selected == null) alert('<?php language_filter("Please select files and folders", false, true);?>'); else $('#download_files').modal('show');"><?php language_filter("Download");?></button>
                                                    <button type="button" class="btn btn-default btn-group-filemanager" onclick="if(selected == '' || selected == null) alert('<?php language_filter("Please select files and folders", false, true); ?>'); else $('#share_files').modal('show');"><?php language_filter("Share"); ?></button>
                                                    <button type="button" class="btn btn-default btn-group-filemanager" onclick="if(selected == '' || selected == null) alert('<?php language_filter("Please select files and folders", false, true); ?>'); else $('#newbackupFile').modal('show');"><?php language_filter("Backup");?></button>
                                                    <button type="button" class="btn btn-default btn-group-filemanager" data-toggle="modal" data-target="#siteMap" onclick="showTree()"><?php language_filter("Site Map"); ?></button> --> */ ?>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        //}
                                        ?>


                                        <div class="table-responsive view-small manage-container">
                                        <div class="fixed-save"><button type="button" data-loading-text="Saving ..." class="btn btn-primary save-page btn-lg"><?php language_filter("Save");?></button></div>
                                            <table class="table manage-table">
                                            	<tbody class=popup-parent>
                                                <?php
                                                //$count = count($root->root_files_folders);
                                                if($fullCount == '')
                                                {
                                                    echo '<div class="alert alert-info"><center><b>'.language_filter("NO FILES AND FOLDERS", true).'</b></center></div>';
                                                }
                                                else
                                                {
                                                    /*echo '<tr>
                                                            <th style="text-align: center;"><button class="btn btn-default btn-xs select-btn-filemanager" onclick="select_all()" id="select_all">'.language_filter("Select All", true).'</button></th>
                                                            <th style="">'.language_filter("Open / Download / View", true).'</th>
                                                            <th style="text-align: center;">'.language_filter("Size", true).'</th>
                                                            <!--<th style="text-align: center;">'.language_filter("Permission", true).'</th>
                                                            <th style="text-align: center;">'.language_filter("Last Activity Time", true).'</th>-->
                                                            <th style="text-align: center;">'.language_filter("Setting", true).'</th>
                                                         </tr>';*/
                                                    for ($i = $core->start; $i < $core->end; $i++)
                                                    {
                                                        $is_zip = 0;
                                                        if($show_root)
                                                            $fileAddress[$i] = ROOT_DIR_NAME."/". $root->root_files_folders[$i];
                                                        else
                                                        {
                                                            $fileAddress[$i] = $path.'/'.$root->root_files_folders[$i];
                                                            $fileAddress[$i] = str_replace($path.'/'.$path.'/', $path.'/', $fileAddress[$i]); // debug search
                                                        }

                                                        if( $search != '' ) {
                                                            $fileAddress[$i] = $root->root_files_folders[$i];
                                                        }

                                                        $fileSize[$i] = $root->formatBytes($fileAddress[$i]);
                                                        $fileTime[$i] = date ("Y/m/d H:i:s", filemtime($fileAddress[$i]));
                                                        $filePerm[$i] = substr(sprintf('%o', fileperms($fileAddress[$i])), -4);
                                                        $navigate = "";
                                                        if(is_dir($fileAddress[$i]))
                                                        {
                                                            $is_file = 0;
                                                            $is_editable_file = 0;
                                                            $is_img = 0;
                                                            $ext = '';
                                                            $navigate = $navigation_url."?redirect=".base64_encode(utf8_encode($fileAddress[$i]));
                                                        }
                                                        else
                                                        {
                                                            $is_file = 1;
                                                            $is_editable_file = 0;
                                                            $is_img = 0;
                                                            $ext = pathinfo($fileAddress[$i], PATHINFO_EXTENSION);
                                                            $ext = strtolower($ext);
                                                            if($ext == "zip")
                                                            {
                                                                $is_zip = 1;
                                                            }

                                                            if($ext == "txt")
                                                            {
                                                                if(is_writable($fileAddress[$i]))
                                                                {
                                                                    $is_editable_file = 1;
                                                                }
                                                            }

                                                            if($ext == "jpg" or $ext == "png" or $ext == "gif" or $ext == "jpeg")
                                                            {
                                                                $is_img = 1;
                                                                list($image_width, $image_height) = getimagesize($fileAddress[$i]);
                                                            }
                                                        }

                                                        $exploded = explode("/", $root->root_files_folders[$i]);
                                                        $filename = (($search != '') ? end($exploded) : $root->root_files_folders[$i]);

                                                        ?>
                                                        <tr id="row<?php echo $i;?>" class="manual_border_top" data-name="<?php if($search != '') { $_root_files_folders = explode("/", $root->root_files_folders[$i]); echo end( $_root_files_folders ); } else echo $root->root_files_folders[$i];?>" data-path="<?php echo $fileAddress[$i] ?>" data-encoded="<?php echo $fileAddress[$i] ?>" data-ext="<?php echo $ext ?>" data-isfile="<?php echo $is_file ?>" data-isimage="<?php echo $is_img ?>" data-filesize="<?php echo $fileSize[$i] ?>" data-date="<?php echo $fileTime[$i] ?>">

                                                            <td class=td-checkbox><input type="checkbox" id="check_<?php echo $i;?>" value="<?php echo $root->root_files_folders[$i];?>" onclick="set_selected(this.value, <?php echo $i;?>, this.checked);"></td>

                                                            <td class=td-name>
                                                            <a href='<?php if($is_img == 1) echo $fileAddress[$i]; else echo "javascript:;";?>' <?php if($is_img == 1) echo "class='popup' data-width=".$image_width." data-height=".$image_height." data-name='".$filename."' data-filesize='".$fileSize[$i]."' rel='group1'";?> onclick="show_this_dir_file('<?php echo $is_file;?>', '<?php echo $is_zip;?>', '<?php echo $is_img;?>', '<?php echo addslashes($fileAddress[$i]);?>', '<?php echo base64_encode(utf8_encode($fileAddress[$i]));?>')" style="<?php if($is_file == 0) echo 'color: #9933ff;'; else echo 'color: #3366cc;';?>"><img src="<?php if($is_file == 1 and $is_zip == 1) echo 'filemanager_assets/img.php?img=zip'; elseif($is_file == 0) echo 'filemanager_assets/img.php?img=directory'; else if($is_file == 1 and $is_img == 1) echo 'filemanager_assets/img.php?img=picture'; else echo 'filemanager_assets/img.php?img=file';?>" style="margin-right: 5px;" /><?php if($search != '') { $_root_files_folders = explode("/", $root->root_files_folders[$i]); echo end( $_root_files_folders ); } else echo $root->root_files_folders[$i];?></a></td>

                                                            <?php /* commented
                                                            <td style="text-align: center;"><?php echo $filePerm[$i]; ?></td>
                                                            <td style="text-align: center;"><?php echo $fileTime[$i]; ?></td> */ ?>

                                                            <td class=td-button>
                                                                <?php
                                                                if($search != '')
                                                                {
                                                                    $navigate_dir =  $root->root_files_folders[$i];

                                                                    if( is_file( $navigate_dir ) ) {
                                                                        $nav_path = '';
                                                                        if(strpos($navigate_dir, "../") === FALSE)
                                                                        {
                                                                            $nav_path = "../";
                                                                        }
                                                                        $navigate_dir = explode("/", $navigate_dir);
                                                                        $nav_count = count($navigate_dir);
                                                                        for($k = 0; $k < $nav_count; $k++)
                                                                        {
                                                                            if($k == $nav_count - 1)
                                                                            {
                                                                                unset($navigate_dir[$k]);
                                                                            }
                                                                        }
                                                                        $navigate_dir = array_values($navigate_dir);

                                                                        $navigate_dir = $nav_path.implode("/", $navigate_dir);
                                                                    }
                                                                    else {
                                                                        $navigate_dir = $fileAddress[$i];
                                                                        $navigate_dir = str_replace(ROOT_DIR_NAME."/".ROOT_DIR_NAME."/", ROOT_DIR_NAME."/", $navigate_dir); //debug home search
                                                                    }
                                                                    echo '<button type="button" class="btn btn-primary btn-xs" onclick="have_action = \'yes\'; navigate_to_path(\''.addslashes($navigate_dir).'\'); " >'.language_filter("Go to directory", true).'</button>';
                                                                }
                                                                else
                                                                {
                                                                    ?>
                                                                    


<?php /* commented
<button class="btn btn-xs btn-info" type="button" onclick="show_config('<?php echo addslashes($navigate);?>', '<?php echo $is_file;?>', '<?php echo $is_zip;?>', '<?php echo addslashes($fileAddress[$i]);?>', '<?php echo addslashes($root->root_files_folders[$i]);?>', '<?php echo $is_editable_file;?>', '<?php echo $is_img;?>')"><span class="glyphicon glyphicon-cog"></span></button> */ ?>


<!-- X3 filemanger dropdown button -->
<?php if($search != '') { $myname = end( $_root_files_folders ); } else { $myname = $root->root_files_folders[$i]; } ?>
<div class="btn-group">
  <button type="button" class="btn btn-xs btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
    <span class="glyphicon glyphicon-wrench"></span>
  </button>
  <ul class="dropdown-menu dropdown-menu-right pull-right text-left" role="menu">
  <li role="presentation" class="dropdown-header"><?php echo $myname;?></li>
<?php if($is_file): ?>
    <li><a href="#" onclick="remove_file('<?php echo $fileAddress[$i];?>', '<?php echo $myname;?>','first'); $('#showConf').modal('show');"><?php language_filter("Remove");?></a></li>
    <li><a href="#" onclick="rename_file('<?php echo $fileAddress[$i];?>', '<?php echo $myname;?>','first'); $('#showConf').modal('show');"><?php language_filter("Rename");?></a></li>
    <li><a href="#" onclick="rename_file('<?php echo $fileAddress[$i];?>', '<?php echo $myname;?>','move'); $('#showConf').modal('show');"><?php language_filter("Move");?></a></li>
    <li><a href="#" onclick="copy_file('<?php echo $fileAddress[$i];?>', '<?php echo $myname;?>','first'); $('#showConf').modal('show');"><?php language_filter("Copy");?></a></li>
<?php else: ?>
    <li><a href="#" onclick="remove_dir('<?php echo $fileAddress[$i];?>', '<?php echo $myname;?>','first'); $('#showConf').modal('show');"><?php language_filter("Remove");?></a></li>
    <li><a href="#" onclick="rename_dir('<?php echo $fileAddress[$i];?>', '<?php echo $myname;?>','first'); $('#showConf').modal('show');"><?php language_filter("Rename");?></a></li>
    <li><a href="#" onclick="rename_dir('<?php echo $fileAddress[$i];?>', '<?php echo $myname;?>','move',true); $('#showConf').modal('show');"><?php language_filter("Move");?></a></li>
    <li><a href="#" onclick="copy_dir('<?php echo $fileAddress[$i];?>', '<?php echo $myname;?>','first',true); $('#showConf').modal('show');"><?php language_filter("Copy");?></a></li>
<?php endif; ?>
	</ul>
</div>


																																		<?php /* commented
                                                                    <a href="<?php if($is_file == 0) echo 'javascript:;'; elseif($is_img == 0 and $is_editable_file == 0){ echo 'javascript:;';} else{if($is_img == 1) echo "edit_img.php?info=".base64_encode(utf8_encode($fileAddress[$i])); if($is_editable_file) echo "edit_file.php?info=".base64_encode(utf8_encode($fileAddress[$i]));} ?>" target="_blank" class="btn btn-xs btn-info" type="button" <?php if($is_file == 0) echo 'disabled="disabled"'; else{if($is_img == 0 and $is_editable_file == 0) echo 'disabled="disabled"';}?> ><span class="glyphicon glyphicon-edit"></span></a> */ ?>

                                                                    <?php
                                                                }
                                                                ?>
                                                            </td>
                                                            <td class=td-filesize><?php echo $fileSize[$i];?></td>
                                                        </tr>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                                </tbody>
                                                </table>
                                        </div>
                                    </div>
                                </div>

                            </div>
                       </div>
                    </div>
                </div>

            <div class="modal" id="showConf" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="confLable"></h4>
                        </div>

                        <div class="modal-body" id="container_id_tree">

                        </div>

                        <div class="modal-footer" id="confButton" style="text-align: left;">

                        </div>
                    </div>
                </div>
            </div>

            <div class="modal" id="siteMap" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="myModalLabel_map"><?php language_filter("Site Map");?></h4>
                        </div>
                        <div class="modal-body" id="container_id">

                        </div>
                        <div class="modal-footer">
                            <div class="form-group">
                                <div class="col-xs-5">
                                    <input type="text" disabled="disabled" id="navigate_input" class="form-control">
                                </div>
                                <div class="col-xs-7">
                                    <button type="button" class="btn btn-default" onclick="navigate_to = '';" data-dismiss="modal"><?php language_filter("Cancel")?></button>
                                    <button type="button" class="btn btn-primary" onclick="navigate_to_path(navigate_to); navigate_to = '';" data-dismiss="modal"><?php language_filter("Navigate_to")?></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal" id="uploader" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="myModalLabel_upload"><?php language_filter("Upload"); ?></h4>
                        </div>
                        <div class="modal-body" id="show_uploader">
                            <?php language_filter("Loading...");?>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal" onclick="show_preloader(); setTimeout(function(){loading_from_file = false; hide_preloader(); have_action = 'yes'; showFileManager('<?php if($show_root == false) echo addslashes($path);?>')}, 1000)"><?php language_filter("Click to see uploaded files.");?></button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal" id="newFolder" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="myModalLabel_folder"><?php language_filter("Create New Folder");?></h4>
                        </div>
                        <div class="modal-body">
                        		<i class="panel-help fa fa-question-circle" data-help=new_folder></i>
                        		<label for="new_folder">Create New folder in <span class='path'></span></label>
                            <input type="text" class="form-control input-folder" id="new_folder" placeholder="1.foldername" style="margin-top: 3px;" />
                            <span>&nbsp;</span>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-default" data-dismiss="modal"><?php language_filter("Cancel");?></button>
                            <button class="btn btn-primary btn-key" type="button"><?php language_filter("Create");?></button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal" id="newzipFile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="myModalLabel_zip"><?php language_filter("Create Zip File");?></h4>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-info" style="text-align: center; font-weight: bold;"><?php language_filter("Please write zip file name without extension.");?></div>
                        </div>
                        <div class="modal-footer">
                            <div class="form-group col-md-4">
                                <input type="text" class="form-control" id="new_zip" placeholder="Zip File Name" style="float: left; margin-top: 0px;" onchange="set_new_zipFile_name(this.value);"/>
                            </div>
                            <button class="btn btn-default" data-dismiss="modal"><?php language_filter("Cancel");?></button>
                            <button class="btn btn-success btn-key" type="button" onclick="create_zip();"><?php language_filter("Create");?></button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal" id="newbackupFile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="myModalLabel_backup"><?php language_filter("Create Backup");?></h4>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-info" style="text-align: center; font-weight: bold;"><?php language_filter("Please write zip file name without extension.");?></div>
                        </div>
                        <div class="modal-footer">
                            <div class="form-group col-md-4">
                                <input type="text" class="form-control" id="new_zip_backup" placeholder="<?php language_filter("Zip File Name");?>" style="float: left; margin-top: 0px;" onchange="set_new_zipFile_name(this.value);"/>
                            </div>
                            <button class="btn btn-default" data-dismiss="modal"><?php language_filter("Cancel");?></button>
                            <button class="btn btn-success" type="button" onclick="create_backup();"><?php language_filter("Create");?></button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal" id="removeSelected" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="myModalLabel_folders"><?php language_filter("Remove Selected Files And Folders");?></h4>
                        </div>
                        <div class="modal-body">
                            <?php language_filter("Do you want to remove selected files and folders");?>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-default" data-dismiss="modal" aria-hidden="true"><?php language_filter("Cancel");?></button>
                            <button class="btn btn-danger" type="button" onclick="remove_selected();"><?php language_filter("Remove");?></button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal" id="moveSelected" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="myModalLabel_move"><?php language_filter("Move Selected Files And Folders");?></h4>
                        </div>
                        <div class="modal-body" id="container_id_tree2">

                        </div>
                        <div class="modal-footer">
                            <div class="form-group col-md-4">
                                <input type="text" class="form-control" id="selected_move" placeholder="<?php language_filter("New Folder Path");?>" style="float: left; margin-top: 0px;" onchange="set_new_name(this.value);"/>
                            </div>
                            <button class="btn btn-default" data-dismiss="modal" aria-hidden="true"><?php language_filter("Cancel");?></button>
                            <button class="btn btn-info" type="button" onclick="showInlineTree();"><?php language_filter("Browse")?></button>
                            <button class="btn btn-primary" type="button" onclick="move_selected();"><?php language_filter("Move")?></button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal" id="copySelected" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="myModalLabel_copy"><?php language_filter("Copy Selected Files And Folders");?></h4>
                        </div>
                        <div class="modal-body" id="container_id_tree3">

                        </div>
                        <div class="modal-footer">
                            <div class="form-group col-md-4">
                                <input type="text" class="form-control" id="selected_copy" placeholder="<?php language_filter("New Folder Path");?>" style="float: left; margin-top: 0px;" onchange="set_new_name(this.value);" />
                            </div>
                            <button class="btn btn-default" data-dismiss="modal"><?php language_filter("Cancel");?></button>
                            <button class="btn btn-info" type="button" onclick="showInlineTree();"><?php language_filter("Browse");?></button>
                            <button class="btn btn-primary" type="button" onclick="copy_selected();"><?php language_filter("Copy");?></button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal" id="share_files" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="myModalLabel_share"><?php language_filter("Share");?></h4>
                        </div>
                        <div class="modal-body">
                            <form class="form-horizontal" role="form">
                                <div class="form-group">
                                    <label for="send_to" class="col-sm-2 control-label"><?php language_filter("Send to");?></label>
                                    <div class="col-sm-9">
                                        <input type="email" class="form-control" id="send_to" placeholder="email@example.com">
                                    </div>
                                    <div class="col-sm-1" style="margin-top: 7px;">
                                        <span class="glyphicon glyphicon-plus-sign" style="cursor: pointer;" onclick="add_send_to();"></span>
                                    </div>
                                </div>
                                <div id="send_to_place">

                                </div>
                                <div class="form-group">
                                    <label for="send_to" class="col-sm-2 control-label"><?php language_filter("Send to");?></label>
                                    <div class="col-sm-10">
                                        <textarea id="extra_send_to" class="form-control" rows="3" placeholder="email@example.com,email2@example.com,email3@example.com,email4@example.com,email5@example.com"></textarea>
                                    </div>
                                </div>
                                <hr />
                                <div class="form-group">
                                    <label for="from" class="col-sm-2 control-label"><?php language_filter("From");?></label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" id="from" placeholder="email@example.com">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="from" class="col-sm-2 control-label"><?php language_filter("subject");?></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="subject" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="message" class="col-sm-2 control-label"><?php language_filter("Message");?></label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" rows="4" id="message"></textarea>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal"><?php language_filter("Cancel")?></button>
                            <button type="button" class="btn btn-warning" onclick="download_selected_files();"><?php language_filter("Download")?></button>
                            <button type="button" class="btn btn-primary" onclick="share_selected_files();"><?php language_filter("Share")?></button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal" id="download_files" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="myModalLabel_download"><?php language_filter("Download");?></h4>
                        </div>
                        <div class="modal-body">
                            <p><?php language_filter("Do_you_want_to_download_selected_files_or_folders"); ?></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal"><?php language_filter("Cancel")?></button>
                            <button type="button" class="btn btn-primary" onclick="download_selected_files();"><?php language_filter("Download")?></button>
                        </div>
                    </div>
                </div>
            </div>

                <script type="text/javascript">
                // X3 prevent default event for filemanager dropdown
                $('.btn-group .dropdown-menu').on('click', 'a', function(event) {
                	event.preventDefault();
                });

                 new_name = "";
                 filext = "";
                 is_root = '<?php if($show_root) echo "true"; else echo "false";?>';
                 this_dir_path = "";
                 this_file_path = "";
                 here = ("<?php echo $path;?>").replace(/\/$/, '');
                 is_rename = false;
                 is_move = false;
                 new_folder_path = "";
                 selected = new Array();
                 zip_file_name = "";
                 this_dir_selected = "";
                 old_name = "";
                 new_file_per = "";
                 navigate_to = "";
                 send_to_counter = 1;
                 <?php
                     if(is_array($root->root_files_folders))
                     {
                         if(!empty($root->root_files_folders))
                         {
                            $all_files_folders = implode(", ", $root->root_files_folders);
                         }
                     }
                     else
                     {
                        $all_files_folders = "";
                     }
                 ?>

                <?php if($search != "" or $have_action == "yes") echo "$('#myTab a:last').tab('show');"; else echo "$('#myTab a:first').tab('show');";?>

                function navigate_to_path(navigate_to)
                {
                    if(navigate_to == "")
                    {
                        alert('<?php language_filter("Select_nav_error", false, true);?>');
                        return false;
                    }
                    if(navigate_to == "../") navigate_to = '';
                    show_preloader();
                    setTimeout(function(){
                        hide_preloader();
                        showFileManager(navigate_to);
                    }, 1000);
                }

                 function download_selected_files()
                 {
                     $("#download_files").modal("hide");
                     show_preloader();
                     setTimeout(function(){
                         $.post("ajax_manage_dir.php",
                         {
                             download_selected:selected,
                             this_path:here
                         },
                         function(data,status)
                         {
                             if(status == "success")
                             {
                                 if(data != "false")
                                 {
                                     show_errors_on_nav('<?php language_filter("Please wait to get the download started", false, true)?>', 'green');
                                     document.location = data;
                                     return false;
                                 }
                                 else
                                 {
                                     show_errors_on_nav('<?php language_filter("Can not download selected files", false, true)?>', 'red');
                                     return false;
                                 }
                             }
                             else
                             {
                                 alert("Error: " + status);
                                 hide_preloader();
                             }
                         });
                     }, 1000);
                 }

                 /*function select_all()
                 {
                 		 var select_all = $("#select_all")
                     var ischecked = (select_all.attr('title') == "<?php language_filter("Select All")?>");
                     var start = <?php echo $core->start;?>;
                     var count = <?php echo $core->end;?>;
                     var value = new Array(<?php if(is_array($root->root_files_folders)) {for ($j = $core->start; $j < $core->end; $j++){ if($j == ($core->end - 1)){echo "\"".addslashes($root->root_files_folders[$j])."\"";}else{echo "\"".addslashes($root->root_files_folders[$j])."\", ";} } }?>);
                     if(ischecked)
                     {
                         //$("#select_all").html("<?php language_filter("Unselect All")?>");
                         select_all.attr('title', '<?php language_filter("Unselect All")?>');
                         select_all.addClass('active');
                         for(var i = start; i < count; i++)
                         {
                             document.getElementById("check_"+i).checked = true;
                         }
                         selected = value;
                     }
                     else
                     {
                         //$("#select_all").html("<?php language_filter("Select All")?>");
                         select_all.attr('title', '<?php language_filter("Select All")?>');
                         select_all.addClass('active');
                         for(var i = start; i < count; i++)
                         {
                             document.getElementById("check_"+i).checked = false;
                         }
                         selected = new Array();
                     }
                     console.log('selected: '+selected);
                 }*/

                 function copy_selected()
                 {
                     document.getElementById('selected_copy').value = "";
                     $("#copySelected").modal("hide");
                     show_preloader();
                     setTimeout(function(){
                         $.post("ajax_manage_dir.php",
                         {
                             copy_selected:selected,
                             this_path:here,
                             copy_path:new_name
                         },
                         function(data,status)
                         {
                             if(status == "success")
                             {
                                 have_action = "yes";
                                 if(data == "true")
                                 {
                                     loading_from_file = '<?php language_filter("Files and folders has been copied.", false, true);?>';
                                     loading_from_file_status = "green";
                                     reload_sidebar = true;
                                 }
                                 else
                                 {
                                     loading_from_file = '<div class="alert alert-error"><center><?php language_filter("Error! Can not copy", false, true)?> '+data+'.</center></div>';
                                     loading_from_file_status = "red";
                                 }
                                 if(is_root == 'true')
                                     showFileManager('');
                                 else
                                     showFileManager(here);
                             }
                             else
                             {
                                 alert("Error: " + status);
                                 hide_preloader();
                             }
                         });
                     }, 1000);
                 }

                 function move_selected()
                 {
                     $("#moveSelected").modal("hide");
                     show_preloader();
                     setTimeout(function(){
                         $.post("ajax_manage_dir.php",
                         {
                             move_selected:selected,
                             this_path:here,
                             move_path:new_name
                         },
                         function(data,status)
                         {
                             have_action = "yes";
                             if(status == "success")
                             {
                                 if(data == "true")
                                 {
                                     loading_from_file = '<?php language_filter("Files and folders has been moved.", false, true);?>';
                                     loading_from_file_status = "green";
                                     reload_sidebar = true;
                                 }
                                 else
                                 {
                                     loading_from_file = '<?php language_filter("Error! Can not move", false, true);?> '+data+'.';
                                     loading_from_file_status = "red";
                                 }
                                 if(is_root == 'true')
                                     showFileManager('');
                                 else
                                     showFileManager(here);
                             }
                             else
                             {
                                 alert("Error: " + status);
                                 hide_preloader();
                             }
                         });
                     }, 1000);
                 }

                function remove_selected()
                {
                    $("#removeSelected").modal("hide");
                    show_preloader();
                    setTimeout(function(){
                        $.post("ajax_manage_dir.php",
                        {
                            remove_selected:selected,
                            this_path:here
                        },
                        function(data,status)
                        {
                            if(status == "success")
                            {
                                have_action = "yes";
                                if(data == "true")
                                {
                                    loading_from_file = '<?php language_filter("Files and folders has been removed.", false, true);?>';
                                    loading_from_file_status = "green";
                                    reload_sidebar = true;
                                }
                                else
                                {
                                    loading_from_file = '<?php language_filter("Error! Can not remove", false, true);?> '+data+'. <?php language_filter("Please Wait...", false, true);?>';
                                    loading_from_file_status = "red";
                                }
                                if(is_root == 'true')
                                    showFileManager('');
                                else
                                    showFileManager(here);
                            }
                            else
                            {
                                alert("Error: " + status);
                                hide_preloader();
                            }
                        });
                    }, 1000);
                }

                function check_selected_files_folders()
                {
                    if(selected == "" || selected == null)
                    {
                        alert('<?php language_filter("Please select files and folders", false, true);?>');
                    }
                    else
                    {
                        $("#removeSelected").modal('show');
                    }
                }

                 function showUploader(uploadDir)
                 {
                    $.post("filemanager_uploader.php",
                     {
                         upload_dir:uploadDir
                     },
                     function(data,status)
                     {
                         if(status == "success")
                         {
                            $("#show_uploader").html(data);
                         }
                         else
                         {
                            alert("Error: " + status);
                         }
                     });
                 }

                function set_selected(value, id, checker)
                {
                    if(checker == true)
                    {
                        if(!in_array(selected, value))
                        {
                            selected.push(value);
                        }
                    }
                    else
                    {
                        if(in_array(selected, value))
                        {
                            removeItem(selected, value);
                        }
                    }
                }

                function removeItem(array, item)
                {
                    for(var i in array)
                    {
                        if(array[i]==item)
                        {
                            array.splice(i,1);
                            break;
                        }
                    }
                }

                function in_array(array, id)
                {
                    for(var i=0;i<array.length;i++)
                    {
                        if(array[i] === id)
                        {
                            return true;
                        }
                    }
                    return false;
                }

                function showTree()
                {
                    $('#container_id').fileTree({
                        root: '<?php echo ROOT_DIR_NAME ?>/',
                        script: 'jqueryFileTree.php',
                        expandSpeed: 500,
                        collapseSpeed: 500,
                        multiFolder: false
                    }, function(file) {
                        navigate_to = "";
                        if(file == ".." || file == "..." || file == "....")
                        {
                            navigate_to = "../";
                        }
                        else
                        {
                            var myString = file;
                            var stringLength = myString.length;
                            var lastChar = myString.charAt(stringLength - 1);
                            if(lastChar == "/" || lastChar == "\\")
                            {
                                navigate_to = file;
                            }
                            else
                            {
                                myString = myString.split("/");
                                myString.pop();
                                myString = myString.join("/")+"/";
                                navigate_to = myString;
                            }
                        }
                        $("#navigate_input").val(navigate_to);
                    });
                }

                function showInlineTree()
                {
                    var loop_start = <?php echo substr_count(ROOT_DIR_NAME, "../");?>;
                    $('#container_id_tree').fileTree({
                        root: '<?php echo ROOT_DIR_NAME?>/',
                        script: 'jqueryFileTree.php',
                        expandSpeed: 500,
                        collapseSpeed: 500,
                        multiFolder: false
                    }, function(file) {
                        var set_back_slashes = '';
                        if(is_root == "truez") // X3 disable
                        {
                            var real_name_show = file.replace('<?php echo ROOT_DIR_NAME?>/', '');
                        }
                        else
                        {
                            var real_name_show = file.replace('<?php echo ROOT_DIR_NAME?>/', '../');
                            var create_back = here.split("/");
                            removeItem(create_back, "");

                            create_back = create_back.length;

                            var debug = here.split("/");
                            removeItem(debug, "");
                            create_back -= 2;
                            for(var j = 0; j < debug.length; j++)
                            {
                                if(debug[j] == "" && j != (debug.length - 1))
                                {
                                    create_back += 2;
                                    create_back -= 3;
                                    break;
                                }
                            }


                            if(create_back >= 1)
                            {
                                for(var i = loop_start; i < create_back; i++)
                                {
                                    set_back_slashes += '../';
                                }
                            }

                        }


                        real_name_show = real_name_show.substring(0, real_name_show.length - 1);
                        var copy_new_name = document.getElementById('copy_new_name');

                        if(copy_new_name != null)
                        {
                            if(is_root == "true")
                                document.getElementById('copy_new_name').value = real_name_show+old_name;
                            else
                            {
                                document.getElementById('copy_new_name').value = set_back_slashes+real_name_show+old_name;
                            }

                            filext = document.getElementById('rename_new_ext').value;
                        }
                        var rename_new_name = document.getElementById('rename_new_name');
                        if(rename_new_name != null)
                        {
                            if(is_root == "true")
                                document.getElementById('rename_new_name').value = real_name_show+old_name;
                            else
                            {
                                document.getElementById('rename_new_name').value = set_back_slashes+real_name_show+old_name;

                            }
                            filext = document.getElementById('rename_new_ext').value;
                        }

                        var copy_new_name_dir = document.getElementById('copy_new_name_dir');
                        if(copy_new_name_dir != null)
                        {
                            if(is_root == "true")
                                document.getElementById('copy_new_name_dir').value = real_name_show+old_name;
                            else
                            {
                                document.getElementById('copy_new_name_dir').value = set_back_slashes+real_name_show+old_name;
                            }

                            filext = '';
                        }

                        var rename_new_name_dir = document.getElementById('rename_new_name_dir');
                        if(rename_new_name_dir != null)
                        {
                            if(is_root == "true")
                                document.getElementById('rename_new_name_dir').value = real_name_show+old_name;
                            else
                            {
                                document.getElementById('rename_new_name_dir').value = set_back_slashes+real_name_show+old_name;
                            }

                            filext = '';
                        }
                        set_new_name(set_back_slashes+real_name_show+old_name);
                    });

                    $('#container_id_tree2').fileTree({
                        root: '<?php echo ROOT_DIR_NAME?>/',
                        script: 'jqueryFileTree.php',
                        expandSpeed: 500,
                        collapseSpeed: 500,
                        multiFolder: false
                    }, function(file) {
                        var set_back_slashes = '';
                        if(is_root == "true")
                        {
                            var real_name_show = file.replace('<?php echo ROOT_DIR_NAME?>/', '');
                        }
                        else
                        {
                            var real_name_show = file.replace('<?php echo ROOT_DIR_NAME?>/', '../');;
                            var create_back = here.split("/");
                            removeItem(create_back, "");
                            create_back = create_back.length;
                            var debug = here.split("/");
                            removeItem(debug, "");
                            create_back -= 2;
                            for(var j = 0; j < debug.length; j++)
                            {
                                if(debug[j] == "" && j != (debug.length - 1))
                                {
                                    create_back += 2;
                                    create_back -= 3;
                                    break;
                                }
                            }


                            if(create_back >= 1)
                            {
                                for(var i = loop_start; i < create_back; i++)
                                {
                                    set_back_slashes += '../';
                                }
                            }

                        }

                        real_name_show = real_name_show.substring(0, real_name_show.length - 1);
                        var selected_copy = document.getElementById('selected_move');
                        if(selected_copy != null)
                        {
                            if(is_root == "true")
                                document.getElementById('selected_move').value = real_name_show+old_name;
                            else
                            {
                                document.getElementById('selected_move').value = set_back_slashes+real_name_show+old_name;
                            }
                        }
                        set_new_name(set_back_slashes+real_name_show);
                    });

                    $('#container_id_tree3').fileTree({
                        root: '<?php echo ROOT_DIR_NAME?>/',
                        script: 'jqueryFileTree.php',
                        expandSpeed: 500,
                        collapseSpeed: 500,
                        multiFolder: false
                    }, function(file) {
                        var set_back_slashes = '';
                        if(is_root == "true")
                        {
                            var real_name_show = file.replace('<?php echo ROOT_DIR_NAME?>/', '');
                        }
                        else
                        {
                            var real_name_show = file.replace('<?php echo ROOT_DIR_NAME?>/', '../');
                            var create_back = here.split("/");
                            removeItem(create_back, "");
                            create_back = create_back.length;
                            var debug = here.split("/");
                            removeItem(debug, "");
                            create_back -= 2;
                            for(var j = 0; j < debug.length; j++)
                            {
                                if(debug[j] == "" && j != (debug.length - 1))
                                {
                                    create_back += 2;
                                    create_back -= 3;
                                    break;
                                }
                            }

                            if(create_back >= 1)
                            {
                                for(var i = loop_start; i < create_back; i++)
                                {
                                    set_back_slashes += '../';
                                }
                            }
                        }

                        real_name_show = real_name_show.substring(0, real_name_show.length - 1);
                        var selected_copy = document.getElementById('selected_copy');
                        if(selected_copy != null)
                        {
                            if(is_root == "true")
                                document.getElementById('selected_copy').value = real_name_show+old_name;
                            else
                            {
                                document.getElementById('selected_copy').value = set_back_slashes+real_name_show+old_name;
                            }
                        }
                        set_new_name(set_back_slashes+real_name_show);
                    });
                }

                 function show_this_dir_file(is_file, is_zip, is_img, name, download)
                 {
                    if(is_file == 0)
                    {
                        page = 1;
                        this_dir_path = name;
                        showFileManager(this_dir_path);
                    }
                    else
                    {
                        if(is_img == 0) window.open("download.php?show="+download, "download.php?show="+download);
                    }
                 }

                 function show_config(navigate, is_file, is_zip, name, index, is_editable_file, is_img)
                 {
                    $('#container_id_tree').html('<?php language_filter("What do you want to do now", false, true);?>');
                    $("#confLable").html(index);
                    $("#confButton").html('<button class="btn btn-default" data-dismiss="modal" aria-hidden="true"><?php language_filter("Cancel", false, true);?></button>');
                    if(is_file == 0)
                    {
                        if(navigate != "")
                        {
                            var user_navigate = navigate.replace("filemanager_admin", "filemanager_user");
                            var html = $('#container_id_tree').html();
                            $('#container_id_tree').html('<p>'+html+'</p><div class="form-group"><label><?php language_filter('Navigate url', false, true)?></label><input type="text" class="form-control" onclick="this.select();" value="'+navigate+'"/></div><div class="form-group"><label><?php language_filter('Navigate_url_user1', false, true)?><small> ( <?php language_filter('Navigate_url_user2', false, true)?> ) </small></label><input type="text" class="form-control" onclick="this.select();" value="'+user_navigate+'"/></div>');
                        }
                        $("#confButton").html($("#confButton").html()+'<button class="btn btn-danger" onclick="remove_dir(\''+name+'\', \''+index+'\',\'first\')"><?php language_filter("Remove", false, true);?></button>');
                        $("#confButton").html($("#confButton").html()+'<button class="btn btn-warning" onclick="rename_dir(\''+name+'\', \''+index+'\',\'first\')"><?php language_filter("Rename", false, true);?></button>');
                        $("#confButton").html($("#confButton").html()+'<button class="btn btn-primary" onclick="rename_dir(\''+name+'\', \''+index+'\',\'move\')"><?php language_filter("Move", false, true);?></button>');
                        $("#confButton").html($("#confButton").html()+'<button class="btn btn-info" onclick="copy_dir(\''+name+'\', \''+index+'\',\'first\')"><?php language_filter("Copy", false, true);?></button>');
                    }
                    else
                    {
                        $("#confButton").html($("#confButton").html()+'<button class="btn btn-danger" onclick="remove_file(\''+name+'\', \''+index+'\',\'first\')"><?php language_filter("Remove", false, true);?></button>');
                        $("#confButton").html($("#confButton").html()+'<button class="btn btn-warning" onclick="rename_file(\''+name+'\', \''+index+'\',\'first\')"><?php language_filter("Rename", false, true);?></button>');
                        $("#confButton").html($("#confButton").html()+'<button class="btn btn-primary" onclick="rename_file(\''+name+'\', \''+index+'\',\'move\')"><?php language_filter("Move", false, true);?></button>');
                        $("#confButton").html($("#confButton").html()+'<button class="btn btn-info" onclick="copy_file(\''+name+'\', \''+index+'\',\'first\')"><?php language_filter("Copy", false, true);?></button>');
                        //$("#confButton").html($("#confButton").html()+'<button class="btn btn-success" onclick="change_per(\''+name+'\', \''+index+'\',\'first\')">Edit Permission</button>');
                        if(is_zip == 1)
                        {
                            $("#confButton").html($("#confButton").html()+'<button class="btn btn-inverse" onclick="unZip(\''+name+'\', \''+index+'\',\'first\');"><?php language_filter("Unzip", false, true);?></button>');
                        }
                    }
                    var copy_new_name = document.getElementById('copy_new_name');
                    if(copy_new_name != null)
                    {
                        document.getElementById('copy_new_name').value = '';
                    }
                    var rename_new_name = document.getElementById('rename_new_name');
                    if(rename_new_name != null)
                    {
                        document.getElementById('rename_new_name').value = '';
                    }

                     $("#showConf").modal("show");
                 }

                function unZip(name, index, time)
                {
                    if(time == 'first')
                    {
                        $("#confLable").html('<?php language_filter("Unzip", false, true)?> ' + index);
                        $('#container_id_tree').html('<?php language_filter("Do you want to unzip this file", false, true);?>');
                        $("#confButton").html('<button class="btn btn-default" data-dismiss="modal" aria-hidden="true"><?php language_filter("Cancel", false, true);?></button><button class="btn btn-inverse" onclick="unZip(\''+name+'\', \''+index+'\', \'u\')"><?php language_filter("Unzip", false, true);?></button>');
                    }
                    else
                    {
                        $("#showConf").modal("hide");
                        show_preloader();
                        setTimeout(function(){
                            $.post("ajax_manage_dir.php",
                            {
                                un_zip:name,
                                path_location:here
                            },
                            function(data,status)
                            {
                                have_action = "yes";
                                if(status == "success")
                                {
                                    if(data == "true")
                                    {
                                        loading_from_file = '<?php language_filter("File has been unzipped.", false, true);?>';
                                        loading_from_file_status = "green";
                                    }
                                    else
                                    {
                                        loading_from_file = '<?php language_filter("File has not been unzipped.", false, true);?>';
                                        loading_from_file_status = "red";
                                    }
                                    if(is_root == 'true')
                                        showFileManager('');
                                    else
                                        showFileManager(here);
                                }
                                else
                                {
                                    alert("Error: " + status);
                                    hide_preloader();
                                }
                            });
                        }, 1000);
                    }
                }

                function rename_file(name, index, time)
                {
                    filext = name.substr((Math.max(0, name.lastIndexOf(".")) || Infinity) + 1);
                    filext = '.'+filext;
                    var val = index.replace(/\.[^/.]+$/, '');
                    if(time == "first")
                    {
                        is_rename = true;
                        $("#confLable").html('<?php language_filter("Rename", false, true);?> ' + index);
                        $('#container_id_tree').html('');
                        $('#container_id_tree').html('<?php language_filter("Write a new name.", false, true)?>');
                        $("#confButton").html('<div class="row"><div class="col-xs-6"><input type="text" class="form-control" id="rename_new_name" placeholder="<?php language_filter("New File Name", false, true);?>" style="float: left; margin-top: 0px;" onchange="is_rename = true; set_new_name(this.value);" value="'+val+'" /><input type="hidden" class="input-small" id="rename_new_ext" value="'+filext+'" style="float: left; margin-top: 0px;" onchange="//filext = this.value;"/></div><div class="col-xs-6"><button class="btn btn-default" data-dismiss="modal" aria-hidden="true"><?php language_filter("Cancel", false, true);?></button><button class="btn btn-success btn-key" onclick="rename_file(\''+name+'\', \''+index+'\', \'r\')"><?php language_filter("Rename", false, true);?></button></div></div>');
                    }
                    else if(time == "move")
                    {
                        $("#confLable").html('<?php language_filter("Move", false, true);?> ' + index);
                        $('#container_id_tree').html('');
                        $('#container_id_tree').html('<?php language_filter("Choose your target directory.", false, true);?>');
                         old_name = name.replace(here, "");
                         old_name = old_name.replace(filext, "");
                        is_move = true;
                        $("#confButton").html('<div class="row"><div class="col-xs-6"><input type="text" class="form-control input-move" id="rename_new_name" placeholder="<?php language_filter("New File Path", false, true)?>" style="float: left; margin-top: 0px;" onchange="is_move = true; set_new_name(this.value);"/><input type="hidden" class="input-small" id="rename_new_ext" value="'+filext+'" style="float: left; margin-top: 0px;" onchange="//filext = this.value;"/></div><div class="col-xs-6"><button class="btn btn-default" data-dismiss="modal" aria-hidden="true"><?php language_filter("Cancel", false, true)?></button><button class="btn btn-info" onclick="showInlineTree()"><?php language_filter("Browse", false, true);?></button><button class="btn btn-success" onclick="rename_file(\''+name+'\', \''+index+'\', \'m\')"><?php language_filter("Move", false, true)?></button></div></div>');
                    }
                    else
                    {
                         $("#showConf").modal("hide");

                         var user_name = new_name;

                         var last_char = name.split("/");
                         last_char[last_char.length-1] = last_char[last_char.length-1].replace(index, new_name);
                         new_name = last_char.join("/");
                         show_preloader();
                         setTimeout(function(){
                             $.post("ajax_manage_dir.php",
                             {
                                 filename:name,
                                 newName:new_name
                             },
                             function(data,status)
                             {
                                 have_action = "yes";
                                 if(status == "success")
                                 {
                                     if(data == "true")
                                     {
                                         if(time == 'r')
                                             var error_text = "<?php language_filter("File has been renamed", false, true);?>";
                                         if(time == 'm')
                                             var error_text = "<?php language_filter("File has been moved", false, true);?>";
                                         loading_from_file = error_text;
                                         loading_from_file_status = "green";
                                     }
                                     else
                                     {
                                         if(time == 'r')
                                             var error_text = "<?php language_filter("File has not been renamed", false, true);?>";
                                         if(time == 'm')
                                             var error_text = "<?php language_filter("File has not been moved", false, true);?>";
                                         loading_from_file = error_text;
                                         loading_from_file_status = "red";
                                     }
                                     if(is_root == 'true')
                                         showFileManager('');
                                     else
                                         showFileManager(here);
                                 }
                                 else
                                 {
                                     alert("Error: " + status);
                                     hide_preloader();
                                 }
                             });
                         }, 1000);
                     }
                }

                 function copy_file(name, index, time)
                 {
                     filext = name.substr((Math.max(0, name.lastIndexOf(".")) || Infinity) + 1);
                     filext = '.'+filext;
                     if(time == "first")
                     {
                         $("#confLable").html('<?php language_filter("Copy", false, true)?> ' + index);
                         $('#container_id_tree').html('');
                         $('#container_id_tree').html('<?php language_filter("Choose your target directory.", false, true)?>');
                         old_name = name.replace(here, "");
                         old_name = old_name.replace(filext, "");
                         $("#confButton").html('<div class="row"><div class="col-xs-6"><input type="text" class="form-control" id="copy_new_name" placeholder="<?php language_filter("New Folder Path", false, true)?>" style="float: left; margin-top: 0px;" onchange="set_new_name(this.value);"/></div><input type="hidden" class="form-control" id="rename_new_ext" value="'+filext+'" style="float: left; margin-top: 0px;" onchange="//filext = this.value;"/><div class="col-xs-6"><button class="btn btn-default" data-dismiss="modal" aria-hidden="true"><?php language_filter("Cancel", false, true);?></button><button class="btn btn-info" onclick="showInlineTree()"><?php language_filter("Browse", false, true);?></button><button class="btn btn-success" onclick="copy_file(\''+name+'\', \''+index+'\', \'rename\')"><?php language_filter("Copy", false, true);?></button></div></div>');
                     }
                     else
                     {

                         $("#showConf").modal("hide");
                         var user_name = new_name;
                         var last_char = name.split("/");
                         last_char[last_char.length-1] = last_char[last_char.length-1].replace(index, new_name);
                         new_name = last_char.join("/");
                         //return false;
                         show_preloader();
                         setTimeout(function(){
                             $.post("ajax_manage_dir.php",
                             {
                                 filename:name,
                                 newName:new_name,
                                 copy_this:'ok'
                             },
                             function(data,status)
                             {
                                 have_action = "yes";
                                 if(status == "success")
                                 {
                                     if(data == "true")
                                     {
                                         loading_from_file = '<?php language_filter("File has been copied.", false, true);?>';
                                         loading_from_file_status = "green";
                                     }
                                     else
                                     {
                                         loading_from_file = '<?php language_filter("File has not been copied.", false, true);?>';
                                         loading_from_file_status = "red";
                                     }
                                     if(is_root == 'true')
                                         showFileManager('');
                                     else
                                         showFileManager(here);
                                 }
                                 else
                                 {
                                     alert("Error: " + status);
                                     hide_preloader();
                                 }
                             });
                         }, 1000);
                     }
                 }

                function remove_file(name, index, time)
                 {
                    if(time == "first")
                    {
                        $("#confLable").html('<?php language_filter("Remove", false, true)?> ' + index);
                        $("#container_id_tree").html('<?php language_filter("Do you want to remove this file", false, true);?>');
                        $("#confButton").html('<button class="btn btn-default" data-dismiss="modal" aria-hidden="true"><?php language_filter("Cancel", false, true)?></button><button class="btn btn-danger" onclick="remove_file(\''+name+'\', \''+index+'\',\'rename\')"><?php language_filter("Remove", false, true)?></button>');
                    }
                    else
                    {
                        $("#showConf").modal("hide");
                        show_preloader();
                        setTimeout(function(){
                            $.post("ajax_manage_dir.php",
                            {
                                removeFileName:name
                            },
                            function(data,status)
                            {
                                have_action = "yes";
                                if(status == "success")
                                {
                                    if(data == "true")
                                    {
                                        loading_from_file = '<?php language_filter("File has been deleted.", false, true);?>';
                                        loading_from_file_status = "green";
                                    }
                                    else
                                    {
                                        loading_from_file = '<?php language_filter("File has not been deleted.", false, true);?>';
                                        loading_from_file_status = "red";
                                    }
                                    if(is_root == 'true')
                                        showFileManager('');
                                    else
                                        showFileManager(here);
                                }
                                else
                                {
                                    alert("Error: " + status);
                                    hide_preloader();
                                }
                            });
                        }, 1000);
                    }
                 }

                 function rename_dir(name, index, time)
                 {		
                 			//here = context ? name : here;
                 			name = name.replace(/\/$/, '');
                 			/*context = context || false;
                 			if(context) {
                 				var old_here = here;
                 				here = name;
                 			}*/
                 		var index_warning = name.match('.index$') || name.match('/index$') ? '<div class="alert alert-danger" role="alert">确实要重命名index主页吗？</div>' : '';

                     if(time == "first")
                     {
                         $("#confLable").html('<?php language_filter("Rename", false, true)?> ' + index);
                         $('#container_id_tree').html('');
                         $('#container_id_tree').html(index_warning + '<?php language_filter("Write a new name.", false, true);?><div class=modal-help>* Make sure to save any unsaved settings before you rename a folder.</div>');
                         $("#confButton").html('<div class="row"><div class="col-xs-6"><input type="text" class="form-control is-dir" id="rename_new_name" placeholder="<?php language_filter("New Folder Name", false, true)?>" style="float: left; margin-top: 0px;" onchange="is_rename = true; set_new_name(this.value);" value="'+index+'" /></div><div class="col-xs-6"><button class="btn btn-default" data-dismiss="modal" aria-hidden="true"><?php language_filter("Cancel", false, true)?></button><button class="btn btn-success btn-key" onclick="rename_dir(\''+name+'\', \''+index+'\', \'r\')"><?php language_filter("Rename", false, true)?></button></div></div>');

                     }
                     else if(time == "move")
                     {
                         $("#confLable").html('<?php language_filter("Move", false, true)?> ' + index);
                         $('#container_id_tree').html('');
                         $('#container_id_tree').html('<?php language_filter("Choose your target directory.", false, true)?>');
                         old_name = name.replace(here, "");
                         old_name = old_name.replace(filext, "");
                         is_move = true;
                         $("#confButton").html('<div class="row"><div class="col-xs-6"><input type="text" class="form-control is-dir" id="rename_new_name_dir" placeholder="<?php language_filter("New Folder Path", false, true)?>" style="float: left; margin-top: 0px;" onchange="is_move = true; set_new_name(this.value);"/></div><div class="col-xs-6"><button class="btn btn-default" data-dismiss="modal" aria-hidden="true"><?php language_filter("Cancel", false, true);?></button><button class="btn btn-info" onclick="showInlineTree()"><?php language_filter("Browse", false, true)?></button><button class="btn btn-success" onclick="is_move = true; rename_dir(\''+name+'\', \''+index+'\', \'m\')"><?php language_filter("Move", false, true)?></button></div></div>');
                     }
                     else
                     {

                         $("#showConf").modal("hide");
                         if(here == name && is_move ) {
                             new_name = new_name.replace( "../", "" );
                         }
                         var user_name = new_name;
                         var last_char = name.split("/");//.filter(Boolean);
                         last_char[last_char.length-1] = last_char[last_char.length-1].replace(index, new_name);
                         new_name = last_char.join("/");
                         if( here == name && is_move ) {
                             new_name = new_name+"/"+index;
                         }
                         is_move = false;
                         show_preloader();
                         var was_here = here;
                         setTimeout(function(){
                             $.post("ajax_manage_dir.php",
                             {
                                 dirname:name,
                                 newName:new_name
                             },
                             function(data,status)
                             {
                                 have_action = "yes";
                                 if(status == "success")
                                 {
                                     if(data == "true")
                                     {
                                         if(time == 'r')
                                             var error_text = "<?php language_filter("Folder has been renamed.", false, true);?>";
                                         if(time == 'm')
                                             var error_text = "<?php language_filter("Folder has been moved.", false, true);?>";
                                         this_dir_path = new_name.replace(user_name, '');
                                         if( name == was_here && time == "m" ) {
                                             this_dir_path = name.replace(index, '');
                                         }
                                         if( name == was_here && time == "r" ) {
                                             this_dir_path = new_name;
                                         }
                                         loading_from_file = error_text;
                                         loading_from_file_status = "green";
                                         reload_sidebar = true;

                                         // X3 mtree push open ID
                                         var arr = name.split('/');
                                         var old_id = 'menu_'+arr[arr.length-1].replace('.','_');
                                         var new_id = 'menu_'+user_name.replace('.','_');
                                         if($('ul.mtree #'+old_id).hasClass('mtree-open')) {
                                         	$('ul.mtree #'+old_id).attr('id', new_id);
                                         	mtreeSaveState();
                                         }

                                     }
                                     else
                                     {
                                         if(time == 'r')
                                             var error_text = "<?php language_filter("Folder has not been renamed.", false, true)?>";
                                         if(time == 'm')
                                             var error_text = "<?php language_filter("Folder has not been moved.", false, true);?>";
                                         this_dir_path = name.replace(index, '');
                                         loading_from_file = error_text;
                                         loading_from_file_status = "red";
                                     }
                                     if(is_root == 'true') {
                                     	showFileManager('');
                                     } else {
                                     	showFileManager(this_dir_path);
                                     }

                                 }
                                 else
                                 {
                                     alert("Error: " + status);
                                     hide_preloader();
                                 }
                             });
                         }, 1000);
                     }
                 }

                 function copy_dir(name, index, time)
                 {
                 		//here = context? name : here;
                 		name = name.replace(/\/$/, '');
                     if(time == "first")
                     {
                         $("#confLable").html('<?php language_filter("Copy", false, true)?> ' + index);
                         $('#container_id_tree').html('');
                         $('#container_id_tree').html('<?php language_filter("Choose your target directory.", false, true)?>');
                         old_name = name.replace(here, "");
                         old_name = old_name.replace(filext, "");
                         $("#confButton").html('<div class="row"><div class="col-xs-6"><input type="text" class="form-control" id="copy_new_name_dir" placeholder="<?php language_filter("New Folder Path", false, true)?>" style="float: left; margin-top: 0px;" onchange="set_new_name(this.value);"/></div><div class="col-xs-6"><button class="btn btn-default" data-dismiss="modal" aria-hidden="true"><?php language_filter("Cancel", false, true);?></button><button class="btn btn-info" onclick="showInlineTree()"><?php language_filter("Browse", false, true);?></button><button class="btn btn-success" onclick="copy_dir(\''+name+'\', \''+index+'\', \'rename\')"><?php language_filter("Copy", false, true)?></button></div></div>');
                     }
                     else
                     {
                         $("#showConf").modal("hide");
                         if( here == name ) {
                             new_name = new_name.replace( "../", "" );
                         }
                         var user_name = new_name;
                         var last_char = name.split("/");
                         last_char[last_char.length-1] = last_char[last_char.length-1].replace(index, new_name);
                         new_name = last_char.join("/");
                         if( here == name ) {
                             new_name = new_name+"/"+index;
                         }
                         show_preloader();
                         var was_here = here;
                         setTimeout(function(){
                             $.post("ajax_manage_dir.php",
                             {
                                 dirname:name,
                                 newName:new_name,
                                 copy_this:'ok'
                             },
                             function(data,status)
                             {
                                 have_action = "yes";
                                 if(status == "success")
                                 {
                                     if(data == "true")
                                     {
                                         this_dir_path = new_name.replace(user_name, '');
                                         reload_sidebar = true;
                                         loading_from_file = '<?php language_filter("Folder has been copied.", false, true);?>';
                                         loading_from_file_status = "green";
                                     }
                                     else
                                     {
                                         this_dir_path = name.replace(index, '');
                                         loading_from_file = '<?php language_filter("Folder has not been copied.", false, true);?>';
                                         loading_from_file_status = "red";
                                     }
                                     if(is_root == 'true')
                                         showFileManager('');
                                     else {
                                         if( was_here == name ) {
                                             this_dir_path = was_here;
                                         }
                                         showFileManager(this_dir_path);
                                     }

                                 }
                                 else
                                 {
                                     alert("Error: " + status);
                                     hide_preloader();
                                 }
                             });
                         }, 1000);
                     }
                 }

                 function remove_dir(name, index, time)
                 {
                 		name = name.replace(/\/$/, '');
                 		var index_warning = name.match('.index$') || name.match('/index$') ? '<div class="alert alert-danger" role="alert">Are you sure you want to delete your home page?</div>' : '';
                    if(time == "first")
                    {
                        $("#confLable").html('<?php language_filter("Remove", false, true);?> ' + index);
                        $("#container_id_tree").html(index_warning + '<?php language_filter("Do you want to remove this folder", false, true);?>');
                        $("#confButton").html('<button class="btn btn-default" data-dismiss="modal" aria-hidden="true"><?php language_filter("Cancel", false, true);?></button><button class="btn btn-danger" onclick="remove_dir(\''+name+'\', \''+index+'\',\'rename\')"><?php language_filter("Remove", false, true)?></button>');
                    }
                    else
                    {
                        $("#showConf").modal("hide");
                        show_preloader();
                        setTimeout(function(){
                            $.post("ajax_manage_dir.php",
                            {
                                removeDirName:name
                            },
                            function(data,status)
                            {
                                have_action = "yes";
                                if(status == "success")
                                {
                                    if(data == "true")
                                    {
                                        reload_sidebar = true;
                                        loading_from_file = '<?php language_filter("Folder has been deleted.", false, true)?>';
                                        loading_from_file_status = "green";
                                    }
                                    else
                                    {
                                        loading_from_file = '<?php language_filter("Folder has not been deleted.", false, true);?>';
                                        loading_from_file_status = "red";
                                    }
                                    var last_char = name.split("/");
                                    last_char[last_char.length-1] = last_char[last_char.length-1].replace(index, '');
                                    this_dir_path = last_char.join("/");
                                    if(is_root == 'true')
                                        showFileManager('');
                                    else
                                        showFileManager(this_dir_path);
                                }
                                else
                                {
                                    alert("Error: " + status);
                                    hide_preloader();
                                }
                            });
                        }, 1000);
                    }
                 }

                 function set_new_name(name)
                 {
                    if(is_rename == true)
                    {
                        is_rename = false;
                        var check = name.indexOf("/");
                        if(check != -1)
                        {
                            alert("<?php language_filter("Please write new folder/file name.", false, true)?>");
                            return false;
                        }
                    }
                    if(is_move == true)
                    {
                        is_move = false;
                        var check = name.indexOf("/");
                        if(check == -1)
                        {
                            alert("<?php language_filter("Please write new folder/file path.", false, true)?>");
                            return false;
                        }
                    }
                    var check = name.indexOf("'");
                    if(check != -1)
                    {
                        alert("<?php language_filter("Please don't use quotation in server folders.", false, true)?>");
                        return false;
                    }
                    check = name.indexOf("\"");
                    if(check != -1)
                    {
                        alert("<?php language_filter("Please don't use quotation in server folders.", false, true)?>");
                        return false;
                    }
                        var file_ext = document.getElementById('rename_new_ext');
                        if(file_ext != null)
                            filext = document.getElementById('rename_new_ext').value;

                    new_name = name+filext;
                    filext = "";
                 }

                function addslashes(string)
                {
                    return string.replace(/\\/g, '\\\\').
                            replace(/\u0008/g, '\\b').
                            replace(/\t/g, '\\t').
                            replace(/\n/g, '\\n').
                            replace(/\f/g, '\\f').
                            replace(/\r/g, '\\r').
                            replace(/'/g, '\\\'').
                            replace(/"/g, '\\"');
                }

                /*function set_new_folder_name(name)
                {
                    var check = name.indexOf("'");
                    if(check != -1)
                    {
                        alert("<?php language_filter("Please don't use quotation in server folders.", false, true)?>");
                        return false;
                    }
                    check = name.indexOf("\"");
                    if(check != -1)
                    {
                        alert("<?php language_filter("Please don't use quotation in server folders.", false, true)?>");
                        return false;
                    }
                    new_folder_path = name;
                }*/

                function mkdir(there)
                {
                    $("#newFolder").modal("hide");
                    show_preloader();
                    var new_here = there||here;
                    setTimeout(function(){
                        $.post("ajax_manage_dir.php",
                        {
                            "mkdir_path":new_folder_path,
                            "this_place":new_here//there||here
                        },
                        function(data,status)
                        {
                            if(status == "success")
                            {
                                have_action = "yes";
                                reload_sidebar = true;
                                if(data == "true")
                                {
                                    loading_from_file = '<?php language_filter("Folder has been created.", false, true)?>';
                                    loading_from_file_status = "green";
                                }
                                else
                                {
                                    loading_from_file = '<?php language_filter("Folder has not been created.", false, true);?>';
                                    loading_from_file_status = "red";
                                }
                                if(is_root == 'true')
                                    showFileManager('');
                                else
                                    showFileManager(new_here);
                            }
                            else
                            {
                                alert("Error: " + status);
                                hide_preloader();
                            }
                        });
                        new_folder_path = "";
                    }, 1000);
                }


                function set_new_zipFile_name(value)
                {
                    var check = value.indexOf(".zip");
                    if(check != -1)
                    {
                        alert("<?php language_filter("Please write zip file name without extension.", false, true);?>");
                        return false;
                    }
                    zip_file_name = value;
                }
                function create_zip()
                {
                    if(selected == "" || selected == null)
                    {
                        alert("<?php language_filter("Please select files and folders", false, true);?>");
                    }
                    else
                    {
                        $("#newzipFile").modal("hide");
                        show_preloader();
                        setTimeout(function(){
                            $.post("ajax_manage_dir.php",
                            {
                                create_zip:selected,
                                this_place:here,
                                zip_name:zip_file_name
                            },
                            function(data,status)
                            {
                                if(status == "success")
                                {
                                    if(data == "true")
                                    {
                                        loading_from_file = '<?php language_filter("Zip file has been created.", false, true);?>';
                                        loading_from_file_status = "green";
                                    }
                                    else
                                    {
                                        loading_from_file = '<?php language_filter("Zip file has not been created.", false, true)?>';
                                        loading_from_file_status = "red";
                                    }
                                    showFileManager(here);
                                }
                                else
                                {
                                    alert("Error: " + status);
                                    hide_preloader();
                                }
                            });
                            zip_file_name = "";
                        }, 1000);
                    }
                }

                // X3 various set input focus on modal
                $('#newFolder, #showConf, #newzipFile').on('shown.bs.modal', function () {
								  $(this).find('input.form-control').focus().select();
								});

                <?php
                if( $search == "" ):
                ?>

              	// Get page.json
                <?php
	                if(file_exists($path.'/page.json')) {
										$c = trim(file_get_contents($path.'/page.json'));
										$page_json = $c ? $c : '{}';
									} else {
										$page_json = '{}';
									}
								?>

								// get x3 page settings
               var page_json = <?php echo $page_json; ?>;
               mtreeActive();
               get_x3_page_settings(page_json, '<?php echo $path.'/page.json'; ?>');

                <?php
                endif;
                ?>
                </script>
    <?php
            }
        }
    }
    else
    {
        header("Status: 404 Not Found");
    }
}
else
{
    header("Status: 404 Not Found");
}
?>