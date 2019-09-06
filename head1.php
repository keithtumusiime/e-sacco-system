<?php
date_default_timezone_set('Africa/Kampala');
include "session.php";
include 'db.php';
$id = $_SESSION['customerID'];

//member details
$member = mysqli_query($con,"select * from  customer where customerID = '$id'");
$member_details = mysqli_fetch_array($member);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!--set icon-->
  <link rel="shortcut icon" href="assets/assets/img/title.gif" type="image/x-icon">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <meta name="description" content="overview &amp; stats" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

<link rel="stylesheet" href="assets/css/fonts.googleapis.com.css" />
<link rel="stylesheet" href="assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
<script src="assets/js/ace-extra.min.js"></script>
<link rel="stylesheet" href="assets/css/w3.css" />
<link rel="stylesheet" href="assets/css/style.css" />
<link rel="stylesheet" href="assets/css/ace-rtl.min.css" />
<link rel="stylesheet" href="assets/css/ace-skins.min.css" />

<!--[if lte IE 9]>
<link rel="stylesheet" href="assets/css/ace-part2.min.css" class="ace-main-stylesheet" />
<![endif]-->
<!--[if lte IE 9]>
<link rel="stylesheet" href="assets/css/ace-ie.min.css" />
<![endif]-->
<script type="text/javascript">
  $(document).ready(function(){
    $("#mytable").DataTables();
  });
</script>
<!-- Javascript for Approving balance-->
<script>
    function accept(){
        var x = confirm("Are you sure you want to Continue with this Operation?");
        if(x==true){return true;}
        if(x==false){return false;}
    }
</script>


<!-- Javascript for denying balance-->
<script>
    function abort(){
        var x = delete("Are you sure you want to Delete this Record?");
        if(x==true){return true;}
        if(x==false){return false;}
    }
</script>


  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">

    <!-- Logo -->
    <a href="dash.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>e</b>S</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>E-SACCO</b></span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="badge label-danger">4</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 4 messages</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- start message -->
                    <a href="#">
                      <div class="pull-left">
                        <img src="dist/img/keith1.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Support Team
                        <small><i class="fa fa-clock-o"></i> 5 mins</small>
                      </h4>
                      <p>Why not join the electronic saving?</p>
                    </a>
                  </li>
                  <!-- end message -->
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        e-Sacco Design Team
                        <small><i class="fa fa-clock-o"></i> 2 hours</small>
                      </h4>
                      <p>Why not open an account with e-Sacco?</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Developers
                        <small><i class="fa fa-clock-o"></i> Today</small>
                      </h4>
                      <p>Test the Smart way savings</p>
                    </a>
                  </li>
                  <li>
                    <a href="">
                      <div class="pull-left">
                        <img src="dist/img/keith.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Sales Department
                        <small><i class="fa fa-clock-o"></i> Yesterday</small>
                      </h4>
                      <p>Know your net-Share instantly</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="dist/img/patty2.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Reviewers
                        <small><i class="fa fa-clock-o"></i> 2 days</small>
                      </h4>
                      <p>Reduce distance by saving from home</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">See All Messages</a></li>
            </ul>
          </li>
          <!-- Notifications: style can be found in dropdown.less -->


                <?php
                include 'db.php';

                //member requests
                $count_request = mysqli_query($con,"select count(customerID)as requests from customer where status ='pending'");
                $counted_requests = mysqli_fetch_array($count_request);

                //loan requests.
                $count_loan = mysqli_fetch_array(mysqli_query($con,"select count(customerID)as loan_request from loan where adminAction ='pending'"));

                //getting total requests
                $total = $counted_requests['requests'] + $count_loan['loan_request'];

                ?>

                <?php
                if($_SESSION['customerID']=='C11011'){
                    ?>
                    <li class="purple dropdown-modal">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="ace-icon fa fa-bell-o icon-animated-bell"></i>
                            <span class="badge badge-danger"><?php echo $total;?></span>
                        </a>

                        <ul class="dropdown-menu-right dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-close">
                            <li class="dropdown-header">
                                <i class="ace-icon fa fa-exclamation-triangle"></i>
                                You have <?php echo $total;?> notification(s)<br>
                            </li>

                            <li class="dropdown-content">
                                <ul class="dropdown-menu dropdown-navbar navbar-pink">

                                    <?php
                                    include 'db.php';
                                    $re = mysqli_query($con,"select * from customer where status ='pending'");
                                    while($request = mysqli_fetch_array($re)){
                                        $customerID = $request['customerID'];
                                        ?>
                                        <li>
                                            <a href="profile.php?customerID=<?php echo $customerID?>">
                                              <div class="clearfix">
                                                <span class="pull-left">
                                                  <i class="btn btn-xs no-hover btn-pink fa fa-eye"></i>
                                                  <?php echo $request['full_names'];?> has requested for Membership
                                                </span>
                                                      
                                                <span class="pull-right badge"><?php echo $request['join_date'];?></span>
                                              </div>
                                            </a>
                                        </li>
                                        <li>
                                        </li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </li>

                            <li class="dropdown-footer">
                                <a href="pending_accounts.php">
                                    See all notifications
                                    <i class="ace-icon fa fa-arrow-right"></i>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php
                  }
                ?>

                <?php
                $chech = mysqli_fetch_array(mysqli_query($con,"select accountNumber from accounts where customerID = '$id'"));

               $sendmoney = mysqli_fetch_array(mysqli_query($con,"select count(receiverID)as sent from transfers where  status = '0' and receiverID = '$id'" ));


                if($_SESSION['customerID']!='C11011'){
                    ?>
                    <li class="purple dropdown-modal">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="ace-icon fa fa-bell-o icon-animated-bell"></i>
                            <span class="badge badge-danger"><?php echo $sendmoney['sent'];?></span>
                        </a>

                        <ul class="dropdown-menu-right dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-close">
                            <li class="dropdown-header">
                                <i class="ace-icon fa fa-exclamation-triangle"></i>
                                You have <?php echo $sendmoney['sent'];?> Notifications<br>
                            </li>

                            <li class="dropdown-content">
                                <ul class="dropdown-menu dropdown-navbar navbar-pink">

                                    <?php
                                    include 'db.php';
                                    $re = mysqli_query($con,"select * from transfers where receiverID ='$id' and status = 0");
                                    while($request = mysqli_fetch_array($re)){
                                        $senderID = $request['senderAC'];
                                        $money = $request['amount'];
                                        $test = mysqli_fetch_array(mysqli_query($con,"select * from accounts where accountNumber = '$senderID'"));
                                        ?>
                                        <li>
                                            <a href="">
                                              <div class="clearfix">
                                                <span class="pull-left">
                                                  <i class="btn btn-xs no-hover btn-pink fa fa-eye"></i>
                                                  You have received <?php echo $money;?> from <?php echo $test['accountName'];?>
                                                </span>
                                                      
                                                <span class="pull-right badge"><?php echo $request['transactiondate'];?></span>
                                              </div>
                                            </a>
                                        </li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </li>

                            <li class="dropdown-footer">
                                <a href="">
                                    See all notifications
                                    <i class="ace-icon fa fa-arrow-right"></i>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php
                  }
                ?>

          
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="photos/<?php echo $member_details['photo']; ?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $member_details['full_names'];?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="photos/<?php echo $member_details['photo']; ?>" class="img-circle" alt="User Image">

                <p>
                  <?php echo $member_details['full_names'];?> - <?php echo $member_details['occupation'];?>
                  <small>Member since <?php echo $member_details['join_date'];?></small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="profile.php" class="btn btn-default btn-primary">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="logout.php" class="btn btn-default btn-primary">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>

    </nav>
  </header>
  <!-- Javascript for Approving balance-->
<!--Zooming images when the mouse is over-->
<style type="text/css"> .zoomin img { height: 35px; width: 35px; -webkit-transition: all 2s ease; -moz-transition: all 2s ease; -ms-transition: all 2s ease; transition: all 2s ease; } .zoomin img:hover { width: 100px; height: 100px; } </style>
