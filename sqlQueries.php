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
	$sql = "SELECT * FROM users where email= '".$email."'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row;

}
function existOrNot($email){
	global $conn;
	$sql = "SELECT COUNT(*) as count1 FROM users where email= '".$email."'";
    $count1 = mysqli_query($conn,$sql);
    $count = mysqli_fetch_assoc($count1);
    $count = $count['count1'];
    return $count;

}
function messageThreadCount($msgId){
	global $conn;
	$sql = "SELECT COUNT(*) as count1 FROM threaded_messages where message_id= '".$msgId."'";
    $count1 = mysqli_query($conn,$sql);
    $count = mysqli_fetch_assoc($count1);
    $count = $count['count1'];
    return $count;

}
function getChannelName($channel_id){
	global $conn;
	$sql = "SELECT * FROM channels where channel_id="."'$channel_id'";
	$result = mysqli_query($conn, $sql);
	$row = $result->fetch_assoc();
	return $row;
}
function userChannels($email){
	global $conn;
	$sql = "SELECT channel_id FROM `userChannels` where userChannels.user_email='$email'";
	$result = mysqli_query($conn, $sql);
	$arrayOfChannels = [];
	while(($row = mysqli_fetch_assoc($result))) 
	{
		array_push($arrayOfChannels, $row['channel_id']);
	}
	return $arrayOfChannels;
}
function getAllPublicChannels($email){
	global $conn;
	$sql = "SELECT channels.channel_name FROM `userChannels` join channels on userChannels.channel_id=channels.channel_id where userChannels.user_email='$email' and access_specifiers=0";
    $result = mysqli_query($conn, $sql);
    $string = "";
    while(($row = mysqli_fetch_assoc($result))) 
	{ 
    	$string=$string."<li ><i style='font-size: 126%;padding-right: 3%;' class='fa'>&#xf09c;</i>".$row['channel_name']."</li>";
	}
	return $string;
}
function getAllChannels($email){
	global $conn;
	$sql = "SELECT channels.channel_id,channels.channel_name FROM `userChannels` join channels on userChannels.channel_id=channels.channel_id where userChannels.user_email="."'$email'";
    $result = mysqli_query($conn, $sql);
    $string = "";
    while(($row = mysqli_fetch_assoc($result))) 
	{ 
    	$string=$string."<li ><a class= 'listbg' href=index.php?channel=".$row['channel_id']."#scrollBottom><i style='font-size: 126%;padding-right: 3%;' class='fa'>&#xf09c;</i>".$row['channel_name']."</a></li>";
	}
	return $string;
}
function channelList($email){
	global $conn;
	$publicChannelsql = "SELECT * FROM channels where access_specifiers=0";
	$privateChannelsql = "SELECT * FROM channels where access_specifiers=1 and 	created_by_user_email = '$email'";
    $publicResult = mysqli_query($conn, $publicChannelsql);
    $privateResult = mysqli_query($conn, $privateChannelsql);
    $publicChannel = "<select name ='selValue' id = 'channelId' class='selectpicker' data-show-subtext='true' data-live-search='true'>";
    $privateChannel ="";

    while(($row = mysqli_fetch_assoc($publicResult))) 
	{ 	$channelName = $row['channel_name'];
		$channel_id = $row['channel_id'];
		$created = $row['created_by_user_email'];
		if($created==$email){
    		$publicChannel=$publicChannel."
    						<option data-subtext='Public channel created by You' value='$channel_id' >$channel_id-$channelName</option>
    					";
    	}else{
    		$publicChannel=$publicChannel."
    						<option data-subtext='Public channel created by $created' value='$channel_id' >$channel_id-$channelName</option>
    					";
    	}
	}
	while(($row = mysqli_fetch_assoc($privateResult))) 
	{ 	$channelName = $row['channel_name'];
		$channel_id = $row['channel_id'];
    	$privateChannel=$privateChannel."
    						<option data-subtext='Private channel Creadted by You' value='$channel_id'>$channel_id-$channelName</option>
    					";
	}
	$publicChannel = $publicChannel.$privateChannel;
	$publicChannel = $publicChannel."
									</select>
									";

	return $publicChannel;
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
		$contactImg = "./assets/images/";
		$msgId = $row['cmessage_id'];
		$messageThreadCount=messageThreadCount($msgId);
    	$string=$string."<div class='right'>
    						<img src=".$contactImg.$row['email'].".png"." alt='Contact_Img' class='contact_Img'>
    						<a href= ''>".$row['display_name']."</a>
    						<label class = 'timeStamp'>".$time."</label>  					
    						<div class= 'textMessage'>
    							<span>".$message."</span>
    						</div>
    						<div class = 'reaction'>
    							<label class='likeIcon likeIcon$msgId' data-toggle='tooltip' title='$likeStr' style='font-size:24px' emoji_id = '1' name = 'like' id =".$row['cmessage_id']." onclick = 'reactionFunction(".$row['cmessage_id'].","."\"".$_SESSION['email']."\"".",1)' ><i class='fa fa-thumbs-o-up'></i></label><label class=likeCount".$row['cmessage_id'].">".$likeCount['likeCount']."</label>
    							<label class = 'dislikeIcon dislikeIcon$msgId'data-toggle='tooltip' title='$dislikeStr' style='font-size:24px' emoji_id = '2' name = 'dislike' id =".$row['cmessage_id']." onclick = 'reactionFunction(".$row['cmessage_id'].","."\"".$_SESSION['email']."\"".",2)' ><i class='fa fa-thumbs-o-down'></i></label><label class=dislikeCount".$row['cmessage_id'].">".$dislikeCount['dislikeCount']."</label>
    							<label class = 'replyMsgIcon' id=".$row['cmessage_id']." ><i class='fa fa-reply' aria-hidden='true'></i></label>";
    		if($messageThreadCount>0){
    			$string=$string."<a href='#thread_wrapper$msgId' class = 'repliesCount$msgId' data-toggle='collapse' style = 'margin-left:1%;text-decoration:none;'>Replies($messageThreadCount)</a>
    						</div><div class = 'collapse thread_wrapper$msgId' id ='thread_wrapper$msgId'>";
    		}
    		// else{
    		// 	$string=$string."<a href='#thread_wrapper$msgId'  data-toggle='collapse' style = 'margin-left:1%;text-decoration:none;'>Replies($messageThreadCount)</a>
    		// 	</div><div class = 'collapse thread_wrapper$msgId' id ='thread_wrapper$msgId'>";
    		// }					
    		
    	
    	$stringThread = "";
    	if($row['has_thread']==1){
    		$threadsql = "SELECT * FROM `threaded_messages` join users on users.email=threaded_messages.user_email where message_id=".$row['cmessage_id'];
			$threadResult = mysqli_query($conn, $threadsql);

			
			while(($threadrow = mysqli_fetch_assoc($threadResult))) 
			{ 
				$ThreadDate = date_create($threadrow['createdon']);
				$threadTime = date_format($ThreadDate, 'Y-m-d l g:ia');
				$threadMessage = htmlspecialchars($threadrow['message']);
				$stringThread=$stringThread."<div id =".$row['cmessage_id']." class='thread'>
												<img src=".$contactImg.$threadrow['email'].".png"." alt='Contact_Img' class='contact_Img'><a href= ''>".$threadrow['display_name']."</a><label class = 'timeStamp'>".$threadTime."</label>  					
					    						<div class= 'textMessage'><span>".$threadMessage."</span></div>		
											</div>";
			}
			$stringThread = $stringThread."</div>";//thread_wrapper
			
		}
		$userDetails = getUserDetails($_SESSION['email']);
		$userDetails = $userDetails['display_name'];
		$string=$string.$stringThread."

							<div class = '$replyMsg input-group input-group-lg textinput' style='display:none;'>
    							<form id = '$myForm' class = '' method ='post'>
    								<input type='hidden' name='user' id='user' value=".$_SESSION['email']." >
    								<input type='hidden' name='msgId' id='msgId' value=".$row['cmessage_id']." >
    								<input type='hidden' name='channel' id='channel' value='$channel_id' >
    								<input type='hidden' name='display_name' id='display_name' value='$userDetails' >
    								<input type='text' id='txt' class='form-control' name = 'message' style  = 'width: 95%;border: 2px solid #bfc4bd;border-bottom-left-radius: 10px;border-top-left-radius: 10px;' placeholder= 'Type Some message ....' aria-describedby='sizing-addon1' autofocus required>
    								<button type='submit' id = ".$row['cmessage_id']." class='btn btn-info btn-md replyButton'><span class='glyphicon glyphicon-send'></span> </button>
    							</form>
    						</div>
    						</div>";

	}
	$string = $string."<div id = 'scrollBottom'></div></div>";
	return $string;
}
if(isset($_POST['usersList']))
{
	$sql = "SELECT * FROM users";
    $result = mysqli_query($conn, $sql);
    $userList = [];
    while(($row = mysqli_fetch_assoc($result))) 
	{ 
    	array_push($userList,$row['email']);
	}
	echo json_encode($userList);
	
	}
if(isset($_POST['usersList1']))
{
	$sql = "SELECT * FROM users";
    $result = mysqli_query($conn, $sql);
    $userList = [];
    while(($row = mysqli_fetch_assoc($result))) 
	{ 
    	array_push($userList,$row['email']);
	}
	echo json_encode($userList);
	
	}
if(isset($_POST['thread']))
{
	$thread = $_POST['thread'];
	$channel_id = intval($thread['channel']);
	$message = mysqli_real_escape_string($conn,$thread['message']);
	$msgId = intval($thread['msgId']);
	$user_email = $thread['user'];
	$sql = "INSERT INTO `threaded_messages` VALUES(DEFAULT,'$msgId','$user_email','$message',CURRENT_TIMESTAMP)";
	
	if (mysqli_query($conn, $sql)) {       
        // echo "**** thread message inserted successfully ***";
        //echo json_encode($messageThreadCount);
    }else{
        // echo "**** failed inserting thread message ***";
    }
	$updateHasthread = "UPDATE channel_messages SET has_thread=1 where cmessage_id='$msgId'";
	if (mysqli_query($conn, $updateHasthread)) {       
        // echo "**** thread updated successfully in channel_messages ***";
    }else{
        // echo "**** failed thread updating in channel_messages***";
    }
    $messageThreadCount=messageThreadCount($msgId);
    echo json_encode($messageThreadCount);
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
	$likeStr='';
	$dislikeStr='';
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
			$likeList = "SELECT *  FROM `channel_message_reaction` join users on users.email=channel_message_reaction.user_email where message_id='$msg_id' and emoji_id=1";
			$dislikeList = "SELECT * FROM `channel_message_reaction` join users on users.email=channel_message_reaction.user_email where message_id='$msg_id' and emoji_id=2";
			$likeUsersList = mysqli_query($conn,$likeList);
			$dislikeUsersList = mysqli_query($conn,$dislikeList);


			while(($likeUser = mysqli_fetch_assoc($likeUsersList))) 
			{ 
				if($likeUser['email']==$_SESSION['email']){
					$likeStr=$likeStr."You, ";
				}else{
					$likeStr=$likeStr.$likeUser['display_name'].",";
				}
			}
			while(($dislikeUser = mysqli_fetch_assoc($dislikeUsersList))) 
			{ 
				if($dislikeUser['email']==$_SESSION['email']){
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
			$likeList = "SELECT *  FROM `channel_message_reaction` join users on users.email=channel_message_reaction.user_email where message_id='$msg_id' and emoji_id=1";
			$dislikeList = "SELECT * FROM `channel_message_reaction` join users on users.email=channel_message_reaction.user_email where message_id='$msg_id' and emoji_id=2";
			$likeUsersList = mysqli_query($conn,$likeList);
			$dislikeUsersList = mysqli_query($conn,$dislikeList);
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
			$likeList = "SELECT *  FROM `channel_message_reaction` join users on users.email=channel_message_reaction.user_email where message_id='$msg_id' and emoji_id=1";
			$dislikeList = "SELECT * FROM `channel_message_reaction` join users on users.email=channel_message_reaction.user_email where message_id='$msg_id' and emoji_id=2";
			$likeUsersList = mysqli_query($conn,$likeList);
			$dislikeUsersList = mysqli_query($conn,$dislikeList);
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