<?php
$data = json_decode(file_get_contents("php://input"), true);
require_once("Connect.php"); 
$id = $data['file_id'];


try{
          $stetment = $con -> prepare("select  FileName,User_ID,file_Type from user_upload where ID='$id' ");
                $stetment -> execute();
                $count    = $stetment -> fetch();
             $User_ID=$count['User_ID'];
             $file_Type=$count['file_Type'];
             $FileName=$count['FileName'];
    }
catch(PDOException $e) {
$Max_ID=1;
}
 $stmt = $con -> prepare("INSERT INTO Trash(User_ID, file_Type,FileName)
                                                                    VALUES ( :User_ID, :file_Type,:FileName );");
                        $stmt -> execute(array(
                                
                                'User_ID'      => $User_ID, 
                                
                                'file_Type'        => $file_Type,
                                
                                'FileName'        => $FileName
));

$stmt = $con -> prepare("delete  FROM user_upload where ID='$id'");
 $stmt -> execute();
header('Location:../index.php');
exit;
?>