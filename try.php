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
    //$interest = ($rate/100)*$amount;

    //Checking for Garanters
    $search_gar1 = mysql_query("select * from customer where full_names = '$gar1' and contact = '$tel1'");
    $gar1_details= mysql_fetch_array($search_gar1);
    if(mysql_num_rows($search_gar1)>0){
        $gar1_id = $gar1_details['customerID'];
    }
    else{
        $gar1_error = "The Guarantor and the contact mismatch";
    }

    $search_gar2 = mysql_query("select * from customer where full_names = '$gar2' and contact = '$tel2'");
    $gar2_details= mysql_fetch_array($search_gar2);
    if(mysql_num_rows($search_gar1)>0){
        $gar2_id = $gar2_details['customerID'];
    }
    else{
        $gar2_error = "The Guarantor and the contact mismatch";
    }
    //Checking for Garanters


    //Checking if a guarantor is already a guarantor for another loan.

    $one = mysql_query("select * from loan where guarantor1 = '$gar1_id' or guarantor1 = '$gar2_id'");
    //$gar1_details= mysql_fetch_array($search_gar1);
    if(mysql_num_rows($one)>0){
        $error = "One of the Guarantors are already Guarantors";
    }else{
        $two = mysql_query("select * from loan where guarantor2 = '$gar1_id' or guarantor2 = '$gar2_id'");
        //$gar1_details= mysql_fetch_array($search_gar1);
        if(mysql_num_rows($two)>0){
            $error = "One of the Guarantors are already Guarantors";
        }else{

            //Checking for Guarantors Balance

            $bal1 = mysql_query("select * from accounts where customerID = '$gar1_id'");
            $bal1_details = mysql_fetch_array($bal1);

            $gar1_bal = $bal1_details['accountBalance'];

            $bal2 = mysql_query("select * from accounts where customerID = '$gar2_id'");
            $bal2_details = mysql_fetch_array($bal2);
//Calculating their Balance
            $gar2_bal = $bal2_details['accountBalance'];
            $total_balance = $gar1_bal + $gar2_bal;

            if($total_balance < $amount){
                $error = "The Guarantors Dont have Sufficient Balance";
            }
            else{
                //Processing the loan to the next steps

                $insert  = mysql_query("insert into loan (customerid,amount,guarantor1,action1,guarantor2,action2,rate,period,reason,adminAction,balance)
VALUES ('$cid','$amount','$gar1_id','pending','$gar2_id','pending','$rate','$term','$reason','pending','0',)");

                $success = "Request has been Successfully Sent";

            }
        }
    }
}
?>