<?php 
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once "../login/connect.php"; 
$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD,DB_NAME)
    OR die ('Could not connect to MySQL: '.mysql_error());

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if(isset($_POST['submit']))
{
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $userName = mysqli_real_escape_string($conn,$_POST['userName']);
    $psw = mysqli_real_escape_string($conn,$_POST['psw']);
    $pswRepeat = mysqli_real_escape_string($conn,$_POST['pswRepeat']);
    //echo $email."<br></br>".$userName."<br></br>".$psw."<br></br>".$pswRepeat."<br></br>";
    $sql = "SELECT * FROM register where email= '".$email."'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    if($_POST && ($row['email']==$email)){ 
        echo "<br><br><p style='text-align:center;color:red;'>**** User already exist ***</p>";

    }
    else{
        if($psw==$pswRepeat){
            $sql = "INSERT INTO `register` VALUES('$email','$psw','$userName','$userName')";
            if (mysqli_query($conn, $sql)) {
                echo "<br><br><p style='text-align:center;color:green;'>**** Registered successfully ***</p>";
            }else{
                echo "<br><br><p style='text-align:center;color:red;'>**** failed registering ***</p>";
            }
        
        }else{
            echo "<br><br><p style='text-align:center;color:red;'>**** Password didn't match ***</p>";
        }

    }
}



?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="signUpPage.css">

    </head>
    <body>
        <div class = "formDiv">
            <h2>Slack Signup Form</h2>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" style="border-top:2px solid #e0ebe1">
              <div class="container">
                <label><b>Email</b></label>
                <input type="text" class = "inputfield"placeholder="Enter Email" name="email" autofocus required>
                <label><b>User Name</b></label>
                <input type="text" class = "inputfield"placeholder="Enter User Name" name="userName"  required>
                <label><b>Password</b></label>
                <input type="password" class = "inputfield" placeholder="Enter Password" name="psw" required>

                <label><b>Repeat Password</b></label>
                <input type="password" class = "inputfield" placeholder="Repeat Password" name="pswRepeat" required>
                <input type="checkbox" checked="checked"> Remember me
                

                <div class="clearfix">
                  <button type="submit" name = "submit" class="signupbtn">Sign Up</button>
                </div>
              </div>
            </form>
        </div>
    </body>
</html>
