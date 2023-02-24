<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Safe zone </title>
  <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">


<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<link rel="stylesheet" href="style/style.css">

</head>
<body>
<!-- partial:index.partial.html -->
<div class="box-form">
	<div class="left">
		<div class="overlay">
		<img src="images/Logo.png" class="img" />
		</div>
	</div>
	
	
	<div class="right">
		<h2>Welcome to Safe Zone </h2>
		<br />
		<h1></h1>

		<div class="inputs">
			<form action="DataBase/Authentication.php" method="post">
				<br>
				<input type="password" name='num' placeholder="Random Number">
              <input type="submit" value="Login" class="SubmitButton" />
		</form>

		</div>


		<a  href="DataBase/mail.php" > send Code again</a>	
		<br>

		
            
	</div>
	
</div>
<!-- partial -->
  
</body>
</html>
