<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


$mail = new PHPMailer(true);

try {
 require_once("Connect.php"); 
      session_start(); 
$_SESSION['rand'] =$six_digit_random_number = random_int(100000, 999999);
 $email=$_GET['email'];
$stmt   = $con -> prepare('SELECT * FROM users WHERE  (User_Email=? or User_Name=?)');
            $stmt   -> execute(array($email,$email));
            $item    = $stmt -> fetch() ;
            $count  =  $stmt -> rowCount() ;
if ($count==0){
echo "the email not found";
return;
}

$_SESSION['email']=$item['User_Email'];
$_SESSION['User_Name']= $item['User_Name'];
$_SESSION['User_ID']=$item['User_ID'];         
    $mail->isSMTP();                                           
    $mail->Host       = 'smtp.gmail.com';                     
    $mail->SMTPAuth   = true;                                   
    $mail->Username   = 'Safezone.cloud1@gmail.com';                    
    $mail->Password   = 'eugtsqzxymtlkuos';                             
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
    $mail->Port       = 465;                                    

  
    $mail->setFrom('Safezone.cloud1@gmail.com', 'SafeZone');

    $mail->addAddress($_GET['email']);             


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