<?php

require_once("Connect.php"); 
session_start();
$User_ID=$_SESSION['User_ID'];
$FileName=$_GET['FileName'];
// A list of permitted file extensions

  try{
          $stetment = $con -> prepare("select Max(ID) as max from user_upload");
                $stetment -> execute();
                $count    = $stetment -> fetch();
            $Max_ID=$count['max']+1;
            
    }
catch(PDOException $e) {
$Max_ID=1;
}
$extension = pathinfo(".../uploads/".$FileName, PATHINFO_EXTENSION);
 $stmt = $con -> prepare("INSERT INTO user_upload (ID, User_ID, file_Type,FileName)
                                                                    VALUES (:ID, :User_ID, :file_Type,:FileName );");
                        $stmt -> execute(array(
                                'ID'         => $Max_ID, 
                                'User_ID'      => $User_ID, 
                                
                                'file_Type'        => $extension,
                                
                                'FileName'        => $FileName
));

$stmt = $con -> prepare("delete  FROM Trash where FileName='$FileName'");
 $stmt -> execute();

header('Location:../Trash.php');
exit;
?>






