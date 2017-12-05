<?php
session_start();
if(!$_SESSION['loggedIn']){
	header("location: ./login/login.php");
	die();
}
include_once "login/connect.php"; 
$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD,DB_NAME)
    OR die ('Could not connect to MySQL: '.mysql_error());

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
include_once "sqlQueries.php";
$image_url = getImage($_GET['email']);
$result = getUserDetails(mysqli_real_escape_string($conn,$_GET['email']));
$count = existOrNot(mysqli_real_escape_string($conn,$_GET['email']));
// echo $count;
$userName =  $result['display_name'];
$result = getUserDetails(mysqli_real_escape_string($conn,$_GET['email']));
$email =  $result['email'];
$result = getUserDetails(mysqli_real_escape_string($conn,$_GET['email'])); 
$status = $result['status'];
$publicChannels =getAllPublicChannels(mysqli_real_escape_string($conn,$_GET['email']));
$rating = userProfileRating(mysqli_real_escape_string($conn,$_GET['email']));
$profile = "<!DOCTYPE html>
						<html>
						    <head>
						    	<title>ProfileView</title>
						    	<meta name='viewport' content='width=device-width, initial-scale=1'>
								<meta charset='utf-8'>
						        <link rel='stylesheet' type='text/css' href='./profilePage.css'>
						        <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
						        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
						    </head>
						    <body>";


    if($_GET['email'] && $count){
        //echo "string";
         // header('location: userProfile.php?email='.$_SESSION['email'];);
        //header('location: userProfile.php?email='.$_SESSION['email']);

        $profile = $profile. "
								<div class = 'formDiv'>
												<div class =''>
									            	<a href ='".$_SESSION['url']."'><i class='fa fa-arrow-left arrowLeft' aria-hidden='true' style = 'margin-top: 3%;'></i></a>
									            	<h2 style='margin-top: -3%;'>Profile Page</h2>
									            </div>
								                <div class='container' style = 'height:100%; width:95%;'>
									                <div class = 'leftside' style='float:left;width: 70%;'>
									                	<label><b>User Name:</b></label><span class='profileStyle'>$userName</span><br>
										                <label><b>Email:</b></label><span class='profileStyle'>$email</span><br>
										                <label><b>Status:</b></label><span class='profileStyle'>$status</span><br>
										                <div class = 'userRating'>
									                        <label>Rating:</label></br>
									                        	$rating
									                    </div>
									                </div>
     
									                <div class ='profilePic' style='width:30%;height:100%;float:right;margin-top: -3%;' >
									                    <label class='notifyImgResult'></label>
									                    <img src='$image_url' width='100%'' height='40%'' alt='Avatar' class='avatar'>
									                    <div class = 'channels'>
									                        <label>Public Channels</label>
									                        	$publicChannels
									                    </div>
									                </div>
                									<div class='clearfix'>  
                									</div>
              									</div>
            
        						</div>
    						</body>
						</html>
						    ";
						    echo $profile;
    }
    else{
        $profile = $profile. "
	        			<div class ='noUser'>
	        					<label class = 'displayNone'>User not present in the work space<label>
	        			</div>
	        		</body>
				</html>
        			";
        echo $profile;
    }
 ?>
