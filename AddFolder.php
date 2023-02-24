<?php
session_start();

  require_once("Connect.php"); 
       if(empty($_POST['FName'])){
            echo"enter your data";
            } 
       else {
  $User=$_SESSION['User_ID'];
$FName=$_POST['FName'];

         $stmt = $con -> prepare("insert into directory(User_ID,Name)values('$User','$FName')");
        if ($stmt -> execute())
        {
      header("refresh:0; url=../index.php"); 
         
        } else {
          echo "Error: " . $sql . "<br>" . mysqli_error($con);
        } 
 } 
?>