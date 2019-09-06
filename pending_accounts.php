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
      <h1>Profile<small>Admin</small></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
        <li class="">Loans</li>
        <li class="active">Members Approval Sheet</li>
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
                            <div class="pull-right tableTools-container"></div>
                        </div>
                        <div class="table-header">
                            Un approved Transactions
                        </div>

                        <!-- div.table-responsive -->

                        <!-- div.dataTables_borderWrap -->
                        <div class="table-responsive">
                            <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr style="color: #1B6AAA">
                                    <th>Names</th>
                                    <th>Address</th>
                                    <th>Contact</th>
                                    <th>Email</th>
                                    <th colspan="3">Actions</th>
                                    <th hidden>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                include 'db.php';

                                $query = mysqli_query($con,"select * from customer where status='Pending'");
                                $id = 0;
                                while ($rqst_details = mysqli_fetch_array($query)){
                                    $id++;
                                    $customer_id = $rqst_details['customerID'];
                                    ?>
                                    <tr>
                                        <td><?php echo $rqst_details['full_names'];?></td>
                                        <td><?php echo $rqst_details['address'];?></td>
                                        <td><?php echo $rqst_details['contact'];?></td>
                                        <td><?php echo $rqst_details['email'];?></td>
                                        <td align="center"><a class="green" onclick="return accept()" href="account-accept.php?customerID=<?php echo $customer_id?>" ><i class="ace-icon fa fa-check-circle bigger-180"></i></a></td>
                                        <td align="center"><a class="red" href="delete_account.php?customerID=<?php echo $customer_id; ?>"><i class="ace-icon fa fa-close bigger-180"></i></a></td>
                                        <td align="center"><a class="red" href="profile.php?customerID=<?php echo $customer_id?>""><i class="ace-icon fa fa-eye bigger-180"></i></a></td>
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
</div><!-- /.main-container -->

