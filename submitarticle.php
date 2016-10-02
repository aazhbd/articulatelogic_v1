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

if($utype != 1)
{
    Errors::report("You do not have permission to view this page.");
    return;
}

extract($_POST);

if( $cat == "0" ) {
    Errors::report("Invalid category id for inserting article information.");
    return;
}

if(!isset($_FILES) && $action == 'add'){
    Errors::report("Image file information not set.");
    return;
}

if($action == "add")
{
    switch($_FILES['ifile']['error'])
    {
        case 1:
            $err[] = " 1. The image file is bigger than $MAX_FILE_SIZE Bytes.";
            $uploadimage_success = false;
        break;
        
        case 2:
            $err[] = " 2. The image file you selected is more than $MAX_FILE_SIZE bytes. Please select a smaller file.";
            $uploadimage_success = false;
        break;
        
        case 3:
            $err[] = " 3. Only part of the image file was uploaded";
            $uploadimage_success = false;
        break;
        
        case 4:
            //$err[] = " 4. Can not move image file! ";
            $uploadimage_success = false;
            $img_not_uploaded = true;
        break;
        
        default:
            $uploadimage_success = true;
    }
    
    if($uploadimage_success)
    {
        $imgPath = PATH . "/directories/is";
        
        $imgName = basename($_FILES['ifile']['name']);
        $imgName = str_replace(' ', '_', $imgName);
        $imgName = addslashes($imgName);
        
        $id = getNewId("images", $al->db);
        
        $imgName = $id . "_". trim($imgName);
        
        $ipath = $imgPath . "/" . $imgName;
        
        if(move_uploaded_file($_FILES['ifile']['tmp_name'], $ipath)) 
        {
            if( !file_exists($ipath) )
            {
                $err[] = " 5. Could not save image file. Image file already exists";
                $image_upload_success = false;
            }
            else
                $image_upload_success = true;
        }
        else
        {
            $err[] = " 6. Could not move uploaded image file";
        }
    }
    
    if(!$image_upload_success && !$img_not_uploaded)
    {
        Errors::report("Failed to upload image.");
        break;
    }
    
    if(count($err) > 0) {
        Errors::report($err);
        return;
    }
    
    $id = getNewId("articles", $al->db);

    if($id == false)
        return;
    
    if($image_upload_success)
    {
        $img_id = getNewId("images", $al->db);

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
        
        $values = array($img_id, $id, addslashes($arttitle),addslashes(basename($_FILES['ifile']['name'])), addslashes($imgName ),0, date("Y-m-d H:i:s"), date("Y-m-d H:i:s"), 0);
        
        $isinserted = setRow('images', $fields, $values, 'insert', $al->db);

        if($isinserted)
            $rep .= "Your image has been uploaded. ";
        else
            $err .= "We are sorry. Your image was not uploaded. Please try again.";
        
        if(!$isinserted)
        {
            Errors::report("Image not saved in database.");
            return;
        }
    }
    
    $fieldinfo = getFieldInfo('articles', $al->db);
    
    if(is_string($fieldinfo))
        $rep .= $fieldinfo;
    
    if($fieldinfo === false)
        return;
    
    $i = 0;
    $fields = array();
    foreach($fieldinfo as $f)
    {
        if($i > 0) $q .= " or ";
        $fields[] = $f['Field'];
        $i++;
    }
    
    $values = array($id, $l->getId(), $cat, addslashes($arturl), addslashes($arttitle), addslashes($subtitle), addslashes(htmlentities($bodytxt)), addslashes($remarks), addslashes($keywords), 0, 0, 0, date("Y-m-d H:i:s"), date("Y-m-d H:i:s"), 0);

    $isinserted = setRow('articles', $fields, $values, 'insert', $al->db);

    if($isinserted)
        $rep .= "Your article has been added.";
    else
        $err .= "We are sorry. Your article was not added. Please try again.";
}
else if($action == "edit")
{
    $bodytxt = html_entity_decode(stripslashes($bodytxt));
    $fields = array( "title", "subtitle", "body", "remarks", "date_updated", "category_id","meta_tags", "url");
    $values = array( addslashes($arttitle), addslashes($subtitle), addslashes($bodytxt), addslashes($remarks), date("Y-m-d H:i:s"), $cat, addslashes($keywords), $arturl);
    
    $isUpdated = setRow('articles', $fields, $values, 'update', $al->db, $art_id);

    if($isUpdated)
        $rep .= "Article has been updated.";
    else
        $err .= "Your article was not updated. Please try again.";
}
else
{
    Errors::report("Invalid value for action varriable.");
    return;
}

$al->tp->assign('rep', $rep);
$al->tp->assign('err', $err);

$al->tp->assign('title', 'List of articles');
$al->tp->assign('selMenu','article');

$catList = getTableData('categories', $al->db);

if(is_string($catList)) {
    $al->tp->assign('rep', $catList);
    $catList = null;
}

if($catList === false)
    $catList = null;
    
$al->tp->assign('catList',$catList);

$data = getTableData("articles", $al->db);

if(is_string($data)) {
    $al->tp->assign('rep', $data);
    $data = null;
}

if($data === false)
    $data = null;
    
$al->tp->assign('data',$data);

$body = $al->tp->fetch('admin_menu.tpl');
$body .= $al->tp->fetch("view_arttable.tpl");
$al->tp->assign('body', $body);

$al->tp->assign('ttitle',"Submit Article:: ArticulateLogic.com");

$al->tp->display('admin.tpl');

?>