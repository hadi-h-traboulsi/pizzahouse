
<?php include('../config/constants.php'); ?>
<html>
    <head>
        <title>Login -Food Order System</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>

        <div class = "login">
            <h1 class="text-center">Login</h1>
            <br><br>

            <?php
               
                if(isset($_SESSION['no-login-message']))
                {
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);

                } 
               
            
            ?>
            <!-- Login form starts here -->
            <form action="" method="POST" class="text-center">
            Username: <br>
            <input type="text" name="username" placeholder="Enter Username"><br><br>
            Password:<br>
            <input type="password" name="password" placeholder="Enter  Password"><br><br>
            <input type="submit" name="submit" value="Login" class="btn-primary">
            <br><br>
            </form>

            <p class="text-center"> Created by   <a href="www.HadiTraboulsi.com">Hadi Traboulsi</a></p>
        </div>
    </body>
</html>
<?php
    // check whether the submit button is clicked or not
    if(isset($_POST['submit']))
    {
        // Process for Login
        // 1.Get the data from Login form
         $username =$_POST['username'];
         $password =md5($_POST['password']);

         // 2.sql to check whether the user with username and password existz or not
        $sql ="SELECT * FROM tbl_admin WHERE username ='$username' AND password='$password'";

        // 3.Execute the query
        $res = mysqli_query($conn,$sql);

        // 4.count rows to check whether the user exists or not
        $count = mysqli_num_rows($res);

        if($count==1)
        {
            // user avialable and login success
            $_SESSION['login']="<div class='success'>Login successful.</div>";
            $_SESSION['user']=$username;//check whether the user is login in or not and logout will unset it
            // Redirect to home page/dashboard
            header('location:'.SITEURL.'admin/');
        }
        else
        {
            // user not available and login fail
            $_SESSION['login']="<div class='error text-center'>Username and Password did not match.</div>";
            // Redirect to home page/dashboard
            header('loaction:'.SITEURL.'admin/login.php');
        }
    }
    



?>