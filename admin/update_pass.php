<?php include('partials/header.php') ?>


<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
        </br>    
        </br>


        <?php
            if(isset($_GET['id'])) 
            {
                $id = $_GET['id'];
            } 
        ?>


        <form action="" method="POST" class="">
            <table class="tbl-30">
                <tr>
                    <td class="aua">Old Password : </td>
                    <td>
                        <input class="auah" type="password" name="current_password" placeholder="Old Password">
                    </td>                    
                </tr>

                <tr>
                    <td class="aua">New Password : </td>
                    <td>
                        <input class="auah" type="password" name="new_password" placeholder="New Password">
                    </td>                    
                </tr>

                <tr>
                    <td class="aua">Confirm Password : </td>
                    <td>
                        <input class="auah" type="password" name="confirm_password" placeholder="Confirm Password">
                    </td>                    
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id ?>">
                        <input type="submit" name="submit" value="Change Password" class="butt-1">
                    </td>                  
                </tr>
            </table>
        </form>
    </div>
</div>

<?php

if(isset($_POST['submit'])) 
{
    //Get data from form
    $id = $_POST['id'];
    $current_password = md5($_POST['current_password']);
    $new_password = md5($_POST['new_password']);
    $confirm_password = md5($_POST['confirm_password']);

    //SQL for cek id and password exists
    $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";

    //Execute SQL query
    $res = mysqli_query($conn, $sql);

    if($res==TRUE)
    {
        $count=mysqli_num_rows($res);

        if($count==1)
        {
            if($new_password==$confirm_password)
            {
                $sql0 = "UPDATE tbl_admin SET
                    password='$new_password'
                    WHERE id=$id
                    ";
                
                $res0 = mysqli_query($conn, $sql0);

                if($res0==TRUE)
                {
                    $_SESSION['pass_change'] = "<div class='success'>Password Changed Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage_admin.php');
                }
                else
                {
                    $_SESSION['pass_change'] = "<div class='failed'>Password Changed Failed.</div>";
                    header('location:'.SITEURL.'admin/manage_admin.php');
                }
            }
            else
            {
                $_SESSION['pass_match'] = "<div class='failed'>Password Did Not Match.</div>";
                header('location:'.SITEURL.'admin/manage_admin.php');
            }
        }
        else
        {
            $_SESSION['user_none'] = "<div class='failed'>Wrong Old Password.</div>";
            header('location:'.SITEURL.'admin/manage_admin.php');
        }
    }
}
?>


<?php include('partials/footer.php') ?>