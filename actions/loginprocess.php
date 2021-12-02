<?php

  require('../controllers/customer_controller.php');
  require('../settings/core.php');

    //customer log in
     if (isset($_POST['loginUser']) ){
       //check login details
        $customer_email = $_POST['email'];
        $customer_pass = $_POST['pass_1'];    
       
        //echo $customer_email, $customer_pass;
       
        //call the select one customer controller
        //it is not working
        $login = selectOneCustomerController($customer_email);
     //  var_dump($login['customer_id']);
       // exit;
        //echo $login;
       
               
        if ($login){
          $hashed_password = $login['customer_pass'];

          if(password_verify($customer_pass, $hashed_password)){

            $_SESSION['customer_id'] =$login["customer_id"];
            $_SESSION['user_role']=$login["user_role"];
            $_SESSION['customer_email']=$login["customer_email"];
            $_SESSION['customer_city']=$login["customer_city"];
            $_SESSION['user_role']=$login["user_role"];
            $_SESSION['customer_contact']=$login["customer_contact"];
        

            if($_SESSION['user_role']==1){
              //if role is 1 load admin index page
              header("Location: ../admin/index.php");
            }
            //other wise user is a regular customer, laod user view index page
            else header("Location: ../view/index.php");
            }  
          else {
            echo '<script>alert("Incorrect Password");
            window.location ="../view/login.php";
            </script>';
          }
        }

      }

   
   
?>