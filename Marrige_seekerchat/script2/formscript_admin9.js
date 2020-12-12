function formsubmit() {
    var msg = document.getElementById('msg').value;
    var user = document.getElementById('user').value;
    //store all the submitted data in astring.
 var formdata = '&msg=' + msg + '&user=' + user;
	// validate the form input
	
	if (msg == '' ) {
		alert("please enter your message....");
		return false;
	}
	else {
	// AJAX code to submit form.
	$.ajax({
		 type: "POST",
		 url: "admin_message.php", //call storeemdata.php to store form data
		 data: formdata,
		 cache: false,
		 success: function(html) {
		  //alert(html);
		  setInterval('location.reload()', 1000); 
		 }
	});
	$(document).ready(function(){
    $(".btn").click(function(){
        $("#chatForm").trigger("reset");
    });
});
$(document).ready(function(){
 $('#div1').animate({ scrollTop: d.prop('scrollHeight') }, 1000);
});
		}

	return false;
}
