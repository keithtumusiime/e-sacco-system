<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'head1.php';
    include 'db.php';
    ?>
</head>
<body >
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Loans<small>Admin</small></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Transactions</li>
        <li class="active">Loans Due</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

            <?php include 'sidenav1.php'?>

      <div class="main-content">
          <div class="page-content">
                        <div class="panel panel-info w3-card-4">
                            <div class="panel-heading">Client Details</div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-xs-12">
                                            <div class="row">
                                                <div class="col-sm-3"> 
                                                    <div class="tableTools-container"></div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <?php
                                                    $query = mysqli_query($con,"select count(id) as loans from loan where adminAction='Accepted' and balance > 0");
                                                    $loans = mysqli_fetch_array($query);
                                                    ?>
                                                    <div class="alert alert-success w3-green w3-text-white">
                                                        <strong>Total Un cleared Loans:</strong> <?php echo $loans['loans']; ?>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <?php
                                                    $query = mysqli_query($con,"select sum(balance) as balance from loan where adminAction='Accepted' and loan_status='pending'");
                                                    $balance = mysqli_fetch_array($query);
                                                    ?>
                                                    <div class="alert alert-success w3-orange w3-text-white">
                                                        <strong>Total Amount on Loans:</strong> <?php echo "Shs. ".number_format($balance['balance']); ?>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-header">
                                Un Cleared Loans
                            </div>

                        <!-- div.table-responsive -->

                        <!-- div.dataTables_borderWrap -->
                            <div class="table-responsive">
                                <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                                    <thead>
                                    <tr style="color: #1B6AAA">
                                        <th>S/N</th>
                                        <th>Customer Name</th>
                                        <th>Loan Taken</th>
                                        <th>Amount Remaining</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    include 'db.php';

                                    $query = mysqli_query($con,"select * from loan where adminAction='Accepted' and balance > 0");
                                    $no = 0;
                                    while ($loan_details = mysqli_fetch_array($query)){
                                        $no++;

                                        $id = $loan_details['id'];
                                        $customer_id = $loan_details['customerid'];

                                        $query1 =mysqli_query($con,"select * from customer where customerID='$customer_id'");
                                        $names = mysqli_fetch_array($query1);
                                        ?>
                                        <tr>
                                            <td><?php echo $no;?></td>
                                            <td><?php echo $names['full_names'];?></td>
                                            <td><?php echo $loan_details['amount'];?></td>
                                            <td><?php echo $loan_details['balance'];?></td>
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
                </div>
                <!-- /.row -->


          </div><!-- /.page-content -->
        </div>
      </div><!-- /.main-content -->
      </section>

    <?php include 'footer.php';?>

</div><!-- /.main-container -->
</script>
</body>
</html>
