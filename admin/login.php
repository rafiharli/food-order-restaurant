<?php include('../config/constants.php') ?>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login - RAFIFOOD</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>
        <div class="login">
            <h1 class="text-center">Login</h1>
            </br>

            <?php
            if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
            if(isset($_SESSION['no_login']))
                {
                    echo $_SESSION['no_login'];
                    unset($_SESSION['no_login']);
                }
            ?>
            <br>

            <!-- Login form -->
            <form action="" method="POST" class="text-center">
                Username: </br>
                <input type="text" name="username" placeholder="Enter Username" class="boks">
                </br></br>
                Password: </br>
                <input type="password" name="password" placeholder="Enter Password" class="boks">
                </br></br>
                <input type="submit" name="submit" value="Login" class="butt-1">
            </form>


            <!-- Login form -->

            </br>
            <h6 class="text-center">Developed By - <a href="https://instagram.com/rafiharlii?igshid=ZDc4ODBmNjlmNQ==" target="_blank" class="rafi"> Rafi Harlianto</h6>
        </div>
    </body>
</html>

<?php

    //check if button submit is clicked
    if(isset($_POST['submit'])) 
    {
        //LOGIN PROCESS
        //Get data from login form
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password_0 = md5($_POST['password']);
        $password = mysqli_real_escape_string($conn, $password_0);

        //check in database if user & pass exist and same
        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";
        
        //execute query
        $res = mysqli_query($conn, $sql);

        //count to cek user exist or not
        $count = mysqli_num_rows($res);
        if($count==1)
        {
            //user exist
            $_SESSION['login'] = "<div class='success'>Login Successful.</div>";
            $_SESSION['user'] = $username; //to check user login or not

            header('location:'.SITEURL.'admin/');
        }
        else
        {
            //user not exist
            $_SESSION['login'] = "<div class='failed text-center'>Username and Password did not match.</div>";
            header('location:'.SITEURL.'admin/login.php');
        }


    }
?>