<?php

ob_start();

//session start
session_start();

//destroy session
session_destroy();

header("Location: ../view/login.php");
?>