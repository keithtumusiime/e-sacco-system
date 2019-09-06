<?php
date_default_timezone_set('Africa/Kampala');



//Getting the last month and date of payment
$last_date = "2018-05-11";
$last_time_array = explode("-", $last_date);

$last_year = $last_time_array[0];
$last_month =$last_time_array[1];
$last_day =$last_time_array[2];


//Current Date
$current_date = date("Y-m-d H:i:s");
$current_time_array = explode("-",$current_date);

$current_year = $current_time_array[0];
$current_month = $current_time_array[1];
$current_day = $current_time_array[2];


if($last_month==$current_month){
    echo "Same month";
}
if($current_month==($last_month+1)){
    echo "two ";
}
if($current_month==($last_month+2)){
    echo "three";
}


?>