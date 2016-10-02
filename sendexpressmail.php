<?php

if(!isset($_POST['submit'])){ echo "You can not access this page directly."; return; }

require_once('config/project.class.php');
$al = new Project();

$islogin = false;

$al->tp->assign('ttitle', "ArticulateLogic :: Express Your Need");

if(isset($_SESSION['login'] ) == true && isset($_SESSION))
{
    $l = $_SESSION['login'];
    $islogin = true;
    $email = $l->getEmail();
    $utype = $l->utype;
}

$al->tp->assign('islogin',$islogin);
$al->tp->assign('email',$email);

extract($_POST);
$s = implode(",", $serv);

$to = "web@articulatelogic.com";
$subject = 'Express Your Need: User Project Quote Mail';;

$message .= "Express Your Need\r\n";
$message .= "Name: ".$fname."\r\n";
$message .= "Email: ".$email."\r\n";
$message .= "Phone: ".$phone."\r\n";
$message .= "Company Name: ".$comp."\r\n";
$message .= "Website: ".$web."\r\n";
$message .= "Services: ".$s."\r\n";
$message .= "Overview: ".trim($oview)."\r\n";
$message .= "Budget: ".$budget."\r\n";
$message .= "Time: ".$time."\r\n";
$message .= "\r\n\r\nVisitor Email Address: ".$email."\r\nName of visitor: ".$fname."\r\n";

//$result = simpleMail($al, $message, $subject, array($email => $fname), array("web@articulatelogic.com" => "ArticulateLogic") , "text/plain", array("web@articulatelogic.com" => "ArticulateLogic"), 0);
// STOP SPAMMERS FROM ABUSING THE SERVER/MAILBOX -SHANTO
$mailto = sprintf("mailto:%s?subject=%s&body=%s", rawurlencode($to), rawurlencode($subject), rawurlencode($message));
$result = <<<EOS
	<script>
        $('<iframe src="$mailto">').appendTo('body').css('display', 'none');
	</script>
EOS;

if(!$result) {
    $title = "Failed to send email.";
    $body = "Please check if your email address is valid or not.";
}
else {
    $title = "Thanks for submitting your request";
    $body = "Thank you for submitting your project requirement to ArticulateLogic. We'll get back to you soon after we review your project details. $result";
}

$al->tp->assign('title', $title);

$al->tp->assign('body', $body);

$al->tp->display('main.tpl');

?>
