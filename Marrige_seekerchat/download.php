<?php
if(isset($_GET['id'])) {
    $id = intval($_GET['id']);
    if($id <= 0) {
        die('The ID is invalid!');
    }
    else {
require_once __DIR__ . '/../db_config.php';
include('Chat_session.php');
$username=$_SESSION['username_session'];
include('online_user.php');
$sql="SELECT * FROM chat WHERE message_id = {$id}"; 
$current_id = mysqli_query($con,$sql) or die("<b>Error:</b>  File is not attached<br/>" .        
mysqli_error($con));
$num_rows = mysqli_num_rows($current_id);
if(isset($current_id)) {
			 if($num_rows == 1) {
                $row =  mysqli_fetch_assoc($current_id );
                header("Content-Type: ". $row['mime']);
                header("Content-Length: ". $row['size']);
                header("Content-Disposition: attachment; filename=". $row['name']);
                echo $row['data'];
            }
           else {
                echo 'Error! No file exists with that ID.';
            }
            mysqli_free_result($current_id);
        }
        else {
            echo "Error! Query failed: <pre>{mysqli_error($con)}</pre>";
        }
		 mysqli_close($con);
    }
}
else {
    echo 'Error!';
}
?>