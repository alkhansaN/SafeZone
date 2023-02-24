<?php

require_once("Connect.php"); 
$id = $_GET['FileName'];
$stmt = $con -> prepare("delete  FROM Trash where FileName='$id'");
 $stmt -> execute();
header('Location:../Trash.php');
exit;
?>