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
	</head>
	<body>
		<div class = "container">
			<div class="imgcontainer">
				<img src="img_avatar4.png" alt="Avatar" class="avatar">
			</div>
			<h3>Slack Login Page</h3>
			<div class ="loginform">
				<form method="post" action="login.php">

					<label class = "label" for="email">Email</label>
					<input class="inputfield" type="text" name="email"  autofocus/>
					<br>
					<label class = "label" for="password">Password</label>
					<input class="inputfield" type="password" name="password" />
					<br>

					<input class = "btn" type="submit" value="login" />
					<input type="checkbox" checked="checked"> Remember me

				</form>
			</div>
	</div>
	</body>
</html>