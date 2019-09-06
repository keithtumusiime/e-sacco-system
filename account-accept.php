<?php
include "db.php";
date_default_timezone_set('Africa/Kampala');
$id=$_GET['customerID'];


//Selecting other fields from Customer table
$details =mysqli_fetch_array(mysqli_query($con,"select * from customer where customerID = '$id'"));
$accountname = $details['full_names'];
$date = $details['join_date'];
$activation_date = date("Y-m-d H:i:s");
///Setting up the account details
$accountnum = "100". rand(1111111,9999999);

$check = mysqli_query($con,"select * from accounts where accountNumber = '$accountnum'");
if(mysqli_num_rows($check) > 0){
    while(mysqli_num_rows($check) > 0){
        $accountnum++;
    }

    $insert = mysqli_query($con,"insert into accounts (customerID,accountName,accountNumber,openingDate,accountBalance)
      VALUES ('$id','$accountname','$accountnum','$activation_date','')");
}
else{
    $insert = mysqli_query($con,"insert into accounts (customerID,accountName,accountNumber,openingDate,accountBalance)
      VALUES ('$id','$accountname','$accountnum','$activation_date','')");
}


//Updating the customer table
$insert = mysqli_query($con,"update customer set status = 'approved',activation_date ='$activation_date'  where customerID = '$id'") or die.mysql_error();



if($insert){
    echo "<script type='text/javascript'>alert('Approved Successfully!')</script>";
    header("location: pending_accounts.php");

    $customerID = $id;

}else{
    "<script type='text/javascript'>alert('Approval Failed!')</script>";
}


?>