<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "../vendor/phpmailer/phpmailer/src/Exception.php";
require '../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../vendor/phpmailer/phpmailer/src/SMTP.php';

require_once "../vendor/autoload.php";

//PHPMailer Object
$mail = new PHPMailer(true); //Argument true in constructor enables exceptions
$mail->SMTPDebug = 3;                               
//Set PHPMailer to use SMTP.
$mail->isSMTP();            
//Set SMTP host name                          
$mail->Host = "smtp.gmail.com";
//Set this to true if SMTP host requires authentication to send email
$mail->SMTPAuth = true;                          
//Provide username and password     
$mail->Username = "guccilinen69@gmail.com";
$mail->Password = "evetigokazuvam2001";                           
//If SMTP requires TLS encryption then set it
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
//Set TCP port to connect to
$mail->Port = 587;                                   

$mail->From = "Athena-WP4@gmail.com";
$mail->FromName = "Emilija";

$mail->addAddress("tanjagrozdani@gmail.com");

$mail->isHTML(true);

$mail->Subject = "Subject Text";
$mail->Body = "<i>Mail body in HTML</i>";
$mail->AltBody = "This is the plain text version of the email content";

try {
  if (isset($_POST['obvestilo'])){
    $mail->send();
    echo "Message has been sent successfully";}
} catch (Exception $e) {
    echo "Mailer Error: " . $mail->ErrorInfo;
}

?>