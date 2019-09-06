<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'head1.php';
    include 'db.php';
    ?>
</head>

<?php
$id = $_SESSION['customerID'];
$customer_details = mysqli_fetch_array(mysqli_query($con,"select * from customer where customerID='$id'"));

?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Loans<small>Member</small></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Loans</li>
        <li class="active">Mini Statement</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      
        <script type="text/javascript">
        try{ace.settings.loadState('main-container')}catch(e){}
      </script>

            <?php include 'sidenav1.php'?>

      <div class="main-content">
          <div class="page-content">

                <div class="row">
                    <div class="col-xs-12">
                        <h3 class="header smaller lighter blue"><b>Loan Statement for <?= $customer_details['full_names'];?></b></h3>
                        <div class="clearfix">
                        <?php
                        $query = mysqli_query($con,"select * from loan where customerid ='$id'");
                        $det = mysqli_fetch_array($query);
                        ?>
                            <div class="row">
                               <div class="col-sm-3"><div class=" tableTools-container"></div></div>
                               <div class="col-sm-3">
                                   <div class="alert alert-success w3-orange w3-text-white">
                                       <strong>Loan Balance:</strong> <?php echo "Shs. ".number_format($det['balance']); ?>
                                   </div>
                               </div>
                               <div class="col-sm-3">
                                   <div class="alert alert-success w3-red  w3-text-white">
                                       <strong>Interest Paid:</strong> <?php echo "Shs. ".number_format($det['interest']); ?>
                                   </div>
                               </div>
                               <div class="col-sm-3">
                                   <div class="alert alert-success w3-green  w3-text-white">
                                       <strong>Money Spent:</strong> <?php
                                       $total = $det['balance'] + $det['interest'];
                                       echo "Shs. ".number_format($total); ?>
                                   </div>
                               </div>
                            </div>
                        </div>
                        <div class="table-header">
                           Loan Statement
                        </div>

                        <!-- div.table-responsive -->

                        <!-- div.dataTables_borderWrap -->
                        <div class="table-responsive">
                            <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr style="color: #1B6AAA">
                                    <th>Date</th>
                                    <th>Amount Borrowed</th>
                                    <th>Interest</th>
                                    <th>Total</th>
                                    <th>Amount Paid</th>
                                    <th>Balance</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                include 'db.php';

                                //Selectig the loan payment details
                                $query = mysqli_query($con,"select * from loan_clearing where loan_customerID='$id' and admin_status ='Accepted' ORDER BY loan_date ASC ");
                                while ($payment_details = mysqli_fetch_array($query)){
                                    ?>
                                    <tr>
                                        <td><?php echo $payment_details['loan_date'];?></td>
                                        <td><?php echo number_format($payment_details['opening_balance']);?></td>
                                        <td><?php echo number_format($payment_details['interest']);?></td>
                                        <td><?php echo number_format($payment_details['total']);?></td>
                                        <td><?php echo number_format($payment_details['paid']);?></td>
                                        <td><?php echo number_format($payment_details['balance']);?></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
                <!-- /.row -->
          </div><!-- /.page-content -->
        </div>
      </div><!-- /.main-content -->

<?php include 'footer.php';?>

