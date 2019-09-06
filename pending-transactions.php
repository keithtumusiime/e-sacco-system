<!DOCTYPE html>
<html lang="en">
<head>
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
        <li class="active">Transactions</li>
        <li class="active">Approve Sheet</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

            <?php include 'sidenav1.php' ?>
            

      <div class="main-content">
      <div class="col-sm-3"><div class="tableTools-container"></div></div>
                    <div class="page-content">

                        <div class="panel panel-info w3-card-4">
                            <div class="panel-heading">Client Details</div>

                            <div class="panel-body">
                            <div class = "row">
                                <!--?php include 'callback.php'; ?-->
                            </div>
                                <div class="row">
                                        <div class="table-header">
                                           Un approved Transactions
                                        </div>

                                    <!-- div.dataTables_borderWrap -->
                                    <div class="table-responsive">
                                        <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr style="color: #1B6AAA">
                                                    <th>Names</th>
                                                    <th>Acct Number</th>
                                                    <th>Transaction Date</th>
                                                    <th>Transaction Type</th>
                                                    <th>Amount</th>
                                                    <th colspan="2">Actions</th>
                                                    <th hidden>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                include 'db.php';

                                                $query = mysqli_query($con,"select * from transactions where status='Pending'");
                                                $id = 0;
                                                while ($trans_details = mysqli_fetch_array($query)){
                                                    $customer_id = $trans_details['customerID'];

                                                    $cname = mysqli_fetch_array(mysqli_query($con,"select * from customer where customerID='$customer_id'"));
                                                    $id++;
                                                    $transaction_id = $trans_details['id'];
                                                    $customer_id = $trans_details['customerID'];
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $cname['full_names'];?></td>
                                                        <td><?php echo $trans_details['accountNumber'];?></td>
                                                        <td><?php echo $trans_details['transactionDate'];?></td>
                                                        <td><?php echo $trans_details['transaction_type'];?></td>
                                                        <td><?php echo $trans_details['transactionAmount'];?></td>
                                                        <td align="center"><a class="green" onclick="return deleted()" href="accept-transaction.php?trans_id=<?php echo $transaction_id; ?>&&customerID=<?php echo$customer_id;?>" ><i class="ace-icon fa fa-check-circle bigger-180"></i></a></td>
                                                        <td align="center"><a class="red" href="deny_transaction.php"><i class="ace-icon fa fa-close bigger-180"></i></a></td>
                                                    </tr>
                                                <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            </div>
                <!-- /.row -->
          </div><!-- /.page-content -->
        </div>
      </div><!-- /.main-content -->
      </section>

      <?php include 'footer.php';?>
</div><!-- /.main-container -->
