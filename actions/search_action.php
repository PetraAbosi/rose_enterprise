<?php
session_start();
require('../controllers/search_controller.php');

//ADDING BRAND
// check if theres a POST variable with the name 'addProductButton'
if(isset($_GET['s'])){
    // retrieve the name, description and quantity from the form submission
  
    $product_title = $_GET['title']; 
 
     
    // call the search product title controller function: return true or false
    $result = displaySearchProduct($product_title);
   


    if($result){
        
         header("Location: ../view/search.php");
    }
   // else echo "Wrong input";

}
?>
