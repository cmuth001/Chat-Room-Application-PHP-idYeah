<?php
  //session_start();
  include_once "connect.php";
  $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD,DB_NAME)
            OR die ('Could not connect to MySQL: '.mysql_error());

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  function check_login($u,$p){
    global $conn;
    $sql = "SELECT * FROM users where email= '".$u."'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return($row['email']==$u && $row['password']==$p); 
  }
   

  $email = htmlspecialchars($_POST['email']);
  $password = htmlspecialchars($_POST['password']);
  if($_POST && check_login($email,$password)){
     $_SESSION['email'] = $email;
     $_SESSION['loggedIn'] = True;
     $logInAcitvitySql = "INSERT INTO `loginActivityLog` VALUES(DEFAULT,'$email',CURRENT_TIMESTAMP)";
     $result = $conn->query($logInAcitvitySql);

     header("location: ../index.php");
     exit();
    session_write_close();
  }elseif($_POST) {
    $Err= "*** Entered email / password is incorrect ***";
    
  }else {
    $Err= "**** You're not logged in ***";
    
  }
 
?>




