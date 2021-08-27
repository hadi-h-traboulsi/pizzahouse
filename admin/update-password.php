
<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br><br>
        <?php
            $id=$_GET['id'];
            // 2.create sql query to get the details
            $sql="SELECT * FROM tbl_admin where id=$id";
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Current Password: </td>
                    <td>
                        <input type="password" name="current_password" placeholder="old password">
                    </td>
                </tr>
                <tr>
                    <td>New Password: </td>
                    <td>
                        <input type="password" name="new_password" placeholder="New Password">
                    </td>
                </tr>
                <tr>
                    <td>Confirm Password: </td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Confirm Password"> 
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Change Password" class="btn-secondary"> 
                    </td>
                </tr>

            </table>
        
        </form>
    </div>
</div>
<?php

    // check whether the submit button is clicked or not
    if(isset($_POST['submit']))
    {
        //  echo "Clicked";

        // 1.Get the DATA from form
         echo $id = $_POST['id'];
         echo $current_password = md5($_POST['current_password']);
         echo $new_password = md5($_POST['new_password']);
         echo $confirm_password = md5($_POST['confirm_password']);

        // 2.check whether yhe user with current ID and current Password Exists or Not
        $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";

        // Execute the query
        $res = mysqli_query($conn,$sql);

        if($res==true)
        {
            // check whether data is available or not
            $count=mysqli_num_rows($res);

            if($count==1)
            {
                // user exists and password can be changed
                // echo "User Found";
                // check whether the new password and confirm match or not
                if($new_password==$confirm_password)
                {
                    // update the password
                    $sql2 = "UPDATE tbl_admin SET
                        password='$new_password'
                        WHERE id=$id
                        ";
                        // Execute the query
                        $res2 =mysqli_query($conn,$sql2);

                        if($res==true)
                        {
                            // Display Success message
                            $_SESSION['change-pwd']="<div class='success'>Password Changed Successfully.</div>";
                            // Redirect the user
                            header('location:'.SITEURL.'admin/manage-admin.php');
                        }
                        else
                        {
                            // Display Error message
                            $_SESSION['change-pwd']="<div class='error'>Failed to change password.</div>";
                            // Redirect the user
                            header('location:'.SITEURL.'admin/manage-admin.php');
                        }
                }
                else
                {
                    // Redirect to manage-admin page with error message
                    $_SESSION['pwd-not-match']="<div class='error'>Password did Not match.</div>";
                    // Redirect the user
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }

            }
            else
            {
                // user does not exist set message and redirect
                $_SESSION['user-not-found']="<div class='error'>User not found.</div>";
                // redirect the user 
                header('location:'.SITEURL.'admin/manage-admin.php');

            }

        }

        // 3.check whether the new Password and Confirm Password match or not

        // 4.change password if all above is true
    }

       
   
?>
<?php include('partials/footer.php'); ?>




