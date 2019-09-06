<?php 
$post = file_get_contents('php://input'); 
$data = json_decode($post); 
$reference=$data->reference; //This is your order id, mark this as paid<br>
$reason=$data->reason; //reason you stated 
$txid=$data->transactionId; //Easypay transction Id 
$amount=$data->amount; //amount deposited 
$phone=$data->phone; //phone number that deposited 
 //With the above details you can update your system and mark order as paid on your side 
?> 