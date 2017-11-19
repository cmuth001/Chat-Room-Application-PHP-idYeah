


$(document).ready(function () {
	// getting pagination pages 
	var url_string = location.search;
	var id = parseInt(url_string.split("=")[1]);
	console.log(id);
	$.ajax({
			async:false,
	        url: 'sqlQueries.php',
	        type: 'post',
	        data: {'messagesCount':id},
	        dataType: 'text',
	        success: function (data) {	
    		  var messagesCount = parseInt(data);
    		  pages = Math.ceil(messagesCount/7);
    		  if(pages>7){
    		  	max=7;
    		  }else{
    		  	max = pages;
    		  }
	        }
	        
	    });

	$.ajax({
	url: 'sqlQueries.php',
    type: 'post',
    data: {'usersList':0},
    dataType: 'text',
    async:false,
    success: function (data) {	
		globalUser = JSON.parse(data);
		$('#tokenfield1').tokenfield({
			autocomplete: {
				        source: globalUser,
				        delay: 100
				      },
				      showAutocompleteOnFocus: true
				  });

		    //console.log(JSON.parse(data)); 
		    //console.log("");

		}
	});
$.ajax({
	url: 'sqlQueries.php',
    type: 'post',
    data: {'usersList1':0},
    dataType: 'text',
    success: function (data) {	
		globalUser2 = JSON.parse(data);
		$('#tokenfield2').tokenfield({
			autocomplete: {
				        source: globalUser2,
				        delay: 100
				      },
				      showAutocompleteOnFocus: true
				  });


		    //console.log(JSON.parse(data)); 
		    //console.log("");

		}
	});

	

	 $('#pagination-here').bootpag({
	    total: pages,          
	    page: 1,            
	    maxVisible: max,     
	    leaps: true,
	    href: "#result-page-{{number}}",
	})


	//page click action
	$('#pagination-here').on("page", function(event, num){	
	    //show / hide content or pull via ajax etc
	    // SELECT * FROM `channel_messages` where channel_id=1 ORDER BY `channel_messages`.`cmessage_id` DESC LIMIT 3,4
	    console.log("channelId: "+id);
	    var startRow = (7*(num-1));
	    var jsonData = {'channelId':id,'start':startRow,'end':7};
	    var string ='';
	    $.ajax({
			async:false,
	        url: 'sqlQueries.php',
	        type: 'post',
	        data: {'getmessages':jsonData},
	        dataType: 'json',
	        success: function (data)
	        {
	        	

	        	// message loop
	        	var string ='';
    		  	for (i = 0; i < data[0].length; i++)
    		  	{
    		  		var stringThread = '';
    		  		var replyMsg = "replyMsg"+data[0][i]['cmessage_id'];
    		  		var myForm = "myForm"+data[0][i]['cmessage_id'];
    		  		var codeForm = "threadCodeForm"+data[0][i]['cmessage_id'];
    		  		var myThreadModal = "myThreadModal"+data[0][i]['cmessage_id'];
    		  		var modalClose = "modalClose"+data[0][i]['cmessage_id'];
    		  		var channelId = data[0][i]['channel_id'];
    		  		var channelMessage = data[0][i]['channel_message'];
    		  		var textOrCode = parseInt(data[0][i]['textOrCode']);
    		  		var messageId = data[0][i]['cmessage_id'];
    		  		var messageTimeStamp = data[0][i]['cmsg_timestamp'];
    		  		var user = data[0][i]['cuser_email'];
    		  		var displayName = data[0][i]['display_name'];
    		  		var imagePath = "./assets/images/";
    		  		string+="<div class = 'right right"+messageId+"'>";
    		  				string+="<img src='"+imagePath+user+".png'  alt='Contact_Img' class='contact_Img'>";
    		  				string+="<a href=''>"+displayName+"</a>";
    		  				string+="<label class = 'timeStamp'>"+messageTimeStamp+"</label>";
    		  				string+="<div class = 'textMessage'>";
    		  					if(textOrCode==0){
    		  						string+="<span>"+channelMessage+"</span></div>";
    		  					}else if(textOrCode==1){
    		  						string+="<span><pre class='codeDisplay'><code>"+channelMessage+"</code></pre></span></div>";
    		  					}else if(textOrCode==2){
    		  						string+="<a href='"+channelMessage+"' target='_blank'>"+channelMessage+"</a><a href='#imageCollapse"+messageId+"' data-toggle='collapse' ><i class='fa fa-caret-down' aria-hidden='true' style='cursor:pointer;'></i></a>";
    		  						string+="<img id ='imageCollapse"+messageId+"' class='profile-pic collapse' src='"+channelMessage+"'  />"
    		  					}else{
    		  						string+="<img class='profile-pic' src='./assets/channelImages/"+messageId+".png' />"
    		  						string+="<span>"+channelMessage+"</span></div>";
    		  					}
    		  				string+="<div class = 'reaction reaction"+messageId+"'>";
    		  					if(data[0][i]['isArchive']==0){
    		  						string+="<label class = ' likeIcon likeIcon"+messageId+"' data-toggle='tooltip' title='' style='font-size:24px' emoji_id = '1' name = 'like' id ='"+messageId+"' onclick='reactionFunction("+messageId+",\""+user+"\",1)'><i class='fa fa-thumbs-o-up'></i></label><label class='likeCount"+messageId+"'>"+data[0][i]['likeCount']+"</label>";
    		  						string+="<label class = ' dislikeIcon  dislikeIcon "+messageId+"' data-toggle='tooltip' title='' style='font-size:24px' emoji_id = '1' name = 'like' id ='"+messageId+"' onclick='reactionFunction("+messageId+",\""+user+"\",2)'><i class='fa fa-thumbs-o-down'></i></label><label class='dislikeCount"+messageId+"'>"+data[0][i]['disLikeCount']+"</label>";
    		  						string+="<label class = 'replyMsgIcon' id="+messageId+" ><i class='fa fa-reply' aria-hidden='true'></i></label>";
    		  					}
    		  				if(data[0][i]['has_thread']==1){
    		  					string+="<a href='#thread_wrapper"+messageId+"' class = 'repliesCount repliesCount"+messageId+"' id = '"+messageId+"' data-toggle='collapse' style = 'margin-left:1%;text-decoration:none;'>Replies("+data[0][i]['replies']+")</a>";
    		  					if(data[0][0]['isArchive']==0){
	    		  					if(data[0][0]['session_email']=='cmuth001@odu.edu'){
	    								string+="<label><i class='fa fa-trash-o delete "+channelId+"' id ='"+messageId+"' aria-hidden='true'></i></label>";
	    							}
	    						}
    							string+="</div><div class = 'collapse thread_wrapper"+messageId+"' id ='thread_wrapper"+messageId+"'>";
    		  				}else{
    		  					if(data[0][0]['isArchive']==0){
					    			if(data[0][0]['session_email']=='cmuth001@odu.edu'){
					    				string+="<label><i class='fa fa-trash-o delete "+channelId+"' id ='"+messageId+"' aria-hidden='true'></i></label>";
					    			}
					    		}
				    			string+="</div><div class = 'collapse thread_wrapper"+messageId+"' id ='thread_wrapper"+messageId+"'>";				    			
				    		}

		    		  		// threads loop
		    		  		
		    		  		if(data[0][i]['has_thread']==1){
			    		  		for (j = 0; j < data[1].length; j++) {   
			    		  			if(data[1][j]['message_id']==data[0][i]['cmessage_id']){
			    		  				stringThread+="<div id ='"+messageId+"' class='thread'>";
			    		  						stringThread+="<img src='"+imagePath+data[1][j]['email']+".png' alt='Contact_Img' class='contact_Img'><a href= ''>"+data[1][j]['display_name']+"</a><label class = 'timeStamp'>"+data[1][j]['createdon']+"</label>";
			    		  						if(data[1][j]['textOrCode']==0){
			    		  							stringThread+="<div class= 'textMessage'><span>"+data[1][j]['message']+"</span></div>";
			    		  						}else{
			    		  							stringThread+="<div class= 'textMessage'><span><pre><code>"+data[1][j]['message']+"</code></pre></span></div>";
			    		  						}		
			    		  				stringThread+="</div>";
			    		  			}	
			    		  		}
    		  				}
    		  				stringThread+="</div>";//thread wrapper
    		  				string=string+stringThread+"<div class = '"+replyMsg+" input-group input-group-lg textinput1' style='display:none;'>";
		  						string+="<form id = '"+myForm+"' class = '' method ='post'>";
    		  						string+="<input type='hidden' name='user' id='user' value='"+data[0][i]['session_email']+"'>";
    		  						string+="<input type='hidden' name='msgId' id='msgId' value='"+messageId+"' >";
    		  						string+="<input type='hidden' name='channel' id='channel' value='"+channelId+"'>";
    		  						string+="<input type='hidden' name='text' value='0'>";
    		  						string+="<input type='hidden' name='display_name' id='display_name' value='"+data[0][i]['session_username']+"'>";
    		  						string+="<input type='text' id='txt' class='form-control' name = 'message' style  = 'width: 85%;border: 2px solid #bfc4bd;border-bottom-left-radius: 10px;border-top-left-radius: 10px;' placeholder= 'Type Some message ....' aria-describedby='sizing-addon1' autofocus required>";
    		  						string+="<button type='submit' id = '"+messageId+"' class='btn btn-info btn-md replyButton'><span class='glyphicon glyphicon-send'></span> </button>";
		  							string+="<button id = '"+messageId+"' class='btn  btn-sm  threadCodeButton'>ifCode</button>"
		  						string+="</form>";
		  					string+="</div>";//Thread modal start
		  					string+="<div class='modal fade' id='"+myThreadModal+"' role='dialog'>";
									    string+="<div class='modal-dialog modal-lg'>";
									      string+="<div class='modal-content'>";
									        string+="<div class='modal-header'>";
									          string+="<button type='button' class='close modalClose' data-dismiss='modal'>&times;</button>";
									          string+="<h4 class='modal-title'>code posting Area</h4>";
									        string+="</div>";
									        string+="<div class='modal-body'>";
									          string+="<form id= '"+codeForm+"' method = 'post'>";
									          string+="<div class='form-group'>";
									            string+="<label for='message-text' class='form-control-label'>code</label>";
									            string+="<textarea class='form-control codeArea' name = 'message' id='code' placeholder= 'Snippet' autofocus required ></textarea>";
									            string+="<input type='hidden' name='channel' value='"+channelId+"'>";
									            string+="<input type='hidden' name='user' id='user' value='"+data[0][i]['session_email']+"'>";
									            string+="<input type='hidden' name='channel' id='channel' value='"+channelId+"' >";
									            string+="<input type='hidden' name='display_name' id='display_name' value='"+data[0][i]['session_username']+"' >";
									            string+="<input type='hidden' name='msgId' id='msgId' value='"+messageId+"' >";
									            string+="<input type='hidden' name='text' value='1'>";
									          string+="</div>";   
									          string+="<div class='modal-footer'>";
									          string+="<button type='button' class='btn btn-default "+modalClose+"' data-dismiss='modal'>Close</button>";
									           string+="<button type='submit' name = 'submit'  id = '"+messageId+"'  class='btn btn-success threadMessageButton' >submit code</button>";
									          string+="</div>";
									          string+="<div>";	
									          string+="</div>";		
									        string+="</form>";
									        string+="</div>";
									        string+="<div class = 'modal-body-result'>";
									        	string+="<p class = 'para' style='text-align:center;'></p>";
									        string+="</div>";
									      string+="</div>";
									    string+="</div>";
									  string+="</div>";
    						string+="</div>";




		  					string+="</div>";//ending right

    		  	}
    		  	string +="<div id = 'scrollBottom'></div></div>";
    			if(data[0][0]['isArchive']==0){
    		 		string+="<form action ='messages/messages.php'  method = 'post'>";
    		 			string+="<div id='footer' class ='col-xs-12 nopadding '>";
	    		 			string+="<div class='input-group input-group-lg textinput'>";
		    		 			string+="<input type='hidden' name='channel' value='"+channelId+"'>";
		    		 			string+="<input type='hidden' name='email' value='"+data[0][0]['session_email']+"'>";
		    		 			string+="<input type='text' class='form-control' name = 'message' style  = 'width: 93%;border-top-left-radius: 10px;border-bottom-left-radius: 10px;' placeholder= 'Type Some message ....' aria-describedby='sizing-addon1' autofocus required>";
    		 				string+="</div>";
    		 			string+="</div>";
    		 		string+="</form>";
	        	}
	        	string+="</div>";//message_container div
	        	$('.message_wrapper').html(string);

        		//console.log(string);
	    	}
        	

	    	// $("#content").html("Page " + num); 
	   	 // 	console.log(num);
	   	});
	    
	});
	
	// end of pagination stuff

	

	var globalUser = new Array();// global array for users
 	$(".modal-body-result").hide();
  	$('[data-toggle="tooltip"]').tooltip();
	$( ".channelButton" ).on("click",function(e) {
		
	    var channelName = document.getElementById("channelName").value;
		var purpose = document.getElementById("purpose").value;
		var private1 = document.getElementById("private").checked ;
		var public1 = document.getElementById("public").checked ;
		var radioButtonValue = (private1===false)?0:1;
		
		
	    var token = $('#tokenfield1').val();
	    token = token.split(",");
	    var trimSpace = token.map(function(e){return e.trim();});
	    token = jQuery.unique(trimSpace);
	    var dataString = {'channelName':channelName, 'purpose':purpose, 'radioButtonValue':radioButtonValue,'usersList':token};
	    console.log(token);
	    $.ajax({
	        url: 'createChannel.php',
	        type: 'post',

	        data: {'data':dataString},
	        dataType: 'text',
	        success: function (data) {
	        	console.log(data);
	        	$("#errorMsg").append(data);
	        	//$('.errorMsg').innerHTML=data;
	   //      	var url = 'index.php';
				// window.location.href = url;
	          
	        }
	        
	    });
	 });

$( ".inviteChannelButton" ).on("click",function(e) {
			var channelId=document.getElementById("channelId");
			var channelId=channelId.options[channelId.selectedIndex].value;
			var channelId = Number(channelId);
			var token = $('#tokenfield2').val();
			token = token.split(",");
			var trimSpace = token.map(function(e){return e.trim();});
	    	token = jQuery.unique(trimSpace);
	    	var dataString = {'channelId':channelId,'usersList':token};
	 	
		    console.log(token);
		    $.ajax({
		        url: 'inviteMembers.php',
		        type: 'post',
		        data: {'data':dataString},
		        dataType: 'text',
		        success: function (data) {
		        	console.log(data);
		        	$("#errorMsg").append(data);
		   
		          
		        }
	        
	    });
	 });
	$(document).on('click','.delete',function(e){
		var messageId = e.currentTarget.id;
		var channelId = parseInt(e.target.className.split(" ")[3]);
		var pageNo= e.currentTarget.baseURI.substring(e.currentTarget.baseURI.lastIndexOf('-')+1);
		$.confirm({
		    title: "<label style ='text-align: center;'>Confirmation </label><i class='fa fa-trash-o' style='color:red'  aria-hidden='true'></i>",
		    content: 'Deleting Message from the Channel',
		    buttons: {
		        delete: function () {
		            //$.alert('Confirmed!');
		            $.ajax({
				        url: 'sqlQueries.php',
				        type: 'post',
				        data: {'deleteMessage':messageId},
				        dataType: 'text',
				        success: function (data) {
				        	console.log(data);
				        	
				        	var divHide = "right"+messageId;
				        	//$('.'+divHide).hide();
				        	var url = "./index.php?channel="+channelId;
				        	console.log(channelId);
				         	window.location.href = url;
				        }
				    });
		        },
		        cancel: function () {
		            
		        }
		    }
		});

	});
	$(document).on('click','.replyMsgIcon',function(e){

		//$(".replyMsg"+e.currentTarget.id).show();
		 $(".replyMsg"+e.currentTarget.id).toggle();
		

	});
	$(document).on('click','.codeButton',function(e){
		$('.textinput').hide().prop('required',false);
		//$('#myThreadModal').modal('show');
		console.log("codeBtn");		
	});
	$(document).on('click','.threadCodeButton',function(e){
		// $('.replyMsg'+e.currentTarget.id).hide().prop('required',false);

		$('#myThreadModal'+e.currentTarget.id).modal('show');
		//console.log("codeBtn");		
	});
	$(document).on('click','.modalClose',function(e){
		$('.textinput').show();
		console.log("modalClose");		
	});
	$(document).on('click','.channelArchive',function(e){

		console.log(e.currentTarget.id);
		var channelId = e.currentTarget.id;
		$.ajax({
	        url: 'sqlQueries.php',
	        type: 'post',
	        data: {'archive':channelId},
	        dataType: 'text',
	        success: function (data) {
	        	console.log(data);
	        	var url = "./index.php?channel="+channelId;
	             window.location.href = url;
	        }
	    });

	});
	$(document).on('click','.repliesCount',function(e){

		// disabled  text input box toggling
		//$(".replyMsg"+e.currentTarget.id).show();
		 //$(".replyMsg"+e.currentTarget.id).toggle();
		

	});

	// $(document).on('change','#profileSearchInputField',function(e){
	$('#profileSearchInputField').keyup(function(){
		
		var keyValue = $('#profileSearchInputField').val();
		$.ajax({
	        url: 'sqlQueries.php',
	        type: 'post',
	        data: {'profileSearchInputField':keyValue},
	        dataType: 'json',
	        success: function (data) {
	        	//$('.listOfProfileSearch').remove();
	        	var usersList = "<ul class='list-group'>";
	        	for (i = 0; i < data.length; i++)
    		  	{	
    		  		usersList+="<a href='profilePage.php?email="+data[i]['email']+"' style='text-decoration: none;'><li class='list-group-item'>"+data[i]['user_name']+"</li></a>";
    		  	}
    		  	usersList+="</ul>";
    		  	$('.listOfProfileSearch').html(usersList);
	        	console.log(usersList);
	        	
	        }
	    });


		console.log('input:value:'+keyValue);
	});
	$('#profileSearchInputField').focusout(function() {
		//$('.listOfProfileSearch').html('');
		//$('#profileSearchInputField').val('');
		
	});
	
	$(document).on('click','.replyButton',function(e){	
		e.preventDefault();

	  	var myForm = document.getElementById('myForm'+e.currentTarget.id);
	   	var formData = new FormData(myForm),
	   	convertedJSON = {},
	   	it = formData.entries(),
	   	n;
	   	while(n = it.next()) {
	      	if(!n || n.done) break;
	      	convertedJSON[n.value[0]] = n.value[1];
	    }
	  	$.ajax({
	        url: 'sqlQueries.php',
	        type: 'post',
	        data: {'thread':convertedJSON},
	        dataType: 'json',
	        success: function (data) {
	        	var msgId = data[1]['message_id'];
	        	var image = data[1]['user_email'];
	        	var user = convertedJSON['display_name'];
	        	var channelId = convertedJSON['channel_id'];
	        	var message = data[1]['message'];
	        	var textOrCode = data[1]['textOrCode'];
	        	var  timeStamp = data[1]['createdon'];
	        	var threadDiv = "<div id ='"+msgId+"' class='thread'><img src='./assets/images/"+image+".png'"+" alt='Contact_Img' class='contact_Img'><a href= ''>"+user+"</a><label class = 'timeStamp'>"+timeStamp+"</label>";
	        	if(textOrCode==0){
	        		threadDiv+="<div class= 'textMessage'><span>"+message+"</span></div></div>";
	        	}else{
	        		threadDiv+="<div class= 'textMessage'><span><pre></code>"+message+"</code></pre></span></div></div>";
	        	}
	        	console.log(threadDiv);
	        	//$('.thread_wrapper'+msgId).append("<div class='thread'><img src='./assets/images/cmuth001@odu.edu.png' alt='Contact_Img' class='contact_Img'></div>");
	        	$('.thread_wrapper'+msgId).removeClass( "collapse" ).addClass( "collapse in" );
	        	$('.thread_wrapper'+msgId).append(threadDiv);

	        	// "<a href='#thread_wrapper"+msgId+"' class='repliesCount repliesCount"+msgId+"' id='"+msgId+"' data-toggle='collapse ' style='margin-left:1%;text-decoration:none;'>Replies(2)</a>";
	        	$('.repliesCount'+msgId).html('Replies('+data[0]+')');
	        	$('form').find('input[type=text]').val('');
	        	


	        	// var url = "./index.php?channel="+convertedJSON['channel'];
	         //     window.location.href = url;
	            /// Send Email to professor
	        }
    	});
	    console.log(convertedJSON);
	});

	//

	$(document).on('click','.threadMessageButton',function(e){	
		e.preventDefault();
	  	var myForm = document.getElementById('threadCodeForm'+e.currentTarget.id);
	   	var formData = new FormData(myForm),
	   	convertedJSON = {},
	   	it = formData.entries(),
	   	n;
	   	while(n = it.next()) {
	      	if(!n || n.done) break;
	      	convertedJSON[n.value[0]] = n.value[1];
	    }
	  	$.ajax({
	        url: 'sqlQueries.php',
	        type: 'post',
	        data: {'thread':convertedJSON},
	        dataType: 'json',
	        success: function (data) {
	        	var msgId = data[1]['message_id'];
	        	var image = data[1]['user_email'];
	        	var user = convertedJSON['display_name'];
	        	var channelId = convertedJSON['channel_id'];
	        	var message = data[1]['message'];
	        	var textOrCode = data[1]['textOrCode'];
	        	var  timeStamp = data[1]['createdon'];
	        	var threadDiv = "<div id ='"+msgId+"' class='thread'><img src='./assets/images/"+image+".png'"+" alt='Contact_Img' class='contact_Img'><a href= ''>"+user+"</a><label class = 'timeStamp'>"+timeStamp+"</label>";
	        	if(textOrCode==0){
	        		threadDiv+="<div class= 'textMessage'><span>"+message+"</span></div></div>";
	        	}else{
	        		threadDiv+="<div class= 'textMessage'><span><pre></code>"+message+"</code></pre></span></div></div>";
	        	}
	        	
	        	console.log(threadDiv);
	        	//$('.thread_wrapper'+msgId).append("<div class='thread'><img src='./assets/images/cmuth001@odu.edu.png' alt='Contact_Img' class='contact_Img'></div>");
	        	$('.thread_wrapper'+msgId).removeClass( "collapse" ).addClass( "collapse in" );
	        	$('.thread_wrapper'+msgId).append(threadDiv);

	        	// "<a href='#thread_wrapper"+msgId+"' class='repliesCount repliesCount"+msgId+"' id='"+msgId+"' data-toggle='collapse ' style='margin-left:1%;text-decoration:none;'>Replies(2)</a>";
	        	$('.repliesCount'+msgId).html('Replies('+data[0]+')');
	        	$('form').find('input[type=text]').val('');
	        	


	        	// var url = "./index.php?channel="+convertedJSON['channel'];
	         //     window.location.href = url;
	            /// Send Email to professor
	        }
    	});
	    console.log(convertedJSON);
	});

// image upload into channel

var readURL = function(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.profile-pic').attr('src', e.target.result);
            }
    
            reader.readAsDataURL(input.files[0]);
        }
    }
    

    $(".file-upload").on('change', function(){
        readURL(this);
    });
    
    $(".upload-button").on('click', function() {
       $(".file-upload").click();
    });

    $('.imageSubmit').on('click', function() {
    	$('#imageUpLoadModal input[type=submit]').trigger('click');
	});
	$('.imageURLSubmit').on('click', function() {
    	$('#imageURLModal input[type=submit]').trigger('click');
	});
    //image upload code end



});
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function userMenu() {
    document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {

    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
function reactionFunction(msg_id,user_email,emoji_id){

	 	var data1 = {'msg_id':msg_id,'user_email':user_email,'emoji_id':emoji_id};
	 	
	    $.ajax({
	        url: 'sqlQueries.php',
	        type: 'post',
	        data: {'reactions':data1},
	        dataType: 'json',
	        success: function (data) {	
        		$('div.reaction label.likeCount'+msg_id).text(data[0]);
        		$('div.reaction label.dislikeCount'+msg_id).text(data[1]); 
        		// $('div.reaction label.likeIcon'+msg_id).attr('title',data[2]);
        		// $('div.reaction label.dislikeIcon'+msg_id).attr('title',data[3]);
	        }
	        
	    });
}