<?php 

session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once "login/connect.php"; 
$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD,DB_NAME)
    OR die ('Could not connect to MySQL: '.mysql_error());

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
	$data = $_POST['data'];
	$channelId = mysqli_real_escape_string($conn,$data['channelId']);

	$userList = $data['usersList'];
    array_push($userList,$_SESSION['email']);
    $userList = array_unique($userList);

    foreach ($userList as $user) {
            $checkSql = "SELECT count(*)as count1 FROM `userChannels` where channel_id='$channelId' and user_email='$user'";
            $checkResult = mysqli_query($conn,$checkSql);
            $checkCount = mysqli_fetch_assoc($checkResult);
            $count = $checkCount['count1'];
             echo "invite '$count'";
            if($count<1)
            {
	            $sql = "INSERT INTO `userChannels` VALUES('$user','$channelId',CURRENT_TIMESTAMP,DEFAULT)";
	            if (mysqli_query($conn, $sql)) {
	            
	                echo "**** $user userChannels created successfully ***";
	            }else{
	            // echo "<br><br><p style='text-align:center;color:red;'>**** failed creating channel***</p>";
	                echo "**** failed creating userChannels***";
	                echo $sql;
	            }
	        }
	        else{
	        	echo "'$user' already exist.";
	        }
    }
?>