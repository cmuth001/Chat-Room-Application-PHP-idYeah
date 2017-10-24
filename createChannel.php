<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once "login/connect.php"; 
$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD,DB_NAME)
    OR die ('Could not connect to MySQL: '.mysql_error());

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if(isset($_POST['submit']))
{
	$channelName = mysqli_real_escape_string($conn,$_POST['channelName']);
    $purpose = mysqli_real_escape_string($conn,$_POST['purpose']);
    $user = $_SESSION['email'];
	$sql = "INSERT INTO `channels` VALUES(DEFAULT,'$channelName','$purpose','$user',CURRENT_TIMESTAMP,DEFAULT,DEFAULT)";
    // $result = $conn->query($sql);
    if (mysqli_query($conn, $sql)) {
        echo "<br><br><p style='text-align:center;color:green;'>**** Channel created successfully ***</p>";
    }else{
        echo "<br><br><p style='text-align:center;color:red;'>**** failed creating channel***</p>";
    }

}
 ?>