<?php
$Max_ID=0;
  require_once("Connect.php"); 


       if(empty($_POST['UserName']) || empty($_POST['Email']) || empty($_POST['pass'])){
            echo"enter your data";
            }

       else {
$password=$_POST['pass'];
$uppercase = preg_match('@[A-Z]@', $password);
$lowercase = preg_match('@[a-z]@', $password);
$number    = preg_match('@[0-9]@', $password);


if(!$uppercase || !$lowercase || !$number  || strlen($password) < 8) {
echo "<script language='javascript'>alert('Password should be at least 8 characters in length and should include at least one upper case letter, one number');
</script>";
header("refresh:0; url=../Regester.html"); 
   
}else{

$email=$_POST['Email'];
$stmt   = $con -> prepare('SELECT * FROM users WHERE (User_Email=? or User_Name=?)' );
            $stmt   -> execute(array($email,$_POST['UserName']));
            $item    = $stmt -> fetch() ;
            $count  =  $stmt -> rowCount() ;
if( $count>=1)
{
echo "<script language='javascript'>alert('error email or name is found');
</script>";
header("refresh:0; url=../Regester.html"); 



 //require_once("../Login.html");
//echo "<script language='javascript'> var d = document.getElementById('wrap-input100 validate-input');
//d.className += ' alert-validate';</script>";
return;

}
		   
 try{
          $stetment = $con -> prepare("select Max(User_ID) as max from users");
                $stetment -> execute();
                $count    = $stetment -> fetch();
            $Max_ID=$count['max']+1;
            
    }
catch(PDOException $e) {
$Max_ID=1;
}
$pass= password_hash($_POST['pass'], PASSWORD_DEFAULT); 
         $stmt = $con -> prepare("insert into users(User_ID,User_Name,User_SecondName,User_password,User_Email)values($Max_ID,'$_POST[UserName]','','$pass','$_POST[Email]')");
        if ($stmt -> execute())
        {
         header("refresh:0; url=../Login.html"); 
         
        } else {
          echo "Error: " . $sql . "<br>" . mysqli_error($con);
        }  } }
?>