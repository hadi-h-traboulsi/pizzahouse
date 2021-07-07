<?php include('../config/constants.php'); ?>
<?php include('partials/menu.php'); ?>
<div class ="main-content">
    <div class="wrapper">
        <h1>Change password</h1>
        <br/><br/>
        <?php
        if(isset($_GET['id']))
        {
            $id=$_GET['id'];
        }
        ?>

        <form action="" methd="POST">
            <table class="tbl-30">
                <tr>
                    <td>Current password: </td>
                    <td>
                        <input type="password" name="current_password" placeholder="Old password">
                    </td>
                </tr>

                <tr>
                    <td>New password: </td>
                    <td>
                        <input type="password"name="new_password" placeholder="New Password">
                    </td>
                </tr>
                <tr>
                    <td>Confirm Password: </td>
                    <td>
                        <input type="password"name="confirm_password" placeholder="Confirm Password">
            
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Change Password">
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
        // echo "Clicked";

        // 1.Get the data from form
        $id=$_POST['id'];
        $current_password=md5($_POST['current_password']);
        $new_password=md5($_POST['new_password']);
        $confirm_password=md5($_POST['confirm_password']);

        // 2.Check whether the current id and current password exists or not
        // rq: we have single got only for current password because it's not an integer but id is not an integer he don't need a single quote
        
        $sql="SELECT  * FROM tbl_admin  WHERE id=$id AND password='$current_password'";
        // execute the query
        $res=mysqli_query($conn,$sql);

        // 3.check whether the new password and confirm password match or not
        if($res==true)
        {
            dd($count=mysqli_num_rows($res));

            if($count==1){
                // user exists and password can be changed
                 echo "user Found";

                // check whether the new password and confirm match or not
                
            }
            else{
                // user does not exist set message and redirect
                $_SESSION['user-not-found']="<div class='error'>User Not Found.</div>";
                // Redirect to user
                header('location:'.SITEURL.'admin/manage-admin.php');

            }
        }
        
        // 4.Change password if all above is true
    }
?>
<?php include('partials/footer.php'); ?>




