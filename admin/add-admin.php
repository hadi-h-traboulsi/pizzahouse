<?php include('partials/menu.php'); ?>
<?php include('../config/constants.php'); ?>

<div class = "main-content">
<div class ="wrapper">
    <h1>Add Admin</h1>

    <br/><br/>

    <?php
        if(isset($_SESSION['add']))//Checking whether the session is set of not
        {
            echo $_SESSION['add'];//Display the Session messaging if set
            unset($_SESSION['add']);//Remove Session Message

        }
    ?>

    <form action="" method="POST">
        <table class="tbl-30">
            <tr>
                <td>Full name: </td>
                <td><input type="text" name="full_name" placeholder="Enter your name"></td> 
            </tr>

            <tr>
                <td>Username: </td>
                <td><input type="text" name="username" placeholder="Your Username">
                </td>
            </tr>   
            <tr>
                <td>Password: </td>
                <td><input type="text" name="password" placeholder="Your Password"></td>

            </tr>
            <tr>
                <td colspan="2" >
                    <input type="submit" name="submit" value="Add Admin" class="btn-secondary"> 
            </td>
            </tr>

        </table>
</div>
</div>

<?php include('partials/footer.php'); ?>
<?php

// Process value from Form and Save it in Database

// check whether the submit button is clicked or not
if(isset($_POST['submit'])){
    // Button clicked
    // echo 'Button Clicked'

    // 1.Get the data from form
      $full_name = $_POST['full_name'];
      $username = $_POST['username'];
      $password = $_POST['password']; //password encryption with md5 method

    // 2.SQL query to save the data in the databse
    $sql = "INSERT INTO tbl_admin SET
        full_name = '$full_name',
        username = '$username',
        password = '$password'
    ";
    // 3.Execute query and saving data into Database
    $res = mysqli_query($conn,$sql) or die(mysqli_error());

    // 4.check whether the (Query is Executed) data is inserted
    if($res==True)
    {
        // Data inserted
        // echo "Data Inserted";
        // Create a Session Variable to Display Message
        $_SESSION['add'] = 'Admin Added successfully';
        // Redirect Page to manage-admin
        header("location:".SITEURL.'admin/manage-admin.php');
    }else
    {
        // Failed to insert data
        // echo "Failed to insert data";
        // Create a Session Variable to Display Message
        $_SESSION['add'] = "Failed to Add admin";
        
    }
    
    
    
        

    }
   



    
    
?>