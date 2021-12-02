<?php
session_start();
require('../controllers/cart_controller.php');
$curl = curl_init();

$customer_email = $_SESSION["customer_email"];
$amount = total_Amount_in_Cart()*100;// $_SESSION["amount"];;  //the amount in kobo. This value is actually NGN 300

// url to go to after payment
// $callback_url = 'http://'.$_SERVER['SERVER_NAME']. '/ecommerceFinale/view/callback.php';  
$callback_url = 'http://localhost/ecommerceFinale/view/callback.php';  


curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.paystack.co/transaction/initialize",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => json_encode([
    'amount'=>$amount,
    'email'=>$customer_email,
    'callback_url' => $callback_url
  ]),
  CURLOPT_HTTPHEADER => [
    "authorization: Bearer sk_live_497a3a223893acf3ff8ecfd4dce1158b2fc9b088", //replace this with your own test key
    "content-type: application/json",
    "cache-control: no-cache"
  ],
));

$response = curl_exec($curl);
$err = curl_error($curl);

if($err){
  // there was an error contacting the Paystack API
  die('Curl returned error: ' . $err);
}

$tranx = json_decode($response, true);

if(!$tranx['status']){
  // there was an error from the API
  print_r('API returned error: ' . $tranx['message']);
}

// echo $tranx['status'];
// var_dump($tranx);

// exit;
if($tranx)
  header('Location: ' . $tranx['data']['authorization_url']);

// comment out this line if you want to redirect the user to the payment page
// print_r($tranx);
// redirect to page so User can pay
// uncomment this line to allow the user redirect to the payment page
// header('Location: ' . $tranx['data']['authorization_url']);

/*

if(isset($tranx->data->status) && $tranx->date->status === 'success'){

*/

