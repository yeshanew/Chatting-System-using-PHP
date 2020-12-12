function formsubmit() {
    var msg = document.getElementById('msg').value;

    //store all the submitted data in astring.
 var formdata = '&msg=' + msg;
	// validate the form input
	
	if (msg == '' ) {
		alert("Please Enter your message");
		return false;
	}
	else {
	// AJAX code to submit form.
	$.ajax({
		 type: "POST",
		 url: "user_message.php", //call storeemdata.php to store form data
		 data: formdata,
		 cache: false,
		 success: function(html) {
		  //alert(html);
		  //setInterval('location.reload()', 1000); 
		 }
	});
	$(document).ready(function(){
    $(".btn").click(function(){
        $("#chatForm").trigger("reset");
    });
});

		}

	return false;
}
