<?php
session_start();
include_once "./login/connect.php"; 
$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD,DB_NAME)
    OR die ('Could not connect to MySQL: '.mysql_error());

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$channel = htmlspecialchars($_POST['channel']);
echo $channel;
$target_dir = "./assets/images/";
$target_file = $target_dir .$_SESSION['email'].'.png';
echo"file name:". $target_file;
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $sql = "UPDATE users SET display_pic=1 where  email ='".$_SESSION['email']."'";
        if (mysqli_query($conn, $sql)) {
            
            echo "error updating into user table";
        }else{
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        header('location: '.$_SESSION['url']);
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>
