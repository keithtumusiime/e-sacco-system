<?php
include 'db.php';
$pointer = $_GET['id'];
date_default_timezone_set('Africa/Kampala');

$type = $_GET['type'];

if($type=='yes'){
    $get_id = mysqli_fetch_array(mysqli_query($con,"select * from loan_clearing where id = '$pointer'"));

    $interest = $get_id['interest'];
    $new_balance = $get_id['balance'];
    $cid = $get_id['loan_customerID'];

    $get_interest = mysqli_query($con,"select * from loan where customerid ='$cid'");
    $got_interest = mysqli_fetch_array($get_interest);
    $last_interest = $got_interest['interest'];
    $new_interest = ($last_interest+$interest);

   $update = mysqli_query($con,"update loan_clearing set admin_status ='Accepted' where id ='$pointer'");

    mysqli_query($con,"update loan set balance='$new_balance',interest = '$new_interest' where customerid = '$cid'");



 if($interest!=0){

    //Date
     $date = date("Y-m-d H:i:s");

     //Sharing the interest on loans
     $shared_interest =  $interest;
     //Getting the number of members.
     $members = mysqli_fetch_array(mysqli_query($con,"select count(customerID) as members from customer where status='approved'"));
     $total_members = $members['members'];


     //calculating the sacco interests
     $sacco_share = (10/100)*$interest;
     mysqli_query($con,"insert into taxes(customerID,taxes,transaction_date,transaction_type)VALUES ('$cid','$sacco_share','$date','Interest')");

     //calculating the other members share
     $other_members_share = (50/100)*$shared_interest;

     // Updating all the accounts
     $search_acct = mysqli_query($con,"select * from accounts");
     while($result = mysqli_fetch_array($search_acct)){
         $customerID = $result['customerID'];
         $accnumber = $result['accountNumber'];
         $current_balance = $result['accountBalance'];

         //calculating the individualshare
         $share = mysqli_query($con,"select sum(accountBalance) as balance from accounts");
         $total_money_details= mysqli_fetch_array($share);
         $total_money = $total_money_details['balance'];

         $share_percentage = ($current_balance/$total_money)*100;
         $individual_share = $share_percentage * $other_members_share;
         $new_balance = $current_balance + $individual_share;


         $update_balance = mysqli_query($con,"update accounts set accountBalance = '$new_balance' where customerID='$customerID'");

         $insert = mysqli_query($con,"insert into transactions(customerID,accountNumber,transactionDate,transactionAmount,transaction_type,status,balance)
        VALUES ('$customerID','$accnumber','$date','$individual_share','Interest on Loan','approved','$new_balance')");
     }
// Updating all the accounts Ends here



     // Updating Guarantors accounts
     //Getting the guarantors;
     $guarantor1 = $got_interest['guarantor1'];
     $guarantor2 = $got_interest['guarantor2'];


     //Getting the guarantors' account Numbers
     $getacct1 = mysqli_fetch_array(mysqli_query($con,"select * from accounts where customerID='$guarantor1'"));
     $guarantor1_acct_number = $getacct1['accountNumber'];

     $getacct2 = mysqli_fetch_array(mysqli_query($con,"select * from accounts where customerID='$guarantor2'"));
     $guarantor2_acct_number = $getacct2['accountNumber'];


     //Calculating the interest for guarantors.
     $guarantors_share = (40/100)*$shared_interest;
     $guarantor_share = ($guarantors_share/2);

     $search_acct1 = mysqli_fetch_array(mysqli_query($con,"select * from accounts where customerID='$guarantor1'"));
     $guarantor1_old_balance = $search_acct1['accountBalance'];

     $search_acct2 = mysqli_fetch_array(mysqli_query($con,"select * from accounts where customerID='$guarantor2'"));
     $guarantor2_old_balance = $search_acct1['accountBalance'];


     $guarantor1_new_balance = $guarantor1_old_balance +$guarantor_share;
     $guarantor2_new_balance = $guarantor2_old_balance +$guarantor_share;



     //first Guarantor
     mysqli_query($con,"update accounts set accountBalance = '$guarantor1_new_balance' where customerID='$guarantor1'");

     $insert = mysqli_query($con,"insert into transactions(customerID,accountNumber,transactionDate,transactionAmount,transaction_type,status,balance)
        VALUES ('$guarantor1','$guarantor1_acct_number','$date','$guarantor_share','Guarantor Interest on Loan','approved','$guarantor1_new_balance')");


     //Second Guarantor
     mysqli_query($con,"update accounts set accountBalance = '$guarantor1_new_balance' where customerID='$guarantor2'");

     $insert = mysqli_query($con,"insert into transactions(customerID,accountNumber,transactionDate,transactionAmount,transaction_type,status,balance)
        VALUES ('$guarantor2','$guarantor2_acct_number','$date','$guarantor_share','Guarantor Interest on Loan','approved','$guarantor1_new_balance')");





     //Saving the sacco interests
     mysqli_query($con,"insert into interests(earn_date,amount)VALUES ('$date','$sacco_share')");
     $update = mysqli_query($con,"update loan_clearing set loan_status ='Cleared' where id ='$pointer'");
 }

}

if($type=='no'){
    $update = mysqli_query($con,"update loan set status ='denied' where id ='$pointer'");
}



if(!$insert)
{
   header("location:accept_loan_payments.php");
}
   
?>