


$(document).ready(function () {
	// getting pagination pages 
	var url_string = location.search;
	var id = url_string.split("=")[1];
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
    		  if(pages>5){
    		  	max=5;
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
	});


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
    		  						string+="<img id ='imageCollapse"+messageId+"' class='profile-pic collapse' src='"+channelMessage+"'  /></div>"
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
    		  					string+="<a href='#thread_wrapper"+messageId+"' class = 'repliesCount repliesCount"+messageId+"' id = '"+messageId+"' data-toggle='collapse' style = 'margin-left:1%;text-decoration:none;'>Comments("+data[0][i]['replies']+")</a>";
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
			    		  							stringThread+="<div class= 'textMessage'><span><pre class='codeDisplay'><code>"+data[1][j]['message']+"</code></pre></span></div>";
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
		    		 			string+="<input type='text' class='form-control' name = 'message' style  = 'border-top-left-radius: 10px;border-bottom-left-radius: 10px;' placeholder= 'Type Some message ....' aria-describedby='sizing-addon1' autofocus required>";
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
				        	var url = "./index.php"+url_string;
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

	$(document).on('click','.channelMemberDelete',function(e){
		var details = e.target.className.split(' ');
		var email = e.currentTarget.id;
		var channelId = details[0];
		var data = {'channelId':channelId ,'email':email};
		
		console.log(e.currentTarget.id);
		$.confirm({
			title:"<label>Channel Member</label>",
			content:"Are you really want to delete</br><span>User name:</br>Email: '"+e.currentTarget.id+"'",
			buttons:{
				Yes:function(){
					$.ajax({
				        url: 'sqlQueries.php',
				        type: 'post',
				        data: {'deleteChannelMember':data},
				        dataType: 'text',
				        success: function (data) {
				        	console.log(data);
				        	
				        	var url = "./index.php"+url_string;
				         	window.location.href = url;
				        }
				    });
				},
				No:function(){

				}

			}

		});

	});
	$(document).on('click','.replyMsgIcon',function(e){

		//$(".replyMsg"+e.currentTarget.id).show();
		//$(".replyMsg"+e.currentTarget.id).toggle();

		$('#message_container').removeClass('col-xs-10');
		$('#message_container').addClass('col-xs-7');
		$('#footer').removeClass('col-xs-12');
		$('#footer').addClass('col-xs-7');
		$('#profilPicUpdate').hide();
		$('#threadContainer').show();
		var messageId = e.currentTarget.id;
		var details = {'channelId':id,'messageId':messageId};
		//getting main message and its threads.
		$.ajax({
			url: "sqlQueries.php",
			type: 'post',
			data: {'threadContainerMessages':details},
			dataType: 'json',
			success: function(data){
					 console.log(data);
					 var string='';
					var stringThread = '';
    		  		var replyMsg = "replyMsg"+data[0]['cmessage_id'];
    		  		var myForm = "myForm"+data[0]['cmessage_id'];
    		  		var codeForm = "threadCodeForm"+data[0]['cmessage_id'];
    		  		var myThreadModal = "myThreadModal"+data[0]['cmessage_id'];
    		  		var modalClose = "modalClose"+data[0]['cmessage_id'];
    		  		var channelId = data[0]['channel_id'];
    		  		var channelMessage = data[0]['channel_message'];
    		  		var textOrCode = parseInt(data[0]['textOrCode']);
    		  		var messageId = data[0]['cmessage_id'];
    		  		var messageTimeStamp = data[0]['cmsg_timestamp'];
    		  		var user = data[0]['cuser_email'];
    		  		var displayName = data[0]['display_name'];
    		  		var imagePath = "./assets/images/";
    		  		string+="<div class = 'rightThread right"+messageId+"'>";
    		  				string+="<img src='"+data[0]['messageContactImg']+"'  alt='Contact_Img' class='contact_Img'>";
    		  				string+="<a href=''>"+displayName+"</a>";
    		  				string+="<label class = 'timeStamp'>"+messageTimeStamp+"</label>";
    		  				string+="<div class = 'textMessage'>";
    		  					if(textOrCode==0){
    		  						string+="<span>"+channelMessage+"</span></div>";
    		  					}else if(textOrCode==1){
    		  						string+="<span><pre class='codeDisplay'><code>"+channelMessage+"</code></pre></span></div>";
    		  					}else if(textOrCode==2){
    		  						string+="<a href='"+channelMessage+"' target='_blank'>"+channelMessage+"</a><a href='#imageCollapse"+messageId+"' data-toggle='collapse' ><i class='fa fa-caret-down' aria-hidden='true' style='cursor:pointer;'></i></a>";
    		  						string+="<img id ='imageCollapse"+messageId+"' class='profile-pic collapse in' src='"+channelMessage+"'  /></div>"
    		  					}else if(textOrCode==4){
	    							string+="<a href='./assets/upload/"+messageId+"_"+channelMessage+"' title='File' target='_blank' download><i class='fa fa-file-text' aria-hidden='true' style='cursor:pointer;'></i>"+channelMessage+"</a></div>";

	    						}else{
    		  						string+="<img class='profile-pic' src='./assets/channelImages/"+messageId+".png' />"
    		  						string+="<span>"+channelMessage+"</span></div>";
    		  					}
    		  				string+="<div class = 'reaction reaction"+messageId+"'>";
    		  					if(data[0]['isArchive']==0){
    		  						if(data[0]['emojiId']==1 && data[0]['session_email']==data[0]['emoji_email'] ){
    		  							string+="<label class = ' likeIcon likeIcon"+messageId+"' data-toggle='tooltip' title=''  emoji_id = '1' name = 'like' id ='"+messageId+"' onclick='reactionFunction("+messageId+",\""+user+"\",1)'><i class='fa fa-thumbs-up' style='color: #3697e1;font-size: 180%;'></i></label><label class='likeCount"+messageId+"'>"+data[0]['likeCount']+"</label>";
    		  							string+="<label class = ' dislikeIcon  dislikeIcon"+messageId+"' data-toggle='tooltip' title=''  emoji_id = '1' name = 'like' id ='"+messageId+"' onclick='reactionFunction("+messageId+",\""+user+"\",2)'><i class='fa fa-thumbs-o-down'style='font-size: 170%;'></i></label><label class='dislikeCount"+messageId+"'>"+data[0]['disLikeCount']+"</label>";
    		  						}else if(data[0]['emojiId']==2 && data[0]['session_email']==data[0]['emoji_email']){
    		  							string+="<label class = ' likeIcon likeIcon"+messageId+"' data-toggle='tooltip' title=''  emoji_id = '1' name = 'like' id ='"+messageId+"' onclick='reactionFunction("+messageId+",\""+user+"\",1)'><i class='fa fa-thumbs-o-up' font-size: 170%;></i></label><label class='likeCount"+messageId+"'>"+data[0]['likeCount']+"</label>";
    		  							string+="<label class = ' dislikeIcon  dislikeIcon"+messageId+"' data-toggle='tooltip' title=''  emoji_id = '1' name = 'like' id ='"+messageId+"' onclick='reactionFunction("+messageId+",\""+user+"\",2)'><i class='fa fa-thumbs-down' style='color: #3697e1;font-size: 180%;'></i></label><label class='dislikeCount"+messageId+"'>"+data[0]['disLikeCount']+"</label>";
    		  						}else{
    		  							string+="<label class = ' likeIcon likeIcon"+messageId+"' data-toggle='tooltip' title=''  emoji_id = '1' name = 'like' id ='"+messageId+"' onclick='reactionFunction("+messageId+",\""+user+"\",1)'><i class='fa fa-thumbs-o-up ' style='font-size: 170%;'></i></label><label class='likeCount"+messageId+"'>"+data[0]['likeCount']+"</label>";
    		  							string+="<label class = ' dislikeIcon  dislikeIcon"+messageId+"' data-toggle='tooltip' title=''  emoji_id = '1' name = 'like' id ='"+messageId+"' onclick='reactionFunction("+messageId+",\""+user+"\",2)'><i class='fa fa-thumbs-o-down' style='font-size: 170%;'></i></label><label class='dislikeCount"+messageId+"'>"+data[0]['disLikeCount']+"</label>";
    		  						}
    		  						
    		  						//string+="<label class = 'replyMsgIcon' id="+messageId+" ><i class='fa fa-reply' aria-hidden='true'></i></label>";
    		  					}
    		  				if(data[0]['has_thread']==1){
    		  					string+="<a href='#thread_wrapper"+messageId+"' class = 'repliesCount repliesCount"+messageId+"' id = '"+messageId+"' data-toggle='collapse' style = 'margin-left:1%;text-decoration:none;'>Comments("+data[0]['replies']+")</a>";
    		  					if(data[0]['isArchive']==0){
	    		  					if(data[0]['session_email']=='cmuth001@odu.edu'){
	    								string+="<label><i class='fa fa-trash-o delete "+channelId+"' id ='"+messageId+"' aria-hidden='true'></i></label>";
	    							}
	    						}
    							string+="</div><div class = 'collapse in  thread_wrapper"+messageId+" thread_wrapper' id ='thread_wrapper"+messageId+" '>";
    		  				}else{
    		  					if(data[0]['isArchive']==0){
					    			if(data[0]['session_email']=='cmuth001@odu.edu'){
					    				string+="<label><i class='fa fa-trash-o delete "+channelId+"' id ='"+messageId+"' aria-hidden='true'></i></label>";
					    			}
					    		}
				    			string+="</div><div class = 'collapse in thread_wrapper"+messageId+" thread_wrapper' id ='thread_wrapper"+messageId+"'>";				    			
				    		}

		    		  		// threads loop
		    		  		
		    		  		if(data[0]['has_thread']==1){
			    		  		for (j = 0; j < data[1].length; j++) {   
			    		  			if(data[1][j]['message_id']==data[0]['cmessage_id']){
			    		  				stringThread+="<div id ='"+messageId+"' class='thread'>";
			    		  						stringThread+="<img src='"+data[1][j]['threadMsgUserImg']+"' alt='Contact_Img' class='contact_Img'><a href= ''>"+data[1][j]['display_name']+"</a><label class = 'timeStamp'>"+data[1][j]['createdon']+"</label>";
			    		  						if(data[1][j]['textOrCode']==0){
			    		  							stringThread+="<div class= 'textMessage'><span>"+data[1][j]['message']+"</span></div>";
			    		  						}else{
			    		  							stringThread+="<div class= 'textMessage'><span><pre class='codeDisplay'><code>"+data[1][j]['message']+"</code></pre></span></div>";
			    		  						}		
			    		  				stringThread+="</div>";
			    		  			}	
			    		  		}
    		  				}
    		  				stringThread+="</div>";//thread wrapper
    		  				string=string+stringThread+"<div class = '"+replyMsg+" input-group input-group-lg textinput1' >";
		  						string+="<form id = '"+myForm+"' class = '' method ='post'>";
    		  						string+="<input type='hidden' name='user' id='user' value='"+data[0]['session_email']+"'>";
    		  						string+="<input type='hidden' name='msgId' id='msgId' value='"+messageId+"' >";
    		  						string+="<input type='hidden' name='channel' id='channel' value='"+channelId+"'>";
    		  						string+="<input type='hidden' name='text' value='0'>";
    		  						string+="<input type='hidden' name='display_name' id='display_name' value='"+data[0]['session_username']+"'>";
    		  						string+="<div>";
	    		  						string+="<img src='"+data[0]['replyMsgContactImg']+"' alt='replyMsgContactImg' class='replyMsgContactImg'/>";
	    		  						string+="<input type='text' id='txt' class='form-control' name = 'message' style  = 'width: 79%;border: 2px solid #bfc4bd;height: 40px' placeholder= 'Type Some message ....' aria-describedby='sizing-addon1' autofocus required>";
	    		  						string+="<button type='submit' id = '"+messageId+"' class='btn btn-info btn-md replyButton'><span class='glyphicon glyphicon-send'></span> </button>";
			  							string+="<button id = '"+messageId+"' class='btn  btn-sm  threadCodeButton' title='Insert Code'><i class='fa fa-code postingOptionMenu' aria-hidden='true'>Code</i></button>"
		  							string+="</div>";
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
									            string+="<input type='hidden' name='user' id='user' value='"+data[0]['session_email']+"'>";
									            string+="<input type='hidden' name='channel' id='channel' value='"+channelId+"' >";
									            string+="<input type='hidden' name='display_name' id='display_name' value='"+data[0]['session_username']+"' >";
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




		  					string+="</div>";
		  					$('#threadContainerBody').html(string);


			}

		});





		console.log(e.currentTarget.id);

	});
	$(document).on('click','.codeButton',function(e){
		//$('.textinput').hide().prop('required',false);
		//$('#myThreadModal').modal('show');
		console.log("codeBtn");		
	});
	$(document).on('click','.threadClose',function(e){
		$('#message_container').removeClass('col-xs-7');
		$('#message_container').addClass('col-xs-10');
		$('#footer').removeClass('col-xs-7');
		$('#footer').addClass('col-xs-12');
		$('#threadContainer').hide();
		console.log("threadClose");		
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
	$(document).on('change','.toggle-event',function(e){
		var email = e.currentTarget.id;
		var isSecure = $('.toggle-event').prop('checked')==true?1:0;
		$.ajax({
	        url: 'sqlQueries.php',
	        type: 'post',
	        data: {'isSecureOption': {'email': email, 'isSecure': isSecure}},
	        dataType: 'text',
	        success: function (data) {
	        	
	        }
	    });
	});
	// $( "#toggle-event" ).change(function() {
 //  		alert( "Handler for .change() called." );
	// });
	$(document).on('click','.picUpdate',function(e){
		$('#message_container').removeClass('col-xs-10');
		$('#message_container').addClass('col-xs-7');
		$('#footer').removeClass('col-xs-12');
		$('#footer').addClass('col-xs-7');
		$('#threadContainer').hide();
		$('#logInActivity').hide();
		$('#profilPicUpdate').show();
		console.log("picUpdate");
	});
	
	$(document).on('click','.loginActivityGraph',function(e){
		$('#message_container').removeClass('col-xs-10');
		$('#message_container').addClass('col-xs-7');
		$('#footer').removeClass('col-xs-12');
		$('#footer').addClass('col-xs-7');
		$('#threadContainer').hide();
		$('#profilPicUpdate').hide();
		$('#logInActivityLineChart').text('');
		$('#logInActivityPieChart').text('');
		logInActivityPieChart();
		logInActivityLineChart();
		$('#logInActivity').show();
		console.log("LogInActivity");
	});
	$(document).on('click','.selectGravatar',function(e){
		var email = e.currentTarget.id;
		$.ajax({
	        url: 'sqlQueries.php',
	        type: 'post',
	        data: {'selectGravatar':email},
	        dataType: 'text',
	        success: function (data) {
	        	console.log(data);
	        	var url = "./index.php"+url_string;
	            window.location.href = url;
	        }
	    });


		console.log(email);
	});
	$(document).on('click','.defaultPhoto',function(e){
		var email = e.currentTarget.id;
		$.ajax({
	        url: 'sqlQueries.php',
	        type: 'post',
	        data: {'defaultPhoto':email},
	        dataType: 'text',
	        success: function (data) {
	        	console.log(data);
	        	var url = "./index.php"+url_string;
	            window.location.href = url;
	        }
	    });


		console.log(email);
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
	        	var url = "./index.php"+url_string;
	             window.location.href = url;
	        }
	    });

	});
	$(document).on('click','.repliesCount',function(e){

		// disabled  text input box toggling
		//$(".replyMsg"+e.currentTarget.id).show();
		 //$(".replyMsg"+e.currentTarget.id).toggle();
		

	});
	$(document).on('click','.loadMore',function(e){
		var start = e.currentTarget.id;
		var details = {'channelId':parseInt(id),'start':start};
		$.ajax({
			url:'sqlQueries.php',
			type:'post',
			data:{'loadMore':details},
			dataType:'text',
			success:function(data){
				// console.log(data);
				$("#loadMore"+start).remove();
				$('.message_wrapper').prepend(data);

			}
		});

		console.log(e.currentTarget.id);

	});
	$(document).on('click','.loadMoreDirectMessages',function(e){
		var start = e.currentTarget.id;
		var details = {'toEmail':id,'start':start};
		$.ajax({
			url:'sqlQueries.php',
			type:'post',
			data:{'loadMoreDirectMessages':details},
			dataType:'text',
			success:function(data){
				$("#loadMoreDirectMessages"+start).remove();
				$('.message_wrapper').prepend(data);
			}

		});

	});
	// $(document).on('change','#profileSearchInputField',function(e){
	$('#profileSearchInputField').keyup(function(){
		$('.listOfProfileSearch').show();
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
	// $('#profileSearchInputField').focusout(function() {
	// 	//$('.listOfProfileSearch').html('');
	// 	//$('#profileSearchInputField').val('');
		
	// });
	var readURL = function(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.profile-pic1').attr('src', e.target.result);
            }
    
            reader.readAsDataURL(input.files[0]);
        }
    }
	$(document).on('click','.container',function(e){	
		$('.listOfProfileSearch').hide();
		$('#profileSearchInputField').val('');
	});
	$(".imageSelect").on('change', function(){
        readURL(this);
    });
	$('.updatePic').on('click', function() {	
		
		$('.imageSelect').trigger('click');
		// readURL(this);

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
	        	var image = data[1]['imgPath'];
	        	var user = convertedJSON['display_name'];
	        	var channelId = convertedJSON['channel_id'];
	        	var message = data[1]['message'];
	        	var textOrCode = data[1]['textOrCode'];
	        	var  timeStamp = data[1]['createdon'];
	        	var threadDiv = "<div id ='"+msgId+"' class='thread'><img src='"+image+"'"+" alt='Contact_Img' class='contact_Img'><a href= ''>"+user+"</a><label class = 'timeStamp'>"+timeStamp+"</label>";
	        	if(textOrCode==0){
	        		threadDiv+="<div class= 'textMessage'><span>"+message+"</span></div></div>";
	        	}else{
	        		threadDiv+="<div class= 'textMessage'><span><pre class='codeDisplay'><code>"+message+"</code></pre></span></div></div>";
	        	}
	        	console.log(threadDiv);
	        	//$('.thread_wrapper'+msgId).append("<div class='thread'><img src='./assets/images/cmuth001@odu.edu.png' alt='Contact_Img' class='contact_Img'></div>");
	        	$('.thread_wrapper'+msgId).removeClass( "collapse" ).addClass( "collapse in" );
	        	$('.thread_wrapper'+msgId).append(threadDiv);

	        	// "<a href='#thread_wrapper"+msgId+"' class='repliesCount repliesCount"+msgId+"' id='"+msgId+"' data-toggle='collapse ' style='margin-left:1%;text-decoration:none;'>Replies(2)</a>";
	        	$('.repliesCount'+msgId).html('Comments('+data[0]+')');
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
	        		threadDiv+="<div class= 'textMessage'><span><pre class='codeDisplay'></code>"+message+"</code></pre></span></div></div>";
	        	}
	        	
	        	console.log(threadDiv);
	        	//$('.thread_wrapper'+msgId).append("<div class='thread'><img src='./assets/images/cmuth001@odu.edu.png' alt='Contact_Img' class='contact_Img'></div>");
	        	$('.thread_wrapper'+msgId).removeClass( "collapse" ).addClass( "collapse in" );
	        	$('.thread_wrapper'+msgId).append(threadDiv);

	        	// "<a href='#thread_wrapper"+msgId+"' class='repliesCount repliesCount"+msgId+"' id='"+msgId+"' data-toggle='collapse ' style='margin-left:1%;text-decoration:none;'>Replies(2)</a>";
	        	$('.repliesCount'+msgId).html('Comments('+data[0]+')');
	        	$('form').find('input[type=text]').val('');
	        	


	        	// var url = "./index.php?channel="+convertedJSON['channel'];
	         //     window.location.href = url;
	            /// Send Email to professor
	        }
    	});
	    console.log(convertedJSON);
	});

// image upload into channel


    

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
	$('.documentSubmit').on('click', function() {
    	$('#documentUpLoadModal input[type=submit]').trigger('click');
	});
    //image upload code end


    // LoginActivity starts
    function logInActivityLineChart(){
    	// Set the dimensions of the canvas / graph
	var margin = {top: 30, right: 20, bottom: 30, left: 50},
	    width = 400 - margin.left - margin.right,
	    height = 300 - margin.top - margin.bottom;

	// Parse the date / time
	var parseDate = d3.time.format("%d-%b-%y").parse;

	// Set the ranges
	var x = d3.time.scale().range([0, width]);
	var y = d3.scale.linear().range([height, 0]);

	// Define the axes
	var xAxis = d3.svg.axis().scale(x)
	    .orient("bottom").ticks(5);

	var yAxis = d3.svg.axis().scale(y)
	    .orient("left").ticks(5);


	// Define the line
	var valueline = d3.svg.line()
	    .x(function(d) { return x(d.date); })
	    .y(function(d) { return y(d.count); });
	    
	// Adds the svg canvas
	var svg = d3.select("#logInActivityLineChart")
	    .append("svg")
	        .attr("width", width + margin.left + margin.right)
	        .attr("height", height + margin.top + margin.bottom)
	    .append("g")
	        .attr("transform", 
	              "translate(" + margin.left + "," + margin.top + ")");

	// Get the data
		$.ajax({
				async:false,
		        url: 'sqlQueries.php',
		        type: 'post',
		        data: {'loginActivityLog':0},
		        dataType: 'json',
		        success: function (data) {	
	    		  	data.forEach(function(d) {
	    		  			d.date = parseDate(d['time'].split(" ")[0]);
			        		d.count = +d['count'];
			        		console.log(d);

	    		  		});
				    // Scale the range of the data
	    x.domain(d3.extent(data, function(d) { return d.date; }));
	    y.domain([0, d3.max(data, function(d) { return d.count; })]);

	    var tip = d3.tip()
		.attr('class', 'd3-tip')
		.offset([-10, 0])
		.html(function(d) {
		 		  return "<strong  style='font-size: 10px'>Login Day: </strong> <span style='font-size:10px;font-style: italic;color:red'>" + d.time+ "</span><br><strong style='font-size: 10px'>No.of Times:</strong><span style='font-size:10px;font-style: italic;color:red'>"+d.count+"</span>";
		});
		svg.call(tip);
	    // Add the valueline path.
	    svg.append("path")
	        .attr("class", "line")
	        .attr("d", valueline(data));

	    // Add the scatterplot
	    svg.selectAll("dot")
	        .data(data)
	      	.enter().append("circle")
	        .attr("r", 2.5)
	        .attr("cx", function(d) { return x(d.date); })
	        .attr("cy", function(d) { return y(d.count); })
	        .style("cursor", "pointer")
	        .on("mouseover",tip.show)
	 		.on('mouseout', tip.hide);
	    // Add the X Axis
	    svg.append("g")
	        .attr("class", "x axis")
	        .style("font-size", "1vh")
	        .attr("transform", "translate(0," + height + ")")
	        .call(xAxis);
	    // text label for the x axis
  		svg.append("text")             
	      .attr("transform",
	            "translate(" + (width/2) + " ," + 
	                           (height + margin.top-2) + ")")
	      .style("text-anchor", "middle")
	      .style("font-size", "1vh")
	      .text("Time stamp");
	    // text label for the y axis
	    svg.append("text")
	      .attr("transform", "rotate(-90)")
	      .attr("y", 0 - margin.left)
	      .attr("x",0 - (height / 2))
	      .attr("dy", "1em")
	      .style("font-size", "1vh")
	      .style("text-anchor", "middle")
	      .text("Number of times User Login"); 
	    // Add the Y Axis
	    svg.append("g")
	        .attr("class", "y axis")
	        .style("font-size", "1vh")
	        .call(yAxis);

				}
		        
		});
		//end of LoginActivity
    }


});
function logInActivityPieChart(){
var w = 300,                        //width
    h = 300,                            //height
    r = 100,                           //radius
    color = d3.scale.category20c();     //builtin range of colors
	$.ajax({
		async:false,
        url: 'sqlQueries.php',
        type: 'post',
        data: {'loginActivityPieChart':0},
        dataType: 'json',
        success: function (counts) {


    data = [{"label":"Messages("+counts[0]+"%)", "value":counts[0]}, 
            {"label":"Threads("+counts[1]+"%)", "value":counts[1]}, 
            {"label":"Reaction("+counts[2]+"%)", "value":counts[2]}];
    
    var vis = d3.select("#logInActivityPieChart")
        .append("svg:svg")              //create the SVG element inside the <body>
        .data([data])                   //associate our data with the document
            .attr("width", w)           //set the width and height of our visualization (these will be attributes of the <svg> tag
            .attr("height", h)
        .append("svg:g")                //make a group to hold our pie chart
            .attr("transform", "translate(" + r + "," + r + ")")    //move the center of the pie chart from 0, 0 to radius, radius

    var arc = d3.svg.arc()              //this will create <path> elements for us using arc data
        .outerRadius(r);

    var pie = d3.layout.pie()           //this will create arc data for us given a list of values
        .value(function(d) { return d.value; });    //we must tell it out to access the value of each element in our data array

    var arcs = vis.selectAll("g.slice")     //this selects all <g> elements with class slice (there aren't any yet)
        .data(pie)                          //associate the generated pie data (an array of arcs, each having startAngle, endAngle and value properties) 
        .enter()                            //this will create <g> elements for every "extra" data element that should be associated with a selection. The result is creating a <g> for every object in the data array
            .append("svg:g")                //create a group to hold each slice (we will have a <path> and a <text> element associated with each slice)
                .attr("class", "slice");    //allow us to style things in the slices (like text)

        arcs.append("svg:path")
                .attr("fill", function(d, i) { return color(i); } ) //set the color for each slice to be chosen from the color function defined above
                .attr("d", arc);                                    //this creates the actual SVG path using the associated data (pie) with the arc drawing function

        arcs.append("svg:text")                                     //add a label to each slice
                .attr("transform", function(d) {                    //set the label's origin to the center of the arc
                //we have to make sure to set these before calling arc.centroid
                d.innerRadius = 0;
                d.outerRadius = r;
                return "translate(" + arc.centroid(d) + ")";        //this gives us a pair of coordinates like [50, 50]
            })
            .attr("text-anchor", "middle")
            .style("font-size","1vh")                          //center the text on it's origin
            .text(function(d, i) { return data[i].label; });        //get the label from our original data array


        }
    });

}

function reCaptchad(){
		document.getElementById("myButton").disabled = false;
}
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
        //openDropdown.classList.remove('show');
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
	        	var string ="";
	        	var like = "<i class='fa fa-thumbs-o-up' style='font-size:170%;'></i>";
	        	var disLike ="<i class='fa fa-thumbs-o-down' style='font-size:170%;'></i>";
	        	if(data[4]==1){
	        		string+="<i class='fa fa-thumbs-up' style='color: #3697e1;font-size:180%;'></i>";
	        		$(".likeIcon"+msg_id).html(string);
	        		$(".dislikeIcon"+msg_id).html(disLike);
	        	}else if(data[4]==2){
	        		string+="<i class='fa fa-thumbs-down' style='color: #3697e1;font-size:180%;'></i>";
	        		$(".likeIcon"+msg_id).html(like);
	        		$(".dislikeIcon"+msg_id).html(string);

	        	}else{
	        		$(".likeIcon"+msg_id).html(like);
	        		$(".dislikeIcon"+msg_id).html(disLike);
	        	}
	        	// if(data[4]==1){
	        	// 	string+="<label class = ' likeIcon likeIcon"+msg_id+"' data-toggle='tooltip' title='' style='font-size:24px' emoji_id = '1' name = 'like' id ='"+msg_id+"' onclick='reactionFunction("+msg_id+",\""+user_email+"\",1)'><i class='fa fa-thumbs-up' style='color: #3697e1;;'></i></label><label class='likeCount"+msg_id+"'>"+data[0]+"</label>";
	        	// 	$(".likeIcon "+msg_id).html(string);
	        	// }else if(data[4]==2){
	        	// 	string+="<label class = ' dislikeIcon  dislikeIcon "+msg_id+"' data-toggle='tooltip' title='' style='font-size:24px' emoji_id = '1' name = 'like' id ='"+msg_id+"' onclick='reactionFunction("+msg_id+",\""+user_email+"\",2)'><i class='fa fa-thumbs-down' style='color: #3697e1;'></i></label><label class='dislikeCount"+msg_id+"'>"+data[1]+"</label>";
	        	// 	$(".dislikeIcon "+msg_id).html(string);
	        	// }else{
	        	// 	string+="<label class = ' likeIcon likeIcon"+msg_id+"' data-toggle='tooltip' title='' style='font-size:24px' emoji_id = '1' name = 'like' id ='"+msg_id+"' onclick='reactionFunction("+msg_id+",\""+user_email+"\",1)'><i class='fa fa-thumbs-o-up'></i></label><label class='likeCount"+msg_id+"'>"+data[0]+"</label>";
    		  		// string+="<label class = ' dislikeIcon  dislikeIcon "+msg_id+"' data-toggle='tooltip' title='' style='font-size:24px' emoji_id = '1' name = 'like' id ='"+msg_id+"' onclick='reactionFunction("+msg_id+",\""+user_email+"\",2)'><i class='fa fa-thumbs-o-down'></i></label><label class='dislikeCount"+msg_id+"'>"+data[1]+"</label>";
	        	// }
        		$('div.reaction label.likeCount'+msg_id).text(data[0]);
        		$('div.reaction label.dislikeCount'+msg_id).text(data[1]); 
        		// $('div.reaction label.likeIcon'+msg_id).attr('title',data[2]);
        		// $('div.reaction label.dislikeIcon'+msg_id).attr('title',data[3]);
	        }
	        
	    });
}
