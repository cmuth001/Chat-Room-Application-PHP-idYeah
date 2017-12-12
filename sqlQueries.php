<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
session_start();
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
function membersInChannel($channelId){
	global $conn;
	$sql = "SELECT COUNT(*) as count1 FROM `userChannels` where channel_id= '".$channelId."'";
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
function getChannelDetails($channel_id){
	global $conn;
	$sql = "SELECT * FROM channels where channel_id="."'$channel_id'";
	$result = mysqli_query($conn, $sql);
	$row = $result->fetch_assoc();
	return $row;

}
function getChannelName($channel_id,$user_email){
	global $conn;
	$sql = "SELECT * FROM channels where channel_id="."'$channel_id'";
	$result = mysqli_query($conn, $sql);
	$row = $result->fetch_assoc();
	$admin = admin();
	if(intval($row['access_specifiers'])==1){
		if (in_array($user_email, $admin)){
			if($row['isArchive']==0){
				$string = "<div><i style='font-size: 170%;padding-right: 1%;color: #706c6c;' class='fa fa-lock'></i><label class = 'channel_title'><b>".$row['channel_name']."</b></label><i style='font-size: 150%;padding-right: 1%;padding-left: 5%;color: #706c6c;cursor:pointer;' class='fa fa-archive channelArchive' id = '$channel_id'></i>";
			}else{
				$string = "<div><i style='font-size: 170%;padding-right: 1%;color: #706c6c;' class='fa fa-lock'></i><label class = 'channel_title'><b>".$row['channel_name']."</b></label><i style='font-size: 150%;padding-right: 1%;padding-left: 5%;color: #d05252;cursor:pointer;' class='fa fa-archive channelArchive' id = '$channel_id'></i>";
			}
			
		}else{
			$string = "<div><i style='font-size: 170%;padding-right: 1%;color: #706c6c;' class='fa fa-lock'></i><label class = 'channel_title'><b>".$row['channel_name']."</b></label>";
		}
	}
	else{
		if (in_array($user_email, $admin)){
			if($row['isArchive']==0){
				$string = "<div><i style='font-size: 170%;padding-right: 1%;color: #706c6c;' class='fa fa-unlock'></i><label class = 'channel_title'><b>".$row['channel_name']."</b></label><i style='font-size: 150%;padding-right: 1%;padding-left: 5%;color: #706c6c;cursor:pointer' class='fa fa-archive channelArchive' id = '$channel_id'></i>";
			}else{
				$string = "<div><i style='font-size: 170%;padding-right: 1%;color: #706c6c;' class='fa fa-unlock'></i><label class = 'channel_title'><b>".$row['channel_name']."</b></label><i style='font-size: 150%;padding-right: 1%;padding-left: 5%;color: #d05252;cursor:pointer' class='fa fa-archive channelArchive' id = '$channel_id'></i>";
			}

			
		}else{
			$string = "<div><i style='font-size: 170%;padding-right: 1%;color: #706c6c;' class='fa fa-unlock'></i><label class = 'channel_title'><b>".$row['channel_name']."</b></label>";
		}
	}
	echo $string;
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
function admin(){
	global $conn;
	$sql = "SELECT * FROM `admin`";
	$result = mysqli_query($conn, $sql);
	$admin = [];
	while(($row = mysqli_fetch_assoc($result))){
		array_push($admin,$row['email']);
	}
	return $admin;
}
function gravatar($email){
	global $conn;
	$sql = "SELECT * FROM `gravatar` where email='$email'";
	$result = mysqli_query($conn, $sql);
	$Cnt = $result->num_rows;
	if($Cnt>0){
		while(($row = mysqli_fetch_assoc($result))){
			return($row['path']);
		}
	}else{
		return('https://www.gravatar.com/avatar/0000000000000000000000?s=40');
	}
	
}
function gitUser($email){
	global $conn;
	$sql = "SELECT * FROM `gitUser` where email='$email'";
	$result = mysqli_query($conn, $sql);
	$Cnt = $result->num_rows;
	if($Cnt>0){
		while(($row = mysqli_fetch_assoc($result))){
			return($row['path']);
		}
	}else{
		return('https://www.gravatar.com/avatar/0000000000000000000000?s=40');
	}
	
}
function getImage($email){
	global $conn;
	$sql = "SELECT * FROM `users` where users.email='$email'";
	$result = mysqli_query($conn, $sql);
	while(($row = mysqli_fetch_assoc($result))){
		if($row['display_pic']==1){
			return "./assets/images/".$email.".png" ;
		}else if($row['display_pic']==0){
			return gravatar($email);
		}else if($row['display_pic']==2){
			return gitUser($email);
		}
		else{
			return('https://www.gravatar.com/avatar/0000000000000000000000?s=40&d=mm&r=g');
		}
	}
	
}
if(isset($_POST['selectGravatar'])){
	$email = $_POST['selectGravatar'];

	$sql = "UPDATE users SET display_pic=0 where email='$email'";
	$result = mysqli_query($conn, $sql);
	echo $email;

}
if(isset($_POST['isSecureOption'])){
	$email = $_POST['isSecureOption']['email'];
	$isSecure = $_POST['isSecureOption']['isSecure'];
	$sql = "UPDATE users SET isSecure=$isSecure where email='$email'";
	$result = mysqli_query($conn, $sql);
}
function getIsSecureOption($email){
	global $conn;
	$sql = "select isSecure from users where email='$email'";
	$result = mysqli_query($conn, $sql);
	while(($row = mysqli_fetch_assoc($result))){
		if($row['isSecure']==1){
			return "checked";
		}
	}

}

if(isset($_POST['defaultPhoto'])){
	$email = $_POST['defaultPhoto'];

	$sql = "UPDATE users SET display_pic=3 where email='$email'";
	$result = mysqli_query($conn, $sql);
	echo $email;

}
function channelMembers($channelId){
	global $conn;
	$sql = "SELECT userChannels.user_email, users.user_name FROM `userChannels` join users on userChannels.user_email=users.email where userChannels.channel_id=$channelId";
	$result = mysqli_query($conn, $sql);
	$admin = admin();
	$user = $_SESSION['email'];
	$string = "<ul class='dropdown-menu ' role='menu' style=' cursor: pointer;' >";
	if(in_array($user, $admin)){
		while(($row = mysqli_fetch_assoc($result))){
			$string = $string."<li ><p class ='channelMembersLink'>".$row['user_name']."<span class='$channelId close channelMemberDelete' id = '".$row['user_email']."' style='color: red !important;opacity: 0.8;' >×</span></p></li>";
		}
	}else{
		while(($row = mysqli_fetch_assoc($result))){
			$string = $string."<li ><p class ='channelMembersLink'>".$row['user_name']."</p></li>";
		}
	}
	
	$string= $string."</ul>";
	return $string;
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

function userProfileRating($email){
	global $conn;

	$sql = "SELECT userChannels.channel_id as chId, channels.channel_name as chName  FROM `userChannels` join channels on userChannels.channel_id=channels.channel_id where userChannels.user_email='$email' and channels.access_specifiers=0";
    //SELECT count(*) as userChannelMessagesCount FROM `channel_messages` where channel_id=2 and channel_messages.cuser_email='cmuth001@odu.edu'
    $result = mysqli_query($conn, $sql);
    $string = "";
    while(($row = mysqli_fetch_assoc($result))) 
	{ 
		$channelId = $row['chId'];
		$channelName= $row['chName'];
		$usersWeight = [];
		$userValue=0;
		$userPercentage=0;
    	//users Channels messages count
		$channelMembersQuery = "SELECT * FROM `userChannels` join channels on userChannels.channel_id=channels.channel_id where userChannels.channel_id=$channelId";
		$channelMembersResult = mysqli_query($conn, $channelMembersQuery);
		while(($memberRow = mysqli_fetch_assoc($channelMembersResult))) 
		{ 
			$channelMemberEmail = $memberRow['user_email'];
	    	$usersMessagesCountQuery = "SELECT count(*) as userChannelMessagesCount FROM `channel_messages` where channel_id='$channelId' and channel_messages.cuser_email='$channelMemberEmail'";
	    	$usersMessagesCountResult = mysqli_query($conn,$usersMessagesCountQuery);
			$usersMessagesCount = mysqli_fetch_assoc($usersMessagesCountResult);
			$usersMessagesCount = intval($usersMessagesCount['userChannelMessagesCount']);

			//weight of messages
			$usersMessagesWeight = ($usersMessagesCount)*(40/100);

			// user thread messages count 
			$userThreadMessagesCountQuery ="SELECT count(*) as userThreadMessagesCount FROM `threaded_messages` join channel_messages on channel_messages.cmessage_id=threaded_messages.message_id where channel_messages.channel_id='$channelId' and threaded_messages.user_email='$channelMemberEmail'";
			$userThreadMessagesCountResult = mysqli_query($conn,$userThreadMessagesCountQuery);
			$userThreadMessagesCount = mysqli_fetch_assoc($userThreadMessagesCountResult);
			$userThreadMessagesCount = intval($userThreadMessagesCount['userThreadMessagesCount']);

			//weight of Thread messages
			$usersThreadMessagesWeight = ($userThreadMessagesCount)*(30/100);

			//user reactions count
			$userReactionCountQuery = "SELECT count(*) as usersReactionCount FROM `channel_message_reaction` JOIN channel_messages on channel_messages.cmessage_id=channel_message_reaction.message_id where channel_messages.channel_id='$channelId' AND channel_message_reaction.user_email='$channelMemberEmail'";
			$userReactionCountResult = mysqli_query($conn,$userReactionCountQuery);
			$userReactionCount =mysqli_fetch_assoc($userReactionCountResult);
			$userReactionCount = intval($userReactionCount['usersReactionCount']);

			//weight of Thread messages
			$userReactionWeight = ($userReactionCount)*(30/100);

			$totalweight = $usersMessagesWeight+$usersThreadMessagesWeight+$userReactionWeight;
			if($email==$channelMemberEmail){
				$userValue =$totalweight;
			}
			array_push($usersWeight, $totalweight);

		}

		$userPercentage = (100*$userValue)/max($usersWeight);
		
    	$string=$string."<span>".$channelName.":<div class='ratings'><div class='empty-stars'></div> <div class='full-stars' style='width:".round($userPercentage,1)."%'></div></div> "." ".round($userPercentage,1)."%"."</span></br>";
	}
	
	return $string;
}

function getAllChannels($email){
	global $conn;
	$sql = "SELECT channels.channel_id,channels.channel_name,channels.access_specifiers, channels.isArchive FROM `userChannels` join channels on userChannels.channel_id=channels.channel_id where userChannels.user_email="."'$email'";
    $result = mysqli_query($conn, $sql);
    $string = "";
    while(($row = mysqli_fetch_assoc($result))) 
	{ 
		if(intval($row['access_specifiers'])==1){
			if(intval($row['isArchive'])==1){
				$string=$string."<li ><a class= 'listbg' href=index.php?channel=".$row['channel_id']."><i style='font-size: 100%;padding-right: 3%;' class='fa fa-archive'></i>".$row['channel_name']."</a></li>";
			}else{
				$string=$string."<li ><a class= 'listbg' href=index.php?channel=".$row['channel_id']."><i style='font-size: 126%;padding-right: 3%;' class='fa fa-lock'></i>".$row['channel_name']."</a></li>";
			}
			
		}
		else{
			if(intval($row['isArchive'])==1){
				$string=$string."<li ><a class= 'listbg' href=index.php?channel=".$row['channel_id']."><i style='font-size: 100%;padding-right: 3%;' class='fa fa-archive'></i>".$row['channel_name']."</a></li>";
			}else{
				$string=$string."<li ><a class= 'listbg' href=index.php?channel=".$row['channel_id']."><i style='font-size: 126%;padding-right: 3%;' class='fa fa-unlock'></i>".$row['channel_name']."</a></li>";
			}
			
		}	
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
	$sql = "SELECT * FROM users";
    $result = mysqli_query($conn, $sql);
    $string = "";
    while(($row = mysqli_fetch_assoc($result))) 
	{ 
    	$string=$string."<li ><a class= 'listbg' href=\"./index.php?email=".trim($row['email'])."\"><i class ='fa' style = 'padding-right: 3%;'>&#xf2be;</i>".$row['user_name']."</a></li>";
	}
	return $string;
}
// direct messages calling function
function getDirectMessages($toEmail,$start){
	global $conn;

	
	$sql = "select * from ( SELECT * FROM `direct_message` join users on users.email=direct_message.from_email where (direct_message.to_email='$toEmail' and direct_message.from_email='".$_SESSION['email']."') or (direct_message.from_email='$toEmail' and direct_message.to_email='".$_SESSION['email']."') ORDER by directmsg_id DESC LIMIT $start,10) as temp ORDER BY directmsg_id ASC";
	
    $result = mysqli_query($conn, $sql);
    $row_cnt = $result->num_rows;//finding the no of rows.
	$toEmailDetails =getUserDetails($toEmail);
    $string = "";
    $_SESSION['lastLimit']=$start+10;
    if($row_cnt>=10){
    	$loadMore = "<div id = 'loadMoreDirectMessages".$_SESSION['lastLimit']."' class='col-xs-12 noPadding'><div class = 'col-xs-5 noPadding'></div><div class ='col-xs-2 noPadding ' style='text-align:center;font-style: italic;color: #337ab7; margin-top: 8px;cursor:pointer;'><span class ='loadMoreDirectMessages' style='text-align:center;' id='".$_SESSION['lastLimit']."'>load more</span></div><div class = 'col-xs-5 noPadding'></div></div>";
		
    }else{
    	$loadMore="<div col-xs-12 style='text-align:center; oncopy='return false' oncut='return false' onpaste='return false'><h1>".$toEmailDetails['user_name']."</h1><p style='border-bottom: 2px solid #ccc;'>This is the very beginning of your chat</p></div>";
    }
	$string =$string.$loadMore;
    while(($row = mysqli_fetch_assoc($result))) 
	{ 	
		$date = date_create($row['dm_timestamp']);
		$time = date_format($date, 'Y-m-d l g:ia');
		$message = htmlspecialchars($row['direct_message']);
		$textOrCode = $row['textOrCode'];
		$contactImg = getImage($row['from_email']);
		$msgId = $row['directmsg_id'];	
    	$string=$string."<div class='col-xs-12 right right$msgId '>";
    						$string=$string."<img src=".$contactImg." alt='Contact_Img' class='contact_Img'>";
    						$string=$string."<a href= ''>".$row['user_name']."</a>
    						<label class = 'timeStamp'>".$time."</label>  					
    						<div class= 'textMessage'>";
	    						if($textOrCode==0){
	    							$string=$string."<span>".$message."</span>";
	    						}elseif ($textOrCode==1){
	    							$string=$string."<span><pre class = 'codeDisplay'><code>".$message."</code></pre></span>";
	    						}else if($textOrCode==2){
	    							$string=$string."<a href='$message' target='_blank'>$message</a><a href='#imageCollapse".$msgId."' data-toggle='collapse' ><i class='fa fa-caret-down' aria-hidden='true' style='cursor:pointer;'></i></a>";
	    							$string=$string."<img id ='imageCollapse".$msgId."' class='profile-pic collapse in' src='$message' />";
	    						}else if($textOrCode==4){
	    							$string=$string."<a href='./assets/upload/$msgId"."_"."$message' title='File' target='_blank' download><i class='fa fa-file-text' aria-hidden='true' style='cursor:pointer;'></i>$message</a>";

	    						}else{
	    							$string=$string."<img  class='profile-pic' src='./assets/DirectMessageImages/".$msgId.".png' />";
	    							$string=$string."<span>".$message."</span>";
	    						}
    							
    						$string=$string."</div>";
    					$string=$string."</div>";//right
    						
    					
    		
   
    	
		$userDetails = getUserDetails($_SESSION['email']);
		$userDetails = $userDetails['display_name'];
		

	}
	// $string = $string."</div>";
	
	
	return $string;
}

//end of direct messages calling function


function getChannelMessages($channel_id,$start){
	global $conn;

	// $sql = "SELECT * FROM `channel_messages` join users on users.email=channel_messages.cuser_email where channel_id="."'$channel_id'";
	$sql = "SELECT * FROM (SELECT * FROM `channel_messages` join users on users.email=channel_messages.cuser_email where channel_id=$channel_id ORDER BY `cmessage_id` DESC LIMIT $start,10 ) TEMP ORDER BY `cmessage_id` ASC";
	//SELECT * FROM (SELECT * FROM `channel_messages` ORDER BY `cmessage_id` DESC LIMIT 5) TEMP ORDER BY `cmessage_id` ASC
    $result = mysqli_query($conn, $sql);
    $row_cnt = $result->num_rows;//finding the no of rows.
	$channelQuery = "SELECT * FROM `channels` where channel_id= '$channel_id'";
	$channelResult = mysqli_query($conn, $channelQuery);
	$channelArray = $channelResult->fetch_assoc();
		
	$admin = admin();
	$ThreadContainer='';

	
    $string = "";
    $_SESSION['lastLimit']=$start+10;
    if($row_cnt>=10){
    	$loadMore = "<div id = 'loadMore".$_SESSION['lastLimit']."' class='col-xs-12 noPadding'><div class = 'col-xs-5 noPadding'></div><div class ='col-xs-2 noPadding ' style='text-align:center;font-style: italic;color: #337ab7; margin-top: 8px;cursor:pointer;'><span class ='loadMore' style='text-align:center;' id='".$_SESSION['lastLimit']."'>load more</span></div><div class = 'col-xs-5 noPadding'></div></div>";
		
    }else{
    	$loadMore="<div col-xs-12 style='text-align:center;oncopy='return false' oncut='return false' onpaste='return false'><h1>".$channelArray['channel_name']."</h1><p style='border-bottom: 2px solid #ccc;'>This is the very beginning of your channel</p></div>";
    }
	$string =$string.$loadMore;
    while(($row = mysqli_fetch_assoc($result))) 
	{ 
		$likeCountQuery = "SELECT COUNT(*) as likeCount FROM `channel_message_reaction` where message_id=".$row['cmessage_id']." and emoji_id=1";
		$dislikeCountQuery = "SELECT COUNT(*) as dislikeCount FROM `channel_message_reaction` where message_id=".$row['cmessage_id']." and emoji_id=2";
		$likeList = "SELECT *  FROM `channel_message_reaction` join users on users.email=channel_message_reaction.user_email where message_id=".$row['cmessage_id']." and emoji_id=1";
		$dislikeList = "SELECT * FROM `channel_message_reaction` join users on users.email=channel_message_reaction.user_email where message_id=".$row['cmessage_id']." and emoji_id=2";
		$reactionStatusQuery ="SELECT * FROM `channel_message_reaction` where channel_message_reaction.message_id=".$row['cmessage_id']." and channel_message_reaction.user_email='".$_SESSION['email']."'";
		
		//$test = "SELECT * FROM channel_message_reaction where channel_message_reaction.message_id=".$row['cmessage_id'];
		$likeResult = mysqli_query($conn,$likeCountQuery);
		$dislikeResult = mysqli_query($conn,$dislikeCountQuery);
		$likeUsersList = mysqli_query($conn,$likeList);
		$dislikeUsersList = mysqli_query($conn,$dislikeList);
		$reactionStatusResult = mysqli_query($conn,$reactionStatusQuery);

		$likeCount = mysqli_fetch_assoc($likeResult);
		$dislikeCount = mysqli_fetch_assoc($dislikeResult);
		$reactionCnt = $reactionStatusResult->num_rows;//finding reaction exist or not.
		if($reactionCnt>0){
			$reactionStatus = mysqli_fetch_assoc($reactionStatusResult);
			$emojiId = intval($reactionStatus['emoji_id']);
		}else{
			$emojiId=0;
		}
		
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
		$textOrCode = $row['textOrCode'];
		$replyMsg = "replyMsg".$row['cmessage_id'];
		$myForm = "myForm".$row['cmessage_id'];
		$codeForm = "threadCodeForm".$row['cmessage_id'];
		$modalClose = "modalClose".$row['cmessage_id'];
		$myThreadModal = "myThreadModal".$row['cmessage_id'];
		$contactImg = getImage($row['email']);
		$msgId = $row['cmessage_id'];
		
		$messageThreadCount=messageThreadCount($msgId);
    	$string=$string."<div class='col-xs-12 right right$msgId '>";
    						$string=$string."<img src=".$contactImg." alt='Contact_Img' class='contact_Img'>";
    						$string=$string."<a href= ''>".$row['display_name']."</a>
    						<label class = 'timeStamp'>".$time."</label>  					
    						<div class= 'textMessage'>";
	    						if($textOrCode==0){
	    							$string=$string."<span>".$message."</span>";
	    						}elseif ($textOrCode==1){
	    							$string=$string."<span><pre class = 'codeDisplay'><code>".$message."</code></pre></span>";
	    						}else if($textOrCode==2){
	    							$string=$string."<a href='$message' target='_blank'>$message</a><a href='#imageCollapse".$row['cmessage_id']."' data-toggle='collapse' ><i class='fa fa-caret-down' aria-hidden='true' style='cursor:pointer;'></i></a>";
	    							$string=$string."<img id ='imageCollapse".$row['cmessage_id']."' class='profile-pic collapse in' src='$message' />";
	    						}else if($textOrCode==4){
	    							$string=$string."<a href='./assets/upload/$msgId"."_"."$message' title='File' target='_blank' download><i class='fa fa-file-text' aria-hidden='true' style='cursor:pointer;'></i>$message</a>";

	    						}else{
	    							$string=$string."<img  class='profile-pic' src='./assets/channelImages/".$row['cmessage_id'].".png' />";
	    							$string=$string."<span>".$message."</span>";
	    						}
    							
    						$string=$string."</div>";
    						$string=$string."<div class = 'reaction reaction$msgId'>";
    						if($channelArray['isArchive']==0){
    							if($emojiId==1 && $_SESSION['email']==$reactionStatus['user_email']){
    								$string=$string."<label class='likeIcon likeIcon$msgId' data-toggle='tooltip' title='$likeStr'   emoji_id = '1' name = 'like' id =".$row['cmessage_id']." onclick = 'reactionFunction(".$row['cmessage_id'].","."\"".$_SESSION['email']."\"".",1)' ><i class='fa fa-thumbs-up' style='color: #3697e1;font-size: 180%;'></i></label><label class=likeCount".$row['cmessage_id'].">".$likeCount['likeCount']."</label>
    									 <label class = 'dislikeIcon dislikeIcon$msgId'data-toggle='tooltip' title='$dislikeStr'  emoji_id = '2' name = 'dislike' id =".$row['cmessage_id']." onclick = 'reactionFunction(".$row['cmessage_id'].","."\"".$_SESSION['email']."\"".",2)' ><i class='fa fa-thumbs-o-down' style='font-size: 170%;'></i></label><label class=dislikeCount".$row['cmessage_id'].">".$dislikeCount['dislikeCount']."</label>";
    							}else if($emojiId==2 && $_SESSION['email']==$reactionStatus['user_email']){
    								$string=$string."<label class='likeIcon likeIcon$msgId' data-toggle='tooltip' title='$likeStr'  emoji_id = '1' name = 'like' id =".$row['cmessage_id']." onclick = 'reactionFunction(".$row['cmessage_id'].","."\"".$_SESSION['email']."\"".",1)' ><i class='fa fa-thumbs-o-up' style='font-size: 170%;'></i></label><label class=likeCount".$row['cmessage_id'].">".$likeCount['likeCount']."</label>
    									 	<label class = 'dislikeIcon dislikeIcon$msgId'data-toggle='tooltip' title='$dislikeStr'  emoji_id = '2' name = 'dislike' id =".$row['cmessage_id']." onclick = 'reactionFunction(".$row['cmessage_id'].","."\"".$_SESSION['email']."\"".",2)' ><i class='fa fa-thumbs-down' style='color: #3697e1;font-size: 180%;'></i></label><label class=dislikeCount".$row['cmessage_id'].">".$dislikeCount['dislikeCount']."</label>";
    							}else{
    								$string=$string."<label class='likeIcon likeIcon$msgId' data-toggle='tooltip' title='$likeStr'  emoji_id = '1' name = 'like' id =".$row['cmessage_id']." onclick = 'reactionFunction(".$row['cmessage_id'].","."\"".$_SESSION['email']."\"".",1)' ><i class='fa fa-thumbs-o-up' style='font-size: 170%;'></i></label><label class=likeCount".$row['cmessage_id'].">".$likeCount['likeCount']."</label>
    									 	<label class = 'dislikeIcon dislikeIcon$msgId'data-toggle='tooltip' title='$dislikeStr'  emoji_id = '2' name = 'dislike' id =".$row['cmessage_id']." onclick = 'reactionFunction(".$row['cmessage_id'].","."\"".$_SESSION['email']."\"".",2)' ><i class='fa fa-thumbs-o-down' style='font-size: 170%;'></i></label><label class=dislikeCount".$row['cmessage_id'].">".$dislikeCount['dislikeCount']."</label>";		

    							}
    							$string=$string."<label class = 'replyMsgIcon' id=".$row['cmessage_id']." title='Leave a comment'><i class='fa fa-comments-o' aria-hidden='true'></i></label>";
    						}
    						
    		if($messageThreadCount>0){
    			$string=$string."<a href='#thread_wrapper$msgId' class = 'repliesCount repliesCount$msgId' id = '$msgId' data-toggle='collapse' style = 'margin-left:1%;text-decoration:none;'>Comments($messageThreadCount)</a>";
    			if($channelArray['isArchive']==0){
	    				if (in_array($_SESSION['email'], $admin)){
	    				$string=$string."<label title='Delete'><i class='fa fa-trash-o delete $channel_id' id ='$msgId' aria-hidden='true'></i></label>";
	    			}
	    		}
    			$string=$string."</div><div class = 'collapse thread_wrapper$msgId' id ='thread_wrapper$msgId'>";
    		
    		}
    		else{
    			if($channelArray['isArchive']==0){
	    			if (in_array($_SESSION['email'], $admin)){
	    				$string=$string."<label title='Delete'><i class='fa fa-trash-o delete $channel_id' id ='$msgId' aria-hidden='true'></i></label>";
	    			}
	    		}
    			
    			$string=$string."</div><div class = 'collapse thread_wrapper$msgId' id ='thread_wrapper$msgId'>";
    			
    		}					
    		
    	
    	$stringThread = "";
    	if($row['has_thread']==1){
    		$threadsql = "SELECT * FROM `threaded_messages` join users on users.email=threaded_messages.user_email where message_id=".$row['cmessage_id'];
			$threadResult = mysqli_query($conn, $threadsql);

			
			while(($threadrow = mysqli_fetch_assoc($threadResult))) 
			{ 
				$threadContactImage = getImage($threadrow['email']);
				$ThreadDate = date_create($threadrow['createdon']);
				$threadTime = date_format($ThreadDate, 'Y-m-d l g:ia');
				$threadMessage = htmlspecialchars($threadrow['message']);
				$stringThread=$stringThread."<div id =".$row['cmessage_id']." class='thread'>
												<img src=".$threadContactImage." alt='Contact_Img' class='contact_Img'><a href= ''>".$threadrow['display_name']."</a><label class = 'timeStamp'>".$threadTime."</label>";					
						    					if($threadrow['textOrCode']==0)
						    					{
						    						$stringThread=$stringThread."<div class= 'textMessage'><span>".$threadMessage."</span></div>		
																				</div>";

						    					}else{
						    						$stringThread=$stringThread."<div class= 'textMessage'><span><pre class='codeDisplay'><code>".$threadMessage."</code></pre></span></div>		
																				</div>";
						    					}
					    						
			}
			
			 
		}
		$stringThread = $stringThread."</div>";//thread_wrapper
		$userDetails = getUserDetails($_SESSION['email']);
		$userDetails = $userDetails['display_name'];
		$string=$string.$stringThread."

							
    						<div class='modal fade' id='$myThreadModal' role='dialog'>
									    <div class='modal-dialog modal-lg'>
									      <div class='modal-content'>
									        <div class='modal-header'>
									          <button type='button' class='close modalClose' data-dismiss='modal'>&times;</button>
									          <h4 class='modal-title'>code posting Area</h4>
									        </div>
									        <div class='modal-body'>
									          
									          <form id= '$codeForm' method = 'post'>
									          
									          <div class='form-group'>
									            <label for='message-text' class='form-control-label'>code</label>
									            <textarea class='form-control codeArea' name = 'message' id='code' placeholder= 'Snippet' autofocus required ></textarea>
									            <input type='hidden' name='channel' value=".$_GET['channel'].">
									            <input type='hidden' name='user' id='user' value=".$_SESSION['email'].">
									            <input type='hidden' name='channel' id='channel' value='$channel_id' >
									            <input type='hidden' name='display_name' id='display_name' value='$userDetails' >
									            <input type='hidden' name='msgId' id='msgId' value=".$row['cmessage_id']." >
									            <input type='hidden' name='text' value='1'>
									          </div>
									          
									          <div class='modal-footer'>
									          <button type='button' class='btn btn-default $modalClose ' id = ".$row['cmessage_id']." data-dismiss='modal'>Close</button>
									           <button type='submit' name = 'submit'  id = ".$row['cmessage_id']."  class='btn btn-success threadMessageButton' >submit code</button>
									          </div>
									          <div>
													
									          </div>		
									        </form>
									        </div>
									        <div class = 'modal-body-result'>
									        	<p class = 'para' style='text-align:center;'></p>
									        </div>
									      </div>
									    </div>
									  </div>
    						</div>";

	}
	$string = $string."</div>";
	
	// $string = $string."</div>";//message_container div
	
	$string =$string.$ThreadContainer;
	
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


if(isset($_POST['profileSearchInputField']))
{
	$keyValue = $_POST['profileSearchInputField'];
	$sql = "SELECT * FROM users WHERE email LIKE \"%$keyValue%\" OR user_name LIKE \"%$keyValue%\"";
    $result = mysqli_query($conn, $sql);
    $userList = [];
    while(($row = mysqli_fetch_assoc($result))) 
	{ 
    	array_push($userList,$row);
	}
	echo json_encode($userList);
	
}
if(isset($_POST['archive']))
{
	$channelId = intval($_POST['archive']);
	$channelQuery = "SELECT * FROM `channels` where channel_id= '$channelId'";
	$result = mysqli_query($conn, $channelQuery);
	$channelArray = $result->fetch_assoc();
	if($channelArray['isArchive']==0){
		$sql = "UPDATE channels SET isArchive=1 where channel_id='$channelId'";
		$archiveMsg = "channel-$channelId successfully archived";
	}else{
		$sql = "UPDATE channels SET isArchive=0 where channel_id='$channelId'";
		$archiveMsg = "channel-$channelId unarchived";
	}
	if (mysqli_query($conn, $sql)) {       
        echo $archiveMsg;
    }else{
        echo "failed channel $archive  archiving";
    }
	

}
if(isset($_POST['deleteMessage']))
{
	$messageId = intval($_POST['deleteMessage']);
	echo $messageId;
	$threadMessageSql = "DELETE FROM threaded_messages WHERE message_id='$messageId'";
	$channekMessageDeleteSql = "DELETE FROM channel_messages WHERE cmessage_id='$messageId'";
	if (mysqli_query($conn, $threadMessageSql)) {       
        echo "'$threadMessageSql'thread messages deleted !!!";
    }else{
        echo "failed deleting thread messages !!!";
    }
    if (mysqli_query($conn, $channekMessageDeleteSql)) {       
        echo "'$threadMessageSql'channel  message deleted !!!";
    }else{
        echo "failed deleting channel message !!!";
    }
}
if(isset($_POST['deleteChannelMember']))
{
	$details = $_POST['deleteChannelMember'];
	$email = $details['email'];
	$channelId = $details['channelId'];
	$sql = "DELETE FROM `userChannels` where userChannels.user_email='$email' and userChannels.channel_id=$channelId";

	if (mysqli_query($conn, $sql)) {       
        echo "removed from channel";
    }else{
        echo "failed deleting tfrom channel !!!";
    }
}
if(isset($_POST['messagesCount']))
{
	$channelId = $_POST['messagesCount'];
	$sql = "SELECT COUNT(*) as msgCount FROM `channel_messages` where channel_id='$channelId'";
	$Result = mysqli_query($conn,$sql);
	$msgCount = mysqli_fetch_assoc($Result);
	echo $msgCount['msgCount'];

}
if(isset($_POST['loadMore']))
{
	$channelId = intval($_POST['loadMore']['channelId']);
	$start = intval($_POST['loadMore']['start']);
	$str = getChannelMessages($channelId,$start);
	echo $str;

}
if(isset($_POST['loginActivityLog'])){
	$email = $_SESSION['email'];
	$sql = "SELECT LogInTime  as time, COUNT(*) as count FROM `loginActivityLog` where logEmail='$email' GROUP BY CAST(LogInTime AS DATE)";
	$Result = mysqli_query($conn,$sql);
	while(($row = mysqli_fetch_assoc($Result))) 
	{
		$date=date_create($row['time']);
		$row['time']=date_format($date,"d-M-y");

		$array[]=array_map('utf8_encode',$row);
	}
	echo json_encode($array);

}
if(isset($_POST['loginActivityPieChart'])){
	$email = $_SESSION['email'];
	$usersMessagesCountQuery = "SELECT count(*) as userChannelMessagesCount FROM `channel_messages` where cuser_email='$email'";
	$usersMessagesCountResult = mysqli_query($conn,$usersMessagesCountQuery);
	$usersMessagesCount = mysqli_fetch_assoc($usersMessagesCountResult);
	$usersMessagesCount = intval($usersMessagesCount['userChannelMessagesCount']);

	$userThreadMessagesCountQuery ="SELECT count(*) as userThreadMessagesCount FROM `threaded_messages` where user_email='$email'";
	$userThreadMessagesCountResult = mysqli_query($conn,$userThreadMessagesCountQuery);
	$userThreadMessagesCount = mysqli_fetch_assoc($userThreadMessagesCountResult);
	$userThreadMessagesCount = intval($userThreadMessagesCount['userThreadMessagesCount']);

	$userReactionCountQuery = "SELECT count(*) as usersReactionCount FROM `channel_message_reaction` where user_email='$email'";
	$userReactionCountResult = mysqli_query($conn,$userReactionCountQuery);
	$userReactionCount =mysqli_fetch_assoc($userReactionCountResult);
	$userReactionCount = intval($userReactionCount['usersReactionCount']);

	$total = $usersMessagesCount+$userThreadMessagesCount+$userReactionCount;
	$messages = round((($usersMessagesCount/$total)*100),1);
	$threads = round((($userThreadMessagesCount/$total)*100),1);
	$reactions = round((($userReactionCount/$total)*100),1);

	echo json_encode([$messages,$threads,$reactions]);

}

if(isset($_POST['loadMoreDirectMessages'])){
	$toEmail = $_POST['loadMoreDirectMessages']['toEmail'];
	$start = $_POST['loadMoreDirectMessages']['start'];
	$str = getDirectMessages($toEmail,$start);
	echo $str;
}
// get messages for pagination
if(isset($_POST['getmessages']))
{
	$json = $_POST['getmessages'];
	$channelId = $json['channelId'];
	$start = intval($json['start']);
	//$sql = "SELECT * FROM `channel_messages` join users on users.email= channel_messages.cuser_email where channel_id=$channelId ORDER BY `channel_messages`.`cmessage_id` DESC LIMIT $start,5";
    $sql = "SELECT * FROM (SELECT * FROM `channel_messages` join users on users.email=channel_messages.cuser_email where channel_id=$channelId  ORDER BY `cmessage_id` DESC LIMIT $start, 7) TEMP ORDER BY `cmessage_id` ASC";
    $result = mysqli_query($conn, $sql);
    $channelQuery = "SELECT * FROM `channels` where channel_id= '$channelId'";
	$channelResult = mysqli_query($conn, $channelQuery);
	$channelArray = $channelResult->fetch_assoc();
    $messages = [];
    $userDetails = getUserDetails($_SESSION['email']);
    // $groupedThreadMessages = [];
    $threadMessages = [];
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
		$row['cmsg_timestamp'] = $time;

		$row['replies'] = messageThreadCount($row['cmessage_id']);
		$row['likeCount'] = $likeCount['likeCount'];
		$row['channel_message'] = htmlspecialchars($row['channel_message']);
		$row['disLikeCount'] = $dislikeCount['dislikeCount'];
		$row['isArchive'] = $channelArray['isArchive'];
		$row['session_email'] = $_SESSION['email'];
		$row['session_username'] =$userDetails['display_name'];
		if($row['has_thread']==1){
			$threadMessagesSql = "SELECT * FROM `threaded_messages` join users on users.email=threaded_messages.user_email WHERE message_id=".$row['cmessage_id'];
			// echo $threadMessagesSql;
			$threadResult = mysqli_query($conn, $threadMessagesSql);

			while(($rowThread = mysqli_fetch_assoc($threadResult))) 
			{
				$date = date_create($rowThread['createdon']);
				$time = date_format($date, 'Y-m-d l g:ia');
				$rowThread['createdon'] = $time;
				$rowThread['message'] = htmlspecialchars($rowThread['message']);
				$row['threadMsgUserImg'] = getImage($row['user_email']);
				array_push($threadMessages,$rowThread);
			}
		}
    	array_push($messages,$row);
	}
	echo json_encode([$messages,$threadMessages]);
	// echo $sql;
	
}
if(isset($_POST['threadContainerMessages']))
{
	$channelId = $_POST['threadContainerMessages']['channelId'];
	$messageId = intval($_POST['threadContainerMessages']['messageId']);
	$sql = "SELECT * FROM `channel_messages` join users on users.email=channel_messages.cuser_email WHERE channel_messages.cmessage_id=$messageId";
	$result = mysqli_query($conn,$sql);
	$userDetails = getUserDetails($_SESSION['email']);
	$channelQuery = "SELECT * FROM `channels` where channel_id= '$channelId'";
	$channelResult = mysqli_query($conn, $channelQuery);
	$channelArray = $channelResult->fetch_assoc();
	$messageDetails = mysqli_fetch_assoc($result);
		$likeCountQuery = "SELECT COUNT(*) as likeCount FROM `channel_message_reaction` where message_id=".$messageId." and emoji_id=1";
		$dislikeCountQuery = "SELECT COUNT(*) as dislikeCount FROM `channel_message_reaction` where message_id=".$messageId." and emoji_id=2";
		$likeResult = mysqli_query($conn,$likeCountQuery);
		$dislikeResult = mysqli_query($conn,$dislikeCountQuery);
		$likeCount = mysqli_fetch_assoc($likeResult);
		$dislikeCount = mysqli_fetch_assoc($dislikeResult);

		$reactionStatusQuery ="SELECT * FROM `channel_message_reaction` where channel_message_reaction.message_id=".$messageId." and channel_message_reaction.user_email='".$_SESSION['email']."'";
		$reactionStatusResult = mysqli_query($conn,$reactionStatusQuery);
		$reactionCnt = $reactionStatusResult->num_rows;//finding reaction exist or not.
		if($reactionCnt>0){
			$reactionStatus = mysqli_fetch_assoc($reactionStatusResult);
			$emojiId = intval($reactionStatus['emoji_id']);
		}else{
			$emojiId=0;
		}

		$date = date_create($messageDetails['cmsg_timestamp']);
		$time = date_format($date, 'Y-m-d l g:ia');
		$messageDetails['cmsg_timestamp'] = $time;
		$messageDetails['replies'] = messageThreadCount($messageDetails['cmessage_id']);
		$messageDetails['likeCount'] = $likeCount['likeCount'];
		$messageDetails['channel_message'] = htmlspecialchars($messageDetails['channel_message']);
		$messageDetails['disLikeCount'] = $dislikeCount['dislikeCount'];
		$messageDetails['isArchive'] = $channelArray['isArchive'];
		$messageDetails['session_email'] = $_SESSION['email'];
		$messageDetails['replyMsgContactImg'] = getImage($_SESSION['email']);
		$messageDetails['messageContactImg'] = getImage($messageDetails['cuser_email']);
		$messageDetails['session_username'] =$userDetails['display_name'];
		$messageDetails['emojiId']= $emojiId;
		$messageDetails['emoji_email']=$reactionStatus['user_email'];
	if($messageDetails['has_thread']==1)
	{
		$threadSql = "SELECT * FROM `threaded_messages` join users on users.email=threaded_messages.user_email WHERE message_id=$messageId";
		$threadResult = mysqli_query($conn,$threadSql);
		$threadArray = [];
		// $threads = mysqli_fetch_assoc($threadResult);
		while($row =mysqli_fetch_assoc($threadResult)){
			$date = date_create($row['createdon']);
			$time = date_format($date, 'Y-m-d l g:ia');
			$row['createdon'] = $time;
			$row['message'] = htmlspecialchars($row['message']);
			$row['threadMsgUserImg'] = getImage($row['user_email']);
			array_push($threadArray, $row);

		}
		echo json_encode([$messageDetails,$threadArray]);
	}else{
		echo json_encode([$messageDetails,[]]);
	}
	

	

}
if(isset($_POST['thread']))
{
	$thread = $_POST['thread'];
	$channel_id = intval($thread['channel']);
	$message = mysqli_real_escape_string($conn,$thread['message']);
	$msgId = intval($thread['msgId']);
	$user_email = $thread['user'];
	$textOrCode =$thread['text']; 

	$sql = "INSERT INTO `threaded_messages` VALUES(DEFAULT,'$msgId','$user_email','$message','$textOrCode',CURRENT_TIMESTAMP)";
	
	if (mysqli_query($conn, $sql)) {       
        
    }else{
        // echo "**** failed inserting thread message ***";
    }
	$updateHasthread = "UPDATE channel_messages SET has_thread=1 where cmessage_id='$msgId'";
	if (mysqli_query($conn, $updateHasthread)) {       
        // echo "**** thread updated successfully in channel_messages ***";
    }else{
        // echo "**** failed thread updating in channel_messages***";
    }
    $sql = "SELECT * FROM `threaded_messages` ORDER BY thread_id DESC LIMIT 1";
    $Result = mysqli_query($conn,$sql);
	$lastThreadDetails = mysqli_fetch_assoc($Result);
	// converting time 
	$date = date_create($lastThreadDetails['createdon']);
	$time = date_format($date, 'Y-m-d l g:ia');
	$lastThreadDetails['createdon'] = $time;
	$lastThreadDetails['imgPath'] = getImage($user_email);
	$lastThreadDetails['message'] = htmlspecialchars($lastThreadDetails['message']);
    $messageThreadCount=messageThreadCount($msgId);
    echo json_encode([$messageThreadCount,$lastThreadDetails]);
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
			$reactionStatusQuery ="SELECT * FROM `channel_message_reaction` where channel_message_reaction.message_id=".$msg_id." and channel_message_reaction.user_email='".$_SESSION['email']."'";
			$reactionStatusResult = mysqli_query($conn,$reactionStatusQuery);
			$reactionCnt = $reactionStatusResult->num_rows;//finding reaction exist or not.
			if($reactionCnt>0){
				$reactionStatus = mysqli_fetch_assoc($reactionStatusResult);
				$emojiId = intval($reactionStatus['emoji_id']);
			}else{
				$emojiId=0;
			}
			echo json_encode([$likeCount['likeCount'],$dislikeCount['dislikeCount'],$likeStr,$dislikeStr,$emojiId]);
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
			$reactionStatusQuery ="SELECT * FROM `channel_message_reaction` where channel_message_reaction.message_id=".$msg_id." and channel_message_reaction.user_email='".$_SESSION['email']."'";
			$reactionStatusResult = mysqli_query($conn,$reactionStatusQuery);
			$reactionCnt = $reactionStatusResult->num_rows;//finding reaction exist or not.
			if($reactionCnt>0){
				$reactionStatus = mysqli_fetch_assoc($reactionStatusResult);
				$emojiId = intval($reactionStatus['emoji_id']);
			}else{
				$emojiId=0;
			}
			echo json_encode([$likeCount['likeCount'],$dislikeCount['dislikeCount'],$likeStr,$dislikeStr,$emojiId]);
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
			$reactionStatusQuery ="SELECT * FROM `channel_message_reaction` where channel_message_reaction.message_id=".$msg_id." and channel_message_reaction.user_email='".$_SESSION['email']."'";
			$reactionStatusResult = mysqli_query($conn,$reactionStatusQuery);
			$reactionCnt = $reactionStatusResult->num_rows;//finding reaction exist or not.
			if($reactionCnt>0){
				$reactionStatus = mysqli_fetch_assoc($reactionStatusResult);
				$emojiId = intval($reactionStatus['emoji_id']);
			}else{
				$emojiId=0;
			}
		echo json_encode([$likeCount['likeCount'],$dislikeCount['dislikeCount'],$likeStr,$dislikeStr,$emojiId]);
		//echo "insert";
	}
	
}

 ?>
