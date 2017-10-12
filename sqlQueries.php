<?php
include_once "./login/connect.php";	
$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD,DB_NAME)
	OR die ('Could not connect to MySQL: '.mysql_error());

if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

function getUserDetails($email){
	global $conn;
	$sql = "SELECT * FROM register where email= '".$email."'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row;

}
function getChannelName($channel_id){
	global $conn;
	$sql = "SELECT * FROM channels where channel_id="."'$channel_id'";
	$result = mysqli_query($conn, $sql);
	$row = $result->fetch_assoc();
	return $row;
}
function getAllChannels(){
	global $conn;
	$sql = "SELECT * FROM channels";
    $result = mysqli_query($conn, $sql);
    while(($row = mysqli_fetch_assoc($result))) 
	{ 
    	$string=$string."<li ><a class= 'listbg' href=index.php?channel=".$row['channel_id'].">#".$row['channel_name']."</a></li>";
	}
	return $string;
}
function getAllUsers(){
	global $conn;
	$sql = "SELECT user_name FROM register";
    $result = mysqli_query($conn, $sql);
    while(($row = mysqli_fetch_assoc($result))) 
	{ 
    	$string=$string."<li ><a class= 'listbg' href=''>".$row['user_name']."</a></li>";
	}
	return $string;
}
function getChannelMessages($channel_id){
	global $conn;
	$sql = "SELECT * FROM channel_messages where channel_id="."'$channel_id'";
    $result = mysqli_query($conn, $sql);
    $string = "<div class = 'message_wrapper'>";
    while(($row = mysqli_fetch_assoc($result))) 
	{ 
    	$string=$string."<div class='right'>
    						<img src='contact.PNG' alt='Contact_Img' class='contact_Img'><a href= ''>".$row['cuser_email']."</a><label class = 'timeStamp'>".$row['cmsg_timestamp']."</label>  					
    						<div class= 'textMessage'><span>".$row['channel_message']."</span></div>
    					</div>";

	}
	$string = $string."</div>";
	return $string;
}


 ?>