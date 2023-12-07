<?php include('partials_front/header.php'); ?>

<?php

    if(isset($_GET['category_id']))
    {
        $category_id = $_GET['category_id'];

        $sql = "SELECT title FROM tbl_category WHERE id=$category_id";
        $res = mysqli_query($conn,$sql);
        $row = mysqli_fetch_assoc($res);
        
        $category_title = $row['title'];
    }
    else
    {
        header('location:'.SITEURL);
    }
?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on <a href="#" class="text-white">"<?php echo $category_title; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
                $sql0 = "SELECT * FROM tbl_food WHERE category_id=$category_id";
                $res0 = mysqli_query($conn,$sql0);
                $count0 = mysqli_num_rows($res0);

                if($count0>0)
                {
                    while($row0=mysqli_fetch_assoc($res0))
                    {   
                        $id=$row0['id'];
                        $title = $row0['title'];
                        $price = $row0['price'];
                        $description = $row0['description'];
                        $image_name = $row0['image_name'];
                        
                        ?>
                        <div class="food-menu-box">
                            <div class="food-menu-img">

                            <?php
                            if($image_name=="")
                            {
                                echo "<div class='failed'>Image Not Available.</div>";
                            }
                            else
                            {
                            ?>
                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" class="img-responsive img-curve"/>
                            <?php
                            }
                            ?>
                            </div>

                            <div class="food-menu-desc">
                                <h4><?php echo $title; ?></h4>
                                <p class="food-price"><?php echo 'Rp. '.$price; ?></p>
                                <p class="food-detail">
                                    <?php echo $description; ?>
                                </p>
                                <br>
                                <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>
                        <?php

                    }
                }
                else
                {
                    echo "<div class='failed'>Food is not Available.</div>";
                }
            ?>

            
            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials_front/footer.php'); ?>