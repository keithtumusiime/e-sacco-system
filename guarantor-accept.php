<?php
include 'db.php';
$guarantor_id = $_GET['guarantorID'];
$guarantee_id = $_GET['guaranteeID'];
$type = $_GET['type'];


if($type=='accept'){

    $search = mysqli_fetch_array(mysqli_query($con,"select * from loan where customerid = '$guarantee_id'"));
    if($search['guarantor1']==$guarantor_id){

        $edit = mysqli_query($con,"update loan set action1 = 'Accepted' where customerid = '$guarantee_id'");
        if($edit){
            $message = "Thanks for taking a Risk";
            header("location: dash.php");
        }

    }elseif($search['guarantor2']==$guarantor_id){
        $edit = mysqli_query($con,"update loan set action2='Accepted' where customerid='$guarantee_id'");
        if($edit){
            $message = "Thanks for taking a Risk";
            header("location: dash.php");
        }

    }
}
if($type=='deny'){
    $search = mysqli_fetch_array(mysqli_query($con,"select * from loan where customerid = '$guarantee_id'"));
    if($search['guarantor1']==$guarantor_id){
        $edit =  mysqli_query($con,"update loan set action1='Denied' where customerid='$guarantee_id'");
        if($edit){
            $message = "Thanks for taking a Risk";
            header("location: dash.php");
        }

    }elseif($search['guarantor2']==$guarantor_id){
        $edit = mysqli_query($con,"update loan set action2='Denied' where customerid='$guarantee_id'");
        if($edit){
            $message = "Thanks for taking a Risk";
            header("location: dash.php");
        }
    }


}

?>