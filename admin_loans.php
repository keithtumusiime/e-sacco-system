<!DOCTYPE html>
<html lang="en">
<head>
<title>Approval Sheet</title>
    <?php include 'head1.php';
    include 'db.php';
    ?>
</head>

<body class="no-skin">


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Loan Request(s)<small>Admin</small></h1>
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
            
                    <div class="col-xs-12">
                        <div class="clearfix">
                            <div class="pull-left tableTools-container"></div>
                        </div>
                        <div class="table-header"> Un approved Transactions
                        </div>

                        <!-- div.table-responsive -->

                        <!-- div.dataTables_borderWrap -->
                        <div class="table-responsive">
                            <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr style="color: #1B6AAA">
                                    <th>Name</th>
                                    <th>Contact</th>
                                    <th>Amount</th>
                                    <th>Reason</th>
                                    <th>Details</th>
                                    <th colspan="2">Actions</th>
                                    <th hidden>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                include 'db.php';

                                $query = mysqli_query($con,"select * from loan   where adminAction ='Pending'");
                                while ($loan_details = mysqli_fetch_array($query)){
                                    $customer_id = $loan_details['customerid'];

                                    $personal = mysqli_fetch_array(mysqli_query($con,"select * from customer where customerID = '$customer_id'"))
                                    ?>
                                    <tr>
                                        <td><?php echo $personal['full_names'];?></td>
                                        <td><?php echo $personal['contact'];?></td>
                                        <td><?php echo $loan_details['amount'];?></td>
                                        <td><?php echo $loan_details['reason'];?></td>
                                        <td align="center"><a class="green" href="admin_loan2.php?id=<?php echo $customer_id?>"><i class="ace-icon fa fa-eye bigger-180" style="color: green; font-size: 27px;"></i></a></td>

                                        <?php
                                        if($loan_details['action1'] == 'Accepted' and $loan_details['action2']=='Accepted'){
                                            ?>
                                            <td align="center"><a class="green" href="grant_loan.php?id=<?php echo  $customer_id;?>" ><i class="ace-icon fa fa-check-circle bigger-180" style="color: green; font-size: 27px;"></i></a></td>
                                            <td align="center"></td>
                                            <?php
                                        }
                                        elseif($loan_details['action1'] == 'Denied' and $loan_details['action2']=='Denied'){
                                            ?>
                                            <td align="center"><a class="red" href=""><i class="ace-icon fa fa-close bigger-180" style="color: red; font-size: 27px;"></i></a></td>
                                            <td align="center"></td>
                                            <?php
                                        }
                                        else{
                                            ?>
                                            <td align="center"></td>
                                            <td align="center"></td>
                                        <?php
                                        }
                                        ?>
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
