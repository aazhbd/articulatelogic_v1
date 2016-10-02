<?php

/*
*   gets the parameters from the url, and sets each of them in array.
*/
function getParams()
{
    $params = array();
    
    if( isset($_GET['url']) )
        $params = explode('/', $_GET['url']);
        
    if(count($params) == 0)
        $params[] = 'home';

    return $params;
}

/**
*   This function loads user home templates for diffferent types of users: e.g admin/ normal user
*/
function getUserHomeByUserType($userType, $email, $al)
{
    if($userType === "") {
        Errors::report("User type of user is missing.");
        return false;
    }

    $data = getUserByEmail($email, $al->db);
    
    if($data === false) return false;
    
    if(is_string($data)) return $data;
    
    $name = $data['firstname'] . " " . $data['lastname'];
    
    switch($userType)
    {
        case '0':            
            $title = "Welcome, $name";
            $subtitle = "You are a normal user.";
            $menuTpl = 'home_user.tpl';
            $mainTpl = 'main.tpl';
        break;
        
        case '1':
            $title = "Welcome, $name";
            $subtitle = "You are an Administrator.";
            $mainTpl = 'admin.tpl';
            $menuTpl = 'admin_menu.tpl';
            $menuBlockTpl = 'admin_menublock.tpl';
            
            $isadmin = true;
        break;
        
        default:
            Errors::report("User type of user is invalid.");
            return false;
    }
    
    $al->tp->assign('title', $title);
    $al->tp->assign('subtitle', $subtitle);

    if($isadmin) {
        if(!$al->tp->template_exists($menuTpl)) {
            Errors::report("The template file, $menuTpl is missing");
            return false;
        }
        
        if(!$al->tp->template_exists($menuBlockTpl)) {
            Errors::report("The template file, $menuBlockTpl is missing");
            return false;
        }        
        $body = $al->tp->fetch($menuTpl);
        $body .= $al->tp->fetch($menuBlockTpl);
    }
    else {
        if(!$al->tp->template_exists($menuTpl)) {
            Errors::report("The template file, $menuTpl is missing");
            return false;
        }
        $body .= $al->tp->fetch($menuTpl);
    }
    
    $al->tp->assign('body', $body);
    
    if(!$al->tp->template_exists($mainTpl)) {
        Errors::report("The file, $mainTpl is missing");
        return false;
    }
    
    $al->tp->display($mainTpl);
    return true;
}

/**
*   This function gives a list of items for various media types or without media type.
*   Categories Table has a type name: Article and media id = 1 as default
*/
function getStaticList($tableName, $type)
{
    if($tableName == "" || ( $tableName == 'categories' && $type == "") ) {
        Errors::report("Values are missing: Table name: $tableName , Media type : $type for static list.");
        return false;
    }
    
    if($tableName == 'categories')
    {
        if($type == 'Article')
        {
            $catList = array();
            $catList[] = 'News and Events';
            $catList[] = 'Science';
            $catList[] = 'Computer and Technology';
            $catList[] = 'Cars and Automobile';
            $catList[] = 'Business';
            $catList[] = 'Arts and Humanities';
            $catList[] = 'Finance and Accounting';
            $catList[] = 'Politics';
            $catList[] = 'Religion';
            $catList[] = 'Society and Culture';
            $catList[] = 'Family and relationships';
            $catList[] = 'Entertainment';
            $catList[] = 'Music';
            $catList[] = 'Recreation and Games';
            $catList[] = 'Literature';
            $catList[] = 'Education and Reference';
            $catList[] = 'Health and Medicine';
            $catList[] = 'Psychology';
            $catList[] = 'Food and Drink';
            $catList[] = 'Sports and Travel';
        }
        else {
            Errors::report("Media type for $tableName table is invalid for static list.");
            return false;            
        }
    }
    else {
        Errors::report("Invalid table name: $tableName for static list.");
        return false;
    }
}

/**
*   Gets a lists of dates by parameter: year, month, day for a range of maximum and minimum values
*/
function getDateListByParam($param, $minValue, $maxValue)
{
    if($param == "" || $minValue == "" || $maxValue == "" ) {
        Errors::report("Values are missing, param: $param, minValue: $minValue and maxValue: $maxValue ");
        return false;
    }
    
    $maxValue = (int) $maxValue;
    $minValue = (int) $minValue;
    
    if($maxValue == $minValue) {
        Errors::report("Maximum value for date with parameter = $param is equal to its minimum value. Can not show $param list.");
        return false;        
    }

    $list = array();
    
    if($maxValue < $minValue)
    {
        $a = $minValue;
        $minValue = $maxValue;
        $maxValue = $a;
    }
    
    for($i = $minValue; $i <= $maxValue; $i++)
        $list[] = $i;
    
    if(count($list) == 0) {
        Errors::report("Date list with parameter = $param is empty.");
        return false;
    }
    
    return $list;
}

/**
*   This function configures the fck editor for the article editing mode
*/
function configFckEditMode($body, $divIdName = 'bodytxt', $toolbar = "ArticleToolbar", $width = 800, $height = 500)
{
    if($divIdName == "" || $toolbar == "" || $width == "" || $height == "" || $body == "") {
        Errors::report("Values are missing:  div id: $divIdName, toolbarName: $toolbar, width: $width and height: $height ");
        return false;
    }
    
    if($body == "") {
        Errors::report("Body of editor text is missing.");
        return false;
    }
    
    try {
        $oFCKeditor = new FCKeditor($divIdName);
        $oFCKeditor->BasePath = URL.'/scripts/fckeditor/' ;
        $oFCKeditor->Config["CustomConfigurationsPath"] = 'edconfig.js'; 
        $oFCKeditor->Config['SkinPath'] = "skins/silver/" ;
        $oFCKeditor->Width = $width;
        $oFCKeditor->Height = $height;
        $oFCKeditor->ToolbarSet = 'ArticleToolbar' ;
                
        $oFCKeditor->Value = "".$body ."";
        
        $fckEditor = $oFCKeditor->CreateHtml();
    }
    catch(Exception $ex) {
        Errors::report($ex->getMessage());
        return false;
    }

    return $fckEditor;
}

function deleteFile($id, $db)
{
    $data =  getRowById("files", $id, $db);
    
    if(is_string($data)) {
        Errors::report("this-".$data);
        return false;
    }
    
    if($data === false)
        return false;
    
    if(!file_exists(PATH ."/directories/fs/" . $data['filepath'])) {
        Errors::report("Can not delete file in location: " . PATH ."/directories/fs/" . $data['filepath'] .". Path do not exist.");
        return false;
    }
    if(unlink(PATH ."/directories/fs/" . $data['filepath']))
        return true;
    else
        return false;
}

function deleteImage($id, $db)
{
    $data =  getRowById("images", $id, $db);
    
    if(is_string($data)) {
        Errors::report("this-".$data);
        return false;
    }
    
    if($data === false)
        return false;
    
    if(!file_exists(PATH ."/directories/is/" . $data['filepath'])) {
        Errors::report("Can not delete image in location: " . PATH ."/directories/is/" . $data['filepath'] .". Path do not exist.");
        return false;
    }
    if(unlink(PATH ."/directories/is/" . $data['filepath']))
        return true;
    else
        return false;
}

function getservnames()
{
    $serv_list = array(
                            "Website Design & Development",
                            "Web Based Small Business Solutions",
                            "Web Based Enterprise Solutions",
                            "Application Software Solutions",
                            "Network & Communication Software Solutions",
                            "Multi-platform Services",
                            "Graphic Design & Animation",
                            "Icons & Logo Design",
                            "Web Template Design",
                            "Software Upgrade, Improvement & Maintenance",
                            "System Administration & Installation",
                            "Network Administration & Installation",
                            "Programming Solutions",
                            "Consultancy",
                            "Web Marketing",
                            "Other"
                            
                    );
    return $serv_list;
}

function getbgtrange()
{
    $bgt = array(
                            "$100 - 500",
                            "$500 - 2000",
                            "$2000 - 5000",
                            "$5000 - 10,000",
                            "$10,000 - 25,000",
                            "$25,000 - 50,000",
                            "$50,000 - 100,000",
                            "$100,000+",
                            "Undetermined"
                    );
    return $bgt;
}

function getprojstrt()
{
    $proj_start = array(
                            "Please select",
                            "Immediately",
                            "1 - 2 Weeks",
                            "2 - 4 Weeks",
                            "4 - 8 Weeks",
                            "8 Weeks+ "
                    );
    return $proj_start;
}

function simpleMail($al, $msgBody, $subject, $fromAr = array('web@articulatelogic.com' => 'Articulatelogic Team'), $toAr = array('web@articulatelogic.com' => 'Articulatelogic Team'), $msgtype = "text/plain" , $replyTo = array('web@articulatelogic.com' => 'Articulatelogic Team'), $priority = 0)
{
    $transport = Swift_SmtpTransport::newInstance('localhost', 25);

    $mailer = Swift_Mailer::newInstance($transport);
    
    $message = Swift_Message::newInstance($subject)
              ->setFrom($fromAr)
              ->setTo($toAr)
              ->setBody($msgBody, $msgtype)
              ->setReplyTo($replyTo)
              ;
    $numSent = $mailer->send($message);
        
    if ($numSent <= 0 || $numSent == null )
        return false;

    return true;
}

?>
