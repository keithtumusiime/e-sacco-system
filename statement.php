<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'head1.php';
    include 'db.php';
    ?>
</head>

<body class="no-skin">
    <?php
                include 'db.php';
                $id = $_SESSION['customerID'];
                $customer_details = mysqli_fetch_array(mysqli_query($con,"select * from customer where customerID='$id'"));

                $bal = mysqli_fetch_array(mysqli_query($con,"select * from accounts where customerID='$id' "));
                
    ?>

    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>SACCO Report<small>Admin</small></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>  <a href="#">Transactions</a></li>
        <li class="">Statement</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

            <?php include 'sidenav1.php'?>

      <div class="main-content">
          <div class="page-content">

            <div class="row">
                    <div class="col-xs-12">
                        <div class="clearfix">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="alert alert-success w3-green w3-text-white">
                                        <strong>Your Total Savings:</strong> <?php

                                        if($_SESSION['customerID']=='C11011'){
                                          $tax = mysqli_fetch_array(mysqli_query($con,"select sum(taxes) as total_savings from taxes"));  
                                        echo "Shs. ".number_format($tax['total_savings']).".00"; }?>
                                        <?php
                                        if($_SESSION['customerID']!='C11011'){  
                                        echo "Shs. ".number_format($bal['accountBalance']).".00"; }?>
                                    </div>
                                </div>
                                <div class="col-sm-5"></div>
                            </div>

                        </div>
                        <div class="table-header">
                            Transaction Statement
                        </div>

                        <!-- div.table-responsive -->

                        <!-- div.dataTables_borderWrap -->

                            <?php
                            if($_SESSION['customerID']=='C11011'){
                            ?>
                            <div class="table-responsive">
                            <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr style="color: #1B6AAA">
                                    <th>Customer ID</th>
                                    <th>Tax Amount</th>
                                    <th>Transaction Date</th>
                                    <th>Transaction Type</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                include 'db.php';

                                //Selectig the loan payment details
                                $query = mysqli_query($con,"select * from taxes");
                                while ($transaction_details = mysqli_fetch_array($query)){
                                    ?>
                                    <tr>
                                        <td><?php echo $transaction_details['customerID'];?></td>
                                        <td><?php echo number_format($transaction_details['taxes']);?></td>
                                        <td><?php echo $transaction_details['transaction_date'];?></td>
                                        <td><?php echo $transaction_details['transaction_type'];?></td>
                                        <td hidden></td>
                                        <td hidden></td>
                                        <td hidden></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                        <?php
                        }

                        ?>

                        <?php
                        if($_SESSION['customerID']!='C11011'){
                        ?>
                        <div class="table-responsive">
                            <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr style="color: #1B6AAA">
                                    <th>Date</th>
                                    <th>Transaction Type</th>
                                    <th>Amount</th>
                                    <th>Balance</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                include 'db.php';

                                //Selectig the loan payment details
                                $query = mysqli_query($con,"select * from transactions where customerID='$id' and status ='approved' ORDER BY id ASC ");
                                $tax=mysqli_fetch_array(mysqli_query($con,"select * from taxes where customerID='$id'"));
                                while ($transaction_details = mysqli_fetch_array($query)){
                                    ?>
                                    <tr>
                                        <td><?php echo $transaction_details['transactionDate'];?></td>
                                        <td><?php echo $transaction_details['transaction_type'];?></td>
                                        <td><?php echo number_format($transaction_details['transactionAmount']);?></td>
                                        <td><?php echo number_format($transaction_details['balance']);?></td>
                                        <td hidden></td>
                                        <td hidden></td>
                                        <td hidden></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>

                        <?php
                        }
                        ?>
                    </div>
                </div>
                <!-- /.row -->

          </div><!-- /.page-content -->
        </div>
      </div><!-- /.main-content -->

  <?php include 'footer.php';?>
</div>