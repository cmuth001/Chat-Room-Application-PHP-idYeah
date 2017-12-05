<?php 
	session_start();
	
if(!$_SESSION['loggedIn']){
	header("location: ./login/login.php");
	die();
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Homepage</title>
		 <meta charset="UTF-8">
		
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="index.css">
		<link rel="stylesheet" type="text/css" href="messages/messages.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="css/tags/jquery-ui.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>

		<script src="css/tags/jquery-migrate-3.0.0.min.js"></script>
		<script src="css/tags/bootstrap-tokenfield.js"></script>
		<script src="css/tags/typeahead.bundle.min.js"></script>
		<script src="slackScripts.js"></script>
		<link rel="stylesheet" type="text/css" href="css/tags/jquery-ui.css">
		<link rel="stylesheet" type="text/css" href="./signup/signUpPage.css">
		<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
		<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
		<!-- multi select -->
		
		
		<link rel="stylesheet" type="text/css" href="css/tags/bootstrap-tokenfield.css">
		<link rel="stylesheet" type="text/css" href="css/tags/bootstrap-tokenfield.css">

		<!-- token field -->
		<script type="text/javascript" src="http://botmonster.com/jquery-bootpag/jquery.bootpag.js"></script>
	</head>
	<body>
		<div class = "formDiv">
				<div id = 'errorMsg'></div>
				<form id= "channelForm" method = "post">
					<div class = 'channelHeading'>
			            <a href =<?php echo "\"".$_SESSION['url']."\""; ?>><i class='fa fa-arrow-left arrowLeft' aria-hidden='true' ></i></a>
			            
			            <h2 style = 'margin-top: -2%;'>Create Channel</h2>
					</div>
					<div class = 'channelFormDiv'>
				  	<div class="form-group">
				    	<label  class="form-control-label">Name:</label>
				    	<input type="text" class="form-control" name = "channelName" id="channelName" placeholder= "Name of the channel" autofocus required>
				  	</div>
				  	<div class="form-group">
				    	<label  class="form-control-label">Purpose</label>
				    	<textarea class="form-control" name = "purpose" id="purpose" placeholder= "Purpose of the channel"></textarea>
				  	</div>
				  	<div class="form-group">
				  		<input type="radio" name="colors" id="private">Private
				  		<input type="radio" name="colors" id="public" checked="checked">Public
				  	</div>
				  	<div id="framework_form">
					  		<label class="form-control-label">Users List:</label>
						    <input type="text" class="form-control" id="tokenfield1" value="" />
						    <!-- <input type="submit" class="btn btn-primary"> -->
						<br>
						<!-- <div class="form-data"></div>   -->
				  	</div>	
			
				   <button type="submit" name = "submit"  class="btn btn-success channelButton" style= 'width: 17%; float:right;'>Create Channel</button>
				 
				  </div>	
			</form>
		</div>
</body>
</html>

<!-- <!DOCTYPE html>
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
</html> -->
