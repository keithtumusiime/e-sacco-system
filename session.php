<?php
session_start();
if(!isset($_SESSION['customerID'])  || (trim($_SESSION['customerID']==''))){
    header("location:index.php");
    exit();
}
?>