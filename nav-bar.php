<?php
include 'db.php';
$id = $_SESSION['customerID'];
$select = mysqli_query($con,"select * from customer where customerID = '$id'");
$cus_details = mysqli_fetch_array($select);
?>
<div id="navbar" class="navbar navbar-default          ace-save-state">
    <div class="navbar-container ace-save-state" id="navbar-container">
        <button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
            <span class="sr-only">Toggle sidebar</span>

            <span class="icon-bar"></span>

            <span class="icon-bar"></span>

            <span class="icon-bar"></span>
        </button>

        <div class="navbar-header pull-left">
            <a href="dashboard.php" class="navbar-brand">
                <small>
                    <i class="fa fa-leaf"></i>
                    Sacco Application
                </small>
            </a>
        </div>

        <div class="navbar-buttons navbar-header pull-right" role="navigation">
            <ul class="nav ace-nav">



                <?php
                include 'db.php';

                $count_request = mysqli_query($con,"select count(customerID)as requests from customer where status ='pending'");
                $counted_requests = mysqli_fetch_array($count_request);
                ?>
                <?php
                if($_SESSION['customerID']=='C11011'){
                    ?>
                    <li class="purple dropdown-modal">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="ace-icon fa fa-users icon-animated-bell"></i>
                            <span class="badge badge-important"><?php echo $counted_requests['requests'];?></span>
                        </a>

                        <ul class="dropdown-menu-right dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-close">
                            <li class="dropdown-header">
                                <i class="ace-icon fa fa-exclamation-triangle"></i>
                                <?php echo $counted_requests['requests'];?> Request(s)
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
                                                        <?php echo $request['full_names'];?>
													</span>
                                                    <span class="pull-right badge"><?php echo $request['join_date'];?></span>
                                                </div>
                                            </a>
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



                <li class="light-blue dropdown-modal">
                    <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                        <?php
                        if($cus_details['photo']!=''){
                          ?>
                            <img class="nav-user-photo" src="photos/<?=$cus_details['photo'];?>" alt="User's Photo" />
                        <?php
                        }else{
                            ?>
                            <img class="nav-user-photo" src="photos/default.jfif" alt="User's Photo" />
                        <?php
                        }
                        ?>

                        <span class="user-info">
									<small>Welcome,</small>
									<?php
                                    if($_SESSION['customerID']=='C11011'){
                                        echo "System Admin";
                                    }
                                    echo $cus_details['full_names'];?>
								</span>

                        <i class="ace-icon fa fa-caret-down"></i>
                    </a>

                    <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">

                        <li>
                            <a href="profile.php?customerID=<?php echo $id;?>">
                                <i class="ace-icon fa fa-user"></i>
                                Profile
                            </a>
                        </li>

                        <li class="divider"></li>

                        <li>
                            <a href="logout.php">
                                <i class="ace-icon fa fa-power-off"></i>
                                Logout
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div><!-- /.navbar-container -->
</div>