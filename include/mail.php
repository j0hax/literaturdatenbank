<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

//Load Composer's autoloader
require 'vendor/autoload.php';

function sendMail($sendMailAdress, $sendMailSubject, $sendMailMessage)
{
 //Create an instance; passing `true` enables exceptions
 $mail = new PHPMailer(true);
 try {
  //Server settings
  $mail->isSMTP();
  $mail->Host       = getenv('SMTP_SERVER');
  $mail->SMTPAuth   = false;
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
  $mail->Port       = 25;

  //Recipients
  $mail->setFrom('noreply@data.ikm.uni-hannover.de', 'Literaturdatenbank');
  $mail->addAddress($sendMailAdress);

  //Content
  $mail->isHTML(false);
  $mail->Subject = $sendMailSubject;
  $mail->Body    = $sendMailMessage;

  $mail->send();
 } catch (Exception $e) {
  die($mail->ErrorInfo);
 }
}
