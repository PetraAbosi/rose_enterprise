<?php
session_start();
require('../controllers/cart_controller.php');

$curl = curl_init();
$reference = isset($_GET['reference']) ? $_GET['reference'] : '';
if(!$reference){
  die('No reference supplied');
}



curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.paystack.co/transaction/verify/" . rawurlencode($reference),
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_HTTPHEADER => [
    "accept: application/json",
    "authorization: Bearer sk_live_497a3a223893acf3ff8ecfd4dce1158b2fc9b088",
    "cache-control: no-cache"
  ],
));

$response = curl_exec($curl);
$err = curl_error($curl);

if($err){
    // there was an error contacting the Paystack API
  die('Curl returned error: ' . $err);
}

$tranx = json_decode($response);

if(!$tranx->status){
  // there was an error from the API
  die('API returned error: ' . $tranx->message);
}

if('success' == $tranx->data->status){
  // transaction was successful...
  // please check other things like whether you already gave value for this ref
  // if the email matches the customer who owns the product etc
  // Give value
  echo "<h2>Thank you for making a purchase. Your file has been sent your email.</h2>";
  
  $ip = Cart::getIpAddress();
  $currency = 'GHS';
  $payment_date = date('Y/m/d');
  $customer_email = $_SESSION['customer_email'];
  $amount = total_Amount_in_Cart();

  $recent_order = recent_order_controller();
  $result = select_all_cart_controller($ip);
  


foreach ($result as $row){

  $order_details = add_order_details_controller($recent_order['recent'], $row['p_id'],$row['qty']);
  

}

$payment = add_payment_details_controller($amount, $customer_email, $recent_order['recent'], $currency, $payment_date);

foreach ($result as $row){

  $delete_details = delete_from_cart_controller($row['p_id'],$ip);

}
header('Location: index.php');
}



  // insert payment
  // insert order
  // clear cart

  // redirect to cart


