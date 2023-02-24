<?php
require_once("Connect.php"); 
session_start();


   
        $imgData = file_get_contents($_FILES['image']['tmp_name']);
        $imgType = $_FILES['userImage']['type'];

if($_POST['Withpass']==1){
$pass= password_hash($_POST['pass'], PASSWORD_DEFAULT); 
$stmt = $con -> prepare("update  users set User_password='$pass' ,User_image=? where User_ID='$_SESSION[User_ID]'");
$stmt -> execute(array($imgData));
}else {
$stmt = $con -> prepare("update  users set User_image=? where User_ID='$_SESSION[User_ID]'");
$stmt -> execute(array($imgData));
}
       
header('Location:../index.php');



?>