?php
	include "./login/connect.php";
  	$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD,DB_NAME)
            OR die ('Could not connect to MySQL: '.mysql_error());

  	if ($conn->connect_error) {
    	die("Connection failed: " . $conn->connect_error);
  	}
  	// echo "session value:".$_SESSION['email'];
  	// $sql = "SELECT * FROM register where email= '".$_SESSION['email']."'";
   //  $result = $conn->query($sql);
   //  $row = $result->fetch_assoc();
   //  // echo $sql;


?>