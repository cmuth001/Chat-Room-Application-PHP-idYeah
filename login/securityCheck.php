
<?php 
  session_start();
  include_once "connect.php";
  $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD,DB_NAME)
            OR die ('Could not connect to MySQL: '.mysql_error());

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  if(isset($_POST['passCode'])){
    $passCode = mysqli_real_escape_string($conn,$_POST['passCode']);
    if($passCode==$_SESSION['Passcode']){
      echo "inside if";
      header("location: ../index.php");
    }else{
      $error='* Wrong passCode, retry';
    }
  }
  


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Security Check</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
</head>
<body>

<div class="container" style='margin-top: 15%;width: 16%;'>
  <h4 style='text-align: center;'>Enter Secure Passcode</h4>
  <p style='color:red;text-align:center;' ><?php echo $error ?></p>
  <form action='./securityCheck.php' method='post'>
    <div class="form-group" style='text-align:center;'>
      <input type="text" class="form-control" name= 'passCode' id="passCode">
      <button type="submit" class="btn btn-default">submit</button>
    </div>
  </form>
</div>

</body>
</html>

