<?php include('partials/menu.php'); ?>


<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
        <br><br>
        <?php
            // 1.Get the id of selected admin
            $id=$_GET['id'];
            // 2.create sql query to get the details
            $sql="SELECT * FROM tbl_admin where id=$id";

            // Execute the query
            $res=mysqli_query($conn,$sql);

            // check wheter the quey is executed or not
            if($res==True){
                // check whether the data is available or not
                $count=mysqli_num_rows($res);
                if($count==1){
                    // Get the details
                    //  echo "Admin available";
                    // check if we have data in database
                    $rows =mysqli_fetch_assoc($res);

                    $full_name =$rows['full_name'];
                    $username = $rows['username'];
                    
                }
                else{
                    // Redirect to manage-admin page
                    header('location'.SITEURL.'admin/manage-admin.php');
                }
            }


         ?>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username; ?>" >
                    </td>
                </tr>
                <tr>
                    <td colspan ="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>





            </table>

    </div>
</div>
<?php

            //check whether the submit buttom is clicked or not
            if(isset($_POST['submit'])){
                //  echo "Button Clicked";
                // Get all the values from form to update
                $id = $_POST['id'];
                $full_name = $_POST['full_name'];
                $username = $_POST['username'];

               //  create sql query to update admin
               $sql="UPDATE tbl_admin set
               full_name='$full_name',
               username='$username'
               where id='$id'
               ";
               // execute the query
               $res =mysqli_query($conn,$sql);
               // check whether the query executed successfully or not
               if($res==true)
               {
                   $_SESSION['update']="<div class='success'>Admin Updated successfully.</div>";
                   // redirect to manage-admin page
                header('location:'.SITEURL.'admin/manage-admin.php');
               }
               else
               {
                   $_SESSION['update']="<div='error'>Failed to Update Admin.</div> ";
                   header('location:'.SITEURL.'admin/manage-admin.php');
               }
               
               
            } 
?>


<?php include('partials/footer.php'); ?>