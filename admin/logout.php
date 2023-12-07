<?php

    include('../config/constants.php');

    //1. Destroy session
    session_destroy(); //unset session = user

    //2. redirect login page
    header('location:'.SITEURL.'admin/login.php');

?>