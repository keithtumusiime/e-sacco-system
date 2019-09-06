<?php
error_reporting(0);
$gar1_error=$gar2_error=$error=$success='';
include 'db.php';
if(isset($_POST['submit'])) {
    $cid = $_POST['cid'];
    $accnumber = $_POST['accnumber'];
    $customernames = $_POST['fnames'];
    $date = date("Y-m-d H:i:s");
    $amount = $_POST['amount'];
    $term = $_POST['term'];
    $rate = 5;
    $gar1 = $_POST['gar1'];
    $tel1 = $_POST['cont1'];
    $gar2 = $_POST['gar2'];
    $tel2 = $_POST['cont2'];
    $reason = $_POST['reason'];
    $interest = ($rate/100)*$amount;

    //Checking for Garanters
   $search_gar1 = mysqli_query($con,"select * from customer where full_names = '$gar1' and contact = '$tel1'");
   $gar1_details= mysqli_fetch_array($search_gar1);
   if(mysqli_num_rows($search_gar1)>0){
       $gar1_id = $gar1_details['customerID'];
   }
   else{
       $gar1_error = "The Guarantor and the contact mismatch";
   }

    $search_gar2 = mysqli_query($con,"select * from customer where full_names = '$gar2' and contact = '$tel2'");
    $gar2_details= mysqli_fetch_array($search_gar2);
    if(mysqli_num_rows($search_gar1)>0){
        $gar2_id = $gar2_details['customerID'];
    }
    else{
        $gar2_error = "The Guarantor and the contact mismatch";
    }
    //Checking for Garanters


    //Checking if a guarantor is already a guarantor for another loan.
    //$gar1_details= mysql_fetch_array($search_gar1);

            //Checking for Guarantors Balance

            $bal1 = mysqli_query($con,"select * from accounts where customerID = '$gar1_id'");
            $bal1_details = mysqli_fetch_array($bal1);

            $gar1_bal = $bal1_details['accountBalance'];

            $bal2 = mysqli_query($con,"select * from accounts where customerID = '$gar2_id'");
            $bal2_details = mysqli_fetch_array($bal2);
            //Calculating their Balance
            $gar2_bal = $bal2_details['accountBalance'];
            $total_balance = $gar1_bal + $gar2_bal;

            if($total_balance < $amount){
                $error = "The Guarantors Dont have Sufficient Balance";
            }
            else{
                //Processing the loan to the next steps

                $insert  = mysqli_query($con,"insert into loan (customerid, amount, guarantor1, action1, guarantor2, action2, rate, period, reason, adminAction, balance, interest, loan_status) VALUES ('$cid','$amount','$gar1_id','pending','$gar2_id','pending','$rate','$term','$reason','pending','$amount','$interest','pending')");
                $success = "Request has been Successfully Sent";
            }
        




}
?>