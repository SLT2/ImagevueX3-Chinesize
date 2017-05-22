<?php
if (!isset($core))
{
	require_once 'filemanager_core.php';
	$core = new filemanager_core();
    require_once 'filemanager_language.php';
}

$extra_num = 0;
function set_new_name_for_file($path, $name)
{
    global $extra_num;
    $extra_num++;
    $new_ext = explode(".", $name);
    $ext = end($new_ext);
    unset($new_ext[count($new_ext) - 1]);
    $new_name = implode($new_ext, ".");
    $new_name .= $extra_num.".".$ext;
    if(file_exists($path.$new_name))
    {
        return set_new_name_for_file($path, $name);
    }
    return $new_name;
}

function get_file_url() {
    $https = !empty($_SERVER['HTTPS']) && strcasecmp($_SERVER['HTTPS'], 'on') === 0 ||
        !empty($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
        strcasecmp($_SERVER['HTTP_X_FORWARDED_PROTO'], 'https') === 0;
    return
        ($https ? 'https://' : 'http://').
        (!empty($_SERVER['REMOTE_USER']) ? $_SERVER['REMOTE_USER'].'@' : '').
        (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : ($_SERVER['SERVER_NAME'].
            ($https && $_SERVER['SERVER_PORT'] === 443 ||
            $_SERVER['SERVER_PORT'] === 80 ? '' : ':'.$_SERVER['SERVER_PORT']))).
        substr($_SERVER['SCRIPT_NAME'],0, strrpos($_SERVER['SCRIPT_NAME'], '/'));
}

if ($core->isLogin())
{

    if( isset( $_GET["action"] ) and $_GET["action"] == "delete_file" and isset( $_GET["delete_file_dir"] ) and isset( $_GET["delete_file_path"] ) ) {
        $dir = urldecode( $_GET["delete_file_dir"] );
        $file = urldecode( $_GET["delete_file_path"] );
        if(  $core->check_base_root( $dir ) ) {
            $info = new stdClass();
            $info->sucess = unlink( $file );
            $info->path = $file;
            $info->file = is_file( $file );
            echo $core->_encode(  array( $info ) );
        }
        exit;
    }

	if(isset($_POST["uploadDir"]) and isset( $_FILES['datafile'] ) )
	{
        if($core->check_base_root($_POST["uploadDir"]))
        {
            $allowedExts = $core->get_allow_uploads();
            $mim_types = $core->get_mime_type();
            $_result["files"] = array();
            $name = "";
            // application/x-zip-compressed
            // application/msword
            // application/vnd.ms-powerpoint
            // application/vnd.ms-excel
            if( isset( $mim_types->zip ) ) {
                array_push( $mim_types->zip, "application/x-zip-compressed" );
            }
            if( isset( $mim_types->docx ) ) {
                array_push( $mim_types->docx, "application/msword" );
            }
            if( isset( $mim_types->xlsx ) ) {
                array_push( $mim_types->xlsx, "application/vnd.ms-excel" );
            }
            if( isset( $mim_types->pptx ) ) {
                array_push( $mim_types->pptx, "application/vnd.ms-powerpoint" );
            }

            if(class_exists('finfo'))
            {
                $finfo = new finfo(FILEINFO_MIME);
            }
            $temp = explode(".", $_FILES["datafile"]["name"]);
            $extension = end($temp);
            $extension = strtolower($extension);
            $mim_type = strtolower($_FILES["datafile"]["type"]);
            if(class_exists('finfo'))
            {
                $mim_type = $finfo->file($_FILES["datafile"]["tmp_name"]);
                if(strpos($mim_type, ";"))
                {
                    $mim_type = explode(";", $mim_type);
                    $mim_type = $mim_type[0];
                }
            }
            if (in_array($extension, $allowedExts))
            {
                if(isset($mim_types->$extension))
                {
                    if (in_array($mim_type, $mim_types->$extension))
                    {
                        if ($_FILES["datafile"]["error"] > 0)
                        {
                            $ret["msg"] = language_filter("Return Code", true).': ' . $_FILES["datafile"]["error"];
                        }
                        else
                        {
                            $name = $_FILES["datafile"]["name"];
                            if (file_exists($_POST["uploadDir"] . $_FILES["datafile"]["name"]))
                            {
                                $name = set_new_name_for_file($_POST["uploadDir"], $name);
                            }

                            if(move_uploaded_file($_FILES["datafile"]["tmp_name"], $_POST["uploadDir"] . $name))
                            {
                                $ret["status"] = "Success";
                                $ret["msg"] = language_filter( "has_been_uploaded.", true );
                            }
                            else
                            {
                                $ret["msg"] = language_filter("Can not upload", true);
                            }
                        }
                    }
                    else
                    {
                        $ret["msg"] = language_filter("Invalid_file", true);
                    }
                }
                else
                {
                    if ($_FILES["datafile"]["error"] > 0)
                    {
                        $ret["msg"] = language_filter("Return Code", true).': ' . $_FILES["datafile"]["error"];
                    }
                    else
                    {
                        $name = $_FILES["datafile"]["name"];
                        if (file_exists($_POST["uploadDir"] . $_FILES["datafile"]["name"]))
                        {
                            $name = set_new_name_for_file($_POST["uploadDir"], $name);
                        }
                        if(move_uploaded_file($_FILES["datafile"]["tmp_name"], $_POST["uploadDir"] . $name))
                        {
                            $ret["status"] = "Success";
                            $ret["msg"] = language_filter( "has_been_uploaded.", true );
                        }
                        else
                        {
                            $ret["msg"] = language_filter("Can not upload", true);
                        }
                    }
                }
            }
            else
            {
                $ret["msg"] = language_filter("Invalid_file", true);
            }

            $url = get_file_url().$_POST["uploadDir"].rawurlencode($name);
            //$url = str_replace("panel", "", $url);
            //basename(dirname(__FILE__));
            $url = str_replace(basename(dirname(__FILE__)), "", $url);
            $url = str_replace( "../", "", $url );
            $ext = pathinfo( $_POST["uploadDir"].$name, PATHINFO_EXTENSION );
            $ext = strtolower($ext);
            //if($ext == "jpg" or $ext == "png" or $ext == "gif" or $ext == "jpeg") {
            if($ext == "jpg" or $ext == "jpeg") {
                $thumbnail_url = $url;
            }
            else {
                $thumbnail_url = "filemanager_img/file.png";
            }
            list($image_width, $image_height) = getimagesize($url);
            $info = array(
                "url" => $url,
                "thumbnailUrl" => $thumbnail_url,
                "name" => $name,
                "type" => $mim_type,
                "size" => $_FILES["datafile"]["size"],
                "width" => $image_width,
                "height" => $image_height,
                "deleteUrl" =>  get_file_url()."/upload.php?action=delete_file&delete_file_path=".urlencode( $_POST["uploadDir"].$name )."&delete_file_dir=".urlencode( $_POST["uploadDir"] ),
                "deleteType" => "GET"
            );
            if( $ret["status"] != "Success" ) {
                $info["error"] = $ret["msg"];
            }
            array_push( $_result["files"], $info );

            header('Vary: Accept');
            if (isset($_SERVER['HTTP_ACCEPT']) &&
                (strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false)) {
                header('Content-type: application/json');
            } else {
                header('Content-type: text/plain');
            }
            $core->touchme();
            echo $core->_encode( $_result );
            die();

        }
        else
        {
            language_filter("Can not upload");
        }
	}
}
?>
