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
    	$string=$string."<li ><a class= 'listbg' href=index.php?channel=".$row['channel_id']."#scrollBottom><i style='ffont-size: 126%;padding-right: 3%;' class='fa'>&#xf09c;</i>".$row['channel_name']."</a></li>";
	}
	return $string;
}
function getAllUsers(){
	global $conn;
	$sql = "SELECT user_name FROM register";
    $result = mysqli_query($conn, $sql);
    while(($row = mysqli_fetch_assoc($result))) 
	{ 
    	$string=$string."<li ><a class= 'listbg' href=''><i class ='fa' style = 'padding-right: 3%;'>&#xf2be;</i>".$row['user_name']."</a></li>";
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
		$date = date_create($row['cmsg_timestamp']);
		$time = date_format($date, 'Y-m-d l g:ia');
		$message = htmlspecialchars($row['channel_message']);
    	$string=$string."<div class='right'>
    						<img src='contact.PNG' alt='Contact_Img' class='contact_Img'><a href= ''>".$row['cuser_email']."</a><label class = 'timeStamp'>".$time."</label>  					
    						<div class= 'textMessage'><span>".$message."</span></div>
    					</div>";

	}
	$string = $string."<div id = 'scrollBottom'></div></div>";
	return $string;
}


 ?>