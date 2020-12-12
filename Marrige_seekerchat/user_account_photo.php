<?php
require_once __DIR__ . '/db_config.php';
if(isset($_GET['image_id'])) {
    $sql = "SELECT * FROM user_account WHERE imageId=" . $_GET['image_id'];
    $result = mysqli_query($con,$sql) or die("<b>Error:</b> Problem on Retrieving Image BLOB<br/>" . mysqli_error($con));
    $row = mysqli_fetch_array($result);
    header("Content-type: " . $row["imagetype"]);
    echo $row["image"];


}
mysql_close($con);

?>