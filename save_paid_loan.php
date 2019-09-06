<?php
date_default_timezone_set('Africa/Kampala');
include 'db.php';
$message="";
if(isset($_POST['submit'])){
    $cid = $_POST['cid'];
    $date = date("Y-m-d H:i:s");
    $amount = $_POST['amount'];
/*
    //Getting the balance
    $balance = mysql_fetch_array(mysql_query("select * from loan where customerid='$cid'"));
    $current_balance =  $balance['balance'];
*/

        //Getting the last interest
    $get_interest = mysqli_query($con,"select * from loan where customerid ='$cid'");
    $got_interest = mysqli_fetch_array($get_interest);

    $last_interest = $got_interest['interest'];


    //Getting the last paid details
    $last_id_details = mysqli_fetch_array(mysqli_query($con,"select max(id) as id from loan_clearing where loan_customerID='$cid'"));
    $last_id = $last_id_details['id'];

    //Getting the details of the last payment
    $paid_loan_details = mysqli_fetch_array(mysqli_query($con,"select * from loan_clearing where id = '$last_id'"));


    //Getting the last month and date of payment
    $last_date = $paid_loan_details['loan_date'];
    $last_time_array = explode("-", $last_date);

    $last_year = $last_time_array[0];
    $last_month =$last_time_array[1];


    //Current Date
    $current_date = date("Y-m-d H:i:s");
    $current_time_array = explode("-",$current_date);

    $current_year = $current_time_array[0];
    $current_month = $current_time_array[1];

    //Testing if the month and date are the same and estimating the interest rate
    if($last_month==$current_month){
        $rate=0;
    }
    if($current_month==($last_month+1)){
        $rate=5;
    }
    if($current_month==($last_month+2)){
        $rate=10;
    }
    if($current_month==($last_month+3)){
        $rate=15;
    }
    if($current_month==($last_month+4)){
        $rate=20;
    }
    if($current_month==($last_month+5)){
        $rate=25;
    }
    if($current_month==($last_month+6)){
        $rate=30;
    }
    if($current_month==($last_month+7)){
        $rate=35;
    }
    if($current_month==($last_month+8)){
        $rate=40;
    }
    if($current_month==($last_month+9)){
        $rate=45;
    }
    if($current_month==($last_month+10)){
        $rate=50;
    }
    if($current_month==($last_month+11)){
        $rate=55;
    }
    if($current_month==($last_month+12)){
        $rate=60;
    }

    //Capturing the new values

    //Cureent date is captured up
    //interest rate is captured up
    //Amount paid  is also captured up
    $opening_balance = $paid_loan_details['balance'];
    $amount_borrowed = 0;
    $interest = ($rate/100)*$opening_balance;
    $total = $opening_balance + $amount_borrowed + $interest;
    $new_balance = $total-$amount;
    $new_interest = ($last_interest+$interest);
    //Getting the status
    if($new_balance == 0){
        $status = "Cleared";
    }else{
        $status="pending";
    }


    if($amount > $opening_balance){
        echo "<script type='text/javascript'>alert('Failed, The Amount are paying is more than what is Demanded !!!')</script>";
    }else{
        //Code for mobile Money



        //Inserting into the loan clearing table
        $insert  = mysqli_query($con,"insert into loan_clearing(loan_customerID,loan_date,opening_balance,amount_borrowed,interest,total,paid,balance,status,admin_status)
VALUES ('$cid','$current_date','$opening_balance','$amount_borrowed','$interest','$total','$amount','$new_balance','$status','pending')");

        /*
        if($insert){
            mysql_query("update loan set balance='$new_balance',interest = '$new_interest' where customerid = '$cid'");
        }
*/

        $message = "Thanks for Clearing your loan. A token has been received";
    }
}
?>