<?php 
echo "string";
include_once "../login/connect.php";
include_once "../sqlQueries.php";
$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD,DB_NAME)
        OR die ('Could not connect to MySQL: '.mysql_error());

if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

$message = mysqli_real_escape_string($conn,$_POST['message']);
$channel_id = $_POST['channel'];
$user = getUserDetails($_POST['email']);
$user = $user['display_name'];
echo"message:". $message;
echo"channel_id:".$channel_id;
echo "user:".$user;
if($message != "")
{	
 	$sql = "INSERT INTO `channel_messages` VALUES(DEFAULT,'$channel_id','$user','$message',CURRENT_TIMESTAMP)";
 	echo $sql;
 	if (mysqli_query($conn, $sql)) {
 		echo "$sql";
    	echo "New record created successfully";
    	header("Location: ../index.php?channel=".$channel_id);
    	exit;
	}else {
    	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}

	
}
mysqli_close($conn);
?>