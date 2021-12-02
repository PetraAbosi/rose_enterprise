<?php

session_start();
require('../controllers/product_controller.php');
require('../controllers/delete_controller.php');

//DELETING Product
if(isset($_GET['deleteProductsID'])){

    $id = $_GET['deleteProductsID'];
    

    // call the function
    $result = delete_products_controller($id);

    if($result === true) header("Location: ../admin/index.php");
    else echo "Deleted";


}


//DELETING BRAND
if(isset($_GET['deleteBrandsID'])){

    $id = $_GET['deleteBrandsID'];
  

    // call the function
    $result = delete_brands_controller($id);


    if($result === true) header("Location: ../admin/index.php");
    else echo "Deleted";


}

//DELETING CATEGORY
if(isset($_GET['deleteCategoriesID'])){

    $id = $_GET['deleteCategoriesID'];
    

    // call the function
    $result = delete_categories_controller($id);

    if($result === true) header("Location: ../admin/index.php");
    else echo "Deleted";


}
?>