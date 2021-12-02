<?php

require_once('../models/delete_class.php');

function delete_products_controller($id){
    // create an instance of the Product class
    $product_instance = new Product();
    // call the method from the class
    return $product_instance->delete_one_products($id);

}



function delete_brands_controller($id){
    // create an instance of the Product class
    $product_instance = new Product();
    // call the method from the class
    return $product_instance->delete_one_brands($id);

}


function delete_categories_controller($id){
    // create an instance of the Product class
    $product_instance = new Product();
    // call the method from the class
    return $product_instance->delete_one_categories($id);

}
?>