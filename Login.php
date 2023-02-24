<?php
 
 require_once("Connect.php"); 

$pass=$_POST['pass'];


if(password_verify($pass, '$2y$10$gM8nCRYkbBKNWMBfRvlQGul8lVreep.GcCjgikENMrVXl//XRZ.2O'))  
                     {  
echo'wererer';
}
$email=$_POST['email'];
$stmt   = $con -> prepare('SELECT * FROM users WHERE  (User_Email=? or User_Name=?)');
            $stmt   -> execute(array($email,$email));
            $item    = $stmt -> fetch() ;
            $count  =  $stmt -> rowCount() ;

if( $count==1 && password_verify($pass, $item['User_password'])){
session_start();
$_SESSION['email']=$item['User_Email'];
$_SESSION['User_Name']= $item['User_Name'];
$_SESSION['User_ID']=$item['User_ID'];
$_SESSION['rand'] =$six_digit_random_number = random_int(100000, 999999);
require_once("mail.php");





  }
else
echo "Erro Nothing Users ";
 require_once("login.php");
?>