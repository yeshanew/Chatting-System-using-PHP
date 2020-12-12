<?php
require_once __DIR__ . '/db_config.php';
if(isset($_SESSION['username_session'])){
$username=$_SESSION['username_session'];
include('online_user.php');
$sql = "select * FROM user_account WHERE email='$username' and userType='MarriageSeeker'"; 
$result = mysqli_query($con,$sql);
//Unread Message couner
$unread_message_sql = "SELECT * FROM chat WHERE receiver_email='$username' and visibility='unread'"; 
$message_result = mysqli_query($con,$unread_message_sql);
$unread_rows=mysqli_num_rows($message_result);
?>

<?php
require_once __DIR__ . '/Chat_session.php';
$username=$_SESSION['username_session'];
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

<body>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="au-card au-card--no-shadow au-card--no-pad m-b-40">
                                    <div class="au-card-title" style="background-image:url('images/bg-title-02.jpg');">
                                        <div class="bg-overlay bg-overlay--blue"></div>
                                        <h3>
                                            <i class="zmdi zmdi-comment-text"></i>Online Users <?php echo '('.($count_user_online-1).')'?></h3>
                                    </div>
                                    <div class="au-inbox-wrap js-inbox-wrap">
                                        <div class="au-message js-list-load">
                                            <div class="au-message-list">
												<?php
																								
												$offline_sql = "select * FROM offline  WHERE NOT username='$username' order by refresh_date DESC"; 
                                                $offline_result= mysqli_query($con,$offline_sql);
												if(mysqli_num_rows($offline_result)>0){
                                                while($offline_row = mysqli_fetch_array($offline_result)){
												$email=$offline_row ['username'];
                                                $sql = "select * FROM user_account where  email='$email'"; 
                                                $result = mysqli_query($con,$sql);
												$row = mysqli_fetch_array($result)
												?>
												<A HREF ="chat_page2.php?image_id=<?php echo $row["imageId"];?>">
                                                <div class="au-message__item unread">
                                                    <div class="au-message__item-inner">
                                                        <?php
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
                                                                <h5 class="name"><?php echo" ".$row["fname"]." ".$row["mname"]; ?></h5>
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
												} 
												}
												else {echo "No one!!!";}
//mysqli_close($con);
?>
                                            </div>
                                            <div class="au-message__footer">
                                                <button class="au-btn au-btn-load js-load-btn">See more</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


</body>

</html>
<?php
}
?>

<!-- end document-->
