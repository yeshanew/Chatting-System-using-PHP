function formsubmit() {
    var msg = document.getElementById('msg').value;

    //store all the submitted data in astring.
 var formdata = '&msg=' + msg;
	// validate the form input
	
	if (msg == '' ) {
		alert("Please Enter Employee Name");
		return false;
	}
	else {
	// AJAX code to submit form.
	$.ajax({
			
		 type: "POST",
		 url: "add.php", //call storeemdata.php to store form data
		 data: formdata,
		 cache: false,
		 success: function(html) {
		  alert(html);
		 }
		 $(document).ready(function(){
    $(".btn").click(function(){
        $("#chatForm").trigger("reset");
    });
});
	});
		}

	return false;
}
