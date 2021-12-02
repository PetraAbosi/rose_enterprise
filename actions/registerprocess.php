<?php
session_start();

require('../controllers/customer_controller.php');

//userregistration
//chech for a POST variable with the name 

if(isset($_POST['registerUser'])){
    
    //retrieve the customer details
        $fullName = $_POST['name'];
        $email = $_POST['email'];
        $password = password_hash($_POST['pass_1'],PASSWORD_DEFAULT);
        $country = $_POST['country'];
        $city = $_POST['city'];
        $contact = $_POST['contact'];

        //echo $fullName, $email, $password, $country, $city, $contact;

            
        // check if email already exist
        $result = selectOneCustomerController($email);
        

        if ($result){
            echo '<script>alert("Email already exist! Login if you are already registered");
                window.location ="../login/register.php?register=error";</script>';
        }
        else{
            //call the add customer controller
            $register = addCustomerController($fullName, $email, $password, $country,$city,$contact);
                        
            if($register) {
                header("Location: ../login/login.php");
                $_SESSION['register-success'] = 'Successfully created';
            }
            else{
                header("Location: ../login/register.php");
                $_SESSION['register-error'] = 'Error registering';
        
            }
        }
        
        
    

}





    
?>