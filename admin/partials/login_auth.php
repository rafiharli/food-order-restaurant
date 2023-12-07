<?php 
    //AUTHORIZATION ACCESS CONTROL
    //CHECK FOR ALL PAGE USER is LOGIN or NOT
    if(!isset($_SESSION['user']))
    {
        //redirect to login page
        $_SESSION['no_login'] = "<div class='failed text-center'>LOGIN DULU BOSS.</div>";
        header('location:'.SITEURL.'admin/login.php');
    }
    
?>