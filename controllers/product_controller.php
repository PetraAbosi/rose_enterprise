<?php

require_once('../models/product_class.php');
require_once('../models/cart_class.php');


function add_products_controller($product_cat, $product_brand, $product_title, $product_price, $product_desc, $product_image){
    // create an instance of the Product class
    $product_instance = new Product();
    // call the method from the class
    return $product_instance->add_products($product_cat, $product_brand, $product_title, $product_price, $product_desc, $product_image);

}

function add_brands_controller($name){
    // create an instance of the Product class
    $product_instance = new Product();
    // call the method from the class
    return $product_instance->add_brands($name);

}

function add_categories_controller($name){
     // create an instance of the Product class
     $product_instance = new Product();
     // call the method from the class
     return $product_instance->add_categories($name);
 
 }
   



function update_products_controller($product_catID,$product_brandID,$product_title,$product_price,$product_desc,$fileName1,$product_id){
    // create an instance of the Product class
    $product_instance = new Product();
    // call the method from the class
    return $product_instance->update_one_products($product_catID,$product_brandID,$product_title,$product_price,$product_desc,$fileName1,$product_id);

}

function update_brands_controller($brand_id, $brand_name){
    // create an instance of the Product class
    $product_instance = new Product();
    // call the method from the class
    return $product_instance->update_one_brands($brand_id, $brand_name);

}

function update_categories_controller($cat_id, $cat_name){  
    // create an instance of the Product class
    $product_instance = new Product();
    // call the method from the class
    return $product_instance->update_one_categories($cat_id, $cat_name);
       

}

function add_productm_controller($product_cat, $product_brand, $product_title, $product_price, $product_desc, $product_image){
    // create an instance of the Product class
    $product_instance = new Product();
    // call the method from the class
    return $product_instance->add_productm($product_cat, $product_brand, $product_title, $product_price, $product_desc, $product_image);

}


function update_productm_controller($product_catID,$product_brandID,$product_title,$product_price,$product_desc,$fileName1,$product_id){
    // create an instance of the Product class
    $product_instance = new Product();
    // call the method from the class
    return $product_instance->update_one_productm($product_catID,$product_brandID,$product_title,$product_price,$product_desc,$fileName1,$product_id);

}

function delete_productm_controller($id){
    // create an instance of the Product class
    $product_instance = new Product();
    // call the method from the class
    return $product_instance->delete_one_productm($id);

}




function displayAllProduct(){
    $all = select_all_products_controller();
    foreach ($all as $value){
        $product_id = $value['product_id'];
        $product_title = $value['product_title'];
        $product_price = $value['product_price'];
        $product_image = $value['product_image'];
        $product_desc = $value['product_desc'];
        
       

  
    echo <<<ALL
        
        <form action="../cart/product-details.php">
        <div class="col-md-5 m-wthree">
        <div class="col-m">
            <img src="$product_image" class="img-responsive" alt="">
        </a>
        <div class="mid-1">
            <div class="women">
                <h6><a href="single.html">$product_title</a></h6>							
            </div>

            <div class="women">
                <p>$product_desc</p>							
            </div>
            <div class="mid-2">
                <p ><label></label><em class="item_price"><del>GHS2.00 </del> GHS $product_price.00</em></p>
                  <div class="block">
                </div>
                <div class="clearfix"></div>
            </div>

            <div class="mid-3">
                <h2 ><label></label><em class="item_price">50% Discount</em></h2>
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

function select_all_products_controller(){
    // create an instance of the Product class

        
    $product_instance = new Product();
    
    //create empty array
    $arr = array();
    
    //check data and return boolean (true /false)
    $all = $product_instance->select_all_products();
    
    //loops through all
    if($all){
        //for each data call the row using the method fetch
        while($each = $product_instance->fetch()){

            //now loop through everything and put into the array
            $arr[]= $each;
        }
     
               
    }

    return $arr;

}

function select_all_brands_controller(){
    // create an instance of the Product class
    
    $brand_instance = new Product();
    
    //create empty array
    $arr = array();
    
    //check data and return boolean (true /false)
    $all = $brand_instance->select_all_brands();
    
    //loops through all
    if($all){
        //for each data call the row using the method fetch
        while($each = $brand_instance->fetch()){

            //now loop through everything and put into the array
            $arr[]= $each;
        }
     
               
    }

    return $arr;

}

function select_all_categories_controller(){
    // create an instance of the Product class
    
    $categories_instance = new Product();
    
    //create empty array
    $arr = array();
    
    //check data and return boolean (true /false)
    $all = $categories_instance ->select_all_categories();
    
    //loops through all
    if($all){
        //for each data call the row using the method fetch
        while($each = $categories_instance ->fetch()){

            //now loop through everything and put into the array
            $arr[]= $each;
        }
     
               
    }

    return $arr;

}

function select_one_products_controller($id){
    // create an instance of the Product class
    $product_instance = new Product();
    // call the method from the class

    $arr = array();
    
    //check data and return boolean (true /false)
    $check = $product_instance->select_one_products($id);
    
    //loops through all
    if($check){
        //for each data call the row using the method fetch
        while($each = $product_instance->fetch()){

            //now loop through everything and put into the array
            $arr[]= $each;
        }
     
               
    }

    return $arr;
    

}



function select_one_productm_controller($id){
    // create an instance of the Product class
    $product_instance = new Product();
    // call the method from the class

    $arr = array();
    
    //check data and return boolean (true /false)
    $check = $product_instance->select_one_productm($id);
    
    //loops through all
    if($check){
        //for each data call the row using the method fetch
        while($each = $product_instance->fetch()){

            //now loop through everything and put into the array
            $arr[]= $each;
        }
     
               
    }

    return $arr;
    

}

function select_one_brands_controller($id){
    // create an instance of the Product class
    $product_instance = new Product();
    // call the method from the class

    $arr = array();
    
    //check data and return boolean (true /false)
    $check = $product_instance->select_one_brands($id);
    
    //loops through all
    if($check){
        //for each data call the row using the method fetch
        while($each = $product_instance->fetch()){

            //now loop through everything and put into the array
            $arr[]= $each;
        }
     
               
    }

    return $arr;
    

}


function select_one_categories_controller($id){
    // create an instance of the Product class
    $product_instance = new Product();
    // call the method from the class

    $arr = array();
    
    //check data and return boolean (true /false)
    $check = $product_instance->select_one_categories($id);
    
    //loops through all
    if($check){
        //for each data call the row using the method fetch
        while($each = $product_instance->fetch()){

            //now loop through everything and put into the array
            $arr[]= $each;
        }
     
               
    }

    return $arr;
    

}



function select_all_mothercare_controller(){
    // create an instance of the Product class

        
    $product_instance = new Product();
    
    //create empty array
    $arr = array();
    
    //check data and return boolean (true /false)
    $all = $product_instance->select_mothercare_products();
    
    //loops through all
    if($all){
        //for each data call the row using the method fetch
        while($each = $product_instance->fetch()){

            //now loop through everything and put into the array
            $arr[]= $each;
        }
     
               
    }

    return $arr;

}

function displayAllMothercare(){
    $all = select_all_mothercare_controller();
    foreach ($all as $value){
        $product_id = $value['product_id'];
        $product_title = $value['product_title'];
        $product_price = $value['product_price'];
        $product_image = $value['product_image'];
        
       

  
    echo <<<ALL
        
        <form action="../cart/productm_details.php">
        <div class="col-md-5 m-wthree">
        <div class="col-m">
            <img src="$product_image" class="img-responsive" alt="">
        </a>
        <div class="mid-1">
            <div class="women">
                <h6><a href="single.html">$product_title</a></h6>							
            </div>
            <div class="mid-2">
                <p ><label></label><em class="item_price">GHS $product_price.00</em></p>
                  <div class="block">
                </div>
                <div class="clearfix"></div>
            </div>

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