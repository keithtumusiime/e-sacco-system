<!DOCTYPE html>
<html lang="en">
<head>
<title>Cash Deposit</title>
    <?php include 'head1.php';
    include 'db.php';
    $id = $_SESSION['customerID'];
    
    $member = mysqli_query($con,"select * from  accounts where customerID = '$id'");
    $details = mysqli_fetch_array($member);
    $memb = mysqli_fetch_array(mysqli_query($con,"select * from  customer where customerID = '$id'"));

    ?>
</head>

<body class="no-skin">
<?php
include 'db.php';
$message="";
if(isset($_POST['submit'])){
    $cid = $_POST['cid'];
    $accnumber = $_POST['accnumber'];
    $date = date("Y-m-d H:i:s");
    $amount = $_POST['amount'];
    $tax = 0.005 * $amount;
    $net_deposit=$amount-$tax;
    $contact = $memb['contact'];

    if ($amount < 500) {
        $message = "<div class=\"alert alert-danger\"> Please make a Deposit of atleast Shs. 500/=<p></div>";
    }
    else{

       include 'money.php';

        $insert = mysqli_query($con,"insert into transactions(customerID,accountNumber,transactionDate,transactionAmount,transaction_type,status)VALUES ('$cid','$accnumber','$date','$net_deposit','Deposit','pending')");
        mysqli_query($con,"insert into taxes(customerID,taxes,transaction_date,transaction_type)VALUES ('$cid','$tax','$date','Deposit')");


    //After inserting a transaction, update the balance
        if($insert){
            $message = "<div class=\"alert alert-success\">Deposited Successfully<p>A service fee of ". $tax." has been deducted</p></div>";
            //  $search_acct = mysql_query("select * from accounts where customerID='$cid' and accountNumber='$accnumber'");

            // $result = mysql_fetch_array($search_acct);
            //  $current_balance = $result['accountBalance'];

            // $new_balance = $current_balance + $amount;

            //    $update_balance = mysql_query("update accounts set accountBalance = '$new_balance' where customerID='$cid' and accountNumber='$accnumber' ");


    //update the balance ends here
        }
 

        else{
            echo mysql_error();
        }
    }
}
?>

    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Dashboard<small>Member</small></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
            <?php include 'sidenav1.php'?>

      <div class="main-content">
          <div class="page-content">

            <div class="row">
                    <div class="col-xs-1"></div>

                    <div class="col-xs-10 ">
                        <form class="form-horizontal" action="deposit.php" method="post" enctype="multipart/form-data" role="form">
                            <div class="well w3-text-blue">E-SACCO Deposit Slip</div>
                            <div class="form-group">
                               <?php echo $message;?>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3" for="form-field-1-1"> Account Number: </label>

                                <div class="col-sm-9">
                                    <input  name="accnumber" value="<?php echo $details['accountNumber'] ?>" readonly  type="text" id="form-field-1-1"  class="form-control" />
                                    <input name="cid" value="<?php echo $details['customerID'] ?>"   type="hidden" class="span6 m-wrap"/>
                                </div>



                            </div>
                            <div class="form-group">
                                <label class="col-sm-3" for="form-field-1-1"> Phone Number: </label>

                                <div class="col-sm-9">
                                    <input  name="number" value="<?php echo $memb['contact'] ?>" readonly  type="text" id="form-field-1-1"  class="form-control" />
                                    <input name="cid" value="<?php echo $details['customerID'] ?>"   type="hidden" class="span6 m-wrap"/>
                                </div>



                            </div>
                            <div class="space-4"></div>

                            <div class="form-group">
                                <label class="col-sm-3" for="form-field-1-1"> Amount: </label>

                                <div class="col-sm-9">
                                    <input type="text" id="form-field-1-1" name="amount" pattern="[0-9]+" title="Integer numbers only" autocomplete="off" required placeholder="Amount Deposited(Integers)"class="form-control" />
                                </div>
                            </div>
                            <div class="space-4"></div>


                            <div class="clearfix form-actions w3-light-gray">
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
</div>
<!-- inline scripts related to this page -->
</body>
</html>

