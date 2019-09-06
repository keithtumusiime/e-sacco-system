<?php
include 'db.php';
$id = $_SESSION['customerID'];
$select = mysqli_query($con,"select * from customer where customerID = '$id'");
$cus_details = mysqli_fetch_array($select);
?>

<div id="sidebar" class="sidebar  responsive ace-save-state">
    <script type="text/javascript">
        try{ace.settings.loadState('sidebar')}catch(e){}
    </script>

    <div class="sidebar-shortcuts" id="sidebar-shortcuts">
        <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
            <button class="btn btn-success">
                <i class="ace-icon fa fa-signal"></i>
            </button>

            <button class="btn btn-info">
                <i class="ace-icon fa fa-pencil"></i>
            </button>

            <button class="btn btn-warning">
                <i class="ace-icon fa fa-users"></i>
            </button>

            <button class="btn btn-danger">
                <i class="ace-icon fa fa-cogs"></i>
            </button>
        </div>

        <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
            <span class="btn btn-success"></span>

            <span class="btn btn-info"></span>

            <span class="btn btn-warning"></span>

            <span class="btn btn-danger"></span>
        </div>
    </div><!-- /.sidebar-shortcuts -->

    <ul class="nav nav-list">
        <li class="">
            <?php
            if($_SESSION['customerID']=='C11011'){
                ?>
                <a href="admin-dash.php">
                    <i class="menu-icon fa fa-tachometer"></i>
                    <span class="menu-text"> Dashboard </span>
                </a>
            <?php
            }else{
                ?>
                <a href="dashboard.php">
                    <i class="menu-icon fa fa-tachometer"></i>
                    <span class="menu-text"> Dashboard </span>
                </a>
                <?php
            }
            ?>

            <b class="arrow"></b>
        </li>

        <?php
        if($_SESSION['customerID']=='C11011'){
            ?>
            <li class="">
                <a href="pending-transactions.php">
                    <i class="menu-icon fa fa-desktop"></i>
                    <span class="menu-text"> Transaction </span>
                </a>

                <b class="arrow"></b>
            </li>
        <?php
        }

        ?>

        <?php
        if($_SESSION['customerID']!='C11011'){
            ?>

            <li class="">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon fa fa-desktop"></i>
                    <span class="menu-text">
								Transactions
							</span>

                    <b class="arrow fa fa-angle-down"></b>
                </a>

                <b class="arrow"></b>

                <ul class="submenu">


                    <li class="">
                        <a href="deposit.php">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Deposit
                        </a>
                        <b class="arrow"></b>
                    </li>
                </ul>
            </li>
        <?php
        }
        ?>

        <li class="">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-list"></i>
                <span class="menu-text"> Reports </span>

                <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>

            <ul class="submenu">
                <?php
                if($_SESSION['customerID']=='C11011'){
                    ?>
                    <li class="">
                        <a href="statement.php">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Sacco Statement
                        </a>

                        <b class="arrow"></b>
                    </li>

                <?php
                }else{
                    ?>
                    <li class="">
                        <a href="statement.php">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Transaction Statement
                        </a>

                        <b class="arrow"></b>
                    </li>
                    <?php
                }
                ?>



            </ul>
        </li>

       <?php
       if($_SESSION['customerID']=='C11011'){
           ?>
           <li class="">
               <a href="members.php">
                   <i class="menu-icon fa fa-street-view"></i>
                   <span class="menu-text"> Members </span>
               </a>

               <b class="arrow"></b>
           </li>
        <?php
       }else{
           ?>
           <li class="">
               <a href="members_list.php">
                   <i class="menu-icon fa fa-street-view"></i>
                   <span class="menu-text"> Members </span>
               </a>

               <b class="arrow"></b>
           </li>
        <?php
       }

       ?>



        <?php
        if($_SESSION['customerID']=='C11011'){

            $loan_request = mysqli_query($con,"select count(id) as loan_request from loan where adminAction ='pending'");
            $loan_request = mysqli_fetch_array($loan_request);

            ?>
            <li class="">
                <a href="admin_loans.php">
                    <i class="menu-icon fa fa-angellist"></i>
                    <span class="menu-text"><b style="color: red"><?php echo $loan_request['loan_request'];?></b> Loan Request(s) </span>
                </a>

                <b class="arrow"></b>
            </li>
        <?php
        }
        ?>

        <li class="">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-list"></i>
                <span class="menu-text"> Loans </span>

                <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>

            <ul class="submenu">


                <?php
                if($_SESSION['customerID']=='C11011'){
                    ?>
                    <li class="">
                        <a href="loans_taken.php">
                            <i class="menu-icon fa fa-caret-right"></i>
                          Unpaid Loans
                        </a>

                        <b class="arrow"></b>
                    </li>
                    <li class="">
                        <a href="accept_loan_payments.php">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Pending Payments
                        </a>

                        <b class="arrow"></b>
                    </li>
                <?php
                }else{
                    ?>
                    <li class="">
                        <a href="loan_apply.php">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Apply
                        </a>
                        <b class="arrow"></b>
                    </li>
                    <li class="">
                        <a href="pay_loan.php">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Clear
                        </a>
                        <b class="arrow"></b>
                    </li>
                    <li class="">
                        <a href="mini_loan_statement.php">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Mini Statement
                        </a>

                        <b class="arrow"></b>
                    </li>
                <?php
                }
                ?>


            </ul>
        </li>

        <?php
        include 'db.php';
        $id = $_SESSION['customerID'];
        $query = mysqli_query($con,"select count(id) as guarant_request from loan where (guarantor1 ='$id' and action1='pending') or (guarantor2='$id' and action2 ='pending')");
        $guarant_request = mysqli_fetch_array($query);

        if($guarant_request['guarant_request']>0){
          ?>
            <li class="">

                <a href="guarantees.php">
                    <i class="menu-icon fa fa-angellist "></i><b style="color: red"><?php echo $guarant_request['guarant_request'];?></b>
                    <span class="menu-text"> Guarantee(s) </span>
                </a>

                <b class="arrow"></b>
            </li>
        <?php
        }
        ?>


    </ul><!-- /.nav-list -->

    <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
        <i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
    </div>
</div>