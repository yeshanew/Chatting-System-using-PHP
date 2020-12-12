<?php
session_start();
require_once __DIR__ . '/../db_config.php';
$current_date= date("Y-m-d H:i:s");
$session=session_id();
$time=time();
$time_check=$time-180;
$sql="SELECT * FROM user_chat WHERE session_id='$session'";
$result=mysqli_query($con,$sql);

$count=mysqli_num_rows($result);
if($count=="0"){

$sql1="INSERT INTO user_chat(session_id, time)VALUES('$session', '$time')";
$result1=mysqli_query($con,$sql1);

}

else {
$sql2="UPDATE user_chat SET time='$time' WHERE session_id = '$session'";
$result2=mysqli_query($con,$sql2);
}
$sql3="SELECT * FROM user_chat";
$result3=mysqli_query($con,$sql3);
$user_chat=mysqli_num_rows($result3);
echo $user_chat;
$sql4="DELETE FROM user_chat WHERE time<$time_check";
$result5=mysqli_query($con,$sql4) or die("<b>Error:</b> <br/>" . mysqli_error($con));	
//mysqli_close($con); // Closing Connection
?>