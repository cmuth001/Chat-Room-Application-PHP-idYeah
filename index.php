<?php

session_start();

if($_GET && $_GET['action'] && $_GET['action']=="logout"){
	unset($_SESSION['loggedIn']);
	unset($_SESSION['email']);
}

if(!$_SESSION['loggedIn']){
	header("location: ./login/login.php");
	die();
}

?>
<html>
	<head>
		<title>Homepage</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="index.css">
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

		<!-- Latest compiled JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>
	<body>
		<!-- <div>
		 	<p>Welcome <?= $_SESSION['email'] ?>! (<a href="./login/login.php">log out</a>)</p>
		</div> -->
		<div class="container nopadding col-md-12" >
			<div class = "col-md-12 headrow">
				<div class = "col-md-3">
					<label><a href="">ODUCS518F17</a></label>
				</div>
				<div class="col-md-9">	
					<label>col-md-9</label>
				</div>
			</div>

			<div class="col-md-12 nopadding">
		        <div class="col-md-3 " style="width:15%; padding: 0px 0;overflow-y: auto; overflow-x: hidden; height: 90%;">
		            <div style="">
		                <ul class="col-md-12 nav nav-list nopadding">
		                    <li>
		                    	<div class="col-md-12 Starreddiv ">
		                    		<div class="col-md-12 nopadding">
		                    			<label>Starred</label>
		                    		</div>
		                    	
	        					</div>
	        					</br>
	        					
	        					<div id="test">
			                        <ul class="nav nav-list tree starredList">
			                            <li class="listbg"><a href="#">user 1</a></li>
			                            <li><a  href="#">Channel 1</a></li>
			                            <li><a href="#">Channel 2</a></li>
			                            
			                        </ul>
		                    	</div>
		                    </li>
		                    
		                    <li class="divider"></li>
		                    <li>
		                    	<div class="col-md-12 channeldiv">
		                    		<div class="col-md-11 nopadding">
		                    			<b><a class ="link" href= "">Channels</a></b>
		                    		</div>
		                    		<div class="col-md-1 nopadding">
			                    		<button type="button" class="btn btn-default btn-sm nopadding btnadj" onclick="addItemTochannel()">
		          							<span class="glyphicon glyphicon-plus-sign"></span>
		        						</button>
	        						</div>
	        					</div>
	        					</br>
	        					<div id="Channel">
				                        <ul class="nav nav-list tree starredList">
				                            <li><a href="#">Channel 3</a></li>
				                            <li><a href="#">Channel 4</a></li>
				                        </ul>
		                    	</div>
		                    </li>
		                    
		                    
		                    <li class="divider"></li>
		                    <li>
		                    	<div class="col-md-12 directmsgdiv ">
		                    		<div class="col-md-11 nopadding">
		                    			<b><a class ="link" href= "">DirectMesssages</a></b>
		                    		</div>
		                    		<div class="col-md-1  nopadding">
			                    		<button type="button" class="btn btn-default btn-sm nopadding btnadj " onclick="addItemToDM()">
		          							<span class="glyphicon glyphicon-plus-sign"></span>
		        						</button>
	        						</div>
	        					</div>
	        					</br>
        						<div id="directmsg">
			                        <ul class="nav nav-list tree directmsgList">
			                            <li><a href="#">User 2</a></li>
			                            <li><a href="#">User 3</a></li>
			                            <li><a href="#">User 4</a></li>
			                        </ul>
	                    		</div>
		                    </li>
		                </ul>
		            </div>
		        </div>
		        <div id="defaultdiv" class ="col-md-10 headrow nopadding" style="width:85%;min-height:94%; ">
		        	<div class ="col-md-12 nopadding " style="height:94%;overflow-y: auto; overflow-x: hidden;position:relative;">
			        	hello world
			        	<p>hello</p><br><p>hello</p><br><p>hello</p><br><p>hello</p><br><p>hello</p><br><p>hello</p><br><p>hello</p><br><p>hello</p><br><p>hello</p><br><p>hello</p><br><p>hello</p><br><p>hello</p><br><p>hello</p><br><p>hello</p><br>
			        	<!-- <p>hello</p><br><p>hello</p><br><p>hello</p><br><p>hello</p><br><p>hello</p><br><p>hello</p><br><p>hello</p><br><p>hello</p><br><p>hello</p><br><p>hello</p><br><p>hello</p><br><p>hello</p><br><p>hello</p><br><p>hello</p><br> -->
		        	</div>
		        	<div id="footer" class ="col-md-12 nopadding "><!-- <input type="text" name="msgbox" style="width:100%;height: 100%;"> -->
		        		<div class="input-group input-group-lg">
	  						<span class="input-group-addon" id="sizing-addon1"><a style="text-decoration: none" href="">+</a></span>
	  						<input type="text" class="form-control" placeholder="Type some  message . . ." aria-describedby="sizing-addon1">
						</div>

		        	</div>
		        </div>


			</div>
	</div>

	<script>
		function addItemTochannel(){
			$("#Channel ul").append('<li><a href=""><span class="tab">Channel</span></a></li>');
			
		}
		function addItemToDM(){
			
			$("#directmsg ul").append('<li><a href=""><span class="tab">User </span></a></li>');
		}
	</script>>
	<!-- <script >
		$(document).ready(function () {
	    $('label.tree-toggler').click(function () {
	        $(this).parent().children('ul.tree').toggle(300);
	    });
	});
	</script>> -->
	</body>
</html>