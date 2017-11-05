$(document).ready(function () {
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
		        	//$('.errorMsg').innerHTML=data;
		   	//      	var url = 'index.php';
					// window.location.href = url;
		          
		        }
	        
	    });
	 });


	$(document).on('click','.replyMsgIcon',function(e){

		//$(".replyMsg"+e.currentTarget.id).show();
		 $(".replyMsg"+e.currentTarget.id).toggle();
		

	});
	$(document).on('click','.repliesCount',function(e){

		//$(".replyMsg"+e.currentTarget.id).show();
		 $(".replyMsg"+e.currentTarget.id).toggle();
		

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
	        	var msgId = convertedJSON['msgId'];
	        	var image = convertedJSON['user'];
	        	var user = convertedJSON['display_name'];
	        	var channelId = convertedJSON['channel_id'];
	        	var message = convertedJSON['message'];
	        	var threadDiv = "<div id ='"+msgId+"' class='thread'><img src='./assets/images/"+image+".png'"+" alt='Contact_Img' class='contact_Img'><a href= ''>"+user+"</a><label class = 'timeStamp'></label><div class= 'textMessage'><span>"+message+"</span></div></div>";
	        	console.log(threadDiv);
	        	//$('.thread_wrapper'+msgId).append("<div class='thread'><img src='./assets/images/cmuth001@odu.edu.png' alt='Contact_Img' class='contact_Img'></div>");
	        	
	        	$('.thread_wrapper'+msgId).append(threadDiv);
	        	$('.repliesCount'+msgId).html('Replies('+data[0]+')');
	        	$('form').find('input[type=text]').val('');
	        	


	        	// var url = "./index.php?channel="+convertedJSON['channel'];
	         //     window.location.href = url;
	            /// Send Email to professor
	        }
    	});
	    console.log(convertedJSON);
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

        		    console.log(JSON.parse(data)); 
        		    console.log("");

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


        		    console.log(JSON.parse(data)); 
        		    console.log("");

	    		}
	    	});
  // $('#tokenfield').tokenfield();
  // {
  		
  //     autocomplete: {
  //       source: ['red','blue','green','yellow','violet','brown','purple','black','white'],
  //       delay: 100
  //     },
  //     showAutocompleteOnFocus: true
  //   });
    
    // $("form").submit(function(e) {
    //     e.preventDefault();
    //     $('.form-data').text( $('#tokenfield').val());
    // });
});
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