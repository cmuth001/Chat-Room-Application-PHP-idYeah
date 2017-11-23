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

	$channelName = mysqli_real_escape_string($conn,$data['channelName']);
    $purpose = mysqli_real_escape_string($conn,$data['purpose']);
    $radioButtonValue = mysqli_real_escape_string($conn,$data['radioButtonValue']);
    $userList = $data['usersList'];
    array_push($userList,$_SESSION['email']);
    $userList = array_unique($userList);
    $userCreated = $_SESSION['email'];
    $checkChannelSql  = " SELECT channel_name from channels;"; 
    $checkChannelResult = mysqli_query($conn, $checkChannelSql);
    $array =[];
    // $checkChannelRow = $checkChannelResult->fetch_assoc();
    while(($checkChannelRow = mysqli_fetch_assoc($checkChannelResult))) 
    {
        array_push($array,$checkChannelRow['channel_name']);

    }
    if(in_array($channelName , $array)) {
        echo "channel already exist use different name";
    }else{  
    	$sql = "INSERT INTO `channels` VALUES(DEFAULT,'$channelName','$purpose','$userCreated',CURRENT_TIMESTAMP,'$radioButtonValue',DEFAULT)";
        // $result = $conn->query($sql);
        if (mysqli_query($conn, $sql)) {
            // echo "<br><br><p style='text-align:center;color:green;'>**** Channel created successfully ***</p>";
            echo "**** Channel created successfully ***";
        }else{
            // echo "<br><br><p style='text-align:center;color:red;'>**** failed creating channel***</p>";
            echo "**** failed creating channel***";
        }
        $sql = "SELECT MAX(channel_id) as last_id FROM `channels`";
        $result = mysqli_query($conn, $sql);
        $row = $result->fetch_assoc();
         $last_id = $row['last_id'];
         echo $last_id;
        foreach ($userList as $user) {
            
            $sql = "INSERT INTO `userChannels` VALUES('$user','$last_id',CURRENT_TIMESTAMP,DEFAULT)";
            if (mysqli_query($conn, $sql)) {
            
                echo "**** $user userChannels created successfully ***";
            }else{
            // echo "<br><br><p style='text-align:center;color:red;'>**** failed creating channel***</p>";
                echo "**** failed creating userChannels***";
            }

        }
    }
    
    mysqli_close($conn);

 ?>