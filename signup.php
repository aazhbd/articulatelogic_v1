<?php
if(!isset($_POST['submit'])){ echo "You can not access this page directly."; return; }

require_once('config/project.class.php');
$al = new Project();

$title = "";
$body = "";
$rep = "";
$islogin = false;
$mail_sent = false;
$isinserted = false;

$al->tp->assign('ttitle',"Signup:: ArticulateLogic.com");

extract($_POST);

list($month, $day, $year) = explode("/", $_POST['birthdate']);

$fieldinfo = getFieldInfo('users', $al->db);
$i = 0;
foreach($fieldinfo as $f)
{
    if($i > 0) $q .= " or ";
    $fields[] = $f['Field'];
    $i++;
}

$values = array("NULL", trim($email), trim($password), trim($fname), trim($lname), $sex, $year."-".$month."-".$day, sha1(rand(10, 100)), 0, 1, 0, date("Y-m-d G:i:s"), date("Y-m-d G:i:s"), 0 );

$isinserted = setRow('users', $fields, $values, 'insert', $al->db);

if($isinserted === true)
{
    $title = "Congratulations!";
    $body = "You are now registered to Articulatelogic CMS. You can now login, with your user name and password that you provided.";
    $rep = "Signup Successful !";
}
else
{
    $title = "Sorry, your signup process failed !";
    $body = "Possible reasons could be the existence of this email address in database already or the entering of invalid characters in  first name, last name, password or email address. Please try <a href='".URL."/signup'>signing up</a> again.";
}
$al->tp->assign('title', $title);

$al->tp->assign('body', $body);

$al->tp->assign('rep', $rep);

$al->tp->display('main.tpl');

?>
