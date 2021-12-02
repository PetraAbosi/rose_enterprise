<?php
session_start();
require('../controllers/customer_controller.php');

    //customer log in
     if (isset($_POST['loginUser']) ){
       //check login details
        $customer_email = $_POST['customer_email'];
        $customer_pass = $_POST['customer_pass'];         
        
        //call the select one customer controller
        //it is not working
        $login = selectOneCustomerController($customer_email); 
      
               
        if ($login){         
          $hashed_password = $login['customer_pass'];

          if(password_verify($customer_pass, $hashed_password)){
           

             //create session for id, role and name
             $_SESSION["customer_id"] = $login['customer_id'];
             $_SESSION["user_role"] = $login['user_role'];
             $_SESSION["customer_name"] = $login['customer_name'];
             $_SESSION["customer_email"] = $login['customer_email'];
 
            header("Location: ../view/order_detail.php");
            $_SESSION['register-success'] = 'Successfully created';
          }  
          else {
          header("Location: ../login/register.php");
          $_SESSION['register-error'] = 'Error registering';
          }
  }

}




    
    
?>