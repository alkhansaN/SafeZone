<?php
$Max_ID=0;
  require_once("Connect.php"); 
       if( empty($_POST['repass']) || empty($_POST['pass']))
{
            echo"enter your data";
            } 
       else {
session_start();

    $pass= password_hash($_POST['pass'], PASSWORD_DEFAULT); 
         $stmt = $con -> prepare("update users set User_password='$pass' where User_Email='$_SESSION[email]'");
        if ($stmt -> execute())
        {
         header("refresh:0; url=../Login.html"); 
         
        } else {
          echo "Error: " . $sql . "<br>" . mysqli_error($con);
        }  
} 
?>