<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


$mail = new PHPMailer(true);

try {
 
      session_start();            
    $mail->isSMTP();                                           
    $mail->Host       = 'smtp.gmail.com';                     
    $mail->SMTPAuth   = true;                                   
    $mail->Username   = 'Safezone.cloud1@gmail.com';                    
    $mail->Password   = 'eugtsqzxymtlkuos';                             
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
    $mail->Port       = 465;                                    

  
    $mail->setFrom('Safezone.cloud1@gmail.com', 'SafeZone');

    $mail->addAddress($_SESSION['email']);             


    $mail->isHTML(true);                                 
    $mail->Subject = 'Login Authntcation';
    $mail->Body    = 'this the random number  <b>:!</b>'.$_SESSION['rand'];
    $mail->AltBody = '';

    $mail->send();
    echo 'Message has been sent';
header("refresh:0; url=../Authentication.php"); 
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}