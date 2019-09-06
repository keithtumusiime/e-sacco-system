
<?php
date_default_timezone_set('Africa/Kampala');
include 'db.php';
session_start();
$error='';

if (isset($_POST['login'])){
    $username = test_input($_POST['username']);
    $password = test_input($_POST['password']);

    if($username=="sacco" and $password=="sacco"){
        $_SESSION['full_names'] = "System Administrator";
        $_SESSION['customerID']  = "C11011";
        header("location: admin-dash.php?log=1");
    }else{
        $login = mysqli_query($con,"select * from login where username = '$username' and password = '$password'");
        if(mysqli_num_rows($login)>0){
            $person =  mysqli_fetch_array($login);
            $log_id = $person['customerID'];
            //checking if the account was verified
            $check_verified = mysqli_query($con,"select * from customer where customerID ='$log_id'");
            $customer_var = mysqli_fetch_array($check_verified);

            if ($check_verified) {
                if (!empty($_POST['remember'])) {
                    # code...
                }else{
                    
                }
            }
            $status = $customer_var['status'];
            if($status == 'approved'){
                $_SESSION['username'] = $person['username'];
                $_SESSION['customerID']  = $person['customerID'];

                header("location: dash.php?log=1");
            }
            else{
                $error = "The Account has not been Approved, Contact the administrator!";
                // echo "<script type='text/javascript'>alert('The Account has not been Approved, Contact the administrator!')</script>".header("location:index.php");
            }


        }else{

            $error = "Invalid Username or password";
        }
    }
}

function test_input($data){
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
