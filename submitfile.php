<?php

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
    //Errors::report("You do not have permission to view this page.");
    //return;
    $err .= "You do not have permission to view this page.";
}

extract($_POST);

if( $cat == "0" ) {
    //Errors::report("Invalid category id for inserting file information.");
    //return;
    $err .= "Invalid category id for inserting file information.";
}

if(!isset($_FILES) && $action == 'add'){
    //Errors::report("File information not set for file upload.");
    //return;
    $err .= "File information not set for file upload.";
}

if($action == "add" )
{
    switch($_FILES['ufile']['error'])
    {
        case 1:
            //$err[] = " 1. The file is bigger than $MAX_FILE_SIZE Bytes.";
            $err .= " 1. The file is bigger than $MAX_FILE_SIZE Bytes.";
            $uploadfile_success = false;
        break;
        
        case 2:
            //$err[] = " 2. The file you selected is more than $MAX_FILE_SIZE bytes. Please select a smaller file.";
            $err .= " 2. The file you selected is more than $MAX_FILE_SIZE bytes. Please select a smaller file.";
            $uploadfile_success = false;
        break;
        
        case 3:
            //$err[] = " 3. Only part of the file was uploaded";
            $err .= " 3. Only part of the file was uploaded";
            $uploadfile_success = false;
        break;
        
        case 4:
            //$err[] = " 4. Can not move file! ";
            $err .= " 4. Can not move file! ";
            $uploadfile_success = false;
        break;
        
        default:
            $uploadfile_success = true;
    }
    
    if(!$uploadfile_success) {
        //Errors::report($err);
        //return;
    }
    
    $fsize = $_FILES['ufile']['size'];
    $filepath = PATH . "/directories/fs";

    $or_filename = addslashes(str_replace(' ', '_', $_FILES['ufile']['name']));
    
    $vfileType = $_FILES['ufile']['type'];
    
    $id = getNewId("files", $al->db);
    
    $filename = $id . "_". trim($or_filename);
    
    $fpath = $filepath . "/" . $filename;
    
    if(move_uploaded_file($_FILES['ufile']['tmp_name'], $fpath)) 
    {
        if( ! file_exists($fpath) ){
            //$err[] = " 9. Could not save file. File already exists";
            $err .= " 9. Could not save file. File already exists";
            $file_upload_success = false;                
        }
        else
            $file_upload_success = true;
    }
    else
        //$err[] = " 10. Could not move uploaded file";
        $err .= " 10. Could not move uploaded file";
    
    if(count($err) > 0) {
        //Errors::report($err);
        //return;
    }
        
    
    $id = getNewId("files", $al->db);

    if($id == false)
        return;
    
    $fieldinfo = getFieldInfo('files', $al->db);
    
    if(is_string($fieldinfo))
        $rep .= $fieldinfo;
    
    if($fieldinfo === false)
        //return;
    
    $i = 0;
    
    foreach($fieldinfo as $f)
    {
        if($i > 0) $q .= " or ";
        $fields[] = $f['Field'];
        $i++;
    }
    
    $values = array($id, $l->getId(), $cat, addslashes($arturl), addslashes($arttitle), addslashes($or_filename), addslashes($filename), addslashes($remarks), addslashes($keywords), 0, 0, 0, date("Y-m-d H:i:s"), date("Y-m-d H:i:s"), 0);
    
    $isinserted = setRow('files', $fields, $values, 'insert', $al->db);

    if($isinserted)
        $rep .= "Your file has been uploaded.";
    else
        $err .= "We are sorry. Your file was not uploaded. Please try again.";
}
else if($action == "edit")
{
    $fields = array( "uid", "category_id", "url", "ftitle", "remarks", "meta_tags", "date_updated");
    $values = array( $l->getId(), $cat, addslashes($arturl), addslashes($arttitle), addslashes($remarks), addslashes($keywords), date("Y-m-d H:i:s"));
    
    $isUpdated = setRow('files', $fields, $values, 'update', $al->db, $art_id);

    if($isUpdated)
        $rep .= "File has been updated.";
    else
        $err .= "Your file was not updated. Please try again.";
}
else
{
    //Errors::report("Invalid value for action varriable.");
    //return;
    $err .= "Invalid value for action varriable.";
}

$rep .= $err; 

$al->tp->assign('rep', $rep);
$al->tp->assign('err', $err);

$al->tp->assign('title', 'List of files');
$al->tp->assign('selMenu','files');

$catList = getTableData('categories', $al->db);

if(is_string($catList)) {
    $al->tp->assign('rep', $catList);
    $catList = null;
}

if($catList === false)
    $catList = null;
    
$al->tp->assign('catList',$catList);

$data = getTableData("files", $al->db);

if(is_string($data)) {
    $al->tp->assign('rep', $data);
    $data = null;
}

if($data === false)
    $data = null;
    
$al->tp->assign('data',$data);

$body = $al->tp->fetch('admin_menu.tpl');
$body .= $al->tp->fetch("view_filestbl.tpl");
$al->tp->assign('body', $body);

$al->tp->assign('ttitle',"Submit Files:: ArticulateLogic.com");
$al->tp->display('admin.tpl');
?>