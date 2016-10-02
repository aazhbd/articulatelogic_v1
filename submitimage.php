<?php

if(!isset($_POST['submit'])){ echo "You can not access this page directly."; return; }

require_once('config/project.class.php');
$al = new Project();

$islogin = false;

if(isset($_SESSION['login'] ) == true && isset($_SESSION))
{
    $l = $_SESSION['login'];
    $islogin = true;
    $email = $l->getEmail();
    $utype = $l->utype;
}

$al->tp->assign('islogin',$islogin);
$al->tp->assign('email',$email);

if($utype != 1){
    Errors::report("You do not have permission to view this page.");
    return;
}

extract($_POST);

if(!isset($_FILES) && $action == 'add'){
    Errors::report("File information not set for image upload.");
    return;
}

if($action == "add" )
{
    switch($_FILES['ifile']['error'])
    {
        case 1:
            $err[] = " 1. The file is bigger than $MAX_FILE_SIZE Bytes.";
            $uploadfile_success = false;
        break;
        
        case 2:
            $err[] = " 2. The file you selected is more than $MAX_FILE_SIZE bytes. Please select a smaller file.";
            $uploadfile_success = false;
        break;
        
        case 3:
            $err[] = " 3. Only part of the file was uploaded";
            $uploadfile_success = false;
        break;
        
        case 4:
            $err[] = " 4. Can not move file! ";
            $uploadfile_success = false;
        break;
        
        default:
            $uploadfile_success = true;
    }
    
    if(!$uploadfile_success) {
        Errors::report($err);
        return;
    }
    
    $fsize = $_FILES['ifile']['size'];
    $filepath = PATH . "/directories/is";

    $or_filename = addslashes(str_replace(' ', '_', $_FILES['ifile']['name']));
    
    $vfileType = $_FILES['ifile']['type'];
    
    $id = getNewId("images", $al->db);
    
    $filename = $id . "_". trim($or_filename);
    
    $fpath = $filepath . "/" . $filename;
    
    if(move_uploaded_file($_FILES['ifile']['tmp_name'], $fpath)) 
    {
        if( ! file_exists($fpath) ){
            $err[] = " 9. Could not save file. File already exists";
            $file_upload_success = false;                
        }
        else
            $file_upload_success = true;
    }
    else
        $err[] = " 10. Could not move uploaded file";
    
    if(count($err) > 0) {
        Errors::report($err);
        return;
    }
        
    
    $id = getNewId("images", $al->db);

    if($id == false)
        return;
    
    $fieldinfo = getFieldInfo('images', $al->db);
    
    if(is_string($fieldinfo))
        $rep .= $fieldinfo;
    
    if($fieldinfo === false)
        return;
    
    $i = 0;
    
    foreach($fieldinfo as $f)
    {
        if($i > 0) $q .= " or ";
        $fields[] = $f['Field'];
        $i++;
    }
    
    $values = array($id, $art_id, $arttitle, addslashes($or_filename), addslashes($filename), 0, date("Y-m-d H:i:s"), date("Y-m-d H:i:s"), 0);
    
    $isinserted = setRow('images', $fields, $values, 'insert', $al->db);

    if($isinserted)
        $rep .= "Your image has been uploaded.";
    else
        $err .= "We are sorry. Your image was not uploaded. Please try again.";
}
else if($action == "edit")
{
    if(!isset($_FILES)){
        Errors::report("File information not set for image update.");
        return;
    }
    
    switch($_FILES['ifile']['error'])
    {
        case 1:
            $err[] = " 1. The file is bigger than $MAX_FILE_SIZE Bytes.";
            $uploadfile_success = false;
        break;
        
        case 2:
            $err[] = " 2. The file you selected is more than $MAX_FILE_SIZE bytes. Please select a smaller file.";
            $uploadfile_success = false;
        break;
        
        case 3:
            $err[] = " 3. Only part of the file was uploaded";
            $uploadfile_success = false;
        break;
        
        case 4:
            $err[] = " 4. Can not move file! ";
            $uploadfile_success = false;
        break;
        
        default:
            $uploadfile_success = true;
    }
    
    if(!$uploadfile_success) {
        Errors::report($err);
        return;
    }
    
    $fsize = $_FILES['ifile']['size'];
    $filepath = PATH . "/directories/is";

    $or_filename = addslashes(str_replace(' ', '_', $_FILES['ifile']['name']));
    
    $vfileType = $_FILES['ifile']['type'];
    
    $id = $img_id;
    
    $filename = $id . "_". trim($or_filename);
    
    $fpath = $filepath . "/" . $filename;
    
    if(move_uploaded_file($_FILES['ifile']['tmp_name'], $fpath)) 
    {
        if( ! file_exists($fpath) ){
            $err[] = " 9. Could not save file. File already exists";
            $file_upload_success = false;                
        }
        else
            $file_upload_success = true;
    }
    else
        $err[] = " 10. Could not move uploaded image";
    
    if(count($err) > 0) {
        Errors::report($err);
        return;
    }

    if($id == false)
        return;
    
    $fields = array( "article_id", "ftitle", "filename", "filepath", "date_updated");
    $values = array( $art_id,  $arttitle, addslashes($or_filename), addslashes($filename), date("Y-m-d H:i:s"));
    
    $isUpdated = setRow('images', $fields, $values, 'update', $al->db, $img_id);

    if($isUpdated)
    {
        $rep .= "Image has been updated.";
        
        $old_imagepath = PATH. "/directories/is/". $oldpath;
        if(trim($oldpath) != trim($filename))
            if(file_exists($old_imagepath))
                unlink($old_imagepath);
    }
    else
        $err .= "Your image was not updated. Please try again.";
}
else
{
    Errors::report("Invalid value for action varriable.");
    return;
}

$al->tp->assign('rep', $rep);
$al->tp->assign('err', $err);

$al->tp->assign('title', 'List of images');
$al->tp->assign('selMenu','images');

$data = getTableData("images", $al->db);

if(is_string($data)) {
    $al->tp->assign('rep', $data);
    $data = null;
}

if($data === false)
    $data = null;
    
$al->tp->assign('data',$data);

$body = $al->tp->fetch('admin_menu.tpl');
$body .= $al->tp->fetch("view_imagestbl.tpl");
$al->tp->assign('body', $body);

$al->tp->assign('ttitle',"Submit Files:: ArticulateLogic.com");
$al->tp->display('admin.tpl');

?>
