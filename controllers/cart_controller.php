<?php
require('../models/cart_class.php');

// add to cart
function add_carts($prod_id, $ip, $qty){
   
	$ip = Cart::getIpAddress();
        
    $cart_instance = new Cart();
   
    //check for duplicates
    $check = validate_cart($ip, $prod_id);

    if(count($check) > 0){
        echo '<script>alert("Item already in cart. Consider increasing the quantity in cart");
                    window.location ="../cart/cart.php";
                  </script>';
      
        
    } 
    else{ 
            $add = $cart_instance->add_carts($prod_id, $ip, $qty);
        if($add){
            header("Location: ../cart/cart.php");

        } 
        else{
            print("Failed");
        }

    }

}

function add_order_details_controller($order_id, $product_id, $qty){
    $cart_instance = new Cart();
    return $cart_instance->add_order_details($order_id, $product_id, $qty);
}

function add_payment_details_controller($amt, $c_id, $order_id, $currency, $payment_date){
    $cart_instance = new Cart();
    return $cart_instance->add_payment_details($amt, $c_id, $order_id, $currency, $payment_date);
}

function select_all_cart_controller($ip){
    // create an instance of the Product class
    $cart_instance = new Cart();


        
    
    //create empty array
    $arr = array();
    
    //check data and return boolean (true /false)
    $all = $cart_instance->select_all_cart($ip);
    
    //loops through all
    if($all){
        //for each data call the row using the method fetch
        while($each = $cart_instance->fetch()){

            //now loop through everything and put into the array
            $arr[]= $each;
        }
     
               
    }

    return $arr;

}



function delete_from_cart_controller($product_id,$ip_add){
    $cart_instance = new Cart();
    return $cart_instance->delete_from_cart($product_id,$ip_add);
}

function recent_order_controller(){
    $cart_instance = new Cart();
    return $cart_instance->recent_order();
}


//remove from cart
function remove_carts($prod_id){
    $arr = array();
    $ip = Cart::getIpAddress();
    $cart_instance = new Cart();

    $remove = $cart_instance->remove_carts($prod_id, $ip);
        if($remove){
            header("Location: ../cart/cart.php");

        } 
        else{
            print("Deletion failed");
        }

}

function select_one_cart($id){
    // create an instance of the Product class
    $cart_instance = new Cart();
    // call the method from the class

    $arr = array();
    
    //check data and return boolean (true /false)
    $check = $cart_instance->select_one_cart($id);
    
    //loops through all
    if($check){
        //for each data call the row using the method fetch
        while($each = $cart_instance->fetch()){

            //now loop through everything and put into the array
            $arr[]= $each;
        }
     
               
    }

    return $arr;
    

}

//update cart
function update_cart_quantity($id, $qty){
    $arr = array();
    $ip = Cart::getIpAddress();
    $cart_instance = new Cart();

    $cart= $cart_instance->update_cart_quantity($id, $qty, $ip);    
    if($cart){
        return $cart;
    }


}

//validate cart for uniqueness
function validate_cart($ip, $prod_id){
    //Create an array variable to hold list of search records
    $cart_array = array();

    //create an instance of the product class
    $cart_object = new Cart();

    //run the search product method
    $carts = $cart_object->validate_cart($ip, $prod_id);

    //check if the method worked
    if ($carts) {

        //loop to see if there is more than one result
        //fetch one at a time
        while ($cart = $cart_object->fetch()) {

            //Assign each result to the array
            $cart_array[] = $cart;
        }
    }
    //return the array
    return $cart_array;
}


function cart_items(){
  //Create an array variable to hold list of search records
  $cart_array = array();

  //create an instance of the product class
  $cart_object = new Cart();

  //run the search product method
  $ip = Cart::getIpAddress();
  $carts = $cart_object->cart_items($ip);

  //check if the method worked
  if ($carts) {

      //loop to see if there is more than one result
      //fetch one at a time
      while ($cart = $cart_object->fetch()) {

          //Assign each result to the array
          $cart_array[] = $cart;
      }
  }
  //return the array
  return $cart_array;

}

function displayCart(){
    $customer_id = $_SESSION['customer_id'];
    $ip = Cart::getIpAddress();

  $cart = cart_items($ip);
  // $amt =getTotalItemAmountInCart();

  if ($cart) {
      foreach ($cart as $value) {
        $id = $value['product_id'];
        $product_title = $value['product_title'];
        $product_price = $value['product_price'];
        $product_quantity = $value['qty'];
        $product_image = $value['product_image'];
        $product_desc = $value['product_desc'];
        $amount = $product_price*$product_quantity;
         

        echo <<< _ALL
            
            <div class="col-12 col-lg-8">
            <div class="cart-title mt-50">
            </div>

            <div class="cart-table clearfix">                          

                <table class="table table-responsive">
                <thead>
                    <tr>
                        <th></th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="cart_product_img">
                            <a href="#"><img src="$product_image" alt="Product"></a>
                        </td>
                        <td class="cart_product_desc">
                            <h5>$product_title</h5>
                        </td>
                        <td class="price">
                            <span>$product_price</span>
                        </td>
                        <td class="qty">
                            <div class="qty-btn d-flex">
                                <p>Qty</p>
                                <div class="quantity">
                                    <span class="qty-minus" onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 1 ) effect.value--;return false;"><i class="fa fa-minus" aria-hidden="true"></i></span>
                                    <input type="number" class="qty-text" id="qty" step="1" min="1" max="300" name="qty" value="$product_quantity">
                                    <span class="qty-plus" onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty )) effect.value++;return false;"><i class="fa fa-plus" aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </td>
                    </tr>
                  
                  
                </tbody>
            </table>
            </div>
            </div>
            <div class="col-12 col-lg-4">
            <div class="cart-summary">
                <h5>Cart Item</h5>
                    <ul class="summary-table">
                        <li><span>price:</span> <span>$product_price</span></li>
                        <li><span>delivery:</span> <span>Free</span></li>
                        <li><span> sub total:</span> <span>$amount</span></li>
                    </ul>

                    <a class="btn btn-primary" href='../actions/cart_action.php?deleteID={$value['product_id']}'> 
                        Delete Item
                    </a> 
                    <a class="btn btn-primary" href='../actions/cart_action.php?updateID={$value['product_id']}'> 
                        Update Item
                    </a> 
               
            </div>
            </div>
            

        _ALL;

      }
    }

}


function total_quantity(){
    $ip = Cart::getIpAddress();
    $cart_instance = new Cart();
    $arr = $cart_instance-> cart_item_quantity($ip);
    if($arr){
        $row = $cart_instance->count();
        return ($row != null) ? $row : "0";
    }  else{
        return "0";
    }
}

function total_Amount_in_Cart(){
    $ip = Cart::getIpAddress();
    $cart_instance = new Cart();
    $arr = $cart_instance->cart_item_amount($ip);
    if($arr){
        $row = $cart_instance->fetch();
        return ($row['amount'] != null) ? $row['amount'] : "0";
    }  
    else{
        return "0";
    }
}

function add_orders($customer_id, $invoice_no, $order_status){
   
    $ip = Cart::getIpAddress();
    $customer_id=$_SESSION['customer_id'];

   
    $cart_instance = new Cart();

    if($cart_instance){
        $toReturn = $cart_instance->add_orders($customer_id, $invoice_no, $order_status);
        }
    

    else{ 
           
            header("Location: ../cart/cart.php");
    }

}





?>