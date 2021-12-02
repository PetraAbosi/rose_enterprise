<?php
require('../models/search_class.php');

//search product function - takes the search term

function searchProduct($product_title){
    // create an instance of the Product class

        
    $search_instance = new Search();
    
    //create empty array
    $arr = array();
    
    //check data and return boolean (true /false)
    $all = $search_instance->searchProduct($product_title);
    
    //loops through all
    if($all){
        //for each data call the row using the method fetch
        while($each = $search_instance->fetch()){

            //now loop through everything and put into the array
            $arr[]= $each;
        }
     
               
    }

    return $arr;

}



function displaySearchProduct($product_title){
    $all = searchProduct($product_title);
    foreach ($all as $value){
        $product_id = $value['product_id'];
        $product_title = $value['product_title'];
        $product_price = $value['product_price'];
        $product_image = $value['product_image'];
        $product_desc = $value['product_desc'];
        
       

  
        echo <<<ALL
        
        <form action="../cart/product-details.php">

        <div class="mid-1">
        <div class="women">
            <h2>$product_title</h2>							
            <h4>$product_desc</h4>							
        </div>
        <div class="mid-2">
            <p ><label></label><em class="item_price">GHS $product_price.00</em></p>
              <div class="block">
            </div>
            <div class="clearfix"></div>
        </div>

        <div class="col-md-5 m-wthree">
        <div class="col-m">
            <img src="$product_image" class="img-responsive" alt="">
        </a>
       

            <div class="mid-3">
                  <div class="block">
                    <div class="starbox small ghosting"> </div>
                </div>
                <div class="clearfix"></div>
            </div>

            <div >
                <input type="hidden" name='id' value="$product_id">
            </div>
                    <div class="add">
               <button class="btn btn-danger my-cart-btn my-cart-b" data-id="2" data-name="addCartButton" data-summary="summary 2" data-price="$product_price" data-quantity="1" data-image=" $product_image" href='singleProduct.php?id=$product_id'>Select Product</button>
            </div>
        </div>
        </div>
        </div>
        </form>
    ALL;
    }
    
}



?>