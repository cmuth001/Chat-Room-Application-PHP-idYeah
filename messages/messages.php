<?php 
include_once "../login/connect.php";
include_once "../sqlQueries.php";
$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD,DB_NAME)
        OR die ('Could not connect to MySQL: '.mysql_error());

if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

$message = mysqli_real_escape_string($conn,$_POST['message']);
$channel_id = mysqli_real_escape_string($conn,$_POST['channel']);
$textOrCode = mysqli_real_escape_string($conn,$_POST['text']);
$user = getUserDetails(mysqli_real_escape_string($conn,$_POST['email']));
$user = $user['email'];
	if($message != "")
	{	
	 	$sql = "INSERT INTO `channel_messages` VALUES(DEFAULT,'$channel_id','$user','$message',DEFAULT,'$textOrCode',CURRENT_TIMESTAMP)";
	 	if (mysqli_query($conn, $sql)) {
	 		
	    	header('Location: ../index.php?channel='.$channel_id.'#scrollBottom');
	    	exit;
		}else{
	    	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}

		
	}
// else{

// 	if($message != "")
// 	{	
// 	 	$sql = "INSERT INTO `channel_messages` VALUES(DEFAULT,'$channel_id','$user','$message',DEFAULT,'$textOrCode',CURRENT_TIMESTAMP)";
// 	 	if (mysqli_query($conn, $sql)) {
	 		
// 	    	header('Location: ../index.php?channel='.$channel_id.'#scrollBottom');
// 	    	exit;
// 		}else{
// 	    	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
// 		}

		
// 	}


// }

mysqli_close($conn);
?>