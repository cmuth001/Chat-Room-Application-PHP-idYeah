<?php
  session_start();
  include_once "connect.php";
  $conn = new mysqli($servername, $username, $password, $dbname); 

  function check_login($u,$p){
    global $conn;
    $sql = "SELECT * FROM register where email= '".$u."'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return($row['email'] && $row['password']); 
  }
  if($_POST && check_login($_POST['email'],$_POST['password'])){
     $_SESSION['email'] = $_POST['email'];
   
     $_SESSION['loggedIn'] = True; 
     header("location: ../index.php");
     exit();
    session_write_close();
  }elseif($_POST) {
    echo "<br><br><p style='text-align:center;color:red;'>*** Unsuccessful login ***</p>";
    
  }else {
    echo "<br><br><p style='text-align:center;color:red;'>**** You're not logged in ***</p>";
    
  }
?>




