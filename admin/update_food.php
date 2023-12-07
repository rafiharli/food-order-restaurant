<?php include('partials/header.php') ?>

<?php

if(isset($_GET['id']))
{
    $id=$_GET['id'];
    
    $sql0="SELECT * FROM tbl_food WHERE id=$id";
    $res0=mysqli_query($conn,$sql0);
    $row0=mysqli_fetch_assoc($res0);

    $title=$row0['title'];
    $description=$row0['description'];
    $price=$row0['price'];
    $featured=$row0['featured'];
    $active=$row0['active'];
    $current_image=$row0['image_name'];
    $current_category=$row0['category_id'];
}
else
{
    header('location:'.SITEURL.'admin/manage_food.php');
}
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>
        <br><br>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input class="boks" type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td>
                        <input class="boks" type="number" name="price" value="<?php echo $price; ?>">
                    </td>
                </tr>
                
                <tr>
                    <td>Current Image: </td>
                    <td>
                    <?php
                            if($current_image != "")
                            {
                                ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>" width="200px">
                                <?php
                            }
                            else
                            {
                                echo "<div class='failed'>Image not Added.</div>";
                            }
                        ?>
                    </td>
                </tr>


                <tr>
                    <td>Select New Image: </td>
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
                                        $category_id = $row['id'];
                                        $category_title = $row['title'];
                                        
                                        ?>
                                        <option <?php if($current_category==$category_id){echo "selected";} ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
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
                        <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes"> Yes
                        <input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes"> Yes
                        <input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">

                        <input type="submit" name="submit" value="Update Food" class="btn-primary">
                    </td>
                </tr>

            </table>
        </form>
        
        <?php

            if(isset($_POST['submit']))
            {   
                $id=$_POST['id'];
                $title=$_POST['title'];
                $description=$_POST['description'];
                $price=$_POST['price'];
                $current_image=$_POST['current_image'];
                $category=$_POST['category'];
                $featured=$_POST['featured'];
                $active=$_POST['active'];

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
                            $_SESSION['upload'] = "<div class='failed'>Upload New Image Failed.</div>";
                            header('location:'.SITEURL.'admin/manage_food.php');
                            die();
                        }

                        if($current_image!="")
                        {
                            $remove_path="../images/food/".$current_image;

                            $remove = unlink($remove_path);
                            if($remove==FALSE)
                            {
                                $_SESSION['remove_fail']="<div class='failed'>Remove Current Image Failed.</div>";
                                header('location:'.SITEURL.'admin/manage_food.php');
                                die();
                            }
                        }
                    }
                    else
                    {
                        $image_name = $current_image;
                    }
                }
                else
                {
                    $image_name = $current_image;
                }

                $sql1="UPDATE tbl_food SET
                    title='$title',
                    description='$description',
                    price=$price,
                    image_name='$image_name',
                    category_id='$category',
                    featured='$featured',
                    active='$active'
                    WHERE id=$id
                    ";

                $res1=mysqli_query($conn,$sql1);

                if($res1==TRUE)
                {
                    $_SESSION['update'] = "<div class='success'>Food Update Succeed.</div>";
                    header('location:'.SITEURL.'admin/manage_food.php');
                }
                else
                {
                    $_SESSION['update'] = "<div class='failed'>Food Update Failed.</div>";
                    header('location:'.SITEURL.'admin/manage_food.php');
                }

            }        
        ?> 
    </div>    
</div>
<?php include('partials/footer.php') ?>