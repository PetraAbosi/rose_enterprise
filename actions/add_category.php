<?php



//DELETING CATEGORY
if(isset($_GET['deleteCategoriesID'])){

    $id = $_GET['deleteCategoriesID'];
    

    // call the function
    $result = delete_categories_controller($id);

    if($result === true) header("Location: ../admin/index.php");
    else echo "deletion failed";


}

?>