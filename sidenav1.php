<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar ">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="photos/<?php echo $member_details['photo']; ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $member_details['full_names'];?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat">
                  <i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
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
                <a href="dash.php">
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

            <li class="treeview">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon fa fa-desktop"></i>
                    <span> Transactions</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="deposit.php">
                            <i class="menu-icon fa fa-circle-o"></i>
                            Deposit
                        </a>
                        <li>
                        <a href="Withdraw.php">
                            <i class="menu-icon fa fa-circle-o"></i>
                            Withdraw
                        </a>

                        <a href="send.php">
                            <i class="menu-icon fa fa-circle-o"></i>
                            Send Money
                        </a>
                        
                    </li>
                        
                    </li>
                </ul>
            </li>
        <?php
        }
        ?>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Reports</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
                <?php
                if($_SESSION['customerID']=='C11011'){
                    ?>
                    <li>
                        <a href="statement.php">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Sacco Statement
                        </a>
                    </li>

                <?php
                }else{
                    ?>
                    <li>
                        <a href="statement.php">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Transaction Statement
                        </a>
                    </li>
                    <?php
                }
                ?>
            </ul>
        </li>
        <?php
       if($_SESSION['customerID']=='C11011'){
           
           $mem_request = mysqli_query($con,"select count(customerID) as mem_request from customer where status ='pending'");
            $mem_request = mysqli_fetch_array($mem_request);
            ?>

           <li class="">
               <a href="members.php">
                   <i class="menu-icon fa fa-street-view"></i>
                   <span class="menu-text"> Members </span>
               </a>

               <b class="arrow"></b>
           </li>
           <li class="">
               <a href="account-accept.php">
                   <i class="menu-icon fa fa-street-view"></i>
                   <span class="menu-text"> <b style="color: red"><?php echo $mem_request['mem_request'];?></b> Members Request(s) </span>
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
        <?php
        if($_SESSION['customerID']=='C11011'){ ?>
        <li class="treeview">
        
          <a href="#">
            <i class="fa fa-edit"></i> <span>Manage Accounts</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href=""><i class="fa fa-circle-o"></i> Savings Account</a></li>
            <li><a href=""><i class="fa fa-circle-o"></i> Fixed Account</a></li>
            <li><a href=""><i class="fa fa-circle-o"></i> Current Account</a></li>
          </ul>

        </li><?php } ?> 
       <li>
          <a href="pages/mailbox/mailbox.php">
            <i class="fa fa-envelope"></i> <span>Mailbox</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-yellow">12</small>
              <small class="label pull-right bg-green">16</small>
              <small class="label pull-right bg-red">5</small>
            </span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-table"></i> <span>Loans</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">


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
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>