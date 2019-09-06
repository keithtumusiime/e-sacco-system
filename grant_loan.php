<?php
date_default_timezone_set('Africa/Kampala');
include 'db.php';
$id = $_GET['id'];

$query = mysqli_fetch_array(mysqli_query($con,"select * from loan where customerid ='$id'"));

$date = date("Y-m-d H:i:s");
$amount_borrowed = $query['amount'];
$open_balance = 0;
$rate = 5;
$interest = ($rate/100)*$amount_borrowed;
$total = (($rate/100)*$amount_borrowed)+$amount_borrowed;
$paid = 0;

$balance = $total-$paid;

$date = date("Y-m-d H:i:s");


//Inserting into the loan processing table


//Mobile money code to send money to the Customer if the admin Accepts his loan request

/*$insert  = mysql_query("insert into loan_clearing(loan_customerID,loan_date,opening_balance,amount_borrowed,interest,total,paid,balance,status)
VALUES ('$id','$date','$open_balance','$amount_borrowed','$interest','$total','$paid','$balance','pending')");
*/
$insert = mysqli_query($con,"update loan set adminAction = 'Accepted',balance='$total' where customerid = '$id'");
if($insert){
    //mysql_query("update loan set adminAction = 'Accepted',balance='$total' where customerid = '$id'");
    $insert  = mysqli_query($con,"insert into loan_clearing(loan_customerID,loan_date,opening_balance,amount_borrowed,interest,total,paid,balance,status,admin_status)
VALUES ('$id','$date','$amount_borrowed','0','$interest','$total','0','$total','pending','Accepted')");

    header("location:admin_loans.php");
    $message = "Accepted";
}
?>