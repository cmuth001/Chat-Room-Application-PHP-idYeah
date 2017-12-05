<?php
session_start();
include_once "sqlQueries.php";
if(!$_SESSION['loggedIn']){
    header("location: ./login/login.php");
    die();
}
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="./profilePage.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <div class = "formDiv">
            <h2 >Profile Page</h2>
            <!-- <form nctype='multipart/form-data' style="border-top:2px solid #e0ebe1"> -->
                <div class="container" style = "height:100%; width:95%;">
                <div class = "leftside" style="float:left;width: 70%;">
                    <label><b>User Name:</b></label><span class="profileStyle"><?php $result = getUserDetails($_GET['email']); echo $result['display_name'] ?></span><br>
                    <label><b>Email:</b></label><span class="profileStyle"><?php $result = getUserDetails($_GET['email']); echo $result['email'] ?></span><br>
                    <label><b>Status:</b></label><span class="profileStyle"><?php $result = getUserDetails($_GET['email']); echo $result['status'] ?></span><br>
                </div>
                <div class ="profilePic" style="width:30%;height:100%;float:right">
                    <label class="notifyImgResult"></label>
                    <img src="./assets/images/homePage.png" width="100%" height="40%" alt="Avatar" class="avatar">
                    
                    <div class = "channels">
                        <label>Public Channels</label>                        
                        <?php 
                            $user_array = getUserDetails($_GET['email']);                                                
                            $result =getAllPublicChannels($_GET['email']);
                            echo $result
                        ?>
                    </div>
                </div>
                <div class="clearfix">
                  <!-- <button type="submit" name = "submit" class="signupbtn">Sign Up</button> -->
                </div>
              </div>
            <!-- </form> -->
        </div>
    
    </body>
</html>