<?php
require_once __DIR__ . '/db_config.php';
$sql3="SELECT * FROM online";
$result3=mysqli_query($con,$sql3);
$count_user_online=mysqli_num_rows($result3);
echo $count_user_online-1;

?>