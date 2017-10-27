<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
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
function getAllChannels($email){
	global $conn;
	$sql = "SELECT * FROM userChannels where user_email="."'$email'";;
    $result = mysqli_query($conn, $sql);
    $string = "";
    while(($row = mysqli_fetch_assoc($result))) 
	{ 
    	$string=$string."<li ><a class= 'listbg' href=index.php?channel=".$row['channel_id']."#scrollBottom><i style='ffont-size: 126%;padding-right: 3%;' class='fa'>&#xf09c;</i>".$row['channel_name']."</a></li>";
	}
	return $string;
}
function getAllUsers(){
	global $conn;
	$sql = "SELECT user_name FROM users";
    $result = mysqli_query($conn, $sql);
    $string = "";
    while(($row = mysqli_fetch_assoc($result))) 
	{ 
    	$string=$string."<li ><a class= 'listbg' href=''><i class ='fa' style = 'padding-right: 3%;'>&#xf2be;</i>".$row['user_name']."</a></li>";
	}
	return $string;
}



function getChannelMessages($channel_id){
	global $conn;
	$sql = "SELECT * FROM `channel_messages` join users on users.email=channel_messages.cuser_email where channel_id="."'$channel_id'";
    $result = mysqli_query($conn, $sql);
    $string = "<div class = 'message_wrapper'>";

    while(($row = mysqli_fetch_assoc($result))) 
	{ 
		$likeCountQuery = "SELECT COUNT(*) as likeCount FROM `channel_message_reaction` where message_id=".$row['cmessage_id']." and emoji_id=1";
		$dislikeCountQuery = "SELECT COUNT(*) as dislikeCount FROM `channel_message_reaction` where message_id=".$row['cmessage_id']." and emoji_id=2";
		
		$likeResult = mysqli_query($conn,$likeCountQuery);
		$dislikeResult = mysqli_query($conn,$dislikeCountQuery);
		
		$likeCount = mysqli_fetch_assoc($likeResult);
		$dislikeCount = mysqli_fetch_assoc($dislikeResult);

		$date = date_create($row['cmsg_timestamp']);
		$time = date_format($date, 'Y-m-d l g:ia');
		$message = htmlspecialchars($row['channel_message']);
    	$string=$string."<div class='right'>
    						<img src='contact.PNG' alt='Contact_Img' class='contact_Img'><a href= ''>".$row['display_name']."</a><label class = 'timeStamp'>".$time."</label>  					
    						<div class= 'textMessage'><span>".$message."</span></div>
    						<div class = 'reaction'>
    							<label class='likeIcon' style='font-size:24px' emoji_id = '1' name = 'like' id =".$row['cmessage_id']." onclick = 'reactionFunction(".$row['cmessage_id'].","."\"".$_SESSION['email']."\"".",1)' ><i class='fa fa-thumbs-o-up'></i></label><label class=likeCount".$row['cmessage_id'].">".$likeCount['likeCount']."</label>
    							<label class = 'dislikeIcon' style='font-size:24px' emoji_id = '2' name = 'dislike' id =".$row['cmessage_id']." onclick = 'reactionFunction(".$row['cmessage_id'].","."\"".$_SESSION['email']."\"".",2)' ><i class='fa fa-thumbs-o-down'></i></label><label class=dislikeCount".$row['cmessage_id'].">".$dislikeCount['dislikeCount']."</label>
    						</div>
    					</div>";
    	


	}
	$string = $string."<div id = 'scrollBottom'></div></div>";
	return $string;
}
if(isset($_POST['reactions']))
{
	$reactions = $_POST['reactions'];
	$msg_id = intval($reactions['msg_id']);
	$user_email = $reactions['user_email'];
	$emoji_id = intval($reactions['emoji_id']);
	$checkReactionQuery = "SELECT * FROM `channel_message_reaction` where message_id='$msg_id' and user_email ='$user_email'";
	$result = mysqli_query($conn, $checkReactionQuery);
	$checkReactionQueryArray = $result->fetch_assoc();
	$deleteReaction = "";
	$updateReaction="";
	$insertReaction="";
	if ($result->num_rows > 0) {
		if($checkReactionQueryArray['emoji_id']==$emoji_id){
			$deleteReaction = "DELETE FROM channel_message_reaction where message_id='$msg_id' and user_email ='$user_email'";
			mysqli_query($conn,$deleteReaction);
			
			$likeCountQuery = "SELECT COUNT(*) as likeCount FROM `channel_message_reaction` where message_id='$msg_id' and emoji_id=1";
			$Result = mysqli_query($conn,$likeCountQuery);
			$likeCount = mysqli_fetch_assoc($Result);
			
			$dislikeCountQuery = "SELECT COUNT(*) as dislikeCount FROM `channel_message_reaction` where message_id='$msg_id' and emoji_id=2";
			$Result = mysqli_query($conn,$dislikeCountQuery);
			$dislikeCount = mysqli_fetch_assoc($Result);
			echo json_encode([$likeCount['likeCount'],$dislikeCount['dislikeCount']]);
		}else{
			$updateReaction = "UPDATE channel_message_reaction SET emoji_id='$emoji_id' where message_id='$msg_id' and user_email ='$user_email'";
			mysqli_query($conn,$updateReaction);
			
			$likeCountQuery = "SELECT COUNT(*) as likeCount FROM `channel_message_reaction` where message_id='$msg_id' and emoji_id=1";
			$Result = mysqli_query($conn,$likeCountQuery);
			$likeCount = mysqli_fetch_assoc($Result);
			
			$dislikeCountQuery = "SELECT COUNT(*) as dislikeCount FROM `channel_message_reaction` where message_id='$msg_id' and emoji_id=2";
			$Result = mysqli_query($conn,$dislikeCountQuery);
			$dislikeCount = mysqli_fetch_assoc($Result);
			echo json_encode([$likeCount['likeCount'],$dislikeCount['dislikeCount']]);
			// echo "update",$checkReactionQueryArray['emoji_id'];
		}
	}
	else{
		$insertReaction = "INSERT INTO `channel_message_reaction` VALUES(DEFAULT,'$msg_id','$user_email','$emoji_id',CURRENT_TIMESTAMP)";
		mysqli_query($conn,$insertReaction);

		$likeCountQuery = "SELECT COUNT(*) as likeCount FROM `channel_message_reaction` where message_id='$msg_id' and emoji_id=1";
		$Result = mysqli_query($conn,$likeCountQuery);
		$likeCount = mysqli_fetch_assoc($Result);
		
		$dislikeCountQuery = "SELECT COUNT(*) as dislikeCount FROM `channel_message_reaction` where message_id='$msg_id' and emoji_id=2";
		$Result = mysqli_query($conn,$dislikeCountQuery);
		$dislikeCount = mysqli_fetch_assoc($Result);
		echo json_encode([$likeCount['likeCount'],$dislikeCount['dislikeCount']]);
		
		//echo "insert";
	}
	
}

 ?>