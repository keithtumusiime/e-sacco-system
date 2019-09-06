<!DOCTYPE html>
<html lang="en">
<head>
<title>Pending Transactions</title>
    <?php include 'head1.php';
    include 'db.php';
    ?>
</head>

<body class="no-skin">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Loans<small>Admin</small></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
        <li class="">Loans</li>
        <li class="active">Pending Payements</li>
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
                        <h3 class="header smaller lighter blue"><b>Loan Clearance Sheet</b></h3>
                        <div class="clearfix">
                            <div class="row">
                                
                                <div class="col-sm-5">
                                    <?php
                                    $query = mysqli_query($con,"select count(id) as transactions from loan_clearing where admin_status ='pending'");
                                    $transaction = mysqli_fetch_array($query);
                                    ?>
                                    <div class="alert alert-success w3-green w3-text-white">
                                        <strong>Total Un Approved Transactions:</strong> <?php echo $transaction['transactions']; ?>
                                    </div>
                                </div>
                                <div class="col=sm-4">

                                </div>
                            </div>

                        </div>
                        <div class="table-header">
                            Un Approved Transactions
                        </div>

                        <!-- div.table-responsive -->

                        <!-- div.dataTables_borderWrap -->
                        <div class="table-responsive">
                            <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr style="color: #1B6AAA">
                                    <th>Transaction Time</th>
                                    <th>Customer ID</th>
                                    <th>Names</th>
                                    <th>Amount</th>
                                    <th colspan="2">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                include 'db.php';
                                //Selectig the loan payment details
                                $query = mysqli_query($con,"select * from loan_clearing where admin_status ='pending' ORDER BY loan_date DESC ");
                                while ($payment_details = mysqli_fetch_array($query)){

                                    $id = $payment_details['loan_customerID'];
                                    $customer_details = mysqli_fetch_array(mysqli_query($con,"select * from customer where customerID='$id'"));
                                   $pointer = $payment_details['id'];
                                    ?>
                                    <tr>
                                        <td><?php echo $payment_details['loan_date'];?></td>
                                        <td><?php echo $payment_details['loan_customerID'];?></td>
                                        <td><?php echo $customer_details['full_names'];?></td>
                                        <td><?php echo number_format($payment_details['paid']);?></td>
                                        <td align="center"><a class="green" onclick="return accept()" href="admin_accept_loan_payment.php?id=<?php echo $pointer?>&&type=<?php echo "yes"?>" ><i class="ace-icon fa fa-check-circle bigger-180" style="color: green; font-size: 27px;"></i></a></td>
                                        <td align="center"><a class="red" onclick="return accept()" href="admin_accept_loan_payment.php?id=<?php echo $pointer?>&&type=<?php echo "no"?>"><i class="ace-icon fa fa-close bigger-180" style="color: red; font-size: 27px;"></i></a></td>
                                        <td hidden></td>
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
      <?php include 'footer.php' ?>
      </div>