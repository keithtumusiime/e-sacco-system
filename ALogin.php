<?php
date_default_timezone_set('Africa/Kampala');
include 'db.php';
session_start();
$error='';

if ($_SERVER['REQUEST_METHOD']=='POST'){
    $username = test_input($_POST['username']);
    $password = test_input($_POST['password']);

        $login = mysqli_query($con,"select * from login where username = '$username' and password = '$password'");

        $result = array();
        $result['login']= array();
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

                $result["success"]="1";
                echo json_encode($result);
            }
            else{
                $result["success"]="0";
                $result["message"]="success";
                echo json_encode($result);
                mysqli_close($con);
            }


        }else{

            $result["success"]="0";
            $result["message"]="Error";

            echo json_encode($result);
            mysqli_close($con);
        }
}

function test_input($data){
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>