<?php include('partials/header.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br>

        <?php
            if(isset($_SESSION['add_cat']))
            {
                echo $_SESSION['add_cat'];
                unset ($_SESSION['add_cat']);
            }
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset ($_SESSION['upload']);
            }
        ?>
        
        <br>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input class="boks" type="text" name="title" placeholder="Category Title">
                    </td>
                </tr>

                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-primary">
                    </td>
                </tr>
            </table>
        </form>

        <?php 

            //Submit button click or not
            if(isset($_POST['submit']))
            {   
                //Get value title from form
                $title = $_POST['title'];

                //FEATURED
                if(isset($_POST['featured']))
                {
                    $featured = $_POST['featured'];
                }
                else
                {
                    $featured = "No";
                }


                // ACTIVE
                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                }
                else
                {
                    $active = "No";
                }

                //IMAGE
                //CHECK IMAGE IS SELECT -> print_r($_FILES['image']);
                if(isset($_FILES['image']['name']))
                {
                    //Identify image path
                    $image_name = $_FILES['image']['name'];

                    //Upload image only when image is select
                    if($image_name != "")
                        {
                            //rename image
                            $ext = end(explode('.', $image_name));
                            $image_name = "Food_Category_".rand(00000, 99999).".".$ext;

                            $source_path = $_FILES['image']['tmp_name'];

                            $destination_path = "../images/category/".$image_name;

                            //Upload Image
                            $upload = move_uploaded_file($source_path, $destination_path);

                            //Cek image upload or not
                            if($upload==FALSE)
                            {
                                $_SESSION['upload'] = "<div class='failed'>Upload Image Failed.</div>";
                                header('location:'.SITEURL.'admin/add_category.php');
                                die();
                            }
                        }   
                }
                else 
                {
                    $image_name = "";
                }

                $sql = "INSERT INTO tbl_category SET
                    title='$title',
                    image_name='$image_name',
                    featured='$featured',
                    active='$active'
                    ";

                $res = mysqli_query($conn, $sql);

                if($res==TRUE)
                {
                    $_SESSION['add_cat'] = "<div class='success'>Category Added Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage_category.php');
                }
                else
                {
                    $_SESSION['add_cat'] = "<div class='failed'>Category Added Failed.</div>";
                    header('location:'.SITEURL.'admin/add_category.php');
                }
            }
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>