<?php include('partials/header.php') ?>

    <div class="main-content menu">
        <div class="wrapper">
            <h1>Dashboard Admin</h1>
        </br>

            <!-- Button Admin -->
            <a href="add_admin.php" class="btn-primary">Add Admin</a>
            
        </br>
        </br>

            <!-- Displaying Message fail/success-->
            <?php
                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }

                if(isset($_SESSION['delete']))
                {
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }

                if(isset($_SESSION['update']))
                {
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }

                if(isset($_SESSION['user_none']))
                {
                    echo $_SESSION['user_none'];
                    unset($_SESSION['user_none']);
                }

                if(isset($_SESSION['pass_match']))
                {
                    echo $_SESSION['pass_match'];
                    unset($_SESSION['pass_match']);
                }

                if(isset($_SESSION['pass_change']))
                {
                    echo $_SESSION['pass_change'];
                    unset($_SESSION['pass_change']);
                }
            ?>

        </br>    

            <table class="tbl_full">
                <tr>
                    <th>No</th>
                    <th>Full Name</th>
                    <th>Username</th>
                    <th>Actions</th>
                </tr>


                <?php
                    //SQLquery to get all admin
                    $sql = "SELECT * FROM tbl_admin";                   
                    //Execute query
                    $res = mysqli_query($conn, $sql);

                    //Check
                    if($res==TRUE)
                    {
                        //Count rows
                        $count = mysqli_num_rows($res);
                        //Check num of rows
                        if($count>0)
                        {   
                            $no=1;
                            //Ada data
                            //While loop to get database
                            while($rows=mysqli_fetch_assoc($res))
                            {
                                //Get individual data
                                $id = $rows['id'];
                                $full_name = $rows['full_name'];
                                $username = $rows['username'];
                                //Display data
                                ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo $full_name; ?></td>
                                        <td><?php echo $username; ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>admin/update_admin.php?id=<?php echo $id ?>" class="btn-secondary">Update</a>
                                            <a href="<?php echo SITEURL; ?>admin/delete_admin.php?id=<?php echo $id ?>" class="btn-danger">Delete</a>
                                            <a href="<?php echo SITEURL; ?>admin/update_pass.php?id=<?php echo $id; ?>" class="butt-1">Change Password</a>
                                        </td>
                                    </tr>
                                <?php
                            }

                        }
                        else 
                        {
                            //Tidak ada data
                        }
                    }
                ?>
                </table>
            <div class="clearfix"></div>
        </div>
    </div>
    
<?php include('partials/footer.php') ?>

