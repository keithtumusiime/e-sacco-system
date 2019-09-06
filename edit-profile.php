<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'head1.php';
    include 'db.php';
    $id = $_GET['id'];

    $select = mysqli_query($con,"select * from  customer where customerID ='$id'");
    $details = mysqli_fetch_array($select);

    ?>
</head>

<body class="no-skin">
<?php include 'nav-bar.php'?>

<div class="main-container ace-save-state" id="main-container">
    <script type="text/javascript">
        try{ace.settings.loadState('main-container')}catch(e){}
    </script>
    <?php include 'sidenav.php'?>

    <div class="main-content">
        <div class="main-content-inner">
            <div class="breadcrumbs ace-save-state" id="breadcrumbs">
                <ul class="breadcrumb">
                    <li>
                        <i class="ace-icon fa fa-home home-icon"></i>
                        <a href="#">Home</a>
                    </li>

                    <li>
                        <a href="#">Profile</a>
                    </li>
                    <li class="active">Edit</li>
                </ul><!-- /.breadcrumb -->

                <div class="nav-search" id="nav-search">
                    <form class="form-search">
								<span class="input-icon">
									<input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
									<i class="ace-icon fa fa-search nav-search-icon"></i>
								</span>
                    </form>
                </div><!-- /.nav-search -->
            </div>

            <div class="page-content">
                <?php include 'settings.php';?>
                <!-- /.ace-settings-container -->
                <br>
                <br>
                <br>
                <div class="row">
                    <div class="col-xs-1"></div>

                    <div class="col-xs-10">
                        <form class="form-horizontal" action="edit-profile.php" method="post" enctype="multipart/form-data" role="form">

                            <div class="form-group">
                                <label class="col-sm-3" for="form-field-1-1"> Customer Names </label>

                                <div class="col-sm-9">
                                    <input  name="accnumber" value="<?php echo $details['accountNumber'] ?>" readonly  type="text" id="form-field-1-1"  class="form-control" />
                                    <input name="cid" value="<?php echo $details['customerID'] ?>"   type="hidden" class="span6 m-wrap"/>
                                </div>
                            </div>
                            <div class="space-4"></div>

                            <div class="form-group">
                                <label class="col-sm-3" for="form-field-1-1"> Amount: </label>

                                <div class="col-sm-9">
                                    <input type="text" id="form-field-1-1" name="amount" pattern="[0-9]+" title="Integer numbers only" required placeholder="Amount Deposited(Integers)"class="form-control" />
                                </div>
                            </div>
                            <div class="space-4"></div>


                            <div class="clearfix form-actions">
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

    <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
        <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
    </a>
</div><!-- /.main-container -->

<!-- basic scripts -->

<!--[if !IE]> -->
<script src="assets/js/jquery-2.1.4.min.js"></script>

<!-- <![endif]-->

<!--[if IE]>
<script src="assets/js/jquery-1.11.3.min.js"></script>
<![endif]-->
<script type="text/javascript">
    if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
</script>
<script src="assets/js/bootstrap.min.js"></script>

<!-- page specific plugin scripts -->

<!-- ace scripts -->
<script src="assets/js/ace-elements.min.js"></script>
<script src="assets/js/ace.min.js"></script>

<!-- inline scripts related to this page -->
</body>
</html>
