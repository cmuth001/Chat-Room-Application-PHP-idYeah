<?php

session_start();

if($_GET && $_GET['action'] && $_GET['action']=="logout"){
	unset($_SESSION['loggedIn']);
	unset($_SESSION['email']);
}

if(!$_SESSION['loggedIn']){
	header("location: login.php");
	die();
}

?>
<html>
	<head>
		<title>Homepage</title>
		<link rel="stylesheet" type="text/css" href="index.css">
	</head>
	<body>
		<div>
		 	<p>Welcome <?= $_SESSION['email'] ?>! (<a href="./login/login.php">log out</a>)</p>
		</div>


	</body>
</html>