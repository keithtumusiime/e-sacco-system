<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'head1.php';
    include 'db.php';
    $id = $_SESSION['customerID'];
    $select = mysqli_query($con,"select * from  accounts where customerID ='$id'");
    $details = mysqli_fetch_array($select);
    ?>
</head>

    <?php include 'sidenav1.php'?>

    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Loans<small>Member</small></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
        <li class="">Loans</li>
        <li class="active">Clear</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

            <?php include 'sidenav1.php'?>

      <div class="main-content">
          <div class="page-content">

            <div class="row">
                    <div class="col-xs-1"></div>
                  <?php include 'save_paid_loan.php';?>
                    <div class="col-xs-10">
                        <form class="form-horizontal" action="<?= $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data" role="form">

                            <?php
                            include 'db.php';
                            $bio_data = mysqli_fetch_array(mysqli_query($con,"select * from customer where customerID = '$id'"));
                            $loan_details = mysqli_fetch_array(mysqli_query($con,"select * from loan where customerid ='$id'"));
                            ?>
                            <div class="alert alert-success alert-dismissable text-center">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <?=$message;?>
                                <strong>Dear  <b style="color: orange"><?= $bio_data['full_names'];?></b>!</strong> <br>
                                Your outstanding balance to clear this loan is <b style="color: orange"><?php


                                    if($loan_details['balance']!=0){
                                        echo "Shs ".number_format($loan_details['balance']);
                                    }

                                    else{
                                        echo "Shs ".number_format($loan_details['balance']);
                                    }

                                    ?></b>
                            </div>
                           <?php
                           if($loan_details['balance']==0 and $loan_details['loan_status']=="cleared"){
                               ?>
                               <div class="alert alert-success">
                                   <strong>Woooow!</strong> <br>
                                   Dear Customer, You are not running any Active Loan
                               </div>
                               <?php
                           }else{
                               ?>
                               <div class="form-group">
                                   <label class="col-sm-3" for="form-field-1-1"> Amount: </label>

                                   <div class="col-sm-9">
                                       <input type="text" id="form-field-1-1" autocomplete="off" name="amount" pattern="[0-9]+" title="Integer numbers only" placeholder="Amount Paid(Integers)"class="form-control" />
                                       <input name="cid" value="<?php echo $details['customerID'] ?>"   type="hidden" class="span6 m-wrap"/>

                                   </div>
                               </div>
                               <div class="space-4"></div>

                               <div class="clearfix form-actions">
                                   <div class="col-md-offset-3 col-md-9">
                                       <button class="btn btn-info" type="submit" name="submit">
                                           <i class="ace-icon fa fa-check bigger-110"></i>
                                           Pay
                                       </button>

                                       <button class="btn btn-danger" type="reset">
                                           <i class="ace-icon fa fa-undo bigger-110"></i>
                                           Reset
                                       </button>
                                   </div>
                               </div>
                            <?php
                           }
                           ?>
                        </form>
                    </div>
                    <div class="col-xs-1"></div>
                </div><!-- /.row -->

          </div><!-- /.page-content -->
        </div>
      </div><!-- /.main-content -->

    <?php include 'footer.php';?>
