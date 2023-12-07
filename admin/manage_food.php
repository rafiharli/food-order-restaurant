<?php include('partials/header.php') ?>

<div class="main-content menu">
        <div class="wrapper">
            <h1>Dashboard Food</h1>
        </br>
            <!-- Button Admin -->
            <a href="add_food.php" class="btn-primary">Add Food</a>
        </br>
        </br>
        
        <?php
            if(isset($_SESSION['add_food']))
            {
                echo $_SESSION['add_food'];
                unset($_SESSION['add_food']);
            }
            if(isset($_SESSION['unauthorized']))
            {
                echo $_SESSION['unauthorized'];
                unset($_SESSION['unauthorized']);
            }
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
            if(isset($_SESSION['del_food']))
            {
                echo $_SESSION['del_food'];
                unset($_SESSION['del_food']);
            }
            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
            if(isset($_SESSION['remove_fail']))
            {
                echo $_SESSION['remove_fail'];
                unset($_SESSION['remove_fail']);
            }
        ?>
            
        </br>
        
            <table class="tbl_full">
                <tr>
                    <th>No</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>

                <?php
                    $sql = "SELECT * FROM tbl_food";

                    $res = mysqli_query($conn, $sql);

                    $count = mysqli_num_rows($res);

                    $no=1;

                    if($count>0)
                    {
                        while($row=mysqli_fetch_assoc($res))
                        {
                            $id = $row['id'];
                            $title = $row['title'];
                            $price = $row['price'];
                            $image_name = $row['image_name'];
                            $featured = $row['featured'];
                            $active = $row['active'];
                            
                            ?>

                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $title; ?></td>
                                <td><?php echo $price; ?></td>
                                <td>
                                    <?php 
                                    if($image_name=="")
                                    {
                                        echo "<div class='failed'>Image not Added.</div>";
                                    }
                                    else
                                    {
                                        ?>

                                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" width="100px">

                                        <?php
                                    }
                                    ?>
                                </td>
                                <td><?php echo $featured; ?></td>
                                <td><?php echo $active; ?></td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>admin/update_food.php?id=<?php echo $id; ?>" class="btn-secondary">Update</a>
                                    <a href="<?php echo SITEURL; ?>admin/delete_food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete</a>
                                </td>
                            </tr>

                            <?php
                        }
                    }
                    else
                    {
                        echo "<tr><td colspan='7' class='failed'>Food not Added Yet.</td></tr>";
                    }
                ?>
            </table>

            <div class="clearfix"></div>
        </div>
    </div>

<?php include('partials/footer.php') ?>
