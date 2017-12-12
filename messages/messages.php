<?php 
include_once "../login/connect.php";
include_once "../sqlQueries.php";
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD,DB_NAME)
        OR die ('Could not connect to MySQL: '.mysql_error());

if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

$message = mysqli_real_escape_string($conn,$_POST['message']);
$channel_id = mysqli_real_escape_string($conn,$_POST['channel']);
$textOrCode = mysqli_real_escape_string($conn,$_POST['text']);
$user = getUserDetails(mysqli_real_escape_string($conn,$_POST['email']));
$toEmail = getUserDetails(mysqli_real_escape_string($conn,$_POST['toEmail']));
$fromEmail = getUserDetails(mysqli_real_escape_string($conn,$_POST['fromEmail']));
$toEmail =$toEmail['email'];
$fromEmail = $fromEmail['email'];
$user = $user['email'];
$imageFormats = ['png','jpeg','jpg','gif','tiff','tif'];
$image = end(explode('.',$message));

$type = get_headers($message, 1)["Content-Type"];
$imgType=explode("/",$type)[1];

if(isset($_POST['toEmail']))
{
	if(intval($textOrCode)==2)
	{	//if (in_array($_GET["channel"], $userChannels))
		if($message != "" && in_array($imgType,$imageFormats) )
		{	

		 	$sql = "INSERT INTO `direct_message` VALUES(DEFAULT,'$fromEmail','$toEmail','$message','$textOrCode',CURRENT_TIMESTAMP)";
		 	if (mysqli_query($conn, $sql)) {
		 		
		    	header('Location: ../index.php?email='.$toEmail);
		    	exit;
			}else{
		    	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}

			
		}else if ($message != ""){
			$textOrCode=0;
			$sql = "INSERT INTO `direct_message` VALUES(DEFAULT,'$fromEmail','$toEmail','$message','$textOrCode',CURRENT_TIMESTAMP)";
		 	if (mysqli_query($conn, $sql)) {
		 		
		    	header('Location: ../index.php?email='.$toEmail);
		    	exit;
			}else{
		    	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}

		}
	}else{

		if($message != "")
		{	
		 	$sql = "INSERT INTO `direct_message` VALUES(DEFAULT,'$fromEmail','$toEmail','$message','$textOrCode',CURRENT_TIMESTAMP)";
		 	if (mysqli_query($conn, $sql)) {
		 		
		    	header('Location: ../index.php?email='.$toEmail);
		    	exit;
			}else{
		    	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}	
		}
	}

}
else
{	
	if(intval($textOrCode)==2)
	{	//if (in_array($_GET["channel"], $userChannels))
		if($message != "" && in_array($imgType,$imageFormats) )
		{	
		 	$sql = "INSERT INTO `channel_messages` VALUES(DEFAULT,'$channel_id','$user','$message',DEFAULT,'$textOrCode',CURRENT_TIMESTAMP)";
		 	if (mysqli_query($conn, $sql)) {
		 		
		    	header('Location: ../index.php?channel='.$channel_id);
		    	exit;
			}else{
		    	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}

			
		}else if ($message != ""){
			$textOrCode=0;
			$sql = "INSERT INTO `channel_messages` VALUES(DEFAULT,'$channel_id','$user','$message',DEFAULT,'$textOrCode',CURRENT_TIMESTAMP)";
		 	if (mysqli_query($conn, $sql)) {
		 		
		    	header('Location: ../index.php?channel='.$channel_id);
		    	exit;
			}else{
		    	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}

		}
	}else{

		if($message != "")
		{	
		 	$sql = "INSERT INTO `channel_messages` VALUES(DEFAULT,'$channel_id','$user','$message',DEFAULT,'$textOrCode',CURRENT_TIMESTAMP)";
		 	if (mysqli_query($conn, $sql)) {
		 		
		    	header('Location: ../index.php?channel='.$channel_id);
		    	exit;
			}else{
		    	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}	
		}
	}
}

mysqli_close($conn);
?>