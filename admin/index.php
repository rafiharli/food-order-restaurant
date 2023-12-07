<?php include('partials/header.php') ?>

    <div class="main-content menu">
        <div class="wrapper">
            <h1>Dashboard</h1>
            <br><br>

            <?php
            if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
            ?>
            <br><br>
            
            <div class="col-4 text-center">
                <h1>
                  
                    <?php
                        $sql="SELECT * FROM tbl_category";
                        $res=mysqli_query($conn,$sql);
                        $count=mysqli_num_rows($res);

                        if($count>0)
                        {
                            echo "$count";
                        }
                        else
                        {
                            echo "0";
                        }
                    ?>
                </h1>
                <br>
                Total Categories
            </div>


            <div class="col-4 text-center">
                <h1>
                    <?php
                        $sql0="SELECT * FROM tbl_food";
                        $res0=mysqli_query($conn,$sql0);
                        $count0=mysqli_num_rows($res0);

                        if($count0>0)
                        {
                            echo "$count0";
                        }
                        else
                        {
                            echo "0";
                        }
                    ?>
                </h1>
                <br>
                Total Food
            </div>


            <div class="col-4 text-center">
                <h1> 
                    <?php
                        $sql1="SELECT * FROM tbl_order";
                        $res1=mysqli_query($conn,$sql1);
                        $count1=mysqli_num_rows($res1);

                        if($count1>0)
                        {
                            echo "$count1";
                        }
                        else
                        {
                            echo "0";
                        }
                    ?>
                </h1>
                <br>
                Total Orders
            </div>

            <div class="col-4 text-center">
                    <?php
                        $sql2="SELECT SUM(total) AS tot FROM tbl_order";
                        $res2=mysqli_query($conn,$sql2);
                        $row=mysqli_fetch_assoc($res2);

                        $revenue=$row['tot'];
                    ?> 
                <h1>
                    <?php echo 'Rp '.$revenue; ?>
                </h1>
                <br>
                Revenue
            </div>

            <div class="clearfix"></div>
        </div>
    </div>

<?php include('partials/footer.php') ?>