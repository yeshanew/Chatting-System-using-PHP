<?php
  $username1=$_SESSION['username_session'];
  $sql = "select * FROM user_account WHERE email='$username1'"; 
  $result = mysqli_query($con,$sql);  
$row1 = mysqli_fetch_array($result);
	    ?>
		
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Serdo Market</title>
  <title>Serdo Market</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/font-awesome.min.css">
  <link rel="stylesheet" href="../css/all.css">
  <script src="/../js/jquery.min.js"></script>
  <script src="/../js/popper.min.js"></script>
  <script src="/../js/bootstrap.min.js"></script>
  <script src="/../js/fontawesome.js"></script>
  <style type="text/css">
    .change_color:hover {
      background-color: #d1d1e0;
      color: white;
    }
  </style>
<script src="jquery.js" type="text/javascript" charset="utf-8"></script>
<script>
   function waitForMsg() {
       $.ajax({

           type: "GET",

           url: "get_online.php",

           async: true,

           cache: false,

           timeout: 50000,

           success: function (data) {

                   $('#online').html(data);

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

   function message() {
       $.ajax({

           type: "GET",

           url: "get_message.php",

           async: true,

           cache: false,

           timeout: 50000,

           success: function (data) {

                   $('#message').html(data);

               setTimeout(

                       message,

                       2000

                       );

},

           error: function (XMLHttpRequest, textStatus, errorThrown) {

               addmsg("error", textStatus + " (" + errorThrown + ")");

               setTimeout(

                       message,

                       15000);

           }

       });

   };


   $(document).ready(function () {

       message();

   });

</script>
</head>
<body>
<!-- Ads bar -->
<div class="container-fluid bg-light" style="padding-top: 15px;">
</div>
<div class="container-fluid" style="position: -webkit-sticky; position: sticky; top: 0; z-index: 50;  padding-top: 0px; padding-bottom: 5px; background-color:#003333;">
  <nav class="navbar navbar-expand-sm bg-dark navbar-dark justify-content-end">
      <a class="navbar-brand" href="#"><?php echo $row1["email"]; ?></a>
      <button class="btn btn-dark ml-auto mr-1"></button>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
          <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse flex-grow-0" id="navbarSupportedContent">
          <ul class="navbar-nav bg-dark">
                <li class="nav-item">
                  <a href="marriageSeeker_home.php" class="nav-link text-white" style="font-size: 15px;">Home</a>
                </li>
                </li>
				  <li class="nav-item">
                 <a href="chat_message.php" class="nav-link text-white" style="font-size: 15px; padding-right: 25px;">Message (<span style=color:red id="message"></span>)</a>
                </li>
                <li class="nav-item">
                 <a href="marriageSeeker_home.php" class="nav-link text-white" style="font-size: 15px; padding-right: 25px;">Online (<span style=color:red id="online"></span>)</a>
                </li>
				 <li class="nav-item">
                  <a href="#.php" class="nav-link text-white" style="font-size: 15px;">Update profile</a>
                </li>
					<li class="nav-item">
                  <a href="#.php" class="nav-link text-white" style="font-size: 15px;">Change Password</a>
				                <li class="nav-item">
                 <a href="logout.php" class="nav-link text-white" style="font-size: 15px; padding-right: 25px;">Logout</a>
                </li>
             
          </ul>
      </div>
  </nav>
  <hr style="background-color: white;">
</div>
<!-- Top nav bar -->
<div class="container-fluid" style="background-color:#003333;">
 
</div>
</body>
</html>