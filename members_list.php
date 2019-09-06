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
      <h1>Dashboard<small>Member</small></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
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
                        <h3 class="header smaller lighter blue">E-SACCO</h3>

                        <div class="clearfix">

                        <?php
                        $total_sql = mysqli_query($con,"select count(customerID) as total from customer where status='approved'");
                        $total = mysqli_fetch_array($total_sql);
                        ?>
                            <div class="row">
                                <div class="col-sm-3"><div class="tableTools-container"></div></div>
                                <div class="col-sm-3">
                                    <div class="alert alert-success w3-red w3-text-white">
                                        <strong>Total Members:</strong> <?php echo $total['total']; ?>
                                    </div>
                                </div>
                                <div class="col-sm-"></div>
                            </div>
                        </div>
                        <div class="table-header">
                            Members of Sacco
                        </div>

                        <!-- div.table-responsive -->

                        <!-- div.dataTables_borderWrap -->
                        <div class="table-responsive">
                            <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr style="color: #1B6AAA">

                                    <th>Names</th>
                                    <th>Contact</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>Occupation</th>
                                    <th>Photo</th>
                                    <th hidden>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                include 'db.php';

                                $query = mysqli_query($con,"select * from customer where status='approved' AND full_names!='Administrator'");
                                $id = 0;
                                while ($rqst_details = mysqli_fetch_array($query)){
                                    $id++;
                                    $customer_id = $rqst_details['customerID'];
                                    ?>
                                    <tr>

                                        <td><?php echo $rqst_details['full_names'];?></td>
                                        <td><?php echo $rqst_details['contact'];?></td>
                                        <td><?php echo $rqst_details['email'];?></td>
                                        <td><?php echo $rqst_details['address'];?></td>
                                        <td><?php echo $rqst_details['occupation'];?></td>
                                        <?php
                                        if($rqst_details['photo']!=''){
                                            ?>
                                            <td class="zoomin img-thumbnail img-responsive"><img  src="photos/<?php echo $rqst_details['photo'] ?>" alt=""></td>
                                        <?php
                                        }else{
                                           ?>
                                            <td class="zoomin img-thumbnail img-responsive"><img  src="photos/default.jfif" alt=""></td>
                                        <?php
                                             }
                                        ?>

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

    <?php include 'footer.php';?>

</div><!-- /.main-container -->