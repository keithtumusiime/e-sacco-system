<?php
include 'db.php';
$customer_id = $_GET['customerID'];

mysqli_query($con,"delete from customer where customerID ='$customer_id' ");
mysqli_query($con,"delete from login where customerID ='$customer_id' ");

header("location:members.php ");

?>