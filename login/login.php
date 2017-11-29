<?php
	session_start();
	session_unset(); 
	include_once "validate.php";
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Login Page</title>
		<link rel="stylesheet" type="text/css" href="login.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		
	     <script src="https://www.google.com/recaptcha/api.js" async defer></script>
	      <script type='text/javascript'>
 	function reCaptchad(){
		document.getElementById("myButton").disabled = false;
	}
     </script>
	</head>
	<body>
		<div class = "container1">
			<div class="imgcontainer">
				<img src="img_avatar4.png" alt="Avatar" class="avatar">
			</div>
			<h3>Slack Login Page</h3>
			<div class ="loginform">
				<form method="post" action="login.php">

					<label class = "label1" for="email">Email</label>
					<input class="inputfield" type="text" name="email"  autofocus required/>
					<br/>
					<label class = "label1" for="password">Password</label>
					<input class="inputfield" type="password" name="password" />
					<br/>
					<div class="g-recaptcha" data-sitekey="6Le0vAgUAAAAAH_ZWM8tw3It6jkrqLHkFFTMOW-J" data-callback="reCaptchad"></div>
      				<br/>
					<input class = "btn1" id="myButton" type="submit" value="login" disabled />
					<input type="checkbox" checked="checked"> Remember me
					
				</form>
				<div class = "newAccount">
					<a href= "../signup/signUpPage.php">Create New Account</a>
				</div>
			</div>
	</div>
	</body>
</html>