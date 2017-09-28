<?php
<<<<<<< HEAD
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
				<img src="img_avatar2.png" alt="Avatar" class="avatar">
			</div>
			<h3>Slack Login Page</h3>
			<div class ="loginform">
				<form method="post" action="login.php">

					<label class = "label" for="email">Email</label>
					<input class="inputfield" type="text" name="email"  />
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
=======
include("../connect.php");


$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$email = $_REQUEST['email'];
$psw = $_REQUEST['psw'];
$sql = "SELECT * FROM register where email= '".$email."'";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
	if($row = $result->fetch_assoc()) {
		if($psw===$row['password']){
			header('Location: ../index.html');
		
		}else {
			header('Location: ../login.html');
			
		}
	}
}else {
			header('Location: ../login.html');
}
$conn->close();
?>
>>>>>>> d3fd1aa1a8a79b1035c541ce92a92c3adc5f837a
