<?php include('partials/header.php') ?>

    <div class="main-content menu">
        <div class="wrapper">
            <h1>Dashboard Category</h1>
        <br>
            <!-- Button Admin -->
            <a href="add_category.php" class="btn-primary">Add Category</a>       
        </br>
        </br>

        <?php
            if(isset($_SESSION['add_cat']))
            {
                echo $_SESSION['add_cat'];
                unset ($_SESSION['add_cat']);
            }
            if(isset($_SESSION['remove']))
            {
                echo $_SESSION['remove'];
                unset ($_SESSION['remove']);
            }
            if(isset($_SESSION['delete']))
            {
                echo $_SESSION['delete'];
                unset ($_SESSION['delete']);
            }
            if(isset($_SESSION['no_cat']))
            {
                echo $_SESSION['no_cat'];
                unset ($_SESSION['no_cat']);
            }
            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset ($_SESSION['update']);
            }
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset ($_SESSION['upload']);
            }
            if(isset($_SESSION['remove_fail']))
            {
                echo $_SESSION['remove_fail'];
                unset ($_SESSION['remove_fail']);
            }
        ?>
            
        </br>
        
            <table class="tbl_full">
                <tr>
                    <th>No</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>

                <?php

                    $sql = "SELECT * FROM tbl_category";

                    $res = mysqli_query($conn, $sql);

                    $count = mysqli_num_rows($res);

                    $no = 1;

                    if($count>0)
                    {
                        while($row=mysqli_fetch_assoc($res))
                        {
                            $id = $row['id'];
                            $title = $row['title'];
                            $image_name = $row['image_name'];
                            $featured = $row['featured'];
                            $active = $row['active'];

                            ?>
                            
                                <tr>
                                    <td><?php echo $no++ ?></td>
                                    <td><?php echo $title ?></td>
                                    <td>
                                        <?php
                                            if($image_name!="")
                                            {
                                                ?>

                                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" width="100px">

                                                <?php
                                            }
                                            else
                                            {
                                                echo "<div class='failed'>Image not Added.</div>";
                                            }

                                        ?>
                                    </td>
                                    <td><?php echo $featured ?></td>
                                    <td><?php echo $active ?></td>
                                    <td>
                                        <a href="<?php echo SITEURL; ?>admin/update_category.php?id=<?php echo $id; ?>" class="btn-secondary">Update</a>
                                        <a href="<?php echo SITEURL; ?>admin/delete_category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete</a>
                                    </td>
                                </tr>

                            <?php
                        }
                    }
                    else
                    {
                        ?>

                            <tr>
                                <td colspan="6"><div class="failed">No Category Added.</div></td>
                            </tr>

                        <?php
                    }

                ?>

                
            </table>

            <div class="clearfix"></div>
        </div>
    </div>

<?php include('partials/footer.php') ?>