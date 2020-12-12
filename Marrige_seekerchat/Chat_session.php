<?php
session_start();
if(!isset($_SESSION['username_session'])){
header('Location:user_login.php');
}
?>