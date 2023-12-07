<?php include('partials/header.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        </br>
            <!-- Displaying Message fail/success-->
            <?php
                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }
            ?>
        </br>    
        </br>
        <form action="" method="POST" class="form">
            <table class="tbl-30">
                <tr>
                    <td class="aua">Full Name : </td>
                    <td>
                        <input class="auah boks" type="text" name="full_name" placeholder="Enter Full Name">
                    </td>                    
                </tr>

                <tr>
                    <td class="aua">Username : </td>
                    <td>
                        <input class="auah boks" type="text" name="username" placeholder="Enter Username">
                    </td>                    
                </tr>

                <tr>
                    <td class="aua">Password : </td>
                    <td>
                        <input class="auah boks" type="password" name="password" placeholder="Enter Password">
                    </td>                    
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-primary">
                    </td>                  
                </tr>
            </table>
        </form>
    </div>
</div>

<?php include('partials/footer.php') ?>

<?php

    if(isset($_POST['submit']))
    {
        //Get data from form
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']); //password encryption "MD5"

        //SQL query to save data to database
        $sql = "INSERT INTO tbl_admin SET 
            full_name='$full_name',
            username='$username',
            password='$password'
            ";
        
        //Executing query and saving to database
        $res = mysqli_query($conn, $sql) or die(mysqli_error());
        
        //check for: query executed(?), data insert(?), n display message condition 
        if($res==TRUE)
        {
            //echo "Data Inserted";
            //Create a session to display message
            $_SESSION['add'] = "<div class='success'>Admin Added Succesfully.</div>";
            //Redirect Page
            header("location:".SITEURL.'admin/manage_admin.php');
        }
        else
        {
            //echo "Data Failed";
            $_SESSION['add'] = "<div class='failed'>Admin Added Failed.</div>";
            //Redirect Page
            header("location:".SITEURL.'admin/add_admin.php');
        }
    }
?>

