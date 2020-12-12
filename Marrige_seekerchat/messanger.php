<?php 
require_once __DIR__ . '/../db_config.php';
require_once __DIR__ . '/Chat_session.php';
$username=$_SESSION['username_session'];
include('online_user.php');
$current_date= date("Y-m-d H:i:s");
$id=$_POST['image_id'];
    $sql = "SELECT * FROM user_account WHERE imageId='$id'";
    $result = mysqli_query($con,$sql) or die("<b>Error:</b> <br/>" . mysqli_error($con));
    $row = mysqli_fetch_array($result);
	$receiver_email=$row["email"];
	$update_query="UPDATE chat SET visibility='1' WHERE sender_email='$receiver_email'and receiver_email='$username'";
	$update_result = mysqli_query($con,$update_query) or die("<b>Error:</b><br/>" .        
    mysqli_error($con));
	$text_counter=0;
if (isset($_POST['message_type'])) {
$message_type=$_POST['message_type'];
$message_content=$_POST['msg_content'];
$query = "INSERT INTO chat (message_id,sender_email,receiver_email,text_content,message_type,date)
            VALUES ('','$username','$receiver_email','$message_content','$message_type','$current_date')";
$insertion_result = mysqli_query($con,$query) or die("<b>Error:</b>  The message  is not attached<br/>" .        
    mysqli_error($con));
if(isset($insertion_result)) {
//
}		
}

if (isset($_POST['send_image'])) {
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
}

if (isset($_POST['attach_file'])) {
if($_FILES['attach']['error'] == 0) {
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
}
	
?>
