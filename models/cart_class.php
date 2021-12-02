<?php

require_once('../settings/dbconnection.php');

// inherit the methods from Connection
class Cart extends Dbconnection{
	
	function cart_items($ip){
		return $this->query("SELECT products.product_id, products.product_cat, products.product_brand, products.product_price, products.product_title, products.product_desc, products.product_image, products.product_keywords, cart.p_id, cart.ip_add, cart.qty FROM products JOIN cart ON products.product_id = cart.p_id AND cart.ip_add = '$ip'");
	}
	function cart_item_quantity($ip){
		return $this->query("SELECT * FROM cart WHERE ip_add='$ip'");
	}

	function cart_item_amount($ip){
		return $this->query("SELECT SUM(product_price * qty) AS amount FROM products JOIN cart ON products.product_id = cart.p_id AND cart.ip_add = '$ip'");
	}

	function validate_cart($ip, $prod_id){
		return $this->query("SELECT * FROM `cart` WHERE `ip_add`='$ip' AND `p_id`='$prod_id'");
	}

	function delete_from_cart($product_id,$ip_add){
		return $this->query("delete from cart where p_id = '$product_id' and ip_add = '$ip_add' ");
	}

	function add_carts($prod_id, $ip, $qty){
		//if (!$this->validate_cart($ip, $prod_id)) {
			 return $this->query("insert into cart(`p_id`, `ip_add`,`qty`) values('$prod_id', '$ip', '$qty')");
		//}

	}

	function remove_carts($prod_id, $ip){
		return $this->query("DELETE FROM cart WHERE ip_add='$ip' AND p_id='$prod_id'");
	}

	function select_one_cart($id){
		// return associative array or false
		return $this->query("select * from cart where p_id='$id'");
	}

	function update_cart_quantity($id, $qty, $ip){
		return $this->query("UPDATE cart SET qty='$qty' WHERE ip_add='$ip' AND p_id='$id'");
	}

	function add_orders($customer_id, $invoice_no, $order_status){
		return $this->query("INSERT INTO orders (`customer_id`, `invoice_no`, `order_date`, `order_status`) VALUES ('$customer_id', '$invoice_no',NOW(), '$order_status')");
	}

	function add_payment($amount,$user_id,$currency){
		return $this->query("INSERT INTO payment(amt,customer_id,currency, payment_date) VALUES ('$amount','$user_id','$currency', NOW())");
	}

	public static function getIpAddress(){
		$ip = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
        return $ip;
    }

	function add_order_details($order_id, $product_id, $qty){
		return $this->query("insert into orderdatails (order_id, product_id, qty) values ('$order_id', '$product_id','$qty' ");
	}

	function select_all_cart($ip){
		return $this->query("select * from cart inner join products on p_id =product_id where ip_add = '$ip' ");
	}

	function recent_order(){
		return $this->fetchOne("select Max(order_id) as recent from orders");
	}

	function add_payment_details($amt, $c_id, $order_id, $currency, $payment_date){
		return $this->query(" insert into payment amt, customer_id, order_id, currency, payment_date) values ('$amt', '$c_id', '$currency', '$payment_date'");
	}

}
