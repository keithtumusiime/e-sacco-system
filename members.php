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
      <h1>Members<small>Admin</small></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
        <li class="">Transactions</li>
        <li class="active">Approval Sheet</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
            <?php include 'sidenav1.php'?>

      <div class="main-content">
          <div class="page-content">

                <div class="row">
                <div class="col-sm-3"><div class="tableTools-container"></div></div>
                    <div class="col-xs-12">
                        <div class="table-header">
                            Members of Sacco
                        </div>

                        <!-- div.dataTables_borderWrap -->
                        <div class="table-responsive">
                            <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr style="color: #1B6AAA">
                                    <th>ID</th>
                                    <th>Names</th>
                                    <th>Contact</th>
                                    <th>Email</th>
                                    <th>JoinDate</th>
                                    <th colspan="3">Actions</th>
                                    <th hidden>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                include 'db.php';

                                $query = mysqli_query($con,"select * from customer where status='approved'");
                                $id = 0;
                                while ($rqst_details = mysqli_fetch_array($query)){
                                    $id++;
                                    $customer_id = $rqst_details['customerID'];
                                    ?>
                                    <tr>
                                        <td><?php echo $rqst_details['customerID'];?></td>
                                        <td><?php echo $rqst_details['full_names'];?></td>
                                        <td><?php echo $rqst_details['contact'];?></td>
                                        <td><?php echo $rqst_details['email'];?></td>
                                        <td><?php echo $rqst_details['join_date'];?></td>
                                        <td align="center"><a class="red" href="delete_member.php?id=<?php echo $customer_id; ?>"><i class="ace-icon fa fa-trash bigger-180 " style="color: red; font-size: 27px;"></i></a></td>
                                    <td></td>
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
        </div>
        <?php include 'footer.php';?>
      </div><!-- /.main-content -->
</div><!-- /.main-container -->
