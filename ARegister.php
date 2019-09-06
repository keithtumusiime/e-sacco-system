<?php
include 'db.php';
$message = "";
date_default_timezone_set('Africa/Kampala');
if($_SERVER['REQUEST_METHOD']=='POST'){
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
        $result["success"]="0";
        $result["message"]="Account already exist";

        echo json_encode($result);
        mysqli_close($con);
    }
    else{

        //check if the username already exists
        $check_username = mysqli_query($con,"select * from login where username = '$username'");
        if(mysqli_num_rows($check_username) > 0){
            $result["success"]="0";
            $result["message"]="username exists";

            echo json_encode($result);
            mysqli_close($con);
        }else{
            // saving the photo
            //$user_photo = $_FILES["photo"]["name"];
            //$name = basename($_FILES['photo']['name']);
            //$t_name = $_FILES['photo']['tmp_name'];
            //$dir = 'photos';
            //move_uploaded_file($t_name,$dir."/".$name);
            //$folder = "/xampp/htdocs/sacco/photos/";
            // saving the photo

            $insert = mysqli_query($con,"insert into customer(customerID,full_names,address,contact,dob,email,join_date,occupation,photo,status)
VALUES ('$id','$names','$address','$contact','$dob','$email','$date','$occupation','user_photo','pending')
");

            $ìnsert = mysqli_query($con,"insert into login(customerID,username,password)VALUES ('$id','$username','$password_encrypt')");

            if( $insert ) {
            	//for android app
            	$result["success"]="1";
            	$result["message"]="success";

                echo json_encode($result);
                mysqli_close($con);

            }else{
            	$result["success"]="0";
            	$result["message"]="failed";
                echo json_encode($result);
                mysqli_close($con);
            }

        }

    }
}

?>