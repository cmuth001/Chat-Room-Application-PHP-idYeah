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
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script src="slackScripts.js"></script>
		<!-- multi select -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/multiple-select/1.2.0/multiple-select.css">
		
		<script src="https://cdnjs.cloudflare.com/ajax/libs/multiple-select/1.2.0/multiple-select.js"></script>
		    <!-- multi select -->
	</head>
	<body>
		<div class="container nopadding col-xs-12" >
			<div class = "col-xs-12 nopadding ">
				<div  class = " col-xs-3 nopadding" style="background-color: #404040;width: 13%;height: 74px;color: white;padding: 1% !important;
">
					<div><label>ODUCS518F17</label></div>
					
						<div><label><?php $result = getUserDetails($_SESSION['email']); echo $result['display_name']?></label></div>
				</div>

				<div class="col-xs-9 nopadding" style="width: 87%;height: 74px;border-bottom: 0.15em solid #706c6c;background-color: white;padding-left: 2% !important; padding-top: 4px !important;;
">					<div class ="col-xs-5 nopadding ">
						<div><i style='font-size: 170%;padding-right: 1%;color: #706c6c;' class='fa'>&#xf09c;</i><label class = 'channel_title'><b>
							<?php
								if (isset($_GET["channel"])){
									$result = getChannelName($_GET["channel"]);
								}else{
									$result ="";
								}
								echo $result['channel_name']
							?>
							</b></label>
						</div>
						<div class = "detailsOfChannel">
							<span class="fa fa-star checked"></span>
							<span class= "divider">|</span>
							<i style='font-size: 117%;padding-right: 1%;color: #706c6c;' class="fa fa-users" aria-hidden="true"></i>
							<span class= "divider">|</span>
							<span class = "purposeChannel">
								<?php
								if (isset($_GET["channel"])){
									$result = getChannelName($_GET["channel"]);
								}else{
									$result = "";
								}
								echo $result['purpose']
							?>
							</span>
						</div>

					</div>
					<div class = "logout">
						<a href="./signOut.php">
          					<span class="glyphicon glyphicon-log-out">LogOut</span>
        				</a>
					</div>
					
				</div>

			</div>

			<div class="col-xs-12 nopadding">
		        <div class="col-xs-3  leftSideMenu nopadding">
		        	<div class = "profileView">
		        		<b><a class= 'link' href= "profilePage.php?email=<?php echo $_SESSION['email']; ?>" ><i class="fa fa-user" aria-hidden="true" style ='font-size: 126%;padding-right: 3%;'></i>ProfileView</a></b>

		        	</div>
		            <div >
		                <ul class="col-xs-12 nav nav-list nopadding">
		                    <!-- <li>
		                    	<div class="col-xs-12 Starreddiv ">
		                    		<div class="col-xs-12 nopadding">
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
		                    </li> -->
		                    
		                    <li class="divider"></li>
		                    <li>
		                    	<div class="col-xs-12 channeldiv">
		                    		<div class="col-xs-11 nopadding">
		                    			<b><a class ="link" href= "">Channels</a></b>
		                    			<button class="btn  btn-sm  btn-circle addChannel" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i></button>
		                    			<!-- Modal -->
										  <div class="modal fade" id="myModal" role="dialog">
										    <div class="modal-dialog modal-lg">
										      <div class="modal-content">
										        <div class="modal-header">
										          <button type="button" class="close" data-dismiss="modal">&times;</button>
										          <h4 class="modal-title">Create a Channel</h4>
										        </div>
										        <div class="modal-body">
										          <!-- <h5>Create a Channel</h5> -->
										          <p>organise a topic</p>
										          <form id= "channelForm" method = "post">
										          <div class="form-group">
										            <label for="recipient-name" class="form-control-label">Name:</label>
										            <input type="text" class="form-control" name = "channelName" id="channelName" placeholder= "Name of the channel" autofocus required>
										          </div>
										          <div class="form-group">
										            <label for="message-text" class="form-control-label">Purpose</label>
										            <textarea class="form-control" name = "purpose" id="purpose" placeholder= "Purpose of the channel"></textarea>
										          </div>
										          <div class="form-group">
										          	<input type="radio" name="colors" id="private">Private
										          	<input type="radio" name="colors" id="public">Public
										          </div>
										          <div id="framework_form">
													    
										          </div>	
										          <div class="modal-footer">
										          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
										           <button type="submit" name = "submit"  class="btn btn-success channelButton" >Create Channel</button>
										          </div>
										          <div>
														
										          </div>		
										        </form>
										        </div>
										        <div class = "modal-body-result">
										        	<p class = "para" style='text-align:center;'></p>
										        </div>
										      </div>
										    </div>
										  </div>
		                    		</div>
		                    		<!-- <div class="col-xs-1  icon-plus nopadding">
			                    	
 										<a href="#"><span class="name"></span></a>
										
	        						</div> -->
	        					</div>
	        					</br>
	        					<div id="Channel">
				                        <ul class="nav nav-list tree starredList">
				                 			<?php 
				                 				$user_array = getUserDetails($_SESSION['email']); 				                 				 
				                            	$result =getAllChannels($user_array['email']);
				                            	echo $result
				                            ?>
				                        </ul>
		                    	</div>
		                    </li>
		                    
		                    
		                    <li class="divider"></li>

		                   	<li> 
			                   	<form action="./uploadImage.php"  id = 'imgForm' method="post" enctype="multipart/form-data">
			     
			                        <div style="background-color: #404040;color: white;padding: 1% !important;"><label>Select image to upload:</label></div>
			                        <input type="file" name="fileToUpload" id="fileToUpload">
			                        <input type="submit" value="Upload Image" name="submit">
			                        <input type="hidden" name="channel" value=<?php echo '"'.$_GET["channel"].'"';?> >
			                    </form>
		                	</li>
		                    <!-- <li>
		                    	<div class="col-xs-12 directmsgdiv ">
		                    		<div class="col-xs-11 nopadding">
		                    			<b><a class ="link" href= "">DirectMesssages</a></b>
		                    		</div>
		                    		<div class="col-xs-1  icon-plus nopadding"> -->
			                    		
 										<!-- <a href="#"><span class="name"></span></a> -->
										
	        						<!-- </div>
	        					</div>
	        					</br>
        						<div id="directmsg">
			                        <ul class="nav nav-list tree directmsgList">			         
			                            <?php $result =getAllUsers();echo $result ?>
			                        </ul>
	                    		</div>
		                    </li> -->
		                </ul>
		            </div>
		        </div>
		        <div id="message_container" class ="col-xs-10 headrow nopadding" style="width:87%;min-height:93%;background-color: white; ">
		        	<div class ="col-xs-12 nopadding " style="height:91%;overflow-y: auto; overflow-x: hidden;position:relative;">
			        	<?php 
			        		if (isset($_GET["channel"])){
			        			$result =getChannelMessages($_GET["channel"]);
			        		}else{
			        			$result ="<h1 class ='emptyChannel'>Please select channel</h1>";
			        		}	
			        		echo $result 
			        	?>

		        	</div>
		        	 <form action = "<?php echo htmlspecialchars("messages/messages.php") ?>" method = "post">
			        	<div id="footer" class ="col-xs-12 nopadding "><!-- <input type="text" name="msgbox" style="width:100%;height: 100%;"> -->
			        		<div class="input-group input-group-lg textinput">
		  						<!-- <span class="input-group-addon" id="sizing-addon1"><a style="text-decoration: none" href="">+</a></span> -->
		  							<input type="hidden" name="channel" value=<?php echo '"'.$_GET["channel"].'"';?> >
		  							<input type="hidden" name="email" value=<?php echo '"'.$_SESSION['email'].'"';?>>
		  							<input type="text" class="form-control " name = "message" style  = "width: 94%;border-top-left-radius: 10px;border-bottom-left-radius: 10px;" placeholder= "Type Some message ...." aria-describedby="sizing-addon1" autofocus required>
		  							<button type="submit" class="btn btn-info btn-lg btnsend"><span class="glyphicon glyphicon-send"></span> </button>
		  							
							</div>

			        	</div>
			        </form>		
		        </div>


			</div>
	</div>

	
	</body>
</html>