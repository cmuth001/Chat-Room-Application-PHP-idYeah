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
    $sql = "SELECT * FROM register where email= '".$u."'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return($row['email']==$u && $row['password']==$p); 
  }
  if($_POST && check_login($_POST['email'],$_POST['password'])){
     $_SESSION['email'] = $_POST['email'];
    // echo "session value:".$_SESSION['email'];
     $_SESSION['loggedIn'] = True; 
     header("location: ../index.php");
     exit();
    session_write_close();
  }elseif($_POST) {
    echo "<br><br><p style='text-align:center;color:red;'>*** Entered email / password is incorrect ***</p>";
    
  }else {
    echo "<br><br><p style='text-align:center;color:red;'>**** You're not logged in ***</p>";
    
  }
?>




