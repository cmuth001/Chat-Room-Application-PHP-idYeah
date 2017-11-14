<?php

    include_once "./login/connect.php";
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD,DB_NAME)
            OR die ('Could not connect to MySQL: '.mysql_error());
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $key=$_GET['key'];
    $array = array();
    $query="SELECT email FROM `users` where email LIKE '%{$key}%'";
    $checkResult = mysqli_query($conn,$query);
    while($row=mysqli_fetch_assoc($checkResult))
    {
      $array[] = $row['email'];
    }
    echo json_encode($array);

?>
<head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js">       </script>
<script src="typeahead.min.js"></script>
</head>
<body>
<input type="text" name="typeahead">

<script>
    $(document).ready(function(){
    $('input.typeahead').typeahead({
        name: 'typeahead',
        local:'search.php?key=%QUERY',
        limit : 10
        
    });
});
    </script>
</body>