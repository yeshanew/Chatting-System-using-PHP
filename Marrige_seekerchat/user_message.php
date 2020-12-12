<?php
require_once __DIR__ . '/../db_config.php';
echo $_POST['msg'];
session_start();
$session=session_id();
$msg = $_POST['msg'];
$current_date= date("Y-m-d H:i:s");
$message=$_POST['msg'];
$admin_sql = "SELECT * FROM admin"; 
$message_result = mysqli_query($con,$admin_sql);
While($rows=mysqli_fetch_array($message_result)){
$receiver=$rows['email'];
$query = "INSERT INTO user_chat_room(chat_id,sender,receiver,message,date)
            VALUES ('','$session','$receiver','$message','$current_date')";
$insertion_result = mysqli_query($con,$query) or die("<b>Error:</b>  The message has not sent<br/>" .        
    mysqli_error($con));
if(isset($insertion_result)) {
	//echo" success";
//
	
}
}