<?php

require('../settings/core.php');

if(check_login()==true){
    header("Location: ../view/login.php");
}else header("Location: ../view/checkout.php");