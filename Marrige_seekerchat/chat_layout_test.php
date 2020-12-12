
<?php
include('../db_config.php');
include('Chat_session.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Serdo Market</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link rel="stylesheet" href="css/all.css">
  <script src="js/jquery.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/fontawesome.js"></script>
</head>
<body>
<!-- Ads bar and nav bar-->
 <?php include 'marriageSeeker_top.php';?>
<!-- Body --> 
  <div class="container-fluid bg-light" style="padding-top: 15px; padding-bottom: 15px;">
    <div class="row">
      <div class="ol-lg-3 col-md-3 col-sm-12" style="background-color:lavender;">
        <?php include 'marriageSeeker_page.php';?>
      </div>
      <div class="col-lg-9 col-md-9 col-sm-12" style="background-color:dark;">
 <?php include 'chat_message.php';?>=====================================================-->
    </div>
    </div>
  </div>
<!-- Footer-->
<?php include 'footer.php';?>

</body>
<!-- Mirrored from www.w3schools.com/bootstrap4/tryit.asp?filename=trybs_navbar_brand&stacked=h by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 21 Nov 2019 18:06:37 GMT -->
</html>