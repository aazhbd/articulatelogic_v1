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

$al->tp->assign('islogin', $islogin);
$al->tp->assign('email', $email);

extract($_POST);

$search = trim($search);

$data = searchRows('articles', $search, $al->db);

if(is_string($data)) {
    $al->tp->assign('rep', $data);
    $data = null;
}

if($data === false)
{
    $data = null;
    return;
}

if($data != null)
{
    foreach($data as $a)
    {
        $art[$i] = $a;
        $art[$i]['body'] = html_entity_decode( stripslashes ( $art[$i]['body'] ));
        
        $art[$i]['title'] = stripslashes($art[$i]['title']);
        $art[$i]['subtitle'] = stripslashes($art[$i]['subtitle']);
        $art[$i]['remarks'] = stripslashes($art[$i]['remarks']);
        $art[$i]['meta_tags'] = stripslashes($art[$i]['meta_tags']);
        $i++;
    }
}
    
$al->tp->assign('articles', $art);


$token = $search;
$al->tp->assign('token',$token);

$body = $al->tp->fetch('view_result.tpl');

$al->tp->assign('islogin',$islogin);
$al->tp->assign('rep', $rep);
$al->tp->assign('body', $body);
$al->tp->assign('subtitle', "Search result for: $token");
$al->tp->assign('title', "Articulate Search result pages");

$ttitle =  "Search result: $search";
$al->tp->assign('ttitle', $ttitle);

if($uid == 1)
    $al->tp->display('admin.tpl');
else
    $al->tp->display('main.tpl');

?>