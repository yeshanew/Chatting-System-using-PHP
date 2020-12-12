<?php
require_once __DIR__ . '/db_config.php';
require_once __DIR__ . '/Chat_session.php';
$username=$_SESSION['username_session'];
include('online_user.php');
$current_date= date("Y-m-d H:i:s");
$notificaion_user='';
$temp='';
//Unread Message couner
$unread_message_sql = "SELECT * FROM chat WHERE receiver_email='$username' and visibility='unread'"; 
$message_result = mysqli_query($con,$unread_message_sql);
$unread_rows=mysqli_num_rows($message_result);
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
                            <div class="col-lg-6">
                                <div class="au-card au-card--no-shadow au-card--no-pad m-b-40">
                                    <div class="au-card-title" style="background-image:url('images/bg-title-02.jpg');">
                                        <div class="bg-overlay bg-overlay--blue"></div>
                                        <h3>
                                            <i class="zmdi zmdi-comment-text"></i><?php echo "Messages (".$unread_rows.')'?></h3>
                                    </div>
                                    <div class="au-inbox-wrap js-inbox-wrap">
                                            <div class="au-message-list">
												<?php

												//last text
												$noif_sql = "SELECT * FROM chat WHERE sender_email='$username' or receiver_email='$username' order by date DESC"; 
                                                $noif_result = mysqli_query($con,$noif_sql);
												while($noif_row = mysqli_fetch_array($noif_result)) { 
												if(strcmp($noif_row['receiver_email'],$temp)!=0 AND strcmp($noif_row['sender_email'],$temp)!=0){
												if($noif_row['receiver_email']==$username){  
												$notificaion_user=$noif_row['sender_email'];
												}
												if($noif_row['sender_email']==$username){
												$notificaion_user=$noif_row['receiver_email'];
												}
                                                $sql = "select * FROM user_account where email='$notificaion_user'"; 
                                                $result = mysqli_query($con,$sql);
												$row = mysqli_fetch_array($result);
												?>
												<A HREF ="chat_page2.php?image_id=<?php echo $row["imageId"];?>">
                                                <div class="au-message__item unread">
                                                    <div class="au-message__item-inner">
                                                        <div class="au-message__item-text">
														                                                        <?php
																																										// check online ststus										
												$offline_sql = "select * FROM offline  WHERE username='$notificaion_user'"; 
                                                $offline_result= mysqli_query($con,$offline_sql);
                                                $offline_row = mysqli_fetch_array($offline_result);
												$refresh_date=$offline_row ["refresh_date"];										
												 // minute
												 $minute_sql="SELECT TIMESTAMPDIFF(minute,'$refresh_date','$current_date') as minute_difference";
												 $minute_result = mysqli_query($con,$minute_sql)or die("<b>Error:</b> <br/>" . mysqli_error($con));
												 $minute_row = mysqli_fetch_array($minute_result);
												  // hour
												 $hour_sql="SELECT TIMESTAMPDIFF(hour,'$refresh_date','$current_date') as hour_difference";
												 $hour_result = mysqli_query($con,$hour_sql)or die("<b>Error:</b> <br/>" . mysqli_error($con));
												 $hour_row = mysqli_fetch_array($hour_result);
												 if(($minute_row['minute_difference']<=3) and ($hour_row['hour_difference']<1)){
														?>
                                                            <div class="avatar-wrap online">
                                                                <div class="avatar">
<img src="user_account_photo.php?image_id=<?php echo $row["imageId"]; ?> "width="120" height='130'/>
                                                                </div>
                                                            </div>
																																									<?php		
												     }
													 else {
														 ?>
														 <div class="avatar-wrap">
                                                                <div class="avatar">
                                                <img src="user_account_photo.php?image_id=<?php echo $row["imageId"]; ?> "width="120" height='130'/>
                                                                </div>
                                                            </div>
															<?php
													 }
															?>
                                                            <div class="text">
                                                                <h5 class="name"><?php echo $row["fname"]." ".$row["mname"]; ?></h5>
																<?php
																if(($noif_row["visibility"]=="unread")and ($noif_row["receiver_email"]==$username) and
																($noif_row["message_type"]=="image"))
																{
																echo'<p><b>Has sent photo<b></p>';
																}
																else if(($noif_row["receiver_email"]==$username) and ($noif_row["message_type"]=="image")){
                                                                echo'<p>Has sent photo</p>';
																}
															   else if(($noif_row["sender_email"]==$username) and ($noif_row["message_type"]=="image"))
																{
																	echo'<p>You has sent photo</p>';
																}
																else if(($noif_row["visibility"]=="unread")and ($noif_row["receiver_email"]==$username) and
																($noif_row["message_type"]=="attachment"))
																{
																echo'<p><b>Has sent file<b></p>';
																}
																else if(($noif_row["receiver_email"]==$username) and ($noif_row["message_type"]=="attachment")){
                                                                echo'<p>Has sent file</p>';
																}
															   else if(($noif_row["sender_email"]==$username) and ($noif_row["message_type"]=="attachment"))
																{
																	echo'<p>You has sent file</p>';
																}
																if(($noif_row["visibility"]=="unread")and ($noif_row["receiver_email"]==$username) and
																($noif_row["message_type"]=="text"))
																{
																echo'<p><b>'.$noif_row["text_content"].'<b></p>';
																}
																else if(($noif_row["receiver_email"]==$username) and($noif_row["message_type"]=="text")){
                                                                echo'<p>'.$noif_row["text_content"].'</p>';
																}
															   else if(($noif_row["sender_email"]==$username) and ($noif_row["message_type"]=="text"))
																{
																	echo'<p>You '.$noif_row["text_content"].'</p>';
																}?>
                                                            </div>
                                                        </div>
                                                        <div class="au-message__item-time">
                                                           <?php
												$lastseen_date=$offline_row ["refresh_date"];		
												 // minute
												 $minute_sql="SELECT TIMESTAMPDIFF(minute,'$lastseen_date','$current_date') as minute_difference";
												 $minute_result = mysqli_query($con,$minute_sql)or die("<b>Error:</b> <br/>" . mysqli_error($con));
												 $minute_row = mysqli_fetch_array($minute_result);
												 // hour
												 $hour_sql="SELECT TIMESTAMPDIFF(hour,'$lastseen_date','$current_date') as hour_difference";
												 $hour_result = mysqli_query($con,$hour_sql)or die("<b>Error:</b> <br/>" . mysqli_error($con));
												 $hour_row = mysqli_fetch_array($hour_result);
												 // day
												 $day_sql="SELECT TIMESTAMPDIFF(day,'$lastseen_date','$current_date') as day_difference";
												 $day_result = mysqli_query($con,$day_sql)or die("<b>Error:</b> <br/>" . mysqli_error($con));
												 $day_row = mysqli_fetch_array($day_result);
												 //month
												 $month_sql="SELECT TIMESTAMPDIFF(month,'$lastseen_date','$current_date') as month_difference";
												 $month_result = mysqli_query($con,$month_sql)or die("<b>Error:</b> <br/>" . mysqli_error($con));
												 $month_row = mysqli_fetch_array($month_result);
												 //year
												 $year_sql="SELECT TIMESTAMPDIFF(year,'$lastseen_date','$current_date') as year_difference";
												 $year_result = mysqli_query($con,$year_sql)or die("<b>Error:</b> <br/>" . mysqli_error($con));
												 $year_row = mysqli_fetch_array($year_result);
														   if($year_row['year_difference']>1){
															   $year=$year_row['year_difference'];																   
															   echo'<span class="mess-time">'.$offline_row ["refresh_date"].'</span><br>';
															   echo'<span class="mess-time">'.$year.' Years ago</span>';
														   }
														   if($year_row['year_difference']==1){
															   echo'<span class="mess-time">'.$offline_row ["refresh_date"].'</span><br>';
															   echo'<span class="mess-time"> 1 Year ago</span>';
														   }
														   else if($month_row['month_difference']>1){
															   $month=$month_row['month_difference'];
															    echo'<span class="mess-time">'.$offline_row ["refresh_date"].'</span><br>';
															    echo'<span class="mess-time">'.$month.' Months ago</span>';
														   }
														    else if($month_row['month_difference']==1){
																echo'<span class="mess-time">'.$offline_row ["refresh_date"].'</span><br>';
															    echo'<span class="mess-time"> 1 Month ago</span>';
														   }
														   else if($day_row['day_difference']>1){
															   $day=$day_row['day_difference'];
															   echo'<span class="mess-time">'.$offline_row ["refresh_date"].'</span><br>';
															   echo'<span class="mess-time">'.$day.' Days ago</span>';
														   }
														   else if($day_row['day_difference']==1){
															   echo'<span class="mess-time">'.$offline_row ["refresh_date"].'</span><br>';
															   echo'<span class="mess-time"> 1 Day ago</span>';
														   }
														   else if($hour_row['hour_difference']>1){
															   $hour=$hour_row['hour_difference'];
															   echo'<span class="mess-time">'.$hour.' Hours ago</span>';
														   }
														   else if($hour_row['hour_difference']==1){
															   echo'<span class="mess-time"> 1 Hour ago</span>';
														   }
														   else if($minute_row['minute_difference']>3){
															   $minute=$minute_row['minute_difference'];
															   echo'<span class="mess-time">'.($minute-3).' Min ago</span>';
														   }
														   ?>
                                                        </div>
                                                    </div>
													
                                                </div></a>
												<?php
												$temp=$notificaion_user;
												
												}}  
mysqli_close($con);
?>
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


</body>

</html>
<!-- end document-->
