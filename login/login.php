<?php
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