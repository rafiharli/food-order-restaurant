<?php include('partials_front/header.php'); ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
      <?php
        if(isset($_SESSION['order']))
        {
          echo $_SESSION['order'];
          unset($_SESSION['order']);
        }
      ?>
      <div class="container">
        <form action="<?php SITEURL; ?>food-search.php" method="POST">
          <input
            type="search"
            name="search"
            placeholder="Search for Food..."
            required
          />
          <input
            type="submit"
            name="submit"
            value="Search"
            class="btn btn-primary"
          />
        </form>
      </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->
<br>


    <!-- CAtegories Section Starts Here -->
    <section class="categories">
      <div class="container">
        <h2 class="text-center">Explore Foods</h2>
        <?php
          $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 3";
          $res = mysqli_query($conn,$sql);
          $count=mysqli_num_rows($res);
          if($count>0)
          {
            while($row=mysqli_fetch_assoc($res))
            {
              $id=$row['id'];
              $title=$row['title'];
              $image_name=$row['image_name'];
              ?>
              <a href="<?php SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                <div class="box-3 float-container">                  
                  <?php
                    if($image_name=="")
                    {
                      echo "<div class='failed'>Image Not Available.</div>";
                    }
                    else
                    {
                      ?>
                      <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" class="img-responsive img-curve"/>
                      <?php
                    }
                  ?>
                  <h3 class="float-text text-white"><?php echo $title; ?></h3>
                </div>
              </a>
              <?php
            }
          }
          else
          {
            echo "<div class='failed'>Category Not Added Yet.</div>";
          }
        ?>
        <div class="clearfix"></div>
      </div>
    </section>
    <!-- Categories Section Ends Here -->


    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
      <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <?php 

          $sql0="SELECT * FROM tbl_food WHERE active='Yes' AND featured='Yes' LIMIT 6";
          $res0=mysqli_query($conn,$sql0);
          $count0=mysqli_num_rows($res0);
          if($count0>0)
          {
            while($row=mysqli_fetch_assoc($res0))
            {
              $id=$row['id'];
              $title=$row['title'];
              $description=$row['description'];
              $price=$row['price'];
              $image_name=$row['image_name'];

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

                  <img src="" class="img-responsive img-curve"/>
                </div>

                <div class="food-menu-desc">
                  <h4><?php echo $title; ?></h4>
                  <p class="food-price"><?php echo 'Rp '.$price; ?></p>
                  <p class="food-detail"> <?php echo $description; ?></p>
                
                  <br>
                  <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                </div>
              </div>

              <?php
            }
          }
          else
          {
            echo "<div class='failed'>Food Not Added Yet.</div>";
          }
        
        ?>

        <div class="clearfix"></div>
      </div>

      <p class="text-center">
        <a href="<?php echo SITEURL; ?>categories.php">See All Categories</a>
      </p>
      <br>
      <p class="text-center">
        <a href="<?php echo SITEURL; ?>foods.php">See All Foods</a>
      </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials_front/footer.php'); ?>

    