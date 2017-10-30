<?php
session_start();
include_once "sqlQueries.php";
$result = getUserDetails($_GET['email']);
$count = existOrNot($_GET['email']);
// echo $count;
$userName =  $result['display_name'];
$result = getUserDetails($_GET['email']);
$email =  $result['email'];
$result = getUserDetails($_GET['email']); 
$status = $result['status'];
$publicChannels =getAllPublicChannels($_GET['email']);
$profile = "<!DOCTYPE html>
						<html>
						    <head>
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
								            <h2 >Profile Page</h2>
								                <div class='container' style = 'height:100%; width:95%;'>
									                <div class = 'leftside' style='float:left;width: 70%;'>
									                	<label><b>User Name:</b></label><span class='profileStyle'>$userName</span><br>
										                <label><b>Email:</b></label><span class='profileStyle'>$email</span><br>
										                <label><b>Status:</b></label><span class='profileStyle'>$status</span><br>
										             </div>
									                <div class ='profilePic' style='width:30%;height:100%;float:right' >
									                    <label class='notifyImgResult'></label>
									                    <img src='./assets/images/homePage.png' width='100%'' height='40%'' alt='Avatar' class='avatar'>
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
