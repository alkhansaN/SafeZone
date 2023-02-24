<?php 
$data = json_decode(file_get_contents("php://input"), true);
$pass =$data['pass'];
$hpass=$data['hpass'];

$url=$data['url'];
 if (password_verify($pass,$hpass)) {
echo"1";
} else 
echo"0";
  
?>