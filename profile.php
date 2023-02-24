<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Safe zone </title>
  <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">


<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<link rel="stylesheet" href="style/style.css">

  <script>  
function verifyPassword() {  
  var pw = document.getElementById("pswd").value;  
  //check empty password field  
  if(pw == "") {  
     document.getElementById("message").innerHTML = "**Fill the password please!";  
     return false;  
  }  
   
 //minimum password length validation  
  if(pw.length < 8) {  
     document.getElementById("message").innerHTML = "**Password length must be atleast 8 characters";  
     return false;  
  }  
  var numbers = /[0-9]/g;
  if(!pw.match(numbers)) {
 document.getElementById("message").innerHTML = "Password  must be atleast one Number";
return false;  
}
 var upperCaseLetters = /[A-Z]/g;
  if(!pw.match(upperCaseLetters)) {
 document.getElementById("message").innerHTML = "Password  must be atleast one Capital characters";
return false;
}
//maximum length of password validation  
  if(pw.length > 15) {  
     document.getElementById("message").innerHTML = "**Password length must not exceed 15 characters";  
     return false;  
  } else {  
     document.getElementById("message").innerHTML =""; 
  } 
} 
</script> 
</head>
<body>
<?php
 require_once("DataBase/Connect.php"); 
session_start();
  $User=$_SESSION['User_ID'];
 $stetment = $con -> prepare("select * from users where User_ID=?");
                $stetment -> execute(array($User));
                $row    = $stetment -> fetch();

               ?>

<!-- partial:index.partial.html -->
<div class="box-form">
	<div class="left">
		<div class="overlay">
		<img src="images/Logo.png" class="img" />
		</div>
	</div>
	
	
	<div class="right">
		<a href="DataBase/Logout.php"><button>Logout</button></a>
		<h2>Your Profile</h2>
		
		<div class="inputs">
			<form action="DataBase\updateProfile.php" method="post" enctype="multipart/form-data">
<?php

require_once("DataBase/Connect.php"); 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$stmt   = $con -> prepare('SELECT User_image FROM users  WHERE  (User_ID=?)');
            $stmt   -> execute(array($_SESSION['User_ID']));
          $items    = $stmt -> fetch();


echo '<a href="profile.php"> <img  id="output" src="data:image/jpeg;base64,'. base64_encode($items['User_image']).'" style="
    width:200px; height: 200px;     margin-bottom: 50px;"></a>';
?>

                               <div class='button-container'>
  <button >Choose file</button>
  <input type='file' onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])" name="image" accept="image/*" style="    margin-top: 0px;
    padding: 0px;" />
</div>
				<input type="text" name='UserName' value=<?php echo $row['User_Name'];?> placeholder="name" disabled="disabled">
				<br>
				<input type="text" name='Email' value=<?php echo $row['User_Email'];?>  placeholder="Email" disabled="disabled">
				<br>
                                <input type="checkBox" name="Withpass"  value="1"  style=" width: 20px;"/> Edite Password
				<input type="password" name="pass"  id = "pswd" value=<?php echo $row['User_password'];?>  placeholder="password" onkeyup="verifyPassword()">
                                 <span id = "message" style="color:red"> </span> <br><br> 
		</div>

		<br><br>

		<!--<div class="remember-me--forget-password">-->
		<!-- Angular -->
		<!--<label>
			
	</div>-->

		<br>
		
		<input type="submit" value="Save"  class="SubmitButton"/>
<h1 id="errorh"> </h1>
		</form>
	</div>
	
</div>
<!-- partial -->
 
</body>
</html>
