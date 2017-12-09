<?php
	session_start();
	session_unset(); 
	include_once "validate.php";
?>

<!DOCTYPE html>
<html>
	<head>
		<title>idYeah! Login Page</title>
		<link rel="stylesheet" type="text/css" href="login.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
	    <script type='text/javascript'>
			function reCaptchad(){
				document.getElementById("myButton").disabled = false;
			}
	 	</script>
	</head>
	<body>
		<div class = "container1">
			<div class="imgcontainer">
				<img src="img_avatar4.png" alt="Avatar" class="avatar">
			</div>
			<h3>idYeah! Login Page</h3>
			<div class ="loginform">
				<form method="post" action="login.php">
					<p style='text-align:center;color:red;'><?php echo $Err;?></p>
					<label class = "label1" >Email</label>
					<input class="inputfield" type="text" name="email"  autofocus required/>
					<br/>
					<label class = "label1" >Password</label>
					<input class="inputfield" type="password" name="password" />
					<br /><br />
					<!-- <input type="checkbox" checked="checked"> Remember me -->
					<div class="g-recaptcha" data-sitekey="6Le0vAgUAAAAAH_ZWM8tw3It6jkrqLHkFFTMOW-J" data-callback="reCaptchad" style='padding-left: 7%;padding-right: 7%;'></div>
      				<br/>
					<!-- <div><input class = "btn1" id="myButton" type="submit" value="login" disabled /></div> -->
					<div class = 'login'>
						<button type="submit" id="myButton" class="btn btn-primary " style='padding-right: 19%;padding-left: 19%;' disabled>Login </button>
						<button type="button" class="btn btn-primary " style='padding-right: 5%;padding-left: 5%;'><i class="fa fa-github" aria-hidden="true"></i>GITHUB Login </button>
					</div>
				</form>

				<div class = "newAccount">
					<br />
					<a href= "../signup/signUpPage.php">Create New Account</a>
				</div>

			</div>
	</div>
	</body>
</html>