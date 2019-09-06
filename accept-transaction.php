<?php
date_default_timezone_set('Africa/Kampala');
include "db.php";
$trans_id    = $_GET['trans_id'];
$customerID  = $_GET['customerID'];


$act_search = mysqli_query($con,"select * from transactions where id = '$trans_id' and customerID = '$customerID' ");
$acct_got = mysqli_fetch_array($act_search);
$acct_number = $acct_got['accountNumber'];
$amount = $acct_got['transactionAmount'];
$type = $acct_got['transaction_type'];
$date_of_approval = date("Y-m-d H:i:s");
 $search_acct = mysqli_query($con,"select * from accounts where customerID='$customerID' and accountNumber='$acct_number'");
    $result = mysqli_fetch_array($search_acct);

    if($type == 'Deposit'){
        $current_balance = $result['accountBalance'];
        $new_balance = $current_balance + $amount;
    }
    else if ($type == 'Withdraw'){
        $current_balance = $result['accountBalance'];
        $tax = 0.04 * $amount;
        $new_balance = $current_balance - $amount - $tax;
        mysqli_query($con,"insert into taxes(customerID,taxes,transaction_date,transaction_type)VALUES ('$customerID','$tax','$date_of_approval','Withdraw')");
    }

  $update_balance = mysqli_query($con,"update accounts set accountBalance = '$new_balance' where customerID='$customerID' and accountNumber='$acct_number' ");

//update the balance ends here
  //calculating taxes
  

$update_status = mysqli_query($con,"update transactions set status = 'approved', approval_date = '$date_of_approval', balance='$new_balance'where customerID='$customerID' and id='$trans_id' ");


header("location: pending-transactions.php");
?>