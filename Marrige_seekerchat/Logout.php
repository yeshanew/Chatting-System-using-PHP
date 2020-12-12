<?php
session_start();
if(session_destroy()) // Destroying All Sessions
{
header("Location:user_login.php"); // Redirecting To Home Page
}
?>
