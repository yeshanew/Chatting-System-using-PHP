
<?php
require_once __DIR__ . '/../db_config.php';
require_once __DIR__ . '/Chat_session.php';
$username=$_SESSION['username_session'];
$unread_message_sql = "SELECT * FROM user_chat_room WHERE receiver='$username' and visibility='unread'"; 
$message_result = mysqli_query($con,$unread_message_sql);
$unread_rows=mysqli_num_rows($message_result);
echo $unread_rows;
?>