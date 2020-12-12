<?php
require_once __DIR__ . '/../db_config.php';
require_once __DIR__ . '/Chat_session.php';
if(isset($_GET['id'])) {
    $sql = "SELECT * FROM chat WHERE message_id=" . $_GET['id'];
    $result = mysqli_query($con,$sql) or die("<b>Error:</b> Problem on Retrieving Image <br/>" . mysqli_error($con));
    $row = mysqli_fetch_array($result);
    header("Content-type: " . $row["imagetype"]);
    echo $row["image"];


}
mysql_close($con);

?>