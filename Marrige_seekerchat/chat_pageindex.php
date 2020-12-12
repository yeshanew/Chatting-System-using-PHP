<?php if(isset($_GET['image_id']))
{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Simple Notification</title>

<script src="jquery.js" type="text/javascript" charset="utf-8"></script>

<script>

   function waitForMsg() {



       $.ajax({

           type: "GET",

           url: "chat_page.php",

           async: true,

           cache: false,

           timeout: 50000,

           success: function (data) {

                   $('#noti').html(data);

               setTimeout(

                       waitForMsg,

                       2000

                       );

},

           error: function (XMLHttpRequest, textStatus, errorThrown) {

               addmsg("error", textStatus + " (" + errorThrown + ")");

               setTimeout(

                       waitForMsg,

                       15000);

           }

       });

   };



   $(document).ready(function () {

       waitForMsg();

   });

</script>

</head>

<body>

<br />

<hr>

No of Notification (<span id="noti"></span>)

<hr>

</body>

</html>
<?php
}
?>

