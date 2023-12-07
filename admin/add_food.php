<?php include('partials/header.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>
        <br>

        <?php
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>

        <br>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Title of the Food" class="boks">
                    </td>
                </tr>

                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Description of the Food."></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price" class="boks">
                    </td>
                </tr>

                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">

                            <?php
                                //create php to display categories from database
                                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                                $res = mysqli_query($conn, $sql);
                                
                                $count = mysqli_num_rows($res);

                                if($count>0)
                                {
                                    while($row=mysqli_fetch_assoc($res))
                                    {
                                        $id = $row['id'];
                                        $title = $row['title'];
                                        
                                        ?>
                                    
                                        <option value="<?php echo $id; ?>"><?php echo $title; ?></option>

                                        <?php
                                    }
                                }
                                else
                                {
                                    ?>

                                    <option value="0">No Category Found.</option>

                                    <?php
                                }

                            ?>
                        </select>
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
                        <input type="submit" name="submit" value="Add Food" class="btn-primary">
                    </td>
                </tr>

            </table>
        </form>

        <?php

            if(isset($_POST['submit']))
            {
                //Get value from form
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price']; 
                $category = $_POST['category'];
                if(isset($_POST['featured']))
                {
                    $featured = $_POST['featured'];
                }
                else
                {
                    $featured = "No";
                }
                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                }
                else
                {
                    $active = "No";
                }

                if(isset($_FILES['image']['name']))
                {
                    $image_name = $_FILES['image']['name'];

                    if($image_name != "")
                    {
                        $ext = end(explode('.', $image_name));
                        $image_name = "Food_Name_".rand(00000, 99999).".".$ext;
                        $src = $_FILES['image']['tmp_name'];
                        $dst = "../images/food/".$image_name;

                        //Upload Image
                        $upload = move_uploaded_file($src, $dst);

                        //Cek image upload or not
                        if($upload==FALSE)
                        {
                            $_SESSION['upload'] = "<div class='failed'>Upload Image Failed.</div>";
                            header('location:'.SITEURL.'admin/add_food.php');
                            die();
                        }
                    }
                }
                else
                {
                    $image_name = "";
                }

                //insert data to database
                $sql0 = "INSERT INTO tbl_food SET
                    title='$title',
                    description='$description',
                    price=$price,
                    image_name='$image_name',
                    category_id = $category,
                    featured='$featured',
                    active='$active'
                    ";

                //execute query
                $res0 = mysqli_query($conn, $sql0);

                if($res0==TRUE)
                {
                    $_SESSION['add_food'] = "<div class='success'>Food Added Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage_food.php');
                }
                else
                {
                    $_SESSION['add_food'] = "<div class='failed'>Food Added Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage_food.php');
                }
            }
        ?>

    </div>
</div>

<?php include('partials/footer.php') ?>