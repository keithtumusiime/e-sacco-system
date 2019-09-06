<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'head1.php';
    include 'db.php';
    $id = $_SESSION['customerID'];

    $select = mysqli_query($con,"select * from  accounts where customerID ='$id'");
    $details = mysqli_fetch_array($select);

    $memb = mysqli_query($con,"select * from customer where customerID = '$id'");
    $memb_details = mysqli_fetch_array($memb);
    ?>


    <style>
        .error{
            color: red;
            font-size: 14px;
            font-weight: bold;
        }
        .error{
            color: green;
            font-size: 16px;
            font-weight: bolder;
        }
    </style>
</head>

<?php include 'apply_loan_processing.php'?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Loans<small>Member</small></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="">Loans</li>
        <li class="active">Apply</li>
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
                    <div class="col-xs-1"></div>

                    <div class="col-xs-10">
                        <form class="form-horizontal" action="<?= $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data" role="form">

                             <h3 class="text-center well w3-text-blue">LOAN APPLICATION & AGREEMENT FORM</h3>
                             <p class="error" align="center"><?= $success;?></p>
                             <p align="center" style="color:red"><?= $error;?></p>
                            

                            <div class="form-group">
                                <label class="col-sm-3" for="form-field-1-1"> Member Names: </label>

                                <div class="col-sm-9">
                                    <input  name="fnames" value="<?php echo $memb_details['full_names'] ?>" readonly  type="text" id="form-field-1-1"  class="form-control" />
                                </div>
                            </div>
                            <div class="space-4"></div>
                            <div class="form-group">
                                <label class="col-sm-3" for="form-field-1-1"> Membership ID: </label>

                                <div class="col-sm-9">
                                    <input  name="" value="<?php echo $memb_details['customerID'] ?>" readonly  type="text" id="form-field-1-1"  class="form-control" />
                                </div>
                            </div>
                            <div class="space-4"></div>
                            <div class="form-group">
                                <label class="col-sm-3" for="form-field-1-1"> Account Number: </label>

                                <div class="col-sm-9">
                                    <input  name="accnumber" value="<?php echo $details['accountNumber'] ?>" readonly  type="text" id="form-field-1-1"  class="form-control" />
                                    <input name="cid" value="<?php echo $details['customerID'] ?>"   type="hidden" class="span6 m-wrap"/>
                                </div>
                            </div>
                            <div class="space-4"></div>

                            <div class="form-group">
                                <label class="col-sm-3" for="form-field-1-1">Loan Amount: </label>

                                <div class="col-sm-9">
                                    <input type="text" id="form-field-1-1" name="amount" pattern="[0-9]+" title="Months (example 1)" placeholder="Amount of loam needed(Integers)"class="form-control" />
                                </div>
                            </div>
                            <div class="space-4"></div>

                            <div class="form-group">
                                <label class="col-sm-3" for="form-field-1-1">Loan Term: </label>

                                <div class="col-sm-9">
                                    <input type="text" id="form-field-1-1" name="term" pattern="[0-9]+" title="Integer numbers only" placeholder="Period of the loan(Integers)"class="form-control" />
                                </div>
                            </div>
                            <div class="space-4"></div>

                            <div class="form-group">
                                <label class="col-sm-3" for="form-field-1-1">Interest Rate: </label>

                                <div class="col-sm-9">
                                    <input type="text" id="form-field-1-1" name="rate" readonly value="5 % Per Month" class="form-control" />
                                </div>
                            </div>
                            <div class="space-4"></div>

                            <div class="form-group">
                                <label class="col-sm-3" for="form-field-1-1">Guarantor1: </label>

                                <div class="col-sm-9">
                                <table width="100%">
                                    <tr>
                                        <td><input type="text" list="customer"  id="form-field-1-1" name="gar1" required placeholder="First" class="form-control" /></td>
                                        <td><input type="text" id="form-field-1-1" name="cont1" required placeholder="Contact" class="form-control" /></td>
                                    </tr>
                                    <tr>
                                        <td class="error"><?= $gar1_error;?></td>
                                    </tr>
                                </table>
                                    <datalist id="customer">
                                        <?php
                                        include 'db.php';
                                        $check = mysqli_query($con,"select * from customer");
                                        while($options = mysqli_fetch_array($check)){
                                            ?>
                                        <option value="<?php echo $options['full_names'];?>">

                                        <?php
                                        }

                                        ?>
                                    </datalist>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3" for="form-field-1-1">Guarantor2: </label>

                                <div class="col-sm-9">
                                    <table width="100%">
                                        <tr>
                                            <td><input type="text" list="customer"  id="form-field-1-1" name="gar2" required placeholder="Second" class="form-control" /></td>
                                            <td><input type="text"   id="form-field-1-1" name="cont2" required placeholder="Contact" class="form-control"/></td>
                                        </tr>
                                        <tr>
                                            <td class="error"><?= $gar2_error;?></td>
                                        </tr>
                                    </table>
                                    <datalist id="customer">
                                        <?php
                                        include 'db.php';
                                        $check = mysqli_query($con,"select * from customer");
                                        while($options = mysqli_fetch_array($check)){
                                        ?>
                                        <option value="<?php echo $options['full_names'];?>">

                                            <?php
                                            }

                                            ?>
                                    </datalist>
                                </div>
                            </div>

                            <div class="space-4"></div>
                            <div class="form-group">
                                <label class="col-sm-3" for="form-field-1-1">Reason: </label>

                                <div class="col-sm-9">
                                    <textarea class="form-control" name="reason" rows="5" id="comment"></textarea>
                                </div>
                            </div>
                            <div class="space-4"></div>

                            <div class="clearfix form-actions w3-card-4 w3-light-grey">
                                <div class="col-md-offset-3 col-md-9">
                                    <button class="btn btn-info" type="submit" name="submit">
                                        <i class="ace-icon fa fa-check bigger-110"></i>
                                        Submit
                                    </button>

                                    &nbsp; &nbsp; &nbsp;
                                    <button class="btn" type="reset">
                                        <i class="ace-icon fa fa-undo bigger-110"></i>
                                        Reset
                                    </button>
                                </div>

                            </div>
                        </form>
                    </div>

                    <div class="col-xs-1"></div>
                </div><!-- /.row -->

          </div><!-- /.page-content -->
        </div>
      </div><!-- /.main-content -->

  <?php include 'footer.php';?>
</div>
<!-- ./wrapper -->
</body>
</html>

