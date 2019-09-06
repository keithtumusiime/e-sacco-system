<?php
date_default_timezone_set('Africa/Kampala');
include "db.php";
$trans_id    = $_GET['trans_id'];
$customerID  = $_GET['customerID'];

$date_of_approval = date("Y-m-d H:i:s");
 
mysqli_query($con,"update transactions set status = 'denied', approval_date = '$date_of_approval',balance='$current_balance' where customerID='$customerID' and id='$trans_id' ");

mysqli_query($con,"delete from taxes where customerID ='$customerID' ");

header("location: pending-transactions.php");
?>