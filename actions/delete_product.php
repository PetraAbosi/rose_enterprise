<?php

require('../controllers/product_controller.php');

//DELETING Product
if(isset($_GET['deleteProductsID'])){

    $id = $_GET['deleteProductsID'];
    echo $id;
    

    // call the function
    $result = delete_products_controller($id);

    if($result === true) header("Location: ../admin/index.php");
    else echo "deletion failed";


}

?>







