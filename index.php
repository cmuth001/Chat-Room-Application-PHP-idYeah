<?php


// session_start();// session already started in sqlQueries.php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
include_once "sqlQueries.php";	
$_SESSION['url']=basename($_SERVER['REQUEST_URI']);
// mysqli_close($conn);
// if($_GET && $_GET['action'] && $_GET['action']=="logout"){
// 	unset($_SESSION['loggedIn']);
// 	unset($_SESSION['email']);
// }

if(!$_SESSION['loggedIn']){
	header("location: ./login/login.php");
	die();
}


// queries executation


?>

<!-- <!DOCTYPE html> -->
<html>
	<head>
		<title>idYeah!HomePage</title>
		<link rel="icon" type="image/png" href="./favicon_IY_bg.png">
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

		<!-- logIn start Activity -->
		<script src="http://d3js.org/d3.v3.min.js"></script>
		<script src="http://labratrevenge.com/d3-tip/javascripts/d3.tip.v0.6.3.js"></script>
		<!-- toggle button -->
		<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
		<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
		<!--end toggle button -->
	</head>
	<body>
		<div class="container nopadding col-xs-12" >
			<div class = "col-xs-12 nopadding " style='border-bottom: 0.15em solid  #404040;'>
				<div  class = " col-xs-2 nopadding" style="background-color: #404040;height: 74px;color: white;padding: 1% !important;
">
					
					
						<div>
							<div><label style='font-size: 2.7vh;'>idYeah! </label></div>
							<div class="dropdown">
								<button onclick="userMenu()" class="dropbtn"><?php $result = getUserDetails($_SESSION['email']); echo $result['display_name'];?><i class="fa fa-angle-down"></i></button>
								  <div id="myDropdown" class="dropdown-content userProfile">
								    <div style = 'color:black;'><img src=<?php echo getImage($_SESSION['email']); ?> alt='Contact_Img' class='contact_Img'>
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
								    <a class = 'userMenuLink '><span class = 'fa fa-shield userMenuList'></span>Account Security<input class="toggle-event" id=<?php echo "'".$_SESSION['email']."'"?> type="checkbox" data-toggle="toggle" <?php echo getIsSecureOption($_SESSION['email']) ?>></a>
								    <a href= "profilePage.php?email=<?php echo $_SESSION['email']; ?>" class = 'userMenuLink'><span class = 'fa fa-user userMenuList'></span> View Profile</a>
								    <!-- <a class = 'userMenuLink picUpdate' style='cursor:pointer;'><span class = 'fa fa-picture-o userMenuList'></span>Update Profile Pic</a> -->
								    <a href='#UpdatePic' class = 'userMenuLink' data-toggle='collapse'><span class = 'fa fa-bars userMenuList'></span>Update Photo</a>
								    <div id='UpdatePic' class='collapse' >
								    	<a  class='defaultPhoto' id ="<?php echo $_SESSION['email']?>" style='margin-left: 10%; text-decoration:none;cursor:pointer;'><span class = 'fa fa-picture-o userMenuList'></span>Default </a>
								    	<a  class='picUpdate' style='margin-left: 10%; text-decoration:none;cursor:pointer;'><span class = 'fa fa-camera'></span>Gallery</a>
								    	<a class='selectGravatar' id ="<?php echo $_SESSION['email']?>" style='margin-left: 10%; text-decoration:none;cursor:pointer;'><span class = 'fa fa-picture-o userMenuList'></span>Use Gravatar</a>
								    </div>
								    <a  class='loginActivityGraph' style=' text-decoration:none;cursor:pointer;'><span class = 'fa fa-line-chart userMenuList'></span>User Graph</a>
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

				<div class="col-xs-10 nopadding" style="    z-index: 100; height: 74px;background-color: white;padding-left: 2% !important;padding-top: 14px !important;">	
					<div class ="col-xs-3 nopadding " style='font-size: 1.46vh;'>
							<?php
								$result ="";
								$userChannels = userChannels($_SESSION['email']);
								if (isset($_GET["channel"])){
									if (in_array($_GET["channel"], $userChannels)) {
										$result = getChannelName($_GET["channel"],$_SESSION['email']);
									}else{
										$result = "<div><label class = 'channel_title'><b>Channel Title</b></label>";
									}
								}else if(isset($_GET["email"])){
									$userDetails = getUserDetails($_GET["email"]);
									echo "<div><label class = 'channel_title'><b>".$userDetails['user_name']."</b></label>";
								}
								else{
									$result = "<div><label class = 'channel_title'><b>Channel Title</b></label>";
								}									
								echo $result;
							?>	
					</div>
						<div class = "detailsOfChannel">
							<span class="fa fa-star checked"></span>
							<span class= "divider">|</span>
							<?php 
								if (isset($_GET["channel"])){
									echo "<i style='font-size: 117%;color: #706c6c; cursor:pointer;' class='fa fa-users dropdown-toggle' data-toggle='dropdown' aria-hidden='true'></i>";
								}else{
									echo "<i style='font-size: 117%;color: #706c6c; cursor:pointer;' class='fa fa-user dropdown-toggle' data-toggle='dropdown' aria-hidden='true'></i>";
								}
							?>
							
							<?php
								if (isset($_GET["channel"])){
									$channelMembers = channelMembers($_GET["channel"]);
									echo $channelMembers;
								}
							?>
							<sub>
								<?php
									if (isset($_GET["channel"])){
										echo membersInChannel($_GET["channel"]);
									}
								?>
							</sub>
							<span class= "divider">|</span>
							<span class = "purposeChannel">
								<?php		
									if (isset($_GET["channel"])){
										$result = "";
										if (in_array($_GET["channel"], $userChannels)) {
											$result = getChannelDetails($_GET["channel"]);
										}
										echo $result['purpose'];
									}else{
										$userDetails = getUserDetails($_GET["email"]);
										echo $userDetails['status'];
									}
							?>
							</span>
						</div>


					</div>
					<div class ="col-xs-4 nopadding ">
						<div class = 'pagination myPagination' style='display:none;'>
							<p id="pagination-here"></p>
	        				<!-- <p id="content">Dynamic page content</p> -->
						</div>
					</div>

					<div class ="col-xs-5 nopadding ">
						<div class ="col-xs-11 nopadding ">
							<!-- search profile field -->
							<div class="input-group input-group-lg profileSearchField">
							  <span class="input-group-addon" id="sizing-addon1" style='padding: 3% 4%;display:none;'>@</span>
							  <input type="text" class="form-control" class ='profileSearchInputField' id ='profileSearchInputField' placeholder="Search User profile" aria-label="Username" aria-describedby="sizing-addon1">
							</div>
							<div class ='listOfProfileSearch'>
							</div>
							<!-- search profile fielf end -->
						</div>

						<div class ="col-xs-1 nopadding ">
							<div class ="col-xs-1 nopadding "></div>
							<div class ="col-xs-10 nopadding ">
							<div class = 'helpPage'>
								<a href= 'helpPage.html' target='_blank' title='help'><i class="fa fa-question-circle-o" aria-hidden="true" style='font-size:200%'></i></a>
							</div>
						</div>
						</div>
					</div>
					
						
					
					
				</div>

			</div>

			<div class="col-xs-12 nopadding">
		        <div class="col-xs-2  leftSideMenu nopadding">
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
										            <?php 

							                        	$string='';
							                        	if (isset($_GET['channel'])){
							                        		$string = $string."<input type='hidden' name='email' value='".$_SESSION['email']."'>";
							                        		$string = $string."<input type='hidden' name='channel' value='".$_GET["channel"]."'>";
							                        	}else{
							                        		$string = $string."<input type='hidden' name='toEmail'  value=".htmlspecialchars($_GET['email']).">";
															$string = $string."<input type='hidden' name='fromEmail' value=".$_SESSION['email'].">";
							                        	}
							                        	echo $string;
						                        	?>
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
						                        <?php 

						                        	$string='';
						                        	if (isset($_GET['channel'])){
						                        		$string = $string."<input type='hidden' name='email' value='".$_SESSION['email']."'>";
						                        		$string = $string."<input type='hidden' name='channel' value='".$_GET["channel"]."'>";
						                        	}else{
						                        		$string = $string."<input type='hidden' name='toEmail'  value=".htmlspecialchars($_GET['email']).">";
														$string = $string."<input type='hidden' name='fromEmail' value=".$_SESSION['email'].">";
						                        	}
						                        	echo $string;
						                        ?>
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


								<!-- File UpLoad Modal -->
								<div class="modal fade" id="documentUpLoadModal" role="dialog">
								    <div class="modal-dialog">
								    
								      <!-- Modal content-->
								      <div class="modal-content">
								        <div class="modal-header">
								          <button type="button" class="close" data-dismiss="modal">&times;</button>
								          <h4 class="modal-title"><i class='fa fa-file-text postingOptionMenu' aria-hidden='true'></i>File Upload</h4>
								          <span style='color:red'>* Images are not allowed here</span>
								        </div>
								        <div class="modal-body">
											<p style='color:red'></p>
											<form action="./upLoadDocument.php"enctype="multipart/form-data" method="post"> 
						                        <?php 

						                        	$string='';
						                        	if (isset($_GET['channel'])){
						                        		$string = $string."<input type='hidden' name='email' value='".$_SESSION['email']."'>";
						                        		$string = $string."<input type='hidden' name='channel' value='".$_GET["channel"]."'>";
						                        	}else{
						                        		$string = $string."<input type='hidden' name='toEmail'  value=".htmlspecialchars($_GET['email']).">";
														$string = $string."<input type='hidden' name='fromEmail' value=".$_SESSION['email'].">";
						                        	}
						                        	echo $string;
						                        ?>
						                        <input class="upload-document" name="uploaded" type="file" /><br /> 
												<input type="submit" name="submit" value="Upload" style='display:none'/>
						                    	
						                    </form>

								        </div>
								    	</br>
								        <div class="modal-footer">
								          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								          <button type="submit" name="submit" value="Upload Image" class="btn btn-success documentSubmit">submit</button>
								        </div>
								      </div>
								      
								    </div>
								</div>
								<!-- end of File UpLoad Modal -->


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
						                        <?php 

						                        	$string='';
						                        	if (isset($_GET['channel'])){
						                        		$string = $string."<input type='hidden' name='email' value='".$_SESSION['email']."'>";
						                        		$string = $string."<input type='hidden' name='channel' value='".$_GET["channel"]."'>";
						                        	}else{
						                        		$string = $string."<input type='hidden' name='toEmail'  value=".htmlspecialchars($_GET['email']).">";
														$string = $string."<input type='hidden' name='fromEmail' value=".$_SESSION['email'].">";
						                        	}
						                        	echo $string;
						                        ?>
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
		                    	<div class="col-xs-12 directmsgdiv ">
		                    		<div class="col-xs-11 nopadding">
		                    			<b><a class ="link" href= "">DirectMesssages</a></b>
		                    		</div>
		                    		<div class="col-xs-1  icon-plus nopadding">
			                    		
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
		                	 <li class="divider"></li>



		                </ul>
		            </div>
		        </div>
		        <div id='message_container' class ='col-xs-10 headrow nopadding' style='min-height:93%;background-color: white; '>
		        	<div class ='col-xs-12 nopadding' style='height:91%;overflow-y: auto; overflow-x: hidden;position:relative;'>
			        	<!-- start of message wrapper -->
			        	<div class = 'message_wrapper'>
			        	<?php 
			        		$userChannels = userChannels($_SESSION['email']);
			        		if (isset($_GET['channel'])){
			        			if (in_array($_GET['channel'], $userChannels)) {
			        				$_SESSION['lastLimit']=0;				
				        			$result =getChannelMessages($_GET['channel'],0);
				        		}else{
				        			$result ="<h1 class ='emptyChannel'>Requested Channel does not exist</h1>";
				        		}
				        	}else if (isset($_GET['email'])){
				        			$_SESSION['lastLimit']=0;
				        			$result =getDirectMessages($_GET['email'],0);
				        		
				        	}else{
				        		
				        		$result ="<h1 class ='emptyChannel'>Please select channel</h1></div>";
				        	}
			        		echo $result; 
			        		
			        	?>
			        </div>
			        <!-- end of message_wrapper -->
			        <!-- form start -->
			        <?php 
				        $userChannels = userChannels($_SESSION['email']);
				        $channelArray=getChannelDetails($_GET['channel']);
				        if (isset($_GET['channel'])){
		        			if (in_array($_GET['channel'], $userChannels)){
						        if($channelArray['isArchive']==0){
						        	$string='';
										$string = $string."<form action ='messages/messages.php'  method = 'post'>";
											$string = $string."<div id='footer' class ='col-xs-12 nopadding '>";
												$string = $string."<div class='input-group input-group-lg textinput'>";
												$string=$string."<div class='col-xs-1  dropup nopadding'><span class='multipleOptions input-group-addon dropdown-toggle' data-toggle='dropdown' id='sizing-addon1'><a style='text-decoration: none;font-size:32px; ' href=''>+</a></span>";
													$string = $string."<ul class='dropdown-menu'>";
														$string = $string."<li><a class ='codeButton' data-toggle='modal' data-target='#myModal' href=''><i class='fa fa-code postingOptionMenu' aria-hidden='true'></i>Code </a></li>";
														$string = $string."<li><a href='' data-toggle='modal' data-target='#documentUpLoadModal' ><i class='fa fa-file-text postingOptionMenu' aria-hidden='true'></i>Document Upload</a></li>";
														$string = $string."<li><a href='' data-toggle='modal' data-target='#imageUpLoadModal' ><i class='fa fa-picture-o postingOptionMenu' aria-hidden='true'></i>Image Upload</a></li>";
														$string = $string."<li><a href='' data-toggle='modal' data-target='#imageURLModal'><i class='fa fa-link postingOptionMenu ' aria-hidden='true'></i> Upload Image URL</a></li>";
														$string = $string."</ul>";
													$string = $string."</div>";
													$string = $string."<div class ='col-xs-11 nopadding'>";
													$string = $string."<input type='hidden' name='channel'  value=".htmlspecialchars($_GET['channel']).">";
													$string = $string."<input type='hidden' name='email' value=".$_SESSION['email'].">";
													$string = $string."<input type='text' class='form-control message' name = 'message'  placeholder= 'Type Some message ....' aria-describedby='sizing-addon1' autofocus required><input type='hidden' name='text' value='0'>";
												$string = $string."</div></div>";
											$string = $string."</div>";
										$string = $string."</form>";
										echo $string;
								}
							}
						}
						if (isset($_GET['email'])){
				        	$string='';
								$string = $string."<form action ='messages/messages.php'  method = 'post'>";
									$string = $string."<div id='footer' class ='col-xs-12 nopadding '>";
										$string = $string."<div class='input-group input-group-lg textinput'>";
										$string=$string."<div class='col-xs-1  dropup nopadding'><span class='multipleOptions input-group-addon dropdown-toggle' data-toggle='dropdown' id='sizing-addon1'><a style='text-decoration: none;font-size:32px; ' href=''>+</a></span>";
											$string = $string."<ul class='dropdown-menu'>";
												$string = $string."<li><a class ='codeButton' data-toggle='modal' data-target='#myModal' href=''><i class='fa fa-code postingOptionMenu' aria-hidden='true'></i>Code </a></li>";
												$string = $string."<li><a href='' data-toggle='modal' data-target='#documentUpLoadModal' ><i class='fa fa-file-text postingOptionMenu' aria-hidden='true'></i>Document Upload</a></li>";
												$string = $string."<li><a href='' data-toggle='modal' data-target='#imageUpLoadModal' ><i class='fa fa-picture-o postingOptionMenu' aria-hidden='true'></i>Image Upload</a></li>";
												$string = $string."<li><a href='' data-toggle='modal' data-target='#imageURLModal'><i class='fa fa-link postingOptionMenu ' aria-hidden='true'></i> Upload Image URL</a></li>";
												$string = $string."</ul>";
											$string = $string."</div>";
											$string = $string."<div class ='col-xs-11 nopadding'>";
											$string = $string."<input type='hidden' name='toEmail'  value=".htmlspecialchars($_GET['email']).">";
											$string = $string."<input type='hidden' name='fromEmail' value=".$_SESSION['email'].">";
											$string = $string."<input type='text' class='form-control message' name = 'message'  placeholder= 'Type Some message ....' aria-describedby='sizing-addon1' autofocus required><input type='hidden' name='text' value='0'>";
										$string = $string."</div></div>";
									$string = $string."</div>";
								$string = $string."</form></div>";
							echo $string;
							
						}

			        ?>

			        <!-- end message_wrapper -->

		        	</div>

		        	<div id='threadContainer' class ='col-xs-3 noPadding panel panel-primary' style='display:none;height: 92%;    border-color: rgb(204, 204, 204) !important;'>
		        		<div class="panel-heading threadHeading">Thread <button type="button" class="close threadClose" >&times;</button></div>
      					<div class="panel-body " id='threadContainerBody'>


      			
      					</div>
		        	</div>
		        	<div id='logInActivity' class ='col-xs-3 noPadding panel panel-primary' style='display:none;height: 92%;    border-color: rgb(204, 204, 204) !important;'>
		        		<div class="panel-heading threadHeading">logIn Activity
		        			<?php 
					    		$result = getUserDetails($_SESSION['email']);
					    		echo "(".$result['display_name'].")";
					    	?><button type="button" class="close threadClose" >&times;</button></div>
      					

      					<div class="panel-body " >
      						<div id='logInActivityLineChart'></div>
      						<div  id='logInActivityPieChart' style='margin-top: 15%;margin-left: 23%;'></div>


      					</div>
      			
      					
		        	</div>
		        	<!-- profile pic update -->
		        	<div id='profilPicUpdate' class ='col-xs-3 noPadding panel panel-primary' style='display:none;  height: 92%;border-color: #cccccc !important;'>
		        		<div class="panel-heading UpdateProfilePicture threadHeading">Update Profile Picture <button type="button" class="close threadClose" >&times;</button></div>
      					<div class="panel-body " id='UpdateProfilePictureBody'>

      						<form action="./uploadImage.php"  id = 'imgForm' method="post" enctype="multipart/form-data">
			     
		                        <!-- <div style="background-color: #404040;color: white;padding-left:9% !important;font-size: 1.7vh;"><label>Select image to upload:</label></div> -->
		                        <img class="profile-pic1 updatePic" src=<?php echo getImage($_SESSION['email']); ?> />
						        <div class="upload-button" style='display:none'>Select Image</div>
		                        <input class = 'imageSelect ' type="file" name="fileToUpload" id="fileToUpload" style='display:none;'>
		                        <input class ='imageUploadBtn' type="submit" value="Upload Image" name="submit">
		                        <input type="hidden" name="channel" value=<?php echo '"'.$_GET["channel"].'"';?> >
			                </form>
      			
      					</div>
		        	</div>

			</div>
		</div>
		<footer>
			<div class="copyRight col-md-12">
				<span>Web-programming Project(CS518)</span><span>© Developed by Chandu Muthyala, Vamsi Krishna, Yasaswy Kandukuri - 2017</span>
			</div>
		</footer>

	</body>
</html>