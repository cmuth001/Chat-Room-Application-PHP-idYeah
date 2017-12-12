<?php
session_start();
include_once "./login/connect.php"; 
$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD,DB_NAME)
    OR die ('Could not connect to MySQL: '.mysql_error());

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['submit']))
{
	$channelId = mysqli_real_escape_string($conn,$_POST['channel']);
	$user = mysqli_real_escape_string($conn,$_POST['email']);
	$toEmail = mysqli_real_escape_string($conn,$_POST['toEmail']);
	$fromEmail = mysqli_real_escape_string($conn,$_POST['fromEmail']);
	$target = "./assets/upload/";
	$fileName = basename($_FILES['uploaded']['name']);
	
	$textOrCode=4;


	$imageFormats = ['png','jpeg','jpg','gif','tiff','tif'];
	$imgType = end(explode('.',$fileName));
	if(!in_array($imgType,$imageFormats)){
		if(isset($_POST['toEmail'])){
			$sql = "INSERT INTO `direct_message` VALUES(DEFAULT,'$fromEmail','$toEmail','$fileName','$textOrCode',CURRENT_TIMESTAMP)";
		}else{
			$sql = "INSERT INTO `channel_messages` VALUES(DEFAULT,'$channelId','$user','$fileName',DEFAULT,'$textOrCode',CURRENT_TIMESTAMP)";
		}
		if (mysqli_query($conn, $sql)) {
	   		if(isset($_POST['toEmail'])){
			    $lastIdQuery  = "SELECT * FROM `direct_message` ORDER BY `direct_message`.`directmsg_id` DESC LIMIT 1";
			    $lastIdResult = mysqli_query($conn,$lastIdQuery);
			    $lastId = mysqli_fetch_assoc($lastIdResult);
			    $lastId =$lastId['directmsg_id'];
			}else{
			    $lastIdQuery  = "SELECT * FROM `channel_messages` ORDER BY `channel_messages`.`cmessage_id` DESC LIMIT 1";
			    $lastIdResult = mysqli_query($conn,$lastIdQuery);
			    $lastId = mysqli_fetch_assoc($lastIdResult);
			    $lastId =$lastId['cmessage_id'];
			}
		}else{
	    	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		
		$ok = 1;
		$target = $target .$lastId."_".basename($_FILES['uploaded']['name']);
		if (move_uploaded_file($_FILES['uploaded']['tmp_name'], $target))
		{
			echo "target:".$target;
			echo "The file " . basename($_FILES['uploaded']['name']) . " has been uploaded";
			header('location: '.$_SESSION['url']);
		}
		else
		{
			echo "Sorry, there was a problem uploading your file.";
		}
	}else{
		echo "This is not a document.";
	}
	
}

?>