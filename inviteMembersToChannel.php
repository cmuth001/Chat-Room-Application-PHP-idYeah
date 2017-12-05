<?php 
	session_start();
	include_once "sqlQueries.php";
	if(!$_SESSION['loggedIn']){
	header("location: ./login/login.php");
	die();
}

?>

<!DOCTYPE html>
<html>
    <head>
        
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta charset="UTF-8">
		<title>Invite members to Channel</title>
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
		<!-- <link rel="stylesheet" type="text/css" href="css/tags/bootstrap-tokenfield.css"> -->
		    <!-- multi select -->
		<script type="text/javascript" src="http://botmonster.com/jquery-bootpag/jquery.bootpag.js"></script>
    </head>
    <body>
    	<div class = 'formDiv'>
			<div class =''>
	        	<a href =<?php echo "\"".$_SESSION['url']."\""; ?>><i class='fa fa-arrow-left arrowLeft' aria-hidden='true' ></i></a>
	        	<h2 style ='margin-top:-1%;'>Invite members to Channel </h2>
	        </div>
	        <form id= "inviteChannelForm" method = "post">
		        <div class='container' style = 'height:100%; width:95%;padding-bottom: 11%'>
		        	<div><label>Select Channel :</label>
			    		<?php  				                 				 
		                	$result =channelList($_SESSION['email']);
		                	echo $result;
		                ?>
	                </div><br>
	                <div id="framework_form">
						  		<label  class="form-control-label">Users List:</label>
							    <input type="text" class="form-control" id="tokenfield2" value="" />
							   
							<br/>
							
					 </div>	
				
					   <button type="submit" name = "submit"  class="btn btn-success inviteChannelButton" style='width: 17%;float:right;' >InviteUsers</button>
				    <!-- <select class="selectpicker" data-show-subtext="true" data-live-search="true">
			        <option data-subtext="Rep California">Tom Foolery</option>
			        <option data-subtext="Sen California">Bill Gordon</option>
			        <option data-subtext="Sen Massacusetts">Elizabeth Warren</option>
			        <option data-subtext="Rep Alabama">Mario Flores</option>
			        <option data-subtext="Rep Alaska">Don Young</option>
			        <option data-subtext="Rep California" disabled="disabled">Marvin Martinez</option>
			      </select> -->
				</div>
			</form>
		</div>
	</body>
</html>