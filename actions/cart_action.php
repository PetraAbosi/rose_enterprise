<?php
require_once('../controllers/cart_controller.php');
require_once('../models/cart_class.php');

//ADDING BRAND
// check if there's a POST variable with the name 'addProductButton'
if(isset($_GET['addtocart'])){
    
    // retrieve the name, description and quantity from the form submission
    $prod_id = $_GET['product_id'];
    $ip = Cart::getIpAddress();
    $qty = $_GET['qty'];
     
    // call the add_product_controller function: return true or false
    $result = add_carts($prod_id, $ip, $qty);
     

    if($result === true){
         header("Location: ../cart/cart.php");
    }
    else {
        echo "insertion failed";
    }
    
}
//DELETING Cart
if(isset($_GET['deleteID'])){

    $id = $_GET['deleteID'];
    $ip = Cart::getIpAddress();
    
       

    // call the function
    $result = remove_carts($id);
   
    if($result){
        header("Location: ../cart/cart.php");

    } 

    else echo "deletion failed";


}

//UPDATE Cart
if(isset($_GET['updateID'], $_GET['qty'])){      

    $id = $_GET['updateID'];  
    echo $id;
    exit;
       
    $qty = $_GET['qty'];
    echo $qty;
    exit;

    
    
        
    
    // call the function
    $result = update_cart_quantity($id, $qty);
   
    
    

    if($result === true){
        header("Location: ../cart/cart.php");
    } 
    else echo "update failed";


}
?>

