<?php 
session_start();
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
include_once "../login/connect.php"; 
include_once "../sqlQueries.php";
$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD,DB_NAME)
    OR die ('Could not connect to MySQL: '.mysql_error());

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$emailErr = $nameErr= $pswErr ="";
$admin = admin();
if(isset($_POST['submit']))
{
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $userName = mysqli_real_escape_string($conn,$_POST['userName']);
    $psw = mysqli_real_escape_string($conn,$_POST['psw']);
    $pswRepeat = mysqli_real_escape_string($conn,$_POST['pswRepeat']);

    
    
   //Gravatar

    /**
     * Get either a Gravatar URL or complete image tag for a specified email address.
     *
     * @param string $email The email address
     * @param string $s Size in pixels, defaults to 80px [ 1 - 2048 ]
     * @param string $d Default imageset to use [ 404 | mm | identicon | monsterid | wavatar ]
     * @param string $r Maximum rating (inclusive) [ g | pg | r | x ]
     * @param boole $img True to return a complete IMG tag False for just the URL
     * @param array $atts Optional, additional key/value attributes to include in the IMG tag
     * @return String containing either just a URL or a complete image tag
     * @source https://gravatar.com/site/implement/images/php/
     */
    function get_gravatar( $email, $s = 40, $d = 'mm', $r = 'g', $img = false) {
        $url = 'https://www.gravatar.com/avatar/';
        $url .= md5( strtolower( trim( $email ) ) );
        $url .= "?s=$s&d=$d&r=$r";
        if ( $img ) {
            $url = '<img src="' . $url . '"';
            foreach ( $atts as $key => $val )
                $url .= ' ' . $key . '="' . $val . '"';
            $url .= ' />';
        }
        return $url;
    }
    $gravatarUrl = get_gravatar($email);
    ////end of gravatar
    
    if(empty($psw) && empty($pswRepeat) ) {
        $pswErr = "Password is required";
    }else{
        $psw = test_input($psw);
        $pswRepeat=test_input($pswRepeat);
    }
    //echo $email."<br></br>".$userName."<br></br>".$psw."<br></br>".$pswRepeat."<br></br>";
    $sql = "SELECT * FROM users where email= '".$email."'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    if($_POST && ($row['email']==$email)){ 
        $emailErr = "User already exist";
    }
    else{ 
        //Email validation
        if(empty($email)) {
            $emailErr = "Email is required";
        }else{
            $email = test_input($email);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email "; 
            }else{
                if($psw==$pswRepeat){

                    $sql = "INSERT INTO `users` VALUES('$email','$userName','$userName',DEFAULT,DEFAULT,'$gravatarUrl',DEFAULT,'$psw',DEFAULT,DEFAULT,CURRENT_TIMESTAMP)";
                    if (mysqli_query($conn, $sql)) {
                        $sql1 = "INSERT INTO `userChannels` VALUES('$email',1,CURRENT_TIMESTAMP,DEFAULT)";
                        $sql2 = "INSERT INTO `userChannels` VALUES('$email',2,CURRENT_TIMESTAMP,DEFAULT)";
                        $sqlResult1 = mysqli_query($conn, $sql1);
                        $sqlResult2 = mysqli_query($conn, $sql2);
                        // echo "<br><br><p style='text-align:center;color:green;'>**** Registered successfully ***</p>";
                       // header("location: ../login/login.php");
                        if(in_array($_SESSION['email'], $admin)){
                            header("location: ../index.php");
                        }else{
                            header("location: ../login/login.php");
                        }
                    }else{
                        // echo "<br><br><p style='text-align:center;color:red;'>**** failed registering ***</p>";
                        echo $sql;
                    }
        
                }else{
                    $pswErr = "Password  didn't matched";
                }

            }
        }
        

    }
}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
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
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" style="border-top:2px solid #e0ebe1">
              <div class="container">
                <label><b>Email</b></label><span class="error">* <?php echo $emailErr;?></span>
                <input type="text" class = "inputfield"placeholder="Enter Email" name="email" autofocus required>
                <label><b>User Name</b></label><span class="error">* <?php echo $nameErr;?></span>
                <input type="text" class = "inputfield"placeholder="Enter User Name" name="userName"  required>
                <label><b>Password</b></label><span class="error">* <?php echo $pswErr;?></span><br>
                <input type="password" class = "inputfield" placeholder="Enter Password" name="psw" required>               
                <label><b>Repeat Password</b></label><span class="error">*</span><br>
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
