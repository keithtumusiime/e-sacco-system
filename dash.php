
<!DOCTYPE html>
<html lang="en">
<title>Member Dashboard</title>
  <head>
        <?php
        include 'head1.php';
        include 'db.php';
        $id = $_SESSION['customerID'];

        //member details
        $member = mysqli_query($con,"select * from  customer where customerID = '$id'");
        $member_details = mysqli_fetch_array($member);
        ?>

  </head>

  <!-- Content Wrapper. Contains page content -->
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

            <?php include 'sidenav1.php'?>

      <div class="main-content">
          <div class="page-content">
                        <div class="panel panel-info w3-card-4">
                            <div class="panel-heading">Client Details</div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <?php
                                        if($member_details['photo']!=''){
                                            ?>
                                            <img class="img-responsive" width="100" height="100" src="photos/<?php echo $member_details['photo']; ?>" alt="">
                                            <figcaption>Profile Photo</figcaption>
                                            <?php
                                        }
                                        else{
                                            ?>
                                            <img class="img-responsive img-thumbnail" width="100" height="100" src="photos/default.jfif" alt="">
                                            <figcaption>No Profile Photo</figcaption>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="col-sm-2">
                                        <h5 class="dash-heads" style="color: orange; font-weight: bold;">Client Name</h5>
                                        <?php echo $member_details['full_names'];?>

                                        <h5 class="dash-heads" style="color: orange; font-weight: bold;">Member Since</h5>
                                        <?php echo $member_details['join_date'];?>
                                    </div>
                                    <div class="col-sm-2">
                                        <h5 class="dash-heads" style="color: orange; font-weight: bold;">Client ID</h5>
                                        <?php echo $member_details['customerID'];?>

                                        <h5 class="dash-heads" style="color: orange; font-weight: bold;">Account Number</h5>
                                        <?php
                                        $acct = mysqli_query($con,"select * from accounts where customerID = '$id'");
                                        $acct_details = mysqli_fetch_array($acct);
                                        echo $acct_details['accountNumber'];?>
                                    </div>
                                    <div class="col-sm-6 w3-card-4">
                                        <div class="panel panel-info">
                                            <div class="panel-heading fa fa-users fa-2x ">Guarantee Details</div>
                                            <div class="panel-body">


                                                <?php
                                                include 'db.php';
                                                $id = $_SESSION['customerID'];
                                                $query = mysqli_query($con,"select * from loan where (guarantor1 ='$id' and balance != '0') or (guarantor2='$id' and balance !='0')");
                                                $guarant_details = mysqli_fetch_array($query);

                                                $action1 = $guarant_details['action1'];
                                                $action2 = $guarant_details['action2'];
                                                $adminAction = $guarant_details['adminAction'];

                                                $loan_ownerID = $guarant_details['customerid'];

                                                $loan_sql = mysqli_query($con,"select * from customer where customerID ='$loan_ownerID'");
                                                $loan_sql_details = mysqli_fetch_array($loan_sql);
                                                $loan_owner = $loan_sql_details['full_names'];

                                                if(mysqli_num_rows($query)>0){
                                                    ?>
                                                    <?php

                                                    if ($action1=='pending' || $action2=='pending' || $adminAction=='pending') {
                                                        ?>
                                                       <p>You are a Pending Guaranter to <b style="color: blue"><?php echo $loan_owner?></b></p>
                                                        <p>The Loan Applied For is <b style="color: blue"><?php echo "Shs. ".number_format($guarant_details['balance']).".00";?></b></p> 
                                                    <?php
                                                    }
                                                    else {
                                                    ?>
                                                       <p>You are an Active Guaranter to <b style="color: blue"><?php echo $loan_owner?></b></p>
                                                        <p>The Loan Balance to Clear is <b style="color: blue"><?php echo "Shs. ".number_format($guarant_details['balance']).".00";?></b></p> 
                                                    <?php
                                                    }
                                                    ?>
                                                <?php
                                                }else{
                                                    echo "
                                                    <p>You dont have any Guarantee</p>
                                                    ";
                                                }
                                                ?>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-info w3-card-4">
                            <div class="panel-heading">Account Overview</div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="panel panel-success ">
                                            <div class="panel-heading w3-blue">
                                                <span class="fa fa-money fa-2x left"> Loan Balance</span>
                                            </div>
                                            <div class="panel-body dash-content" >
                                                <?php
                                                $loan = mysqli_query($con,"select * from loan where customerid ='$id'");
                                                $loan_details = mysqli_fetch_array($loan);
                                                
                                                if($loan_details['balance']!=0 and $loan_details['loan_status']=="pending"){
                                                    echo  "Shs ".number_format($loan_details['balance']).".00";
                                                }else{
                                                    echo "No loan";
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="panel panel-success">
                                            <div class="panel-heading w3-blue" >
                                                <span class="fa fa-money fa-2x left"> Balance</span>
                                            </div>
                                            <div class="panel-body dash-content">
                                                <?php
                                                $balance = mysqli_query($con,"select * from accounts where customerid ='$id'");
                                                $balance_details = mysqli_fetch_array($balance);
                                                $balance = $balance_details['accountBalance'];
                                                echo  "Shs ".number_format($balance_details['accountBalance']).".00";
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="panel panel-success">
                                            <div class="panel-heading w3-blue">
                                                <span class="fa fa-money fa-2x left">Shares Capital</span>
                                            </div>
                                            <div class="panel-body dash-content">
                                                <?php
                                                $share = mysqli_query($con,"select sum(accountBalance) as balance from accounts");
                                                $total_money_details= mysqli_fetch_array($share);
                                                $total_money = $total_money_details['balance'];
                                                $my_share  = $balance_details['accountBalance'];


                                                $share_interest = ($my_share/$total_money)*100;

                                                echo round($share_interest, 3)  ." %";
                                                ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-info w3-card-4">
                            <div class="panel-heading">Recent Transactions</div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="table-responsive">
                                            <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                                                <thead>
                                                <tr style="color: #1B6AAA">
                                                    <th>Date</th>
                                                    <th>Type</th>
                                                    <th>Amount</th>
                                                    <th>Balance</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                include 'db.php';

                                                //Selectig the transaction details
                                                $query = mysqli_query($con,"select * from transactions where customerID='$id' and status ='approved' ORDER BY transactionDate ASC ");
                                                while ($transaction_details = mysqli_fetch_array($query)){
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $transaction_details['transactionDate'];?></td>
                                                        <td><?php echo $transaction_details['transaction_type'];?></td>
                                                        <td><?php echo number_format($transaction_details['transactionAmount']).".00";?></td>
                                                        <td><?php echo number_format($transaction_details['balance']).".00";?></td>
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
                        </div>
                        
          </div><!-- /.page-content -->
        </div>
      </div><!-- /.main-content -->

  <?php include 'footer.php';?>
</div>
<!-- ./wrapper -->


