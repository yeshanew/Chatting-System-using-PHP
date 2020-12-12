<?php
include('db_config.php');
include('Chat_session.php');
$username=$_SESSION['username_session'];
include('online_user.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Serdo Market</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<!-- Ads bar and nav bar-->
<?php include 'marriageSeeker_top.php';?>
<?php include 'marriageSeeker_page.php';?>

<!-- Footer-->
<?php include ('footer.php');?>
</body>
</html>