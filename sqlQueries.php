<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
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
		$likeList = "SELECT *  FROM `channel_message_reaction` join users on users.email=channel_message_reaction.user_email where message_id=".$row['cmessage_id']." and emoji_id=1";
		$dislikeList = "SELECT * FROM `channel_message_reaction` join users on users.email=channel_message_reaction.user_email where message_id=".$row['cmessage_id']." and emoji_id=2";

		$likeResult = mysqli_query($conn,$likeCountQuery);
		$dislikeResult = mysqli_query($conn,$dislikeCountQuery);
		$likeUsersList = mysqli_query($conn,$likeList);
		$dislikeUsersList = mysqli_query($conn,$dislikeList);
		
		$likeCount = mysqli_fetch_assoc($likeResult);
		$dislikeCount = mysqli_fetch_assoc($dislikeResult);
		$likeStr='';
		$dislikeStr='';
		while(($likeUser = mysqli_fetch_assoc($likeUsersList))) 
		{ 
			if($likeUser['email']===$_SESSION['email']){
				$likeStr=$likeStr."You, ";
			}else{
				$likeStr=$likeStr.$likeUser['display_name'].",";
			}
		}
		while(($dislikeUser = mysqli_fetch_assoc($dislikeUsersList))) 
		{ 
			if($dislikeUser['email']===$_SESSION['email']){
				$dislikeStr=$dislikeStr."You, ";
			}else{
				$dislikeStr=$dislikeStr.$dislikeUser['display_name'].",";
			}
		
		}
		$date = date_create($row['cmsg_timestamp']);
		$time = date_format($date, 'Y-m-d l g:ia');
		$message = htmlspecialchars($row['channel_message']);
		$replyMsg = "replyMsg".$row['cmessage_id'];
		$myForm = "myForm".$row['cmessage_id'];

    	$string=$string."<div class='right'>
    						<img src='contact.PNG' alt='Contact_Img' class='contact_Img'><a href= ''>".$row['display_name']."</a><label class = 'timeStamp'>".$time."</label>  					
    						<div class= 'textMessage'><span>".$message."</span></div>
    						<div class = 'reaction'>
    							<label class='likeIcon' data-toggle='tooltip' title='$likeStr' style='font-size:24px' emoji_id = '1' name = 'like' id =".$row['cmessage_id']." onclick = 'reactionFunction(".$row['cmessage_id'].","."\"".$_SESSION['email']."\"".",1)' ><i class='fa fa-thumbs-o-up'></i></label><label class=likeCount".$row['cmessage_id'].">".$likeCount['likeCount']."</label>
    							<label class = 'dislikeIcon'data-toggle='tooltip' title='$dislikeStr' style='font-size:24px' emoji_id = '2' name = 'dislike' id =".$row['cmessage_id']." onclick = 'reactionFunction(".$row['cmessage_id'].","."\"".$_SESSION['email']."\"".",2)' ><i class='fa fa-thumbs-o-down'></i></label><label class=dislikeCount".$row['cmessage_id'].">".$dislikeCount['dislikeCount']."</label>
    							<label class = 'replyMsgIcon' id=".$row['cmessage_id']." ><i class='fa fa-reply' aria-hidden='true'></i></label>
    						</div>
    						<div class = '$replyMsg input-group input-group-lg textinput' style='display:none;'>
    							<form id = '$myForm' class = '' method ='post'>
    								<input type='hidden' name='user' id='user' value=".$_SESSION['email']." >
    								<input type='hidden' name='msgId' id='msgId' value=".$row['cmessage_id']." >
    								<input type='hidden' name='channel' id='channel' value='$channel_id' >
    								<input type='text' id='txt' class='form-control' name = 'message' style  = 'width: 95%;border: 2px solid #bfc4bd;' placeholder= 'Type Some message ....' aria-describedby='sizing-addon1' autofocus required>
    								<button type='submit' id = ".$row['cmessage_id']." class='btn btn-info btn-md replyButton'><span class='glyphicon glyphicon-send'></span> </button>
    							</form>
    						</div>
    					</div>";
    	
    	$stringThread = "<div class = 'thread_wrapper'>";
    	if($row['has_thread']==1){
    		$threadsql = "SELECT * FROM `threaded_messages` join users on users.email=threaded_messages.user_email where message_id=".$row['cmessage_id'];
			$threadResult = mysqli_query($conn, $threadsql);

			
			while(($threadrow = mysqli_fetch_assoc($threadResult))) 
			{ 
				$ThreadDate = date_create($threadrow['createdon']);
				$threadTime = date_format($ThreadDate, 'Y-m-d l g:ia');
				$threadMessage = htmlspecialchars($threadrow['message']);
				$stringThread=$stringThread."<div class='thread'>
												<img src='contact.PNG' alt='Contact_Img' class='contact_Img'><a href= ''>".$threadrow['display_name']."</a><label class = 'timeStamp'>".$threadTime."</label>  					
					    						<div class= 'textMessage'><span>".$threadMessage."</span></div>		
											</div>";
			}
			$stringThread = $stringThread."</div>";
			$string=$string.$stringThread;
		}

	}
	$string = $string."<div id = 'scrollBottom'></div></div>";
	return $string;
}
if(isset($_POST['thread']))
{
	$thread = $_POST['thread'];
	$channel_id = intval($thread['channel']);
	$message = $thread['message'];
	$msgId = intval($thread['msgId']);
	$user_email = $thread['user'];
	$sql = "INSERT INTO `threaded_messages` VALUES(DEFAULT,'$msgId','$user_email','$message',CURRENT_TIMESTAMP)";

	if (mysqli_query($conn, $sql)) {       
        echo "**** thread message inserted successfully ***";
    }else{
        echo "**** failed inserting thread message ***";
    }
	$updateHasthread = "UPDATE channel_messages SET has_thread=1 where cmessage_id='$msgId'";
	if (mysqli_query($conn, $updateHasthread)) {       
        echo "**** thread updated successfully in channel_messages ***";
    }else{
        echo "**** failed thread updating in channel_messages***";
    }
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
			
			//extracting liked and disliked users list
			$likeList = "SELECT *  FROM `channel_message_reaction` join users on users.email=channel_message_reaction.user_email where message_id=".$row['cmessage_id']." and emoji_id=1";
			$dislikeList = "SELECT * FROM `channel_message_reaction` join users on users.email=channel_message_reaction.user_email where message_id=".$row['cmessage_id']." and emoji_id=2";
			$likeUsersList = mysqli_query($conn,$likeList);
			$dislikeUsersList = mysqli_query($conn,$dislikeList);
			$likeStr='';
			$dislikeStr='';
			while(($likeUser = mysqli_fetch_assoc($likeUsersList))) 
			{ 
				if($likeUser['email']===$_SESSION['email']){
					$likeStr=$likeStr."You, ";
				}else{
					$likeStr=$likeStr.$likeUser['display_name'].",";
				}
			}
			while(($dislikeUser = mysqli_fetch_assoc($dislikeUsersList))) 
			{ 
				if($dislikeUser['email']===$_SESSION['email']){
					$dislikeStr=$dislikeStr."You, ";
				}else{
					$dislikeStr=$dislikeStr.$dislikeUser['display_name'].",";
				}
			
			}

			echo json_encode([$likeCount['likeCount'],$dislikeCount['dislikeCount'],$likeStr,$dislikeStr]);
		}else{
			$updateReaction = "UPDATE channel_message_reaction SET emoji_id='$emoji_id' where message_id='$msg_id' and user_email ='$user_email'";
			mysqli_query($conn,$updateReaction);
			
			$likeCountQuery = "SELECT COUNT(*) as likeCount FROM `channel_message_reaction` where message_id='$msg_id' and emoji_id=1";
			$Result = mysqli_query($conn,$likeCountQuery);
			$likeCount = mysqli_fetch_assoc($Result);
			
			$dislikeCountQuery = "SELECT COUNT(*) as dislikeCount FROM `channel_message_reaction` where message_id='$msg_id' and emoji_id=2";
			$Result = mysqli_query($conn,$dislikeCountQuery);
			$dislikeCount = mysqli_fetch_assoc($Result);

			//extracting liked and disliked users list
			$likeList = "SELECT *  FROM `channel_message_reaction` join users on users.email=channel_message_reaction.user_email where message_id=".$row['cmessage_id']." and emoji_id=1";
			$dislikeList = "SELECT * FROM `channel_message_reaction` join users on users.email=channel_message_reaction.user_email where message_id=".$row['cmessage_id']." and emoji_id=2";
			$likeUsersList = mysqli_query($conn,$likeList);
			$dislikeUsersList = mysqli_query($conn,$dislikeList);
			$likeStr='';
			$dislikeStr='';
			while(($likeUser = mysqli_fetch_assoc($likeUsersList))) 
			{ 
				if($likeUser['email']===$_SESSION['email']){
					$likeStr=$likeStr."You, ";
				}else{
					$likeStr=$likeStr.$likeUser['display_name'].",";
				}
			}
			while(($dislikeUser = mysqli_fetch_assoc($dislikeUsersList))) 
			{ 
				if($dislikeUser['email']===$_SESSION['email']){
					$dislikeStr=$dislikeStr."You, ";
				}else{
					$dislikeStr=$dislikeStr.$dislikeUser['display_name'].",";
				}
			
			}
			
			echo json_encode([$likeCount['likeCount'],$dislikeCount['dislikeCount'],$likeStr,$dislikeStr]);
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
		
		//extracting liked and disliked users list
			$likeList = "SELECT *  FROM `channel_message_reaction` join users on users.email=channel_message_reaction.user_email where message_id=".$row['cmessage_id']." and emoji_id=1";
			$dislikeList = "SELECT * FROM `channel_message_reaction` join users on users.email=channel_message_reaction.user_email where message_id=".$row['cmessage_id']." and emoji_id=2";
			$likeUsersList = mysqli_query($conn,$likeList);
			$dislikeUsersList = mysqli_query($conn,$dislikeList);
			$likeStr='';
			$dislikeStr='';
			while(($likeUser = mysqli_fetch_assoc($likeUsersList))) 
			{ 
				if($likeUser['email']===$_SESSION['email']){
					$likeStr=$likeStr."You, ";
				}else{
					$likeStr=$likeStr.$likeUser['display_name'].",";
				}
			}
			while(($dislikeUser = mysqli_fetch_assoc($dislikeUsersList))) 
			{ 
				if($dislikeUser['email']===$_SESSION['email']){
					$dislikeStr=$dislikeStr."You, ";
				}else{
					$dislikeStr=$dislikeStr.$dislikeUser['display_name'].",";
				}
			
			}
		echo json_encode([$likeCount['likeCount'],$dislikeCount['dislikeCount'],$likeStr,$dislikeStr]);
		//echo "insert";
	}
	
}

 ?>