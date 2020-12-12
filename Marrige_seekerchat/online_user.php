<?php
$current_date= date("Y-m-d H:i:s");
$session=session_id();
$time=time();
$time_check=$time-180;
$sql="SELECT * FROM online WHERE username='$username'";
$result=mysqli_query($con,$sql);

$count=mysqli_num_rows($result);
if($count=="0"){

$sql1="INSERT INTO online(session, time,username)VALUES('$session', '$time','$username')";
$result1=mysqli_query($con,$sql1);

}

else {
$sql2="UPDATE online SET time='$time' WHERE session = '$username'";
$result2=mysqli_query($con,$sql2);
}
$sql_off="SELECT * FROM offline WHERE username = '$username'";
$result_off=mysqli_query($con,$sql_off);
$off_count=mysqli_num_rows($result_off);
if($off_count=="0"){
$sql_refresh="INSERT INTO offline(refresh_date,username)VALUES('$current_date','$username')";
$result_refresh=mysqli_query($con,$sql_refresh);
}
else{
$sql_refresh="UPDATE offline SET refresh_date='$current_date' WHERE username = '$username'";
$result_refresh=mysqli_query($con,$sql_refresh);
}
$sql3="SELECT * FROM online";
$result3=mysqli_query($con,$sql3);
$count_user_online=mysqli_num_rows($result3);
$sql4="DELETE FROM online WHERE time<$time_check";
$result5=mysqli_query($con,$sql4) or die("<b>Error:</b> <br/>" . mysqli_error($con));	
//mysqli_close($con); // Closing Connection
?>