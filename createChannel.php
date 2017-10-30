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
$data = $_POST['data'];

	$channelName = mysqli_real_escape_string($conn,$data['channelName']);
    $purpose = mysqli_real_escape_string($conn,$data['purpose']);
    $radioButtonValue = mysqli_real_escape_string($conn,$data['radioButtonValue']);
    
    $user = $_SESSION['email'];
	$sql = "INSERT INTO `channels` VALUES(DEFAULT,'$channelName','$purpose','$user',CURRENT_TIMESTAMP,'$radioButtonValue')";
    // $result = $conn->query($sql);
    if (mysqli_query($conn, $sql)) {
        // echo "<br><br><p style='text-align:center;color:green;'>**** Channel created successfully ***</p>";
        echo "**** Channel created successfully ***";
    }else{
        // echo "<br><br><p style='text-align:center;color:red;'>**** failed creating channel***</p>";
        echo "**** failed creating channel***";
    }
    $sql = "SELECT MAX(channel_id) as last_id FROM `channels`";
    $result = mysqli_query($conn, $sql);
    $row = $result->fetch_assoc();
     $last_id = $row['last_id'];
     echo $last_id;
    $sql = "INSERT INTO `userChannels` VALUES('$user','$last_id','$channelName','$radioButtonValue',CURRENT_TIMESTAMP,DEFAULT)";
    if (mysqli_query($conn, $sql)) {
        // echo "<br><br><p style='text-align:center;color:green;'>**** Channel created successfully ***</p>";
        echo "**** userChannels created successfully ***";
    }else{
        // echo "<br><br><p style='text-align:center;color:red;'>**** failed creating channel***</p>";
        echo "**** failed creating userChannels***";
    }
    mysqli_close($conn);

 ?>