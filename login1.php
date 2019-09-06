
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Login Page - Sacco</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="shortcut icon" href="assets/assets/img/title.gif" type="image/x-icon">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">
  <link rel="stylesheet" href="css/font-awesome/4.5.0/css/font-awesome.min.css" />

    <!-- text fonts -->
  <link rel="stylesheet" href="css/css/fonts.googleapis.com.css" />

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<?php include 'login.php';?>
<style type="text/css">
  body {
                background-color: skyblue; 
                -webkit-background-size: cover;
                -moz-background-size: cover;
                -o-background-size: cover;
                background-size: cover;
            }
  .login-box{
    border-style: solid green;
  }
  .error{
    color: red;
    font-size: 16px;
    font-weight: bold;
  }
</style>
<body class="hold-transition login-page">
            <nav class="navbar navbar-invers" style="background-color: #0099cc;">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <b class="navbar-brand" style="color: #ffffff; font-size: 25px;" >E-SACCO SYSTEM</b>
                    </div>

                    <div class="navbar-header" style="float: right;">
                        <a class="navbar-brand fa fa-facebook" style="color: #ffffff; font-size: 25px;" href="facebook.com/keithorganisations"></a>
                        <a class="navbar-brand fa fa-twitter" style="color: #ffffff; font-size: 25px;" href="#"></a>
                        <a class="navbar-brand fa fa-whatsapp" style="color: #ffffff; font-size: 25px;" href="#"></a>
                    </div>
                </div>
            </nav>
            
<div class="login-box">
  <div class="login-logo">
  <h1><img class="img-responsive" src="assets/images/logo.png" alt=""></h1>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <h4 class="header blue lighter bigger" style="color: #0099cc; font-size: 20px;">
      <i class="ace-icon fa fa-coffee green" style="color: green; font-size: 25px;"></i>
      Please Enter Your Information
      <hr style="padding-top: 1px; color: #0099cc;">
      </h4>
    <form action="<?= $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Username" name="username" autocomplete="off">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="password" autocomplete="off">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck" style="padding-left: 20px;">
            <label>
              <input type="checkbox" name="remember"> Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">

          <button type="submit" class="btn btn-primary btn-block btn-flat" name="login">
            <i class="ace-icon fa fa-key"></i>
            <span class="bigger-110"> Login</span>
         </button>
        </div>
        <!-- /.col -->
      </div>

        <div class="space-4"></div>
            <div class="clearfix" style="text-align: center">
              <div class="error">
                <?= $error;?>
              </div>
            </div>
    </form>

    <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat" onclick="logIn()"><i class="fa fa-facebook"></i> Sign in using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
        Google+</a>
    </div>
    <!-- /.social-auth-links -->

    <a href="#">I forgot my password</a><br>
    <a href="register.php" class="text-center">Register a new membership</a>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="../../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="../../plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>

<script>
        var person = { userID: "", name: "", accessToken: "", picture: "", email: ""};

        function logIn() {
            FB.login(function (response) {
                if (response.status == "connected") {
                    person.userID = response.authResponse.userID;
                    person.accessToken = response.authResponse.accessToken;

                    FB.api('/me?fields=id,name,email,picture.type(large)', function (userData) {
                        person.name = userData.name;
                        person.email = userData.email;
                        person.picture = userData.picture.data.url;

                        $.ajax({
                           url: "login.php",
                           method: "POST",
                           data: person,
                           dataType: 'text',
                           success: function (serverResponse) {
                               console.log(person);
                               //if (serverResponse == "success")
                                   //window.location = "index.php";
                           }
                        });
                    });
                }
            }, {scope: 'public_profile, email'})
        }

        window.fbAsyncInit = function() {
            FB.init({
                appId            : '113852546010164',
                autoLogAppEvents : true,
                xfbml            : true,
                version          : 'v2.11'
            });
        };

        (function(d, s, id){
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {return;}
            js = d.createElement(s); js.id = id;
            js.src = "https://connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
</body>
</html>
