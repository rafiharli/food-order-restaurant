<?php

    include('../config/constants.php');

    if(isset($_GET['id']) && isset($_GET['image_name']))
    {
        $id=$_GET['id'];
        $image_name=$_GET['image_name'];

        if($image_name!="")
        {
            $path="../images/food/".$image_name;
            $remove=unlink($path);

            if($remove==FALSE)
            {
                $_SESSION['remove_fail']="<div class='failed'>Failed to Remove Image File.</div>";
                header('location:'.SITEURL.'admin/manage_food.php');
                die();
            }
        }

        $sql = "DELETE FROM tbl_food WHERE id=$id";
        $res = mysqli_query($conn, $sql);

        if($res==TRUE)
        {
            $_SESSION['del_food']="<div class='success'>Food Deleted Successfully.</div>";
            header('location:'.SITEURL.'admin/manage_food.php');
        }
        else
        {
            $_SESSION['del_food']="<div class='success'>Food Deletion Failed.</div>";
            header('location:'.SITEURL.'admin/manage_food.php');
        }

    }    
    else
    {
        $_SESSION['unauthorized']="<div class='failed'>Unauthorized Access.</div>";
        header('location:'.SITEURL.'admin/manage_food.php');
    }
?>