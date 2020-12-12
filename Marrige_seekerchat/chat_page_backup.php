<?php
error_reporting(0);
require_once __DIR__ . '/../db_config.php';
require_once __DIR__ . '/Chat_session.php';
$username=$_SESSION['username_session'];
include('online_user.php');
$current_date= date("Y-m-d H:i:s");
function getExtension($str)
{
    $i = strrpos($str, ".");
    if (!$i) {
        return "";
    }

    $l = strlen($str) - $i;
    $ext = substr($str, $i+1, $l);
    return $ext;
}

if(isset($_GET['image_id'])) {
    $sql = "SELECT * FROM user_account WHERE imageId=" . $_GET['image_id'];
    $result = mysqli_query($con,$sql) or die("<b>Error:</b> <br/>" . mysqli_error($con));
    $row = mysqli_fetch_array($result);
	$receiver_email=$row["email"];
	$update_query="UPDATE chat SET visibility='1' WHERE sender_email='$receiver_email'and receiver_email='$username'";
	$update_result = mysqli_query($con,$update_query) or die("<b>Error:</b><br/>" .        
    mysqli_error($con));
	$text_counter=0;
if (isset($_POST['send'])) {
$message_type=$_POST['message_type'];
$message_content=$_POST['message_content'];
$query = "INSERT INTO chat (message_id,sender_email,receiver_email,text_content,message_type,date)
            VALUES ('','$username','$receiver_email','$message_content','$message_type','$current_date')";
$insertion_result = mysqli_query($con,$query) or die("<b>Error:</b>  The message  is not attached<br/>" .        
    mysqli_error($con));
if(isset($insertion_result)) {
//
}		
}

if (isset($_POST['send_image'])) {
    $valid_formats = array("jpg", "png", "gif", "bmp","jpeg","PNG","JPG","JPEG","GIF","BMP");
if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {
    $name = $_FILES['photo']['name'];
    $size = $_FILES['photo']['size'];
            
    if (strlen($name)) {
        $ext = getExtension($name);
        if (in_array($ext, $valid_formats)) {
            if ($size<(1024*1024)) {
                require_once('class.ImageFilter.php');
                $filter = new ImageFilter;
                $score = $filter->GetScore($_FILES['photo']['tmp_name']);
                            
                if (isset($score)) {
                    if ($score >= 40) {
                        echo " Not supported, it seems that you have uploaded a nude  and unethical picture!";
                    } else {
                            
                        //---------
                        if(count($_FILES) > 0) {
                        if(is_uploaded_file($_FILES['photo']['tmp_name'])) {
                        $name = mysqli_real_escape_string($con,$_FILES['photo']['name']);
                        $message_type=$_POST['image']; 
                        $imgData =addslashes(file_get_contents($_FILES['photo']['tmp_name']));
                        $imageProperties = getimageSize($_FILES['photo']['tmp_name']);
                      $sql = "INSERT INTO chat(message_id,imagetype ,image,sender_email,receiver_email,name,message_type,date)
    VALUES('','{$imageProperties['mime']}', '{$imgData}','$username','$receiver_email','$name','$message_type','$current_date')";
                  $insertion_result= mysqli_query($con,$sql) or die("<b>Error:</b> Sorry! THe photo has not sent.<br/>" .        

    mysqli_error($con));
if(isset($insertion_result)) {
//
}
}
}
                        //--------
                    }
                }
            } else {
                echo "Image file size max 1 MB";
            }
        } else {
            echo "Invalid file format..";
        }
    } else {
        echo "Please select image..!";
    }
                
    //exit;
}
}

if (isset($_POST['attach_file'])) {
if($_FILES['attach']['error'] == 0) {
	
$valid_formats = array("jpg", "png", "gif", "bmp","jpeg","PNG","JPG","JPEG","GIF","BMP");
if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {
    $name = $_FILES['attach']['name'];
    $size = $_FILES['attach']['size'];
            
    if (strlen($name)) {
        $ext = getExtension($name);
        if (in_array($ext, $valid_formats)) {
            echo "This is image, please send fle";
        } else {
            
	// file sender		
$message_type=$_POST['attachment'];
$name = mysqli_real_escape_string($con,$_FILES['attach']['name']);
$mime = mysqli_real_escape_string($con,$_FILES['attach']['type']);
$data =mysql_real_escape_string(file_get_contents($_FILES['attach']['tmp_name'], 'scholarship_docs/$name'));
$size = intval($_FILES['attach']['size']);
$query = "INSERT INTO chat (message_id,sender_email,receiver_email,name,mime, size,data,message_type,date)
            VALUES ('','$username','$receiver_email','$name','$mime', '{$size}', '{$data}','$message_type','$current_date')";
$insertion_result = mysqli_query($con,$query) or die("<b>Error:</b>  file is not attached<br/>" .        
    mysqli_error($con));
if(isset($insertion_result)) {
//
}		
			
			
        }
    } else {
        echo "Please select image..!";
    }
                
    //exit;
}
}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Inbox</title>
    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/theme_2.css" rel="stylesheet" media="all">
<style>
.fileUpload {
	position: relative;
	overflow: hidden;
	margin: 10px;
	background-color: #BDBDBD;
	height: 30px;
	width: 40px;
	text-align: center;
}
.fileUpload input.upload {
	position: absolute;
	top: 0;
	right: 0;
	margin: 0;
	padding: 0;
	font-size: 20px;
	cursor: pointer;
	opacity: 0;
	filter: alpha(opacity=0);
	height: 100%;
	text-align: center;
}
</style>
</head>

<body class="animsition">
 <?php include 'marriageSeeker_top.php';?>
    <div class="page-wrapper">
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-6"style="  display: block;
  position: fixed;
  bottom: 10;
  height:500px;
  right: 15px;
  border: 3px solid #f1f1f1;
  z-index: 9;">
                                <div class="au-card au-card--no-shadow au-card--no-pad m-b-40">
                                    <div class="au-inbox-wrap js-inbox-wrap">
                                                                               <div class="au-chat">
                                            <div class="au-chat__title">
                                                <div class="au-chat-info">
												<?php $offline_sql = "select * FROM offline  WHERE username='$receiver_email'"; 
                                        $offline_result= mysqli_query($con,$offline_sql);
                                        $offline_row = mysqli_fetch_array($offline_result);
									    $refresh_date=$offline_row ['refresh_date'];
																						 // minute
										$minute_sql="SELECT TIMESTAMPDIFF(minute,'$refresh_date','$current_date') as minute_difference";
										$minute_result = mysqli_query($con,$minute_sql)or die("<b>Error:</b> <br/>" . mysqli_error($con));
										$minute_row = mysqli_fetch_array($minute_result);
										$min_diff=$minute_row['minute_difference']-$current_date;
												 // hour
										$hour_sql="SELECT TIMESTAMPDIFF(hour,'$refresh_date','$current_date') as hour_difference";
										$hour_result = mysqli_query($con,$hour_sql)or die("<b>Error:</b> <br/>" . mysqli_error($con));
										$hour_row = mysqli_fetch_array($hour_result);
										$hour_diff=$hour_row['hour_difference']-$current_date;
										if($min_diff<3 and $hour_diff>1){
										?>
										
                                                    <div class="avatar-wrap online">
                                                        <div class="avatar avatar--small">
                                                            <img src="user_account_photo.php?image_id=<?php echo $row["imageId"]; ?> "width="120" height='130'/>
                                                        </div>
                                                    </div>
										<?php
										}
										else
										{
											?>
									  <div class="avatar-wrap">
                                                        <div class="avatar avatar--small">
                                                            <img src="user_account_photo.php?image_id=<?php echo $row["imageId"]; ?> "width="120" height='130'/>
                                                        </div>
                                                    </div>
										<?php
										}?>
											
											
                                                    <span class="nick">
                                                        <a href="#"><?php echo $row["fname"]." ".$row["mname"]; ?></a>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="au-chat__content" style="  position: relative;
  height:150px;
  z-index: 9;">
											<?php
										
										$send_query = "SELECT * FROM chat WHERE sender_email='$username' and receiver_email='$receiver_email' " ;
                                        $send_result = mysqli_query($con,$send_query) or die("<b>Error:</b> <br/>" . mysqli_error($con));
										$message_counter = mysqli_num_rows($send_result);
									   $conversation = "SELECT * FROM chat" ;
                               $conversation_result = mysqli_query($con,$conversation ) or die("<b>Error:</b> <br/>" . mysqli_error($con));
	                         while($conversation_row  = mysqli_fetch_array($conversation_result)) {
		                    ?>
                                                <div class="recei-mess-wrap">
                                                    <div class="recei-mess__inner">
													<?php if(($conversation_row["sender_email"]==$receiver_email) and ($conversation_row["receiver_email"]==$username))
														{
                                                        echo'<div class="avatar avatar--tiny">';?>
                                                           <img src="user_account_photo.php?image_id=<?php echo $row["imageId"]; ?> "width="120" height='130'/>
                                                        <?php 
														echo'</div>';
                                                        echo'<div class="recei-mess-list">';
												$messaged_date=$conversation_row ["date"];	
												 // minute
												 $minute_sql="SELECT TIMESTAMPDIFF(minute,'$messaged_date','$current_date') as minute_difference";
												 $minute_result = mysqli_query($con,$minute_sql)or die("<b>Error:</b> <br/>" . mysqli_error($con));
												 $minute_row = mysqli_fetch_array($minute_result);
												 // hour
												 $hour_sql="SELECT TIMESTAMPDIFF(hour,'$messaged_date','$current_date') as hour_difference";
												 $hour_result = mysqli_query($con,$hour_sql)or die("<b>Error:</b> <br/>" . mysqli_error($con));
												 $hour_row = mysqli_fetch_array($hour_result);
												 // day
												 $day_sql="SELECT TIMESTAMPDIFF(day,'$messaged_date','$current_date') as day_difference";
												 $day_result = mysqli_query($con,$day_sql)or die("<b>Error:</b> <br/>" . mysqli_error($con));
												 $day_row = mysqli_fetch_array($day_result);
												 //month
												 $month_sql="SELECT TIMESTAMPDIFF(month,'$messaged_date','$current_date') as month_difference";
												 $month_result = mysqli_query($con,$month_sql)or die("<b>Error:</b> <br/>" . mysqli_error($con));
												 $month_row = mysqli_fetch_array($month_result);
												 //year
												 $year_sql="SELECT TIMESTAMPDIFF(year,'$messaged_date','$current_date') as year_difference";
												 $year_result = mysqli_query($con,$year_sql)or die("<b>Error:</b> <br/>" . mysqli_error($con));
												 $year_row = mysqli_fetch_array($year_result);
														   if($year_row['year_difference']>1){
															   $year=$year_row['year_difference'];	
															   if($conversation_row["message_type"]=="text"){
                                                               echo' <div class="recei-mess">'.$conversation_row["text_content"].'</div>';	
															   }
                                                               if($conversation_row["message_type"]=="attachment"){
															  echo" <div class='send-messx'><a href='Download.php?id={$conversation_row['message_id']}'>{$conversation_row['name']}</a></div>";
															   }
															   if($conversation_row["message_type"]=="image"){
															   echo "<img src='chat_photo.php?id={$conversation_row['message_id']}' width='200' height='130'/>";
															   }
															   echo'<span class="mess-time">'.$conversation_row ["date"].'</span><br>';
															   echo'<span class="mess-time">'.$year.' Years ago</span>';
														   }
														   if($year_row['year_difference']==1){
															   if($conversation_row["message_type"]=="text"){
                                                               echo' <div class="recei-mess">'.$conversation_row["text_content"].'</div>';	
															   }
                                                               if($conversation_row["message_type"]=="attachment"){
															  echo" <div class='send-messx'><a href='Download.php?id={$conversation_row['message_id']}'>{$conversation_row['name']}</a></div>";
															   }
															   if($conversation_row["message_type"]=="image"){
															   echo "<img src='chat_photo.php?id={$conversation_row['message_id']}' width='200' height='130'/>";
															   }
															   echo'<span class="mess-time">'.$conversation_row ["date"].'</span><br>';
															   echo'<span class="mess-time"> 1 Year ago</span>';
														   }
														   else if($month_row['month_difference']>1){
															   $month=$month_row['month_difference'];
															   if($conversation_row["message_type"]=="text"){
                                                               echo' <div class="recei-mess">'.$conversation_row["text_content"].'</div>';	
															   }
                                                               if($conversation_row["message_type"]=="attachment"){
															  echo" <div class='send-messx'><a href='Download.php?id={$conversation_row['message_id']}'>{$conversation_row['name']}</a></div>";
															   }
															   if($conversation_row["message_type"]=="image"){
															   echo "<img src='chat_photo.php?id={$conversation_row['message_id']}' width='200' height='130'/>";
															   }
															    echo'<span class="mess-time">'.$conversation_row ["date"].'</span><br>';
															    echo'<span class="mess-time">'.$month.' Months ago</span>';
														   }
														    else if($month_row['month_difference']==1){
															if($conversation_row["message_type"]=="text"){
                                                               echo' <div class="recei-mess">'.$conversation_row["text_content"].'</div>';	
															   }
                                                               if($conversation_row["message_type"]=="attachment"){
															  echo" <div class='send-messx'><a href='Download.php?id={$conversation_row['message_id']}'>{$conversation_row['name']}</a></div>";
															   }
															   if($conversation_row["message_type"]=="image"){
															   echo "<img src='chat_photo.php?id={$conversation_row['message_id']}' width='200' height='130'/>";
															   }
																echo'<span class="mess-time">'.$conversation_row ["date"].'</span><br>';
															    echo'<span class="mess-time"> 1 Month ago</span>';
														   }
														   else if($day_row['day_difference']>1){
															   $day=$day_row['day_difference'];
															if($conversation_row["message_type"]=="text"){
                                                               echo' <div class="recei-mess">'.$conversation_row["text_content"].'</div>';	
															   }
                                                               if($conversation_row["message_type"]=="attachment"){
															  echo" <div class='send-messx'><a href='Download.php?id={$conversation_row['message_id']}'>{$conversation_row['name']}</a></div>";
															   }
															   if($conversation_row["message_type"]=="image"){
															   echo "<img src='chat_photo.php?id={$conversation_row['message_id']}' width='200' height='130'/>";
															   }
															   echo'<span class="mess-time">'.$conversation_row ["date"].'</span><br>';
															   echo'<span class="mess-time">'.$day.' Days ago</span>';
														   }
														   else if($day_row['day_difference']==1){
															if($conversation_row["message_type"]=="text"){
                                                               echo' <div class="recei-mess">'.$conversation_row["text_content"].'</div>';	
															   }
                                                               if($conversation_row["message_type"]=="attachment"){
															  echo" <div class='send-messx'><a href='Download.php?id={$conversation_row['message_id']}'>{$conversation_row['name']}</a></div>";
															   }
															   if($conversation_row["message_type"]=="image"){
															   echo "<img src='chat_photo.php?id={$conversation_row['message_id']}' width='200' height='130'/>";
															   }
															   echo'<span class="mess-time">'.$conversation_row ["date"].'</span><br>';
															   echo'<span class="mess-time"> 1 Day ago</span>';
														   }
														   else if($hour_row['hour_difference']>1){
															   $hour=$hour_row['hour_difference'];
															if($conversation_row["message_type"]=="text"){
                                                               echo' <div class="recei-mess">'.$conversation_row["text_content"].'</div>';	
															   }
                                                               if($conversation_row["message_type"]=="attachment"){
															  echo" <div class='send-messx'><a href='Download.php?id={$conversation_row['message_id']}'>{$conversation_row['name']}</a></div>";
															   }
															   if($conversation_row["message_type"]=="image"){
															   echo "<img src='chat_photo.php?id={$conversation_row['message_id']}' width='200' height='130'/>";
															   }
															   echo'<span class="mess-time">'.$hour.' Hours ago</span>';
														   }
														   else if($hour_row['hour_difference']==1){
															  if($conversation_row["message_type"]=="text"){
                                                               echo' <div class="recei-mess">'.$conversation_row["text_content"].'</div>';	
															   }
                                                               if($conversation_row["message_type"]=="attachment"){
															  echo" <div class='send-messx'><a href='Download.php?id={$conversation_row['message_id']}'>{$conversation_row['name']}</a></div>";
															   }
															   if($conversation_row["message_type"]=="image"){
															   echo "<img src='chat_photo.php?id={$conversation_row['message_id']}' width='200' height='130'/>";
															   }
															   echo'<span class="mess-time"> 1 Hour ago</span>';
														   }
														   else if($minute_row['minute_difference']>=1){
															   $minute=$minute_row['minute_difference'];
															if($conversation_row["message_type"]=="text"){
                                                               echo' <div class="recei-mess">'.$conversation_row["text_content"].'</div>';	
															   }
                                                               if($conversation_row["message_type"]=="attachment"){
															  echo" <div class='send-messx'><a href='Download.php?id={$conversation_row['message_id']}'>{$conversation_row['name']}</a></div>";
															   }
															   if($conversation_row["message_type"]=="image"){
															   echo "<img src='chat_photo.php?id={$conversation_row['message_id']}' width='200' height='130'/>";
															   }
															   echo'<span class="mess-time">'.$minute.' Min ago</span>';
														   }
														   else if($minute_row['minute_difference']<1){
															   $just_now=$minute_row['minute_difference'];
															if($conversation_row["message_type"]=="text"){
                                                               echo' <div class="recei-mess">'.$conversation_row["text_content"].'</div>';	
															   }
                                                               if($conversation_row["message_type"]=="attachment"){
															  echo" <div class='send-messx'><a href='Download.php?id={$conversation_row['message_id']}'>{$conversation_row['name']}</a></div>";
															   }
															   if($conversation_row["message_type"]=="image"){
															   echo "<img src='chat_photo.php?id={$conversation_row['message_id']}' width='200' height='130'/>";
															   }
															   echo'<span class="mess-time">Just now</span>';
														   }
                                                      
                                                        echo'</div>';
															}?>
                                                    </div>
                                                </div>
                                                <div class="send-mess-wrap">                                            
                                                    <div class="send-mess__inner">
                                                        <div class="send-mess-list">
													<?php if(($conversation_row["sender_email"]==$username) and ($conversation_row["receiver_email"]==$receiver_email))
														{
															$text_counter=$text_counter+1;
															$messaged_date=$conversation_row ["date"];	
												 // minute
												 $minute_sql="SELECT TIMESTAMPDIFF(minute,'$messaged_date','$current_date') as minute_difference";
												 $minute_result = mysqli_query($con,$minute_sql)or die("<b>Error:</b> <br/>" . mysqli_error($con));
												 $minute_row = mysqli_fetch_array($minute_result);
												 // hour
												 $hour_sql="SELECT TIMESTAMPDIFF(hour,'$messaged_date','$current_date') as hour_difference";
												 $hour_result = mysqli_query($con,$hour_sql)or die("<b>Error:</b> <br/>" . mysqli_error($con));
												 $hour_row = mysqli_fetch_array($hour_result);
												 // day
												 $day_sql="SELECT TIMESTAMPDIFF(day,'$messaged_date','$current_date') as day_difference";
												 $day_result = mysqli_query($con,$day_sql)or die("<b>Error:</b> <br/>" . mysqli_error($con));
												 $day_row = mysqli_fetch_array($day_result);
												 //month
												 $month_sql="SELECT TIMESTAMPDIFF(month,'$messaged_date','$current_date') as month_difference";
												 $month_result = mysqli_query($con,$month_sql)or die("<b>Error:</b> <br/>" . mysqli_error($con));
												 $month_row = mysqli_fetch_array($month_result);
												 //year
												 $year_sql="SELECT TIMESTAMPDIFF(year,'$messaged_date','$current_date') as year_difference";
												 $year_result = mysqli_query($con,$year_sql)or die("<b>Error:</b> <br/>" . mysqli_error($con));
												 $year_row = mysqli_fetch_array($year_result);
														   if($year_row['year_difference']>1){
															   $year=$year_row['year_difference'];	
															   if($conversation_row["message_type"]=="text"){
                                                               echo' <div class="send-mess">'.$conversation_row["text_content"].'</div>';	
															   }
                                                               if($conversation_row["message_type"]=="attachment"){
															  echo" <div class='send-messx'><a href='Download.php?id={$conversation_row['message_id']}'>{$conversation_row['name']}</a></div>";
															   }
															   if($conversation_row["message_type"]=="image"){
															   echo "<img src='chat_photo.php?id={$conversation_row['message_id']}' width='200' height='130'/>";
															   }
															   echo'<span class="mess-time">'.$conversation_row ["date"].'</span><br>';
															   echo'<span class="mess-time">'.$year.' Years ago</span>';
														   }
														   if($year_row['year_difference']==1){
															   if($conversation_row["message_type"]=="text"){
                                                               echo' <div class="send-mess">'.$conversation_row["text_content"].'</div>';	
															   }
                                                               if($conversation_row["message_type"]=="attachment"){
															  echo" <div class='send-messx'><a href='Download.php?id={$conversation_row['message_id']}'>{$conversation_row['name']}</a></div>";
															   }
															   if($conversation_row["message_type"]=="image"){
															   echo "<img src='chat_photo.php?id={$conversation_row['message_id']}' width='200' height='130'/>";
															   }
															   echo'<span class="mess-time">'.$conversation_row ["date"].'</span><br>';
															   echo'<span class="mess-time"> 1 Year ago</span>';
														   }
														   else if($month_row['month_difference']>1){
															   $month=$month_row['month_difference'];
															   if($conversation_row["message_type"]=="text"){
                                                               echo' <div class="send-mess">'.$conversation_row["text_content"].'</div>';	
															   }
                                                               if($conversation_row["message_type"]=="attachment"){
															  echo" <div class='send-messx'><a href='Download.php?id={$conversation_row['message_id']}'>{$conversation_row['name']}</a></div>";
															   }
															   if($conversation_row["message_type"]=="image"){
															   echo "<img src='chat_photo.php?id={$conversation_row['message_id']}' width='200' height='130'/>";
															   }
															    echo'<span class="mess-time">'.$conversation_row ["date"].'</span><br>';
															    echo'<span class="mess-time">'.$month.' Months ago</span>';
														   }
														    else if($month_row['month_difference']==1){
															if($conversation_row["message_type"]=="text"){
                                                               echo' <div class="send-mess">'.$conversation_row["text_content"].'</div>';	
															   }
                                                               if($conversation_row["message_type"]=="attachment"){
															  echo" <div class='send-messx'><a href='Download.php?id={$conversation_row['message_id']}'>{$conversation_row['name']}</a></div>";
															   }
															   if($conversation_row["message_type"]=="image"){
															   echo "<img src='chat_photo.php?id={$conversation_row['message_id']}' width='200' height='130'/>";
															   }
																echo'<span class="mess-time">'.$conversation_row ["date"].'</span><br>';
															    echo'<span class="mess-time"> 1 Month ago</span>';
														   }
														   else if($day_row['day_difference']>1){
															   $day=$day_row['day_difference'];
															if($conversation_row["message_type"]=="text"){
                                                               echo' <div class="send-mess">'.$conversation_row["text_content"].'</div>';	
															   }
                                                               if($conversation_row["message_type"]=="attachment"){
															  echo" <div class='send-messx'><a href='Download.php?id={$conversation_row['message_id']}'>{$conversation_row['name']}</a></div>";
															   }
															   if($conversation_row["message_type"]=="image"){
															   echo "<img src='chat_photo.php?id={$conversation_row['message_id']}' width='200' height='130'/>";
															   }
															   echo'<span class="mess-time">'.$conversation_row ["date"].'</span><br>';
															   echo'<span class="mess-time">'.$day.' Days ago</span>';
														   }
														   else if($day_row['day_difference']==1){
															if($conversation_row["message_type"]=="text"){
                                                               echo' <div class="send-mess">'.$conversation_row["text_content"].'</div>';	
															   }
                                                               if($conversation_row["message_type"]=="attachment"){
															  echo" <div class='send-messx'><a href='Download.php?id={$conversation_row['message_id']}'>{$conversation_row['name']}</a></div>";
															   }
															   if($conversation_row["message_type"]=="image"){
															   echo "<img src='chat_photo.php?id={$conversation_row['message_id']}' width='200' height='130'/>";
															   }
															   echo'<span class="mess-time">'.$conversation_row ["date"].'</span><br>';
															   echo'<span class="mess-time"> 1 Day ago</span>';
														   }
														   else if($hour_row['hour_difference']>1){
															   $hour=$hour_row['hour_difference'];
															if($conversation_row["message_type"]=="text"){
                                                               echo' <div class="send-mess">'.$conversation_row["text_content"].'</div>';	
															   }
                                                               if($conversation_row["message_type"]=="attachment"){
															  echo" <div class='send-messx'><a href='Download.php?id={$conversation_row['message_id']}'>{$conversation_row['name']}</a></div>";
															   }
															   if($conversation_row["message_type"]=="image"){
															   echo "<img src='chat_photo.php?id={$conversation_row['message_id']}' width='200' height='130'/>";
															   }
															   echo'<span class="mess-time">'.$hour.' Hours ago</span>';
														   }
														  else if($hour_row['hour_difference']==1){
															  if($conversation_row["message_type"]=="text"){
                                                               echo' <div class="recei-mess">'.$conversation_row["text_content"].'</div>';	
															   }
                                                               if($conversation_row["message_type"]=="attachment"){
															  echo" <div class='send-messx'><a href='Download.php?id={$conversation_row['message_id']}'>{$conversation_row['name']}</a></div>";
															   }
															   if($conversation_row["message_type"]=="image"){
															   echo "<img src='chat_photo.php?id={$conversation_row['message_id']}' width='200' height='130'/>";
															   }
															   echo'<span class="mess-time"> 1 Hour ago</span>';
														   }
														   else if($minute_row['minute_difference']>=1){
															   $minute=$minute_row['minute_difference'];
															if($conversation_row["message_type"]=="text"){
                                                               echo' <div class="send-mess">'.$conversation_row["text_content"].'</div>';	
															   }
                                                               if($conversation_row["message_type"]=="attachment"){
															  echo" <div class='send-messx'><a href='Download.php?id={$conversation_row['message_id']}'>{$conversation_row['name']}</a></div>";
															   }
															   if($conversation_row["message_type"]=="image"){
															   echo "<img src='chat_photo.php?id={$conversation_row['message_id']}' width='200' height='130'/>";
															   }
															   echo'<span class="mess-time">'.$minute.' Min ago</span>';
														   }
														   else if($minute_row['minute_difference']<1){
															   $just_now=$minute_row['minute_difference'];
															if($conversation_row["message_type"]=="text"){
                                                               echo' <div class="send-mess">'.$conversation_row["text_content"].'</div>';	
															   }
                                                               if($conversation_row["message_type"]=="attachment"){
															  echo" <div class='send-messx'><a href='Download.php?id={$conversation_row['message_id']}'>{$conversation_row['name']}</a></div>";
															   }
															   if($conversation_row["message_type"]=="image"){
															   echo "<img src='chat_photo.php?id={$conversation_row['message_id']}' width='200' height='130'/>";
															   }
															   echo'<span class="mess-time">Just now</span>';
														   }
														   if($text_counter==$message_counter and $conversation_row["visibility"]=="1" )
														   {
														   echo'<br><span class="mess-time">Seen</span>';
														   }
														}?>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
	<?php }?>
                                            </div>
 <div class="au-chat-textfield">
                                                <form class="au-form-icon" enctype="multipart/form-data" action="" method="post">
												<input name="message_type" type="hidden" value='text'>
                                                    <input class="au-input au-input--full au-input--h65" name="message_content" type="text" placeholder="Type a message">
       
													 <input type="submit" name="send" class="au-btn au-btn--block au-btn--green m-b-20" value="send">
              
													</form>
																										 <form class="au-form-icon" enctype="multipart/form-data" action="" method="post">
													 <input name="image" type="hidden" value='image'>
													<label>Send photo</label>
													<div class="fileUpload">
<span class="custom-span"><img src="css/icons/send_photo.png"HEIGHT="30"width="40"><span style=color:blue></span>
<input id="uploadBtn" type="file" name="photo" class="upload" />
</div>
								   <input type="submit" name="send_image" class="au-btn au-btn--block au-btn--green m-b-20" value="send photo">
                                                </form>
													 <form class="au-form-icon" enctype="multipart/form-data" action="" method="post">
													 <input name="attachment" type="hidden" value='attachment'>
													<label>Send file</label>
                                  <input class="input-file" type="file" name="attach" id="file">
								   <input type="submit" name="attach_file" class="au-btn au-btn--block au-btn--green m-b-20" value="attach">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END PAGE CONTAINER-->

    </div>

<?php 
}
?>
<script>
$( ".au-chat__content" ).scrollTop(777777777777 );
</script>
<script type="text/javascript">
function disableF5(e) { if ((e.which || e.keyCode) == 116 || (e.which || e.keyCode) == 82) e.preventDefault(); };

$(document).ready(function(){
     $(document).on("keydown", disableF5);
});
</script>
</body>

</html>
<!-- end document-->
