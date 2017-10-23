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
					<br>
					<label class = "label1" for="password">Password</label>
					<input class="inputfield" type="password" name="password" />
					<br>

					<input class = "btn1" type="submit" value="login" />
					<input type="checkbox" checked="checked"> Remember me

				</form>
				<div class = "newAccount">
					<a href= "../signup/signUpPage.php">Create New Account</a>
				</div>
			</div>
	</div>
	</body>
</html>