<?php
require_once('config/project.class.php');
$al = new Project();

//require_once( 'scripts/mailer/swift_required.php' );
//$transport = new Swift_SmtpTransport('localhost', 25);
$transport = Swift_SmtpTransport::newInstance('localhost', 25);

$mailer = Swift_Mailer::newInstance($transport);

$message = Swift_Message::newInstance('hello_test subject')
          ->setFrom(array("web@articulatelogic.com" => "ArticulateLogic"))
          ->setTo(array("web@articulatelogic.com" => "ArticulateLogic"))
          ->setBody("This is message", "text/plain")
          ->setReplyTo(array("web@articulatelogic.com" => "ArticulateLogic"))
          ;

$numSent = $mailer->send($message);

if($numSent <= 0) 
    echo "Failed to send email.";

else 
    echo "Mail sent";

?>