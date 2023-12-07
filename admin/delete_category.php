<?php

    //0. include constants.php
    include('../config/constants.php');

    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        if($image_name != "")
        {
            $path = "../images/category/".$image_name;
            
            $remove = unlink($path);

            if($remove==FALSE)
            {   
                $_SESSION['remove'] = "<div class='failed'>Failed to Remove Category Image.</div>";
                header('location:'.SITEURL.'admin/manage_category.php');
                die();
            }
        }
        
        $sql = "DELETE FROM tbl_category WHERE id=$id";

        $res = mysqli_query($conn, $sql);

        if($res==TRUE)
        {
            $_SESSION['delete'] = "<div class='success'>Category Deleted Succesfully.</div>";
            header('location:'.SITEURL.'admin/manage_category.php');
        }
        else
        {
            $_SESSION['delete'] = "<div class='failed'>Category Deleted Failed.</div>";
            header('location:'.SITEURL.'admin/manage_category.php');
        }

    }
    else
    {
        header('location:'.SITEURL.'admin/manage_category.php');
    }

?>