<?php

session_start();

include_once "sqlQueries.php";	


// mysqli_close($conn);
if($_GET && $_GET['action'] && $_GET['action']=="logout"){
	unset($_SESSION['loggedIn']);
	unset($_SESSION['email']);
}

if(!$_SESSION['loggedIn']){
	header("location: ./login/login.php");
	die();
}


// queries executation


?>
<html>
	<head>
		<title>Homepage</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="index.css">
		<link rel="stylesheet" type="text/css" href="messages/messages.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>
	<body>
		<div class="container nopadding col-md-12" >
			<div class = "col-md-12 nopadding ">
				<div  class = " col-md-3 nopadding" style="background-color: #404040;width: 13%;height: 74px;color: white;padding: 1% !important;
">
					<label>ODUCS518F17</label>
					
						<label><?php $result = getUserDetails($_SESSION['email']); echo $result['display_name']?></label>
				</div>

				<div class="col-md-9 nopadding" style="width: 87%;height: 74px;color: white;padding: 1% !important;
">	
					<label><?php $result = getChannelName($_GET["channel"]); echo $result['channel_name']?></label>
				</div>
			</div>

			<div class="col-md-12 nopadding">
		        <div class="col-md-3  leftSideMenu nopadding">
		            <div >
		                <ul class="col-md-12 nav nav-list nopadding">
		                    <li>
		                    	<div class="col-md-12 Starreddiv ">
		                    		<div class="col-md-12 nopadding">
		                    			<label><span>&#x2606;</span>Starred</label>
		                    		</div>
		                    	
	        					</div>
	        					</br>
	        					
	        					<div id="test">
			                        <ul class="nav nav-list tree starredList">
			                            <li ><a class="listbg" href="#">User 1</a></li>
			                            <li ><a class="listbg" href="#">Channel 1</a></li>
			                            <li ><a class="listbg" href="#">Channel 2</a></li>
			                            
			                        </ul>
		                    	</div>
		                    </li>
		                    
		                    <li class="divider"></li>
		                    <li>
		                    	<div class="col-md-12 channeldiv">
		                    		<div class="col-md-11 nopadding">
		                    			<b><a class ="link" href= "">Channels</a></b>
		                    		</div>
		                    		<div class="col-md-1  icon-plus nopadding">
			                    	
 										<!-- <a href="#"><span class="name"></span></a> -->
										
	        						</div>
	        					</div>
	        					</br>
	        					<div id="Channel">
				                        <ul class="nav nav-list tree starredList">
				                 
				                            <?php $result =getAllChannels();echo $result ?>
				                        </ul>
		                    	</div>
		                    </li>
		                    
		                    
		                    <li class="divider"></li>
		                    <li>
		                    	<div class="col-md-12 directmsgdiv ">
		                    		<div class="col-md-11 nopadding">
		                    			<b><a class ="link" href= "">DirectMesssages</a></b>
		                    		</div>
		                    		<div class="col-md-1  icon-plus nopadding">
			                    		
 										<!-- <a href="#"><span class="name"></span></a> -->
										
	        						</div>
	        					</div>
	        					</br>
        						<div id="directmsg">
			                        <ul class="nav nav-list tree directmsgList">			         
			                            <?php $result =getAllUsers();echo $result ?>
			                        </ul>
	                    		</div>
		                    </li>
		                </ul>
		            </div>
		        </div>
		        <div id="message_container" class ="col-md-10 headrow nopadding" style="width:87%;min-height:93%;background-color: #dae2c7; ">
		        	<div class ="col-md-12 nopadding " style="height:91%;overflow-y: auto; overflow-x: hidden;position:relative;">
			        	<?php $result =getChannelMessages($_GET["channel"]);echo $result ?>				        	
		        	</div>
		        	 <form action = "messages/messages.php" method = "post">
			        	<div id="footer" class ="col-md-12 nopadding "><!-- <input type="text" name="msgbox" style="width:100%;height: 100%;"> -->
			        		<div class="input-group input-group-lg textinput">
		  						<span class="input-group-addon" id="sizing-addon1"><a style="text-decoration: none" href="">+</a></span>
		  							<input type="hidden" name="channel" value=<?php echo '"'.$_GET["channel"].'"';?> >
		  							<input type="hidden" name="email" value=<?php echo '"'.$_SESSION['email'].'"';?>>
		  							<input type="text" class="form-control " name = "message" style  = "width: 94%;" placeholder= "Type Some message ...." aria-describedby="sizing-addon1" required>
		  							<button type="submit" class="btn btn-info btn-lg btnsend"><span class="glyphicon glyphicon-send"></span> </button>
		  							
							</div>

			        	</div>
			        </form>		
		        </div>


			</div>
	</div>

	
	</body>
</html>