<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'head1.php';
    $msg ="";
    include 'db.php';
    $id = $_SESSION['customerID'];
    $select = mysqli_query($con,"select * from  accounts where customerID ='$id'");
    $details = mysqli_fetch_array($select);
    $memb = mysqli_fetch_array(mysqli_query($con,"select * from  customer where customerID = '$id'"));
    $contact = $memb['contact'];


    if(isset($_POST['submit'])){
    $cid = $_POST['cid'];
    $accnumber = $_POST['accnumber'];
    $date = date("Y-m-d H:i:s");
    $amount = $_POST['amount'];
    $tax=0.04*$amount;
    $total = $amount + $tax;



    $check_balance = mysqli_query($con,"select * from accounts where customerID = '$cid' and accountNumber = '$accnumber'");
    $got_balance = mysqli_fetch_array($check_balance);
    $current_balance = $got_balance['accountBalance'];

    


    if($total > $current_balance){

        echo "<script type='text/javascript'>alert('Dear Customer, The account Balance is Insufficient to complete this Transaction. !!!')</script>";

    }
    else{
        include 'payout.php';
       $insert = mysqli_query($con,"insert into transactions(customerID,accountNumber,transactionDate,transactionAmount,transaction_type,status)VALUES ('$cid','$accnumber','$date','$amount','Withdraw','pending')");


        //After inserting a transaction, update the balance
        if($insert){
             $msg = "<div class=\"alert alert-success\"> Withdraw Requet Sent for Approval. A withdrawal fee of ".$tax." will be deducted<p></div>";
            //header("location: dash.php");
            
        }

        else{
            echo mysql_error();
        }
    }

}

    ?>

</head>

<body class="no-skin">

        <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Transactions<small>Member</small></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
        <li class="">Transactions</li>
        <li class="active">Withdraw</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
            <?php include 'sidenav1.php'?>

      <div class="main-content">

            <div class="page-content">
                <br>
                <br>
                <br>
                <div class="row">
                    <div class="col-xs-1"></div>

                    <div class="col-xs-10">
                        <form class="form-horizontal" action="withdraw.php" method="post" enctype="multipart/form-data" role="form">


                            <div class="form-group">
                                <label class="col-sm-3" for="form-field-1-1"> Account Number: </label>

                                <div class="col-sm-9">
                                    <input  name="accnumber" value="<?php echo $details['accountNumber'] ?>" readonly  type="text" id="form-field-1-1"  class="form-control" />
                                    <input name="cid" value="<?php echo $details['customerID'] ?>"   type="hidden" class="span6 m-wrap"/>
                                </div>
                            </div>
                            <div class="space-4"></div>

                            <div class="form-group">
                                <label class="col-sm-3" for="form-field-1-1">Withdraw Amount: </label>

                                <div class="col-sm-9">
                                    <input type="text" id="form-field-1-1" name="amount" pattern="[0-9]+" title="Integer numbers only" placeholder="Amount Deposited(Integers)"class="form-control" />
                                </div>
                            </div>
                            <div class="space-4"></div>
                            <p class = "success"> <?php echo $msg ?></p>

                            <div class="clearfix form-actions">
                                <div class="col-md-offset-3 col-md-9">
                                    <button class="btn btn-info" type="submit" name="submit">
                                        <i class="ace-icon fa fa-check bigger-110"></i>
                                        Submit
                                    </button>

                                    &nbsp; &nbsp; &nbsp;
                                    <button class="btn" type="reset">
                                        <i class="ace-icon fa fa-undo bigger-110"></i>
                                        Reset
                                    </button>
                                </div>
                            </div>
                        </form>
                        
                    </div>

                    <div class="col-xs-1"></div>
                </div><!-- /.row -->
            </div><!-- /.page-content -->

        </div>
    </div><!-- /.main-content -->

    <?php include 'footer.php';?>

    <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
        <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
    </a>
</div><!-- /.main-container -->


<!-- inline scripts related to this page -->
</body>
</html>

<?php
include 'db.php';

?>