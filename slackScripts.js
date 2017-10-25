$(document).ready(function () {
 $(".modal-body-result").hide();

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
	        	// console.log(data);
	        	// $(".modal-body").hide();
	        	// $('.modal-body-result.para').text(data);
	        	// $(".modal-body-result").show();
	        	// console.log(data);
	          
	        }
	        
	    });
	 });

});