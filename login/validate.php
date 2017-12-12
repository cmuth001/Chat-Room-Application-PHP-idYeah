<?php
  //session_start();
  include_once "connect.php";
  include './../assets/php/class.phpmailer.php';
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
  function generateTempPassword(){
    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 6; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
  }
function sendMailForNewUser($email,$passCode){
    $return_arrfinal = array();
      $status_array['status'] = '1';
      $mail = new PHPMailer();
      $toarraymail="$email";
      $mail->SMTPDebug = 1;                              // Enable verbose debug output
      $mail->Port = '587';
      $mail->isSMTP();                                      // Set mailer to use SMTP // Specify main and backup SMTP servers                                    // Set mailer to use SMTP
      $mail->Host = gethostbyname('smtp.gmail.com');  // Specify main and backup SMTP servers
      $mail->SMTPAuth = true; // Authentication must be disabled

      $mail->Username = 'mchandrasekharreddym@gmail.com';
      $mail->Password = 'muthyala1234';
      $mail->SMTPSecure= 'tls';


      $mail->setFrom("mchandrasekharreddym@gmail.com","idYeah!");
      $mail->AddAddress($toarraymail);     // Add a recipient
      // Optional name
      $mail->isHTML(true);                                  // Set email format to HTML

      $mail->Subject = ' Secure passCode ';
      $mail->Body    =" Hi, <br> Email: $email<br />Pass Code: $passCode<br />";
      $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

      if(!$mail->Send()){
        echo "false";
        echo 'Mailer Error: ' . $mail->ErrorInfo;
        return false;
      }else{
        echo "Sending email";
        return true;
      }
      echo "Sending email";

}
  $email = htmlspecialchars($_POST['email']);
  $password = htmlspecialchars($_POST['password']);
  if($_POST && check_login($email,$password)){
     $_SESSION['email'] = $email;
     $_SESSION['loggedIn'] = True;
     $logInAcitvitySql = "INSERT INTO `loginActivityLog` VALUES(DEFAULT,'$email',CURRENT_TIMESTAMP)";
     $result = $conn->query($logInAcitvitySql);
     $secureOptionSql = "SELECT isSecure FROM users where email='$email'";
     $secureOptionResult = $conn->query($secureOptionSql);
     $row = $secureOptionResult->fetch_assoc();
     if($row['isSecure']==1){
        $passCode = generateTempPassword();
        $_SESSION['Passcode'] = $passCode;
        sendMailForNewUser($email,$passCode);
        header("location: ./securityCheck.php");
     }else{
        header("location: ../index.php");
     }
     
     exit();
    session_write_close();
  }elseif($_POST) {
    $Err= "*** Entered email / password is incorrect ***";
    
  }else {
    $Err= "**** You're not logged in ***";
    
  }
 
?>




