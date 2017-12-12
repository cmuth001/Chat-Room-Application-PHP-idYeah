<?php
session_start();
include_once "connect.php";
  $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD,DB_NAME)
            OR die ('Could not connect to MySQL: '.mysql_error());
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
//qav2
// define('clientID', 'c4e99274015ff24bfc56');
// define('clientSecret', 'f58c2400067713fff734eb001595445823e9f9e4');
  //define('appName', 'idYeah!');

  // docker
    define('clientID', '402caad5d00ff3bead83');
    define('clientSecret', '14a76d915f85136faf09e3381cfdecb6fdfd6b19');
    define('appName', 'idYeah!_docker');

$url = 'https://github.com/login/oauth/access_token';

$fields = array(
        'client_id' => urlencode(clientID),
        'client_secret' => urlencode(clientSecret),
        'code' => urlencode($_GET['code'])
);

//url-ify the data for the POST
foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
rtrim($fields_string, '&');

$ch = curl_init();

//set the url, number of POST vars, POST data
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch,CURLOPT_URL, $url);
curl_setopt($ch,CURLOPT_POST, count($fields));
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);

//execute post
// echo curl_exec($ch);
$result = json_decode(curl_exec($ch),TRUE);
echo $result["access_token"].'<br>';
//close connection
curl_close($ch);

$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,"https://api.github.com/user?access_token=".$result["access_token"]);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'http://developer.github.com/v3/#user-agent-required');
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));

$output=json_decode(curl_exec($ch),TRUE);
curl_close($ch);
//echo json_encode($output);
// echo "Login: ".$output["login"].'<br>';
// echo $output["avatar_url"].'<br>';
// echo $output["name"].'<br />';
// echo "email: ".$output["email"];
$gitEmail = $output["email"];
$gitUserName = $output["login"];
$gitImage = $output["avatar_url"];

function checkLogin($gitUserName){
    global $conn;
    echo "check login function";
    $sql = "SELECT * FROM users where email= '$gitUserName'";
    $result = mysqli_query($conn,$sql);
    if($result->num_rows > 0 ){
         return false;
    }else{
        return true;
    }
}
if(checkLogin($gitUserName)){
    $sql = "INSERT INTO `users` VALUES('$gitUserName','$gitUserName','$gitUserName',DEFAULT,DEFAULT,2,DEFAULT,'DEFAULT',DEFAULT,DEFAULT,CURRENT_TIMESTAMP)";
    
     if (mysqli_query($conn, $sql)) {
        $sql1 = "INSERT INTO `userChannels` VALUES('$gitUserName',1,CURRENT_TIMESTAMP,DEFAULT)";
        $sql2 = "INSERT INTO `userChannels` VALUES('$gitUserName',2,CURRENT_TIMESTAMP,DEFAULT)";
        $sql3 = "INSERT INTO `gitUser` VALUES(DEFAULT,'$gitUserName','$gitImage',CURRENT_TIMESTAMP)";
        $sqlResult1 = mysqli_query($conn, $sql1);
        $sqlResult2 = mysqli_query($conn, $sql2);
        $sqlResult3 = mysqli_query($conn, $sql3);
        $logInAcitvitySql = "INSERT INTO `loginActivityLog` VALUES(DEFAULT,'$email',CURRENT_TIMESTAMP)";
        $result = $conn->query($logInAcitvitySql);
        header("location: ../index.php");
     }
}else{
    $logInAcitvitySql = "INSERT INTO `loginActivityLog` VALUES(DEFAULT,'$gitUserName',CURRENT_TIMESTAMP)";
    $result = $conn->query($logInAcitvitySql);
    header("location: ../index.php");
}
$_SESSION['email'] = $gitUserName;
$_SESSION['loggedIn'] = True;
?>
