<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8" />
    <title>Registration Form - Sacco</title>

    <meta name="description" content="User login page" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <link rel="shortcut icon" href="assets/assets/img/title.gif" type="image/x-icon">

    <!-- bootstrap & fontawesome -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/font-awesome/4.5.0/css/font-awesome.min.css" />

    <!-- text fonts -->
    <link rel="stylesheet" href="assets/css/fonts.googleapis.com.css" />

    <!-- ace styles -->
    <link rel="stylesheet" href="assets/css/ace.min.css" />

    <!--[if lte IE 9]>
    <link rel="stylesheet" href="assets/css/ace-part2.min.css" />
    <![endif]-->
    <link rel="stylesheet" href="assets/css/ace-rtl.min.css" />

    <!--[if lte IE 9]>
    <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
    <![endif]-->

    <!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

    <!--[if lte IE 8]>
    <script src="assets/js/html5shiv.min.js"></script>
    <script src="assets/js/respond.min.js"></script>
    <![endif]-->

    <!-- calendar -->
    <link href="assets/date/jscal2.css" rel="stylesheet" media="screen">
    <link href="assets/date/datepicker.css" rel="stylesheet" type="text/css" />
    <script src="assets/date/jscal2.js"></script>
    <script src="assets/date/en.js"></script>
    <script type="text/javascript" src="assets/date/datepicker.js"></script>

    <style>
        .error{
            color: red;
            font-size: 16px;
            font-weight: bold;
        }
        body {
            background: url(assets/images/f.PNG) no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }
    </style>
</head>


<?php
include 'db.php';
$message = "";
date_default_timezone_set('Africa/Kampala');
if(isset($_POST['submit'])){
    $names = ucwords($_POST['names']);
    $address = ucwords($_POST['address']);
    $contact = $_POST['contact'];
    $dob = $_POST['dob'];
    $email = $_POST['email'];
    $date = date("Y-m-d H:i:s");
    $occupation = ucwords($_POST['occupation']);
    $username = $_POST['username'];
    $password = $_POST['password'];
    $id = "C".rand(10000,99999);
//checking if the Customer id exists

    $password_encrypt = sha1($password);
    $check = mysqli_query($con,"select * from customer where customerID='$id'");
    while(mysqli_num_rows($check) > 0){
        $id ++;
    }
//checking if the member already exists
    $check_account = mysqli_query($con,"select * from customer where email='$email' or contact ='$contact'");
    if(mysqli_num_rows($check_account)>0){
        $message = "<div class=\"alert alert-danger\"><strong>Failed! The account already exists</strong></div>";
    }
    else{

        //check if the username already exists
        $check_username = mysqli_query($con,"select * from login where username = '$username'");
        if(mysqli_num_rows($check_username) > 0){
            $message = "<div class=\"alert alert-danger\"><strong>Failed! The Username already taken. Chose another one</strong></div>";
        }else{
            // saving the photo
            $user_photo = $_FILES["photo"]["name"];
            $name = basename($_FILES['photo']['name']);
            $t_name = $_FILES['photo']['tmp_name'];
            $dir = 'photos';
            move_uploaded_file($t_name,$dir."/".$name);
            $folder = "/wamp/htdocs/sacco/photos/";
            // saving the photo

            $insert = mysqli_query($con,"insert into customer(customerID,full_names,address,contact,dob,email,join_date,occupation,photo,status)
VALUES ('$id','$names','$address','$contact','$dob','$email','$date','$occupation','$user_photo','pending')
");

            $ìnsert = mysqli_query($con,"insert into login(customerID,username,password)VALUES ('$id','$username','$password_encrypt')");

            if( $insert ) {
                $message = "<div class=\"alert alert-success\"><strong>Success! Request Sent.</strong></div>";

                //Sending confirmation link using phpmmailer  
                require("PHPMailer_5.2.0/class.phpmailer.php");
                
                $message = "Hello $names.<br> A confirmation link has been sent to $email.<br>Thanks for joining our sacco.";
            
                $mail = new PHPMailer();                    //Use phpmailer to send instead of inbult php mail()                
                $mail->isSMTP();                            // Set mailer to use SMTP
                $mail->Host = 'smtp.gmail.com';             // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                     // Enable SMTP authentication
                $mail->Username = 'keithtumusiime6@gmail.com';// SMTP username
                $mail->Password = 'keith.amooti';            // SMTP password
                $mail->SMTPSecure = 'ssl';                  // Enable TLS encryption, `ssl` also accepted
                $mail->FromName = "Mailer";
                $mail->WordWrap = 50;                       // set word wrap
                $mail->IsHTML(true);                        // send as HTML
                $mail->Port = 465;                          // TCP port to connect to

                $mail->From = 'sacco@gmail.com';
                $mail->FromName = 'System Administrator';
                $mail->AddAddress($email); //change it to your email address to actually get the email! 
                $mail->AddBCC('keithtumusiime6@gmail.com.com'); 
                $mail->AddReplyTo('keithtumusiime6@gmail.com');
            
                $mail->Subject  = 'Sign Up to online sacco';
                $mail->Body = $message;
            
                if($mail->Send())
                {
                    echo "Check your email for account information.";
                    echo '<br>';
                    echo '<a button class="btn btn-success" title="Click to bo back"
                                                     href="index.php">Back</a>';
                }
                else
                {
                     echo "Failed to connect to your email.<br>";
                     echo "Mailer Error: " . $mail->ErrorInfo;
                     echo '<br>';
                     echo '<a button class="btn btn-success" title="Click to bo back"
                                                         href="index.php">Back</a>';
                 }

            }else{
                $message = "<div class=\"alert alert-danger\"><strong>Failed! Request Sent Failed</strong></div>";
            }

        }

    }
}

?>
<body class="login-layout">
<div class="main-container">
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <b class="navbar-brand" >E-SACCO SYSTEM</b>
            </div>

            <div class="navbar-header" style="float: right">
                <a class="navbar-brand fa fa-facebook" href="https://facebook.com/keithorganisations"></a>
                <a class="navbar-brand fa fa-twitter" href="#"></a>
                <a class="navbar-brand fa fa-whatsapp" href="#"></a>
            </div>
        </div>
    </nav>
    <div class="main-content">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <div class="login-container">
                    <div class="center">
                        <h1>
                            <h1>
                                <img class="img-responsive" src="assets/images/logo.png" alt="">
                            </h1>
                        </h1>
                    </div>

                    <div class="space-6"></div>

                    <div class="position-relative">
                        <div id="login-box" class="login-box visible widget-box no-border">
                            <div class="widget-body">
                                <div class="widget-main">
                                    <h4 class="header green lighter bigger">
                                        <i class="ace-icon fa fa-users blue"></i>
                                        Member Registration
                                    </h4>

                                    <div class="space-6"></div>
                                    <p> Enter your details to begin: </p>

                                    <form action="register.php" method="post" enctype="multipart/form-data">
                                        <fieldset>
                                            <label class="block clearfix">
												<?php echo $message?>
                                            </label>
                                            <label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="text" class="form-control"  required="required" autocomplete="off"name="names" placeholder="Your Names" />
															<i class="ace-icon fa fa-user"></i>
														</span>
                                            </label>

                                            <label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="text" required="required" autocomplete="off" class="form-control" name="address" placeholder="Adress" />
															<i class="ace-icon fa fa-location-arrow"></i>
														</span>
                                            </label>

                                            <label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="text" required="required" autocomplete="off" maxlength="10" minlength="10" pattern="[0-9]+" title="Invalid Phone Number" class="form-control" name="contact" placeholder="Contact" />
															<i class="ace-icon fa fa-phone"></i>
														</span>
                                            </label>
                                            <label class="block clearfix">
														<span class="block input-icon input-icon-right">
															 <input class="span2 form-control-md" name="dob" id="sdate" placeholder="select date" readonly="readonly"/>
                                                            <button id="f_btn1"><li class="fa fa-calendar"></li></button> 
                                                            <script type="text/javascript">//<![CDATA[
                                                                Calendar.setup({
                                                                    inputField : "sdate",
                                                                    trigger    : "f_btn1",
                                                                    onSelect   : function() { this.hide() },

                                                                    dateFormat : "%Y-%m-%d"
                                                                });                    //]]>
                                                            </script>
                                                        </span>
                                            </label>


                                            <label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="email" name="email" required="required" autocomplete="off" class="form-control" placeholder="Email" />
															<i class="ace-icon fa fa-envelope"></i>
														</span>
                                            </label>

                                            <label class="block clearfix">
														<span class="block input-icon input-icon-right">
                                                                <input type="text" class="form-control" required="required" autocomplete="off" name="occupation" placeholder="Occupation" />

														</span>
                                            </label>

                                            <label class="block clearfix">
														<span class="block input-icon input-icon-right">
                                                            <input class="span6 m-wrap btn-primary"  type="file" name="photo" />
														<i class="ace-icon fa fa-photo"></i>
                                                        </span>
                                            </label>

                                            <label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="text" class="form-control" required="required" autocomplete="off" name="username" placeholder="Username" />
															<i class="ace-icon fa fa-user"></i>
														</span>
                                            </label>

                                            <label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="password" class="form-control" pattern=".{6,}" title="Six or more characters" required="required" autocomplete="off" name="password" placeholder="Password" />
															<i class="ace-icon fa fa-lock"></i>
														</span>
                                            </label>


                                            <label class="block">
                                                <input type="checkbox" required="required" class="ace" />
                                                <span class="lbl">
															I accept the User Agreement
                                                </span>
                                            </label>

                                            <div class="space-24"></div>

                                            <div class="clearfix">
                                                <button type="reset" class="width-30 pull-left btn btn-sm">
                                                    <i class="ace-icon fa fa-refresh"></i>
                                                    <span class="bigger-110">Reset</span>
                                                </button>

                                                <button type="submit" name="submit" class="width-65 pull-right btn btn-sm btn-success">
                                                    <span class="bigger-110">Register</span>

                                                    <i class="ace-icon fa fa-arrow-right icon-on-right"></i>
                                                </button>
                                            </div>
                                        </fieldset>
                                    </form>
                                </div><!-- /.widget-main -->

                                <div class="toolbar clearfix">
                                    <div style="text-align: center">
                                        <a href="index.php"  class="forgot-password-link">
                                            <i class="ace-icon fa fa-arrow-left"></i>
                                            Back to login
                                        </a>
                                    </div>
                                </div>
                            </div><!-- /.widget-body -->
                        </div><!-- /.login-box -->

                    </div><!-- /.position-relative -->
                </div>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.main-content -->
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

<!-- inline scripts related to this page -->
<script type="text/javascript">
    jQuery(function($) {
        $(document).on('click', '.toolbar a[data-target]', function(e) {
            e.preventDefault();
            var target = $(this).data('target');
            $('.widget-box.visible').removeClass('visible');//hide others
            $(target).addClass('visible');//show target
        });
    });


</script>
</body>
</html>
