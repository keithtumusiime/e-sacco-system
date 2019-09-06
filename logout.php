<?php
session_start();
if(session_destroy()) // Destroying All Sessions
{
    header("location:login1.php"); // Redirecting To Home Page
}
?>