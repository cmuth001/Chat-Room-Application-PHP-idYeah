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
		<script src="css/tags/jquery-ui.js"></script>
		<script src="css/tags/jquery-migrate-3.0.0.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script src="css/tags/bootstrap-tokenfield.js"></script>
		<script src="css/tags/typeahead.bundle.min.js"></script>
		<script src="slackScripts.js"></script>
		<link rel="stylesheet" type="text/css" href="css/tags/jquery-ui.css">
		<!-- delete pop links -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>
		<!-- delete popup  -->

		<!-- pagination -->
		<script type="text/javascript" src="http://botmonster.com/jquery-bootpag/jquery.bootpag.js"></script>
		<!-- pagination ends -->

		<!-- multi select -->		
		<link rel="stylesheet" type="text/css" href="css/tags/bootstrap-tokenfield.css">
		<link rel="stylesheet" type="text/css" href="css/tags/bootstrap-tokenfield.css">	
		<!-- multi select -->
		<!-- type head for search -->
		 <!-- // <script src="typeahead.min.js"></script> -->
		<!-- end of type head  -->


	</head>
	<body>
		<div class="container nopadding col-xs-12" >
			<div class = "col-xs-12 nopadding " style='border-bottom: 0.15em solid  #404040;'>
				<div  class = " col-xs-3 nopadding" style="background-color: #404040;width: 13%;height: 74px;color: white;padding: 1% !important;
">
					
					
						<div>
							<div><label>ODUCS518F17</label></div>
							<div class="dropdown">
								<button onclick="userMenu()" class="dropbtn"><?php $result = getUserDetails($_SESSION['email']); echo $result['display_name'];?><i class="fa fa-angle-down"></i></button>
								  <div id="myDropdown" class="dropdown-content userProfile">
								    <div style = 'color:black;'><img src=<?php echo "./assets/images/".$_SESSION['email'].".png" ?> alt='Contact_Img' class='contact_Img'>
								    	<?php 
								    	$result = getUserDetails($_SESSION['email']);
								    	$admin = admin();
								    	if (in_array($_SESSION['email'], $admin)) {
								    		echo $result['display_name']."(Admin)";
								    	}else{
								    		echo $result['display_name'];
								    	}
								    	?>
								    </div>
								    <a href= "profilePage.php?email=<?php echo $_SESSION['email']; ?>" class = 'userMenuLink'><span class = 'fa fa-user userMenuList'></span>Profile View</a>
								    <a href='#contact' class = 'userMenuLink' data-toggle='collapse'><span class = 'fa fa-phone userMenuList'></span>Contact</a>
								    <div id='contact' class='collapse' ><a href='' style='margin-left: 10%; text-decoration:none;'><span class ='fa fa-mobile userMenuList' ></span><?php echo "123-546-7890" ?></a></div>
								    <a href="./signOut.php" class = 'userMenuLink'>
          								<span class="glyphicon glyphicon-log-out userMenuList"></span>LogOut
        							</a>
        							<?php 
        								if(in_array($_SESSION['email'], $admin)){
        									echo "<a href = 'signup/signUpPage.php' class = 'userMenuLink'><span class='fa fa-user-plus userMenuList'></span>Invite new user</a>"; 
        								}	
        							?>	
								  </div>
							</div>
							<!-- <label></label> -->
						</div>
				</div>

				<div class="col-xs-10 nopadding" style="height: 74px;background-color: white;padding-left: 2% !important;padding-top: 14px !important;">	
					<div class ="col-xs-5 nopadding ">
							<?php
								$result ="";
								$userChannels = userChannels($_SESSION['email']);
								if (isset($_GET["channel"])){
									if (in_array($_GET["channel"], $userChannels)) {
										$result = getChannelName($_GET["channel"],$_SESSION['email']);
									}else{
										$result = "<div><label class = 'channel_title'><b>Channel Title</b></label>";
									}
								}else{
									$result = "<div><label class = 'channel_title'><b>Channel Title</b></label>";
								}									
								echo $result;
							?>
							
						</div>
						<div class = "detailsOfChannel">
							<span class="fa fa-star checked"></span>
							<span class= "divider">|</span>
							<i style='font-size: 117%;color: #706c6c; cursor:pointer;' class='fa fa-users dropdown-toggle' data-toggle='dropdown' aria-hidden="true"></i>
							<?php 
								$channelMembers = channelMembers($_GET["channel"]);
								echo $channelMembers;
							?>
							<sub><?php echo membersInChannel($_GET["channel"]); ?></sub>
							<span class= "divider">|</span>
							<span class = "purposeChannel">
								<?php
									$result = "";
									if (isset($_GET["channel"])){
										if (in_array($_GET["channel"], $userChannels)) {
											$result = getChannelDetails($_GET["channel"]);
										}
									}
								echo $result['purpose']
							?>
							</span>
						</div>


					</div>
					<div class = 'pagination myPagination'>
						<p id="pagination-here"></p>
        				<!-- <p id="content">Dynamic page content</p> -->
					</div>
					<!-- search profile field -->
					<div class="input-group input-group-lg profileSearchField">
					  <span class="input-group-addon" id="sizing-addon1">@</span>
					  <input type="text" class="form-control" class ='profileSearchInputField' id ='profileSearchInputField' placeholder="Username" aria-label="Username" aria-describedby="sizing-addon1">
					</div>
					<div class ='listOfProfileSearch'>
					</div>
					<!-- search profile fielf end -->
				
					
				</div>

			</div>

			<div class="col-xs-12 nopadding">
		        <div class="col-xs-3  leftSideMenu nopadding">
		        	<!-- <div class = "profileView">
		        		<b><a class= 'link' href= "profilePage.php?email=<?php echo $_SESSION['email']; ?>" ><i class="fa fa-user" aria-hidden="true" style ='font-size: 126%;padding-right: 3%;'></i>ProfileView</a></b>

		        	</div> -->
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
		                    			<b><a class ="link" href= "inviteMembersToChannel.php">Channels</a></b>
		                    			<a href = 'newChannel.php' class = 'newChannel'><i class="fa fa-plus"></i></a>
		                    			
		                    			<!-- Modal -->
										  <div class="modal fade" id="myModal" role="dialog">
										    <div class="modal-dialog modal-lg">
										      <div class="modal-content">
										        <div class="modal-header">
										          <button type="button" class="close modalClose" data-dismiss="modal">&times;</button>
										          <h4 class="modal-title">code posting Area</h4>
										        </div>
										        <div class="modal-body">
										          
										          <form action ='messages/messages.php' id= "codeForm" method = "post">
										          
										          <div class="form-group">
										            <label for="message-text" class="form-control-label">code<i class='fa fa-code postingOptionMenu' aria-hidden='true'></i></label>
										            <textarea class="form-control codeArea" name = "message" id="code" placeholder= " Snippet" autofocus required ></textarea>
										            <input type='hidden' name='channel' value=<?php echo $_GET['channel']; ?>>
										            <input type='hidden' name='email' value=<?php echo $_SESSION['email']; ?>>
										            <input type='hidden' name='text' value='1'>
										          </div>
										          
										          <div class="modal-footer">
										          <button type="button" class="btn btn-default modalClose" data-dismiss="modal">Close</button>
										           <button type="submit" name = "submit"  class="btn btn-success codeBtn" >submit code</button>
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
	        					<!-- Img  Modal -->
								<div class="modal fade" id="imageUpLoadModal" role="dialog">
								    <div class="modal-dialog">
								    
								      <!-- Modal content-->
								      <div class="modal-content">
								        <div class="modal-header">
								          <button type="button" class="close" data-dismiss="modal">&times;</button>
								          <h4 class="modal-title"><i class='fa fa-picture-o postingOptionMenu' aria-hidden='true'></i>Image Upload</h4>
								        </div>
								        <div class="modal-body">
								
											<form action="./uploadImageInToChannel.php"  id = 'imgForm' method="post" enctype="multipart/form-data">
						     						
						                       	<img class="profile-pic1" src="https://upload.wikimedia.org/wikipedia/commons/thumb/d/d1/Icons8_flat_businessman.svg/1024px-Icons8_flat_businessman.svg.png" />
						                        <div class="upload-button">Select Image</div>
						                        <!-- <input type="file" name="fileToUpload" id="fileToUpload"> -->
						                        <input class="file-upload" name="fileToUpload" id="fileToUpload" type="file" accept="image/*" style='display:none' />
						                        <textarea class="form-control " name = "message" id="imgMessage" placeholder= " Message..." ></textarea>
						                        <input type="hidden" name="channel" value=<?php echo '"'.$_GET["channel"].'"';?> >
						                    	<input type="submit" value="Upload Image" name="submit" style='display:none'>
						                    </form>

								        </div>
								    	</br>
								        <div class="modal-footer">
								          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								          <button type="submit" name="submit" value="Upload Image" class="btn btn-success imageSubmit">submit</button>
								        </div>
								      </div>
								      
								    </div>
								</div>
								<!-- end of Img Model -->

								<!-- Img URL  Modal -->
								<div class="modal fade" id="imageURLModal" role="dialog">
								    <div class="modal-dialog">
								    
								      <!-- Modal content-->
								      <div class="modal-content">
								        <div class="modal-header">
								          <button type="button" class="close" data-dismiss="modal">&times;</button>
								          <h4 class="modal-title">Enter Image URL</h4>
								          <span style='color:red'>*.png, *.jpeg/jpg, *.gif, *.tiff/tif</span>
								        </div>
								        <div class="modal-body">
								        	<form action ='messages/messages.php' method = 'post'>						     
						                      	<div class="input-group">
											  		<span class="input-group-addon"  id="basic-addon1"><i class='fa fa-link postingOptionMenu ' aria-hidden='true'></i>URL</span>
											  		<input type="text" class="form-control" name = "message" placeholder="Image URL..." aria-describedby="basic-addon1">
												</div>
						                        <input type='hidden' name='text' value='2'>
						                        <input type='hidden' name='email' value=<?php echo '"'.$_SESSION['email'].'"';?>>
						                        <input type="hidden" name="channel" value=<?php echo '"'.$_GET["channel"].'"';?> >
						                    	<input type="submit" value="Upload Image" name="submit" style='display:none'>
						                    </form>

								        </div>
								    	</br>
								        <div class="modal-footer">
								          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								          <button type="submit" name="submit" value="Upload Image" class="btn btn-success imageURLSubmit">submit</button>
								        </div>
								      </div>
								      
								    </div>
								</div>
								<!-- end of Img URL Model -->


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
		                	 <li class="divider"></li>


		                </ul>
		            </div>
		        </div>
		        <div id='message_container' class ='col-xs-10 headrow nopadding' style='width:87%;min-height:93%;background-color: white; '>
		        	<div class ='col-xs-12 nopadding' style='height:91%;overflow-y: auto; overflow-x: hidden;position:relative;'>
			        	<?php 
			        		$userChannels = userChannels($_SESSION['email']);
			        		if (isset($_GET['channel'])){
			        			if (in_array($_GET['channel'], $userChannels)) {				
				        			$result =getChannelMessages($_GET['channel']);
				        		}else{
				        			$result ="<h1 class ='emptyChannel'>Requested Channel does not exist</h1>";
				        		}
				        	}else{
				        		
				        		$result ="<h1 class ='emptyChannel'>Please select channel</h1>";
				        	}
			        		echo $result; 
			        		
			        	?>

		        	</div>



			</div>
	</div>

	
	</body>
</html>