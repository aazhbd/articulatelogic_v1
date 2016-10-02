<?php

/* creating the project object for tp and db variable access */
require_once('config/project.class.php');
$al = new Project();

/*
* variables initialization.
*/
$rep = "";
$title = "";
$subtitle = "";
$body = "";
$islogin = false;

$al->tp->assign('ttitle', "ArticulateLogic.com");

/*
* switching to the case according to the url parameter.
*/

$params = getParams();

if(isset($_SESSION['login'] ) == true && isset($_SESSION))
{
    $l = $_SESSION['login'];
    $islogin = true;
    $email = $l->getEmail();
    $utype = $l->utype;
}

setLoginInfo();

$al->tp->assign('islogin',$islogin);
$al->tp->assign('email',$email);

switch($params[0])
{
    case 'a':    
        $data = getArticleByURL($params[1], $al->db);
        
        if($data === false)
            $data = null;
        
        if(is_string($data)){
            $al->tp->assign('rep', $data);
            $data = null;
        }
        
        if( $data['state'] == 1)
            $al->tp->assign('rep', "The requested article is disabled.");
        else
        {
            $data['body'] = html_entity_decode(stripslashes($data['body']));
            $data['body'] = preg_replace('/&(?![A-Za-z0-9#]{1,7};)/','&amp;',$data['body']);
            
            $al->tp->assign('remarks', stripslashes($data['remarks']));
            $al->tp->assign('meta_tags', stripslashes($data['meta_tags']));
            $al->tp->assign('title', stripslashes($data['title'])); 
            $al->tp->assign('subtitle', stripslashes($data['subtitle']));
            $al->tp->assign('body', $data['body']);
            
            $al->tp->assign('ttitle',$data['title'] . " :: ArticulateLogic.com");
            $al->tp->assign('keys', trim(stripslashes($data['meta_tags'])));
            $al->tp->assign('descrip', trim(stripslashes($data['title'])) . " : " . stripslashes($data['subtitle']) . " : " . stripslashes(substr(strip_tags($data['body']), 0, 300) )) ;
        }
        if($utype == 1)
            $al->tp->display('admin.tpl');
        else
            $al->tp->display('main.tpl');
        
    break;

    case 'sitemap':
        $data = getArticleByURL('sitemap', $al->db);
        
        if($data === false)
            $data = null;
        
        if(is_string($data)){
            $al->tp->assign('rep', $data);
            $data = null;
        }
        if( $data['state'] == 1)
            $al->tp->assign('rep', "The requested article is disabled.");
        else{
            $data['body'] = html_entity_decode (stripslashes($data['body']) );
            $al->tp->assign('body', $data['body']);
            $al->tp->assign('keys', trim(stripslashes($data['meta_tags'])));
            $al->tp->assign('descrip', trim(stripslashes($data['title'])) . " : " . stripslashes($data['subtitle']) . " : " . stripslashes(substr(strip_tags($data['body']), 0, 300) )) ;
            
        }
        
        $al->tp->display('main.tpl');
    break;
    
    case 'express':
        $al->tp->assign('ttitle', "ArticulateLogic :: Express Your Needs");
        
        $data = getArticleByURL('express',$al->db);

        if(is_string($data)) {
            $al->tp->assign('rep', $data);
            $data = null;
        }

        if($data === false)
            $data = null;

        if( $data['state'] == 1)
            $al->tp->assign('rep', "The requested article is disabled.");
        else
        {
            $al->tp->assign('cont', html_entity_decode(stripslashes($data['body'])));
            
            $al->tp->assign('title', stripslashes($data['title'])); 
            $al->tp->assign('subtitle', stripslashes($data['subtitle']));
            
            $al->tp->assign('keys', trim(stripslashes($data['meta_tags'])));
            $al->tp->assign('descrip', trim(stripslashes($data['title'])) . " : " . stripslashes($data['subtitle']) . " : " . stripslashes(substr(strip_tags($data['body']), 0, 300) )) ;
            
            $serv_names = getservnames();
            $al->tp->assign('serv_names', $serv_names);
            
            $bgt_range = getbgtrange();
            $al->tp->assign('bgt_range', $bgt_range);
            $al->tp->assign('bgt', $bgt);
            
            $time_range = getprojstrt();
            $al->tp->assign('time_range', $time_range);
            $al->tp->assign('time', $time);
            
            $al->tp->assign('body', $al->tp->fetch('frm_exneed.tpl'));
        }
        $al->tp->display('main.tpl');
    break;
    
    case 'contact':
        $al->tp->assign('ttitle', "ArticulateLogic :: Contact Us");
        
        $data = getArticleByURL('contact',$al->db);

        if(is_string($data)) {
            $al->tp->assign('rep', $data);
            $data = null;
        }

        if($data === false)
            $data = null;
        
        if( $data['state'] == 1)
            $al->tp->assign('rep', "The requested article is disabled.");
        else {
            $al->tp->assign('cont', html_entity_decode(stripslashes($data['body'])));
            
            $al->tp->assign('title', stripslashes($data['title'])); 
            $al->tp->assign('subtitle', stripslashes($data['subtitle']));
            
            $al->tp->assign('keys', trim(stripslashes($data['meta_tags'])));
            $al->tp->assign('descrip', trim(stripslashes($data['title'])) . " : " . stripslashes($data['subtitle']) . " : " . stripslashes(substr(strip_tags($data['body']), 0, 300) )) ;            
            
            $al->tp->assign('body', $al->tp->fetch('frm_contact.tpl'));
        }
        $al->tp->display('main.tpl');
    break;    
    
    case 'download':
        if($params[1] == ""){
            Errors::report("Second parameter of URL is missing for download 'article' case.");
            break;
        }         
        $data = getArticleByURL($params[1], $al->db);
        
        if(is_string($data)) {
            $al->tp->assign('rep', $data);
            $data = null;
        }

        if($data === false)
            $data = null;
        
        if( $data['state'] == 1)
            $al->tp->assign('rep', "The requested article is disabled.");
        else{
            $data['body'] = html_entity_decode(stripslashes($data['body']));
            $data['body2'] = html_entity_decode(stripslashes(substr(strip_tags($data['body'], "<p><a>"), 0, 470)));
            $al->tp->assign('data', $data);
            
            $al->tp->assign('keys', trim(stripslashes($data['meta_tags'])));
            $al->tp->assign('descrip', trim(stripslashes($data['title'])) . " : " . stripslashes($data['subtitle']) . " : " . stripslashes(substr(strip_tags($data['body']), 0, 300) )) ;
            
            $img = getRowByArticleId("images",$data['id'], $al->db);
            
            if(is_string($img)) {
                $al->tp->assign('rep', $img);
                $img = null;
            }

            if($img === false)
                $img = null;
            
            if($img['state'] == 1){
                $al->tp->assign('rep', "Unable to show image with serial no. ".$img[0]['íd'] .".");
                $img = null;
            }
            else
                $al->tp->assign('img', $img);
            
            $al->tp->assign('ttitle' , $data['title'] ." :: ArticulateLogic.com");
            $al->tp->assign('body', $al->tp->fetch('view_download.tpl'));
        }
        $al->tp->display('main.tpl');
    break;
    
    case 'downloads':
        $al->tp->assign('ttitle', "ArticulateLogic :: Downloads and Portfolio");
        
        $data = getArticleByURL($params[0], $al->db);
        
        if(is_string($data)) {
            $al->tp->assign('rep', $data);
            $data = null;
        }

        if($data === false)
            $data = null;
        
        if( $data['state'] == 1)
            $al->tp->assign('rep', "The requested article is disabled.");
        else
        {
            $data['body'] = html_entity_decode(stripslashes($data['body']));
            
            $al->tp->assign('keys', trim(stripslashes($data['meta_tags'])));
            $al->tp->assign('descrip', trim(stripslashes($data['title'])) . " : " . stripslashes($data['subtitle']) . " : " . stripslashes(substr(strip_tags($data['body']), 0, 300) )) ;
            
            $al->tp->assign('info', $data['body']);
            $al->tp->assign('title', $data['title']);
            $al->tp->assign('subtitle', $data['subtitle']);
            
            $cats = getCategoryByMediaType(1, $al->db);
            
            if(is_string($cats)) {
                $al->tp->assign('rep', $cats);
                $cats = null;
            }

            if($cats === false)
                $cats = null;
            
            if(count($cats) != 0)
            {
                foreach($cats as $c)
                {
                    if($c['catname'] == 'Downloads')
                    {
                        $data = getRowByCategoryId('articles', $c['id'] , $al->db, 0);
                        if(is_string($data)) {
                            $al->tp->assign('rep', $data);
                            $data = null;
                        }

                        if($data === false)
                            $data = null;
                        
                        $i = 0;
                        if(count($data) > 0){
                            foreach($data as $d){
                                $img = getRowByArticleId('images', $d['id'], $al->db);
                                
                                if(is_string($img)) {
                                    $al->tp->assign('rep', $img);
                                    $img = null;
                                }

                                if($img === false)
                                    $img = null;
                                
                                $data[$i]['image'] = $img;
                                $i++;
                            }
                        }
                        
                        $al->tp->assign('dList', $data);                
                    }
                    if($c['catname'] == 'Portfolio')
                    {
                        $data = getRowByCategoryId('articles', $c['id'] , $al->db, 0);
                        
                        if(is_string($data)) {
                            $al->tp->assign('rep', $data);
                            $data = null;
                        }
                        
                        if($data === false)
                            $data = null;                
                        
                        $i = 0;
                        if(count($data) > 0){
                            foreach($data as $d){
                                $img = getRowByArticleId('images', $d['id'], $al->db, 0);
                                
                                if(is_string($img)) {
                                    $al->tp->assign('rep', $img);
                                    $img = null;
                                }

                                if($img === false)
                                    $img = null;
                                
                                $data[$i]['image'] = $img;
                                $i++;
                            }
                        }
                        
                        $al->tp->assign('portfolio', $data);
                    }
                    if($c['catname'] == 'ThirdParty')
                    {
                        $data = getRowByCategoryId('articles', $c['id'] , $al->db, 0);
                        
                        if(is_string($data)) {
                            $al->tp->assign('rep', $data);
                            $data = null;
                        }

                        if($data === false)
                            $data = null;
                        
                        $i = 0;
                        if(count($data) > 0){
                            foreach($data as $d){
                                $img = getRowByArticleId('images', $d['id'], $al->db);
                                
                                if(is_string($img)) {
                                    $al->tp->assign('rep', $img);
                                    $img = null;
                                }

                                if($img === false)
                                    $img = null;
                                
                                $data[$i]['image'] = $img;
                                $i++;
                            }
                        }
                        
                        $al->tp->assign('thirdparty', $data);
                    }
                    if($c['catname'] == 'Template')
                    {
                        $data = getRowByCategoryId('articles', $c['id'] , $al->db, 0);
                        
                        if(is_string($data)) {
                            $al->tp->assign('rep', $data);
                            $data = null;
                        }

                        if($data === false)
                            $data = null;
                        
                        $i = 0;
                        if(count($data) > 0){
                            foreach($data as $d){
                                $img = getRowByArticleId('images', $d['id'], $al->db);
                                
                                if(is_string($img)) {
                                    $al->tp->assign('rep', $img);
                                    $img = null;
                                }

                                if($img === false)
                                    $img = null;
                                
                                $data[$i]['image'] = $img;
                                $i++;
                            }
                        }
                        
                        $al->tp->assign('templates', $data);
                    }            
                }
            }
            else
                $al->tp->assign('rep', "Category is empty");
        }
        
        $al->tp->assign('body', $al->tp->fetch('view_downloads.tpl'));
        $al->tp->display('main.tpl');
    break;
    
    case 'f':
        if($params[1] == ""){
            Errors::report("Second parameter of URL is missing.");
            break;
        }

        $data = getFileByURL($params[1], $al->db);
        
        if(is_string($data)) {
            $al->tp->assign('rep', $data);
            $data = null;
        }

        if($data === false)
            $data = null;
        
        if( $data['state'] == 1)
            $al->tp->assign('rep', "The requested file is disabled.");
        else
        {
            $dcount = (int)$data['hitcount'] + 1;
            
            $isupdated = setRow('files', array('hitcount' , 'date_updated' ), array( $dcount, date("Y-m-d H:i:s") ), 'update', $al->db, $data['id']);
            
            if( !$isupdated)
               break; 
            
            $file = PATH ."/directories/fs/".$data['filepath'];
            if( !file_exists($file)) {
                Errors::report('File not found.');
                break;
            }
            $size = filesize($file);
            header('Content-Description: File Transfer'); 
            header("Content-type: application/force-download");
            header('Content-Disposition: inline; filename="' .basename($file) . '"');
            header("Content-Transfer-Encoding: Binary");
            header("Content-length: ".$size);
            header('Content-Type: application/octet-stream');            
            header("Content-Disposition: attachment; filename=" . basename($file) . "");
            header("Cache-control: private");
            readfile($file);
        }
    break;
    
    case 'home':
        $ttitle = "ArticulateLogic :: Home";
        $al->tp->assign('ttitle', $ttitle);
        
        $data = getArticleByURL('home', $al->db);
        
        if(is_string($data)) {
            $al->tp->assign('rep', $data);
            $data = null;
        }

        if($data === false)
            $data = null;

        $al->tp->assign('home', true);
        $al->tp->assign('home_cont', html_entity_decode(stripslashes($data['body'])));
        $al->tp->assign('home_cont2', html_entity_decode(stripslashes(substr(strip_tags($data['body'], "<p><a>"), 0, 1374))));
        $al->tp->assign('title', $data['title']);
        $al->tp->assign('subtitle', $data['subtitle']);
        $al->tp->assign('keys', trim(stripslashes($data['meta_tags'])));
        $al->tp->assign('descrip', trim(stripslashes($data['title'])) . " : " . stripslashes($data['subtitle']) . " : " . stripslashes(substr(strip_tags($data['body']), 0, 300) )) ;
        $al->tp->assign('body', $al->tp->fetch('view_home.tpl'));
        $al->tp->display('main.tpl');
    break;
    
    case 'uhome':
        $al->tp->assign('ttitle',"Member Home :: ArticulateLogic.com");
        if(!$islogin) {
            Errors::report('The page is invalid. Cannot show the requested page.');
            $al->tp->assign('title', 'Invalid page.');
            $al->tp->assign('subtitle', 'Invalid request for page.');
            $al->tp->display('main.tpl');
            break;
        }
        
        getUserHomeByUserType($l->utype, $email, $al);
    break;
    
    case 'login':
        $al->tp->assign('ttitle',"Login :: ArticulateLogic.com");
        $al->tp->assign('title', 'Login');
        $al->tp->assign('subtitle', 'Login to have your member accessibility.');
        
        if(!$al->tp->template_exists('frm_login.tpl')) {
            Errors::report("Template file: frm_login.tpl is missing.");
            break;
        }
        
        $al->tp->assign('body', $al->tp->fetch('frm_login.tpl'));
        $al->tp->display('main.tpl');
    break;
    
    case 'logout':    
        $al->tp->assign('ttitle', "Logout :: ArticulateLogic.com");
        if($islogin == true) {
            $l = $_SESSION['login']; 
            $l->logout();
            unset($_SESSION['login']);
            unset($_COOKIE['ZakirCookie']);
        }
        
        $al->tp->assign('islogin',false);
        $al->tp->assign('rep', "You have been logged out");
        $al->tp->display('main.tpl');        
    break;
    
    case 'signup':
        $al->tp->assign('ttitle',"Signup :: ArticulateLogic.com");
        $al->tp->assign('title', 'Signup');
        $al->tp->assign('subtitle', 'Signup and become a part of the system.');
        
        if(!$al->tp->template_exists('frm_signup.tpl'))
        {
            Errors::report("Template file: frm_signup.tpl is missing.");
            break;
        }
        
        $body = $al->tp->fetch('frm_signup.tpl');
        
        $al->tp->assign('body', $body);
        $al->tp->display('main.tpl');
    break;
    
    case 'manage':
        if($params[1] == ""){
            Errors::report("Second parameter of URL is missing in 'manage' case of index.php.");
            break;
        }
        
        if($utype != 1){
            Errors::report("You do not have permission to view this page.");
            break;
        }
        
        if($params[1] == "articles" )
        {
            $al->tp->assign('title', 'List of articles');
            $al->tp->assign('selMenu','article');
            $table = "articles";
            $tpl = "view_arttable.tpl";
            
            $catList = getTableData('categories', $al->db);
            
            if(is_string($catList)) {
                $al->tp->assign('rep', $catList);
                $catList = null;
            }
            
            if($catList === false)
                $catList = null;
                
            $al->tp->assign('catList',$catList);
            $al->tp->assign('ttitle',"Manage Articles :: ArticulateLogic.com");
        }
        else if($params[1] == "users")
        {
            $al->tp->assign('title', 'List of users');
            $al->tp->assign('selMenu','user');
            $table = "users";
            $tpl = "view_usertbl.tpl";
            $al->tp->assign('ttitle',"Manage Users :: ArticulateLogic.com");
        }        
        else if($params[1] == "categories")
        {
            $al->tp->assign('title', 'List of users');
            $al->tp->assign('selMenu','category');
            $table = "categories";
            $tpl = "view_cattbl.tpl";
            $al->tp->assign('ttitle',"Manage Categories :: ArticulateLogic.com");
        }
        else if($params[1] == "files")
        {
            $al->tp->assign('title', 'List of files');
            $al->tp->assign('selMenu','files');
            $table = "files";
            $tpl = "view_filestbl.tpl";
            
            $catList = getTableData('categories', $al->db);
            
            if(is_string($catList)) {
                $al->tp->assign('rep', $catList);
                $catList = null;
            }
            
            if($catList === false)
                $catList = null;
                
            $al->tp->assign('catList',$catList);
            $al->tp->assign('ttitle',"Manage Files:: ArticulateLogic.com");            
        }
        else if($params[1] == "images")
        {
            $al->tp->assign('title', 'List of images');
            $al->tp->assign('selMenu','images');
            $table = "images";
            $tpl = "view_imagestbl.tpl";
                
            $al->tp->assign('catList',$catList);
            $al->tp->assign('ttitle',"Manage Images:: ArticulateLogic.com");
        }
        else {
            Errors::report("Second parameter of url: ".$params[1]." is not valid.");
            break;
        }
        
        if(!$al->tp->template_exists($tpl)){
            Errors::report("Template file: $tpl is missing.");
            break;
        }
        
        $data = getTableData($table, $al->db);
        
        if(is_string($data)) {
            $al->tp->assign('rep', $data);
            $data = null;
        }
        
        if($data === false)
            $data = null;
            
        $al->tp->assign('data',$data);
        
        $body = $al->tp->fetch('admin_menu.tpl');
        $body .= $al->tp->fetch($tpl);
        
        $al->tp->assign('body', $body);
        $al->tp->display('admin.tpl');
    break;

    case 'add':
        
        if($params[1] == ""){
            Errors::report("Second parameter of URL is missing in 'add' case of index.php.");
            break;
        }
        
        if($utype != 1){
            Errors::report("You do not have permission to view this page.");
            break;
        }
        
        if($params[1] == "article" )
        {
            $al->tp->assign('title', 'Add article');
            $al->tp->assign('selMenu','article');
            $table = "articles";
            $tpl = "frm_article.tpl";
            unset($_SESSION['article']);
            
            $editor_js = "subtpl/editor_js.tpl";
            $al->tp->assign('coneditor_js', $editor_js);
            
            $catList = getCategoryByMediaType(1, $al->db);
            
            if(is_string($catList)) {
                $al->tp->assign('rep', $catList);
                $catList = null;
            }
            
            if($catList === false)
                $catList = null;
                
            $al->tp->assign('catList',$catList);
            $al->tp->assign('ttitle',"Add Article:: ArticulateLogic.com");
        }
        else if($params[1] == "user")
        {
            $al->tp->assign('title', 'Add users');
            $al->tp->assign('selMenu','user');
            $table = "users";
            $tpl = "frm_user.tpl";
            $al->tp->assign('ttitle',"Add User:: ArticulateLogic.com");
        }
        else if($params[1] == "category")
        {
            $al->tp->assign('title', 'Add category');
            $al->tp->assign('selMenu','category');
            $table = "categories";
            $tpl = "frm_category.tpl";
            $al->tp->assign('ttitle',"Add Category:: ArticulateLogic.com");
        }
        else if($params[1] == "file" )
        {
            $al->tp->assign('title', 'Add file');
            $al->tp->assign('selMenu','file');
            $table = "files";
            $tpl = "frm_file.tpl";
            
            $catList = getCategoryByMediaType(2, $al->db);
            
            if(is_string($catList)) {
                $al->tp->assign('rep', $catList);
                $catList = null;
            }
            
            if($catList === false)
                $catList = null;
                
            $al->tp->assign('catList',$catList);
            $al->tp->assign('ttitle',"Add File:: ArticulateLogic.com");
        }
        else if($params[1] == "image" )
        {
            $al->tp->assign('title', 'Add image');
            $al->tp->assign('selMenu','image');
            $table = "images";
            $tpl = "frm_image.tpl";
            
            $artList = getImageFreeArticles($al->db);
            
            if(is_string($artList)) {
                $al->tp->assign('rep', $artList);
                $artList = null;
            }
            
            if($artList === false)
                $artList = null;
                
            $al->tp->assign('artList',$artList);
            $al->tp->assign('ttitle',"Add Image:: ArticulateLogic.com");
        }        
        else
        {
            Errors::report("Second parameter of url: ".$params[1]." is not valid.");
            break;
        }
            
        if(!$al->tp->template_exists($tpl)){
            Errors::report("Template file: $tpl is missing.");
            break;
        }
        
        $al->tp->assign('action', "add");
        $body = $al->tp->fetch('admin_menu.tpl');
        $body .= $al->tp->fetch($tpl);
        
        $al->tp->assign('body', $body);
        $al->tp->display('admin.tpl');        
    break;
    
    case 'edit':
        if($params[1] == ""){
            Errors::report("Second parameter of URL is missing in 'edit' case of index.php.");
            break;
        }
        
        if($utype != 1){
            Errors::report("You do not have permission to view this page.");
            break;
        }
        
        if($params[1] == "articles" )
        {
            $al->tp->assign('title', 'Edit article');
            $al->tp->assign('selMenu','article');
            $tpl = "frm_article.tpl";
            
            if($params[2] == ""){
                Errors::report("Third parameter: article id in the URL is missing in 'edit' case of index.php.");
                break;
            }
            
            $data = getRowById("articles", $params[2], $al->db);
        
            if(is_string($data)) {
                $al->tp->assign('rep', $data);
                $data = null;
            }

            if($data === false)
                $data = null;
            
            $data['body'] = html_entity_decode (stripslashes($data['body']) );
            $data['remarks'] = (stripslashes($data['remarks']) );
            $data['meta_tags'] = (stripslashes($data['meta_tags']) );
            $data['title'] = (stripslashes($data['title']) );
            $data['subtitle'] = (stripslashes($data['subtitle']) );
            $data['url'] = (stripslashes($data['url']) );
                
            $al->tp->assign('data',$data);
            
            $al->tp->assign('fckEditor', configFckEditMode($data['body']));

            if(!$al->tp->template_exists('subtpl/editor_js.tpl')){
                Errors::report("Template file: subtpl/editor_js.tpl is missing.");
                break;
            }
                        
            $al->tp->assign('coneditor_js', 'subtpl/editor_js.tpl');
            
            $catList = getCategoryByMediaType(1, $al->db);
            
            if(is_string($catList)) {
                $al->tp->assign('rep', $catList);
                $catList = null;
            }
            
            if($catList === false)
                $catList = null;
                
            $al->tp->assign('catList',$catList);
            $al->tp->assign('ttitle',"Edit Article:: ArticulateLogic.com");
        }
        else if($params[1] == "user")
        {
            $al->tp->assign('title', 'Edit user');
            $al->tp->assign('selMenu','user');
            $tpl = "frm_user.tpl";
            
            if($params[2] == ""){
                Errors::report("Third parameter: user id in the URL is missing in 'edit' case of index.php.");
                break;
            }
            
            $data = getRowById("users", $params[2], $al->db);
        
            if(is_string($data)) {
                $al->tp->assign('rep', $data);
                $data = null;
            }

            if($data === false)
                $data = null;
            
            $data['firstname'] = (stripslashes($data['firstname']) );
            $data['lastname'] = (stripslashes($data['lastname']) );
                
            $al->tp->assign('data',$data);
            $al->tp->assign('ttitle',"Edit User:: ArticulateLogic.com");         
        }
        else if($params[1] == "category")
        {
            $al->tp->assign('title', 'Edit category');
            $al->tp->assign('selMenu','category');
            $tpl = "frm_category.tpl";
            
            if($params[2] == ""){
                Errors::report("Third parameter: category id in the URL is missing in 'edit' case of index.php.");
                break;
            }
            
            $data = getRowById("categories", $params[2], $al->db);
        
            if(is_string($data)) {
                $al->tp->assign('rep', $data);
                $data = null;
            }

            if($data === false)
                $data = null;
            
            $data['catname'] = (stripslashes($data['catname']) );
                
            $al->tp->assign('data',$data);
            $al->tp->assign('ttitle',"Edit Category:: ArticulateLogic.com");
        }
        else if($params[1] == "file" )
        {
            $al->tp->assign('title', 'Edit files');
            $al->tp->assign('selMenu','file');
            $tpl = "frm_file.tpl";
            
            if($params[2] == ""){
                Errors::report("Third parameter: file id in the URL is missing in 'edit' case of index.php.");
                break;
            }
            
            $data = getRowById("files", $params[2], $al->db);
        
            if(is_string($data)) {
                $al->tp->assign('rep', $data);
                $data = null;
            }

            if($data === false)
                $data = null;
            
            $data['remarks'] = (stripslashes($data['remarks']) );
            $data['meta_tags'] = (stripslashes($data['meta_tags']) );
            $data['ftitle'] = (stripslashes($data['ftitle']) );
            $data['url'] = (stripslashes($data['url']) );
                
            $al->tp->assign('data',$data);
            
            $catList = getCategoryByMediaType(2, $al->db);
            
            if(is_string($catList)) {
                $al->tp->assign('rep', $catList);
                $catList = null;
            }
            
            if($catList === false)
                $catList = null;
                
            $al->tp->assign('catList',$catList);
            $al->tp->assign('ttitle',"Edit File:: ArticulateLogic.com");
        }
        else if($params[1] == "image" )
        {
            $al->tp->assign('title', 'Edit Image');
            $al->tp->assign('selMenu','image');
            $tpl = "frm_image.tpl";
            
            if($params[2] == ""){
                Errors::report("Third parameter: file id in the URL is missing in 'edit' case of index.php.");
                break;
            }
            
            $data = getRowById("images", $params[2], $al->db);
        
            if(is_string($data)) {
                $al->tp->assign('rep', $data);
                $data = null;
            }

            if($data === false)
                $data = null;
            
            $data['ftitle'] = (stripslashes($data['ftitle']) );
                
            $al->tp->assign('data',$data);
            
            $art = getRowById('articles',$data['article_id'], $al->db);
            
            if(is_string($art)) {
                $al->tp->assign('rep', $art);
                $art = null;
            }
            
            if($art === false)
                $art = null;
            
            $artList = getImageFreeArticles($al->db);    
            
            if(is_string($artList)) {
                $al->tp->assign('rep', $artList);
                $artList = null;
            }
            
            if($artList === false)
                $artList = null;
            $al->tp->assign('art',$art);
            $al->tp->assign('artList',$artList);
            
            $al->tp->assign('ttitle',"Edit Image:: ArticulateLogic.com");
        }
        else if($params[1] == "account")
        {
            $al->tp->assign('title', 'Edit Account');
            $al->tp->assign('selMenu','account');
            $tpl = "frm_user.tpl";
            
            $data = getRowById("users", $l->getId(), $al->db);
        
            if(is_string($data)) {
                $al->tp->assign('rep', $data);
                $data = null;
            }

            if($data === false)
                $data = null;
            
            $data['firstname'] = (stripslashes($data['firstname']) );
            $data['lastname'] = (stripslashes($data['lastname']) );
                
            $al->tp->assign('data',$data);
            $al->tp->assign('ttitle',"Edit Account:: ArticulateLogic.com");
        }        
        else
        {
            Errors::report("Second parameter of url: ".$params[1]." is not valid.");
            break;
        }
        
        if(!$al->tp->template_exists($tpl)){
            Errors::report("Template file: $tpl is missing.");
            break;
        }        
        
        $al->tp->assign('action', 'edit');
        $body = $al->tp->fetch('admin_menu.tpl');
        $body .= $al->tp->fetch($tpl);
        
        $al->tp->assign('body', $body);
        $al->tp->display('admin.tpl');
    break;
    
    case 'delete':
        if($params[1] == ""){
            Errors::report("Second parameter of URL is missing in 'delete' case of index.php.");
            break;
        }
        
        if($params[2] == ""){
            Errors::report("Third parameter : content id in the URL is missing in 'delete' case of index.php.");
            break;
        }
        if($utype != 1){
            Errors::report("You do not have permission to view this page.");
            break;
        }
        
        if($params[1] == "article" )
        {
            $al->tp->assign('title', 'List of articles');
            $al->tp->assign('selMenu','article');
            $table = "articles";
            $tpl = "view_arttable.tpl";
            
            $catList = getTableData('categories', $al->db);
            
            if(is_string($catList)) {
                $al->tp->assign('rep', $catList);
                $catList = null;
            }
            
            if($catList === false)
                $catList = null;
                
            $al->tp->assign('catList',$catList);
            
            $isDeleted = deleteRow($table, $params[2], $al->db);
            
            if($isDeleted === false)
                break;
            else
                $al->tp->assign('rep', "The article with id = ".$params[2]." has been deleted.");
            
            $al->tp->assign('ttitle',"Delete Article:: ArticulateLogic.com");
        }
        else if($params[1] == "user")
        {
            $al->tp->assign('title', 'List of users');
            $al->tp->assign('selMenu','user');
            $table = "users";
            $tpl = "view_usertbl.tpl";
            
            $isDeleted = deleteRow($table, $params[2], $al->db);
            
            if($isDeleted === false)
                break;
            else
                $al->tp->assign('rep', "The user with id = ".$params[2]." has been deleted.");
            
            $al->tp->assign('ttitle',"Delete User:: ArticulateLogic.com");
        }
        else if($params[1] == "category")
        {
            $al->tp->assign('title', 'List of users');
            $al->tp->assign('selMenu','category');
            $table = "categories";
            $tpl = "view_cattbl.tpl";
            
            $isDeleted = deleteRow($table, $params[2], $al->db);
            
            if($isDeleted === false)
                break;
            else
                $al->tp->assign('rep', "The category with id = ".$params[2]." has been deleted.");
            
            $al->tp->assign('ttitle',"Delete Category:: ArticulateLogic.com");
        }
        else if($params[1] == "file" )
        {
            $al->tp->assign('title', 'List of files');
            $al->tp->assign('selMenu','file');
            $table = "files";
            $tpl = "view_filestbl.tpl";

            $catList = getTableData('categories', $al->db);
            
            if(is_string($catList)) {
                $al->tp->assign('rep', $catList);
                $catList = null;
            }
            
            if($catList === false)
                $catList = null;
                
            $al->tp->assign('catList', $catList);
            
            $isFileDeleted = deleteFile($params[2], $al->db);
            
            if($isFileDeleted === false)
                break;
                
            $isDeleted = deleteRow($table, $params[2], $al->db);
            
            if($isDeleted === false)
                break;
            else
                $al->tp->assign('rep', "The file with id = ".$params[2]." has been deleted.");
            
            $al->tp->assign('ttitle',"Delete File:: ArticulateLogic.com");
        }
        else if($params[1] == "image" )
        {
            $al->tp->assign('title', 'List of images');
            $al->tp->assign('selMenu','image');
            $table = "images";
            $tpl = "view_imagestbl.tpl";
            
            $isFileDeleted = deleteImage($params[2], $al->db);
            
            if($isFileDeleted === false)
                break;
                
            $isDeleted = deleteRow($table, $params[2], $al->db);
            
            if($isDeleted === false)
                break;
            else
                $al->tp->assign('rep', "The image with id = ".$params[2]." has been deleted.");
            
            $al->tp->assign('ttitle',"Delete Image:: ArticulateLogic.com");
        }
        else
        {
            Errors::report("Second parameter of url: ".$params[1]." is not valid.");
            break;
        }
                
        if(!$al->tp->template_exists($tpl)){
            Errors::report("Template file: $tpl is missing.");
            break;
        }
        
        $data = getTableData($table, $al->db);
        
        if(is_string($data)) {
            $al->tp->assign('rep', $data);
            $data = null;
        }
        
        if($data === false)
            $data = null;
            
        $al->tp->assign('data',$data);
        
        $body = $al->tp->fetch('admin_menu.tpl');
        $body .= $al->tp->fetch($tpl);
        
        $al->tp->assign('body', $body);
        $al->tp->display('admin.tpl');
    break;
 
    case 'toggle':
        if($params[1] == "" || $params[2] == "" || $params[3] == ""){
            Errors::report("Parameter(s) of URL is/are missing:  in 'toggle' case of index.php. param 1: ". $params[1] . ", param 2: ".$params[2] . ", param 3: " . $params[3]);
            break;
        }
        
        if($utype != 1){
            Errors::report("You do not have permission to view this page.");
            break;
        }
        
        if($params[1] == "article" )
        {
            $al->tp->assign('title', 'List of articles');
            $al->tp->assign('selMenu','article');
            $table = "articles";
            $tpl = "view_arttable.tpl";
            
            $catList = getTableData('categories', $al->db);
            
            if(is_string($catList)) {
                $al->tp->assign('rep', $catList);
                $catList = null;
            }
            
            if($catList === false)
                $catList = null;
                
            $al->tp->assign('catList',$catList);
            
            if($params[2] == "permission")
            {
                $data = getRowById('articles', $params[3], $al->db);
                
                if(is_string($data)) {
                    $al->tp->assign('rep', $data);
                    $data = null;
                }
                
                if($data === false)
                    $data = null;                
                
                
                $state = $data['state'] == 1 ? 0: 1;
                $fields = array('state');
                $values = array($state);
                
                if(setRow('articles', $fields, $values, 'update', $al->db, $params[3]) === false)
                    break;
                else
                    $al->tp->assign('rep', "The article permission for id = ".$params[3]." has been updated.");
                
                $al->tp->assign('ttitle',"Toggle Article Permission:: ArticulateLogic.com");
            }
            else
            {
                Errors::report("Parameter 3: ". $params[2] ." is invalid for article toggle operation.");
                break;
            }
        }
        else if($params[1] == "user")
        {
            $al->tp->assign('title', 'List of users');
            $al->tp->assign('selMenu','user');
            $table = "users";
            $tpl = "view_usertbl.tpl";
            
            if($params[2] == "permission")
            {
                $data = getRowById('users', $params[3], $al->db);
                
                if($data === false)
                    break;
                
                $state = $data['state'] == 1 ? 0: 1;
                $fields = array('state');
                $values = array($state);
                
                if(setRow('users', $fields, $values, 'update', $al->db, $params[3]) === false)
                    break;
                else
                    $al->tp->assign('rep', "The user permission for id = ".$params[3]." has been updated.");
                
                $al->tp->assign('ttitle',"Toggle User Permission:: ArticulateLogic.com");
            }
            else if($params[2] == "type")
            {
                $data = getRowById('users', $params[3], $al->db);
                
                if($data === false)
                    break;                
                
                $ut = $data['utype'] == 1 ? 0: 1;
                
                $fields = array('utype');
                $values = array($ut);
                
                if(setRow('users', $fields, $values, 'update', $al->db, $params[3]) === false)
                    break;
                else
                    $al->tp->assign('rep', "The user type for id = ".$params[3]." has been updated.");
                
                $al->tp->assign('ttitle',"Toggle User Type:: ArticulateLogic.com");
            }
            else if($params[2] == "status")
            {
                $data = getRowById('users', $params[3], $al->db);
                
                if($data === false)
                    break;                
                
                $ut = $data['ustatus'] == 1 ? 0: 1;
                
                $fields = array('ustatus');
                $values = array($ut);
                
                if(setRow('users', $fields, $values, 'update', $al->db, $params[3]) === false) 
                    break;
                else    
                    $al->tp->assign('rep', "The user status for id = ".$params[3]." has been updated.");
                
                $al->tp->assign('ttitle',"Toggle User Status:: ArticulateLogic.com");
            }
            else
            {
                Errors::report("Parameter 3: ". $params[2] ." is invalid for user toggle operation.");
                break;
            }
        }
        else if($params[1] == "category")
        {
            $al->tp->assign('title', 'List of users');
            $al->tp->assign('selMenu','category');
            $table = "categories";
            $tpl = "view_cattbl.tpl";
            
            if($params[2] == "permission"){
                $data = getRowById('categories', $params[3], $al->db);
                $state = $data['state'] == 1 ? 0: 1;
                $fields = array('state');
                $values = array($state);
                
                if(setRow('categories', $fields, $values, 'update', $al->db, $params[3]) === false)
                    break;
                else
                    $al->tp->assign('rep', "The category permission for id = ".$params[3]." has been updated.");
                
                $al->tp->assign('ttitle',"Toggle Category Permission:: ArticulateLogic.com");
            }
            else{
                Errors::report("Parameter 3: ". $params[2] ." is invalid for category toggle operation.");
                break;
            }            
        }
        else if($params[1] == "file" )
        {
            $al->tp->assign('title', 'List of files');
            $al->tp->assign('selMenu','files');
            $table = "files";
            $tpl = "view_filestbl.tpl";
            
            $catList = getTableData('categories', $al->db);
            
            if(is_string($catList)) {
                $al->tp->assign('rep', $catList);
                $catList = null;
            }
            
            if($catList === false)
                $catList = null;
                
            $al->tp->assign('catList',$catList);
            
            if($params[2] == "permission")
            {
                $data = getRowById('files', $params[3], $al->db);
                $state = $data['state'] == 1 ? 0: 1;
                $fields = array('state');
                $values = array($state);
                
                $isupdated = setRow('files', $fields, $values, 'update', $al->db, $params[3]);
                
                if(setRow('images', $fields, $values, 'update', $al->db, $params[3]) === false)
                    break;
                else
                    $al->tp->assign('rep', "The files permission for id = ".$params[3]." has been updated.");
                
                $al->tp->assign('ttitle',"Toggle File Permission:: ArticulateLogic.com");
            }
            else
            {
                Errors::report("Parameter 3: ". $params[2] ." is invalid for files toggle operation.");
                break;
            }
        }
        else if($params[1] == "image" )
        {
            $al->tp->assign('title', 'List of images');
            $al->tp->assign('selMenu','files');
            $table = "images";
            $tpl = "view_imagestbl.tpl";
            
            if($params[2] == "permission")
            {
                $data = getRowById('images', $params[3], $al->db);
                $state = $data['state'] == 1 ? 0: 1;
                $fields = array('state');
                $values = array($state);
                
                $isupdated = setRow('images', $fields, $values, 'update', $al->db, $params[3]);
                
                if(setRow('images', $fields, $values, 'update', $al->db, $params[3]) === false)
                    break;
                else
                    $al->tp->assign('rep', "The images permission for id = ".$params[3]." has been updated.");
                
                $al->tp->assign('ttitle',"Toggle Images Permission:: ArticulateLogic.com");
            }
            else
            {
                Errors::report("Parameter 3: ". $params[2] ." is invalid for files toggle operation.");
                break;
            }
        }
        else{
            Errors::report("Second parameter of url: ".$params[1]." is not valid.");
            break;
        }
        
        if(!$al->tp->template_exists($tpl)){
            Errors::report("Template file: $tpl is missing.");
            break;
        }
        
        $data = getTableData($table, $al->db);
        
        if(is_string($data)) {
            $al->tp->assign('rep', $data);
            $data = null;
        }
        
        if($data === false)
            $data = null;
            
        $al->tp->assign('data',$data);
        
        $body = $al->tp->fetch('admin_menu.tpl');
        $body .= $al->tp->fetch($tpl);
        
        $al->tp->assign('body', $body);
        $al->tp->display('admin.tpl');
    break;
        
    default:
        $al->tp->assign('ttitle',"Invalid Page :: ArticulateLogic.com");
        $al->tp->assign('title', 'Invalid request for page.');
        $al->tp->assign('subtitle', 'The page is still Underconstruction.');
        $errmsg[] = 'The page is still Underconstruction, can not find the requested page.';
        $al->tp->assign('errmsg', $errmsg);        
        $al->tp->display('error.tpl');
}
?>
