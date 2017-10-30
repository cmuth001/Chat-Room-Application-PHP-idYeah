$(document).ready(function () {
 	$(".modal-body-result").hide();
  	$('[data-toggle="tooltip"]').tooltip();
	$( ".channelButton" ).on("click",function(e) {

	    var channelName = document.getElementById("channelName").value;
		var purpose = document.getElementById("purpose").value;
		var private1 = document.getElementById("private").checked ;
		var public1 = document.getElementById("public").checked ;
		var radioButtonValue = (private1===false)?0:1;
		var dataString = {'channelName':channelName, 'purpose':purpose, 'radioButtonValue':radioButtonValue};
	    $.ajax({
	        url: 'createChannel.php',
	        type: 'post',
	        data: {'data':dataString},
	        dataType: 'text',
	        success: function (data) {
	        	console.log(data);
	        	// $(".modal-body").hide();
	        	// $('.modal-body-result.para').text(data);
	        	// $(".modal-body-result").show();
	        	console.log(data);
	          
	        }
	        
	    });
	 });

	$(document).on('click','.replyMsgIcon',function(e){

		//$(".replyMsg"+e.currentTarget.id).show();
		 $(".replyMsg"+e.currentTarget.id).toggle();
		// $("#message_container").css({
  //           width:"60%"
  //       });
  //       $("#footer").css({
  //           width:"60%"
  //       });
  //       document.body.innerHTML += '<div style="float:right;width:30%;height:90%;opacity:0.3;z-index:100;background:#000;">Thread</div>';


	});
	// $(document).on('click','.imgUpload',function(e){
	// 	var myForm = document.getElementById('imgForm');
	//    	var formData = new FormData(myForm),
	//    	convertedJSON = {},
	//    	it = formData.entries(),
	//    	n;
	//    	while(n = it.next()) {
	//       	if(!n || n.done) break;
	//       	convertedJSON[n.value[0]] = n.value[1];
	//     }
	//   	$.ajax({
	//         url: 'uploadImage.php',
	//         type: 'post',
	//         data: {'image':convertedJSON},
	//         dataType: 'text',
	//         success: function (data) {
	//         	console.log(data);
	//         	//var url = "./index.php?channel="+convertedJSON['channel'];
	//              //window.location.href = url;
	//             /// Send Email to professor
	//         }
 //    	});

	// });
	
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
	        dataType: 'text',
	        success: function (data) {
	        	console.log(data);
	        	var url = "./index.php?channel="+convertedJSON['channel'];
	             window.location.href = url;
	            /// Send Email to professor
	        }
    	});
	    console.log(convertedJSON);
	});

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
	        }
	        
	    });
}