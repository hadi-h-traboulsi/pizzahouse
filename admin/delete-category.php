<?php
    // Include constants file
    include('../config/constants.php');

    // echo "Delete Page";
    // check whether the id and image_name value is set or not
    if(isset($_GET['id']) And isset($_GET['image_name']))
    {
        // Get the value and Delete
        // echo "Get value and delete";
        $id=$_GET['id'];
        $image_name=$_GET['image_name'];

        // Remove the physical image file is available
        if($image_name != "")
        {
            // Image is available. so remove 
            $path = "../images/category/".$image_name;
            // Remove the image
            $remove = unlink($path);

            // If failed to remove image then add an error message and stop the process
            if($remove==false)
            {
                // set the session message
                $_SESSION['remove']="<div class='error'>Failed to remove category image.</div>";
                // Redirect to manage_category page
                header('location:'.SITEURL.'admin/manage-category.php');
                // stop the process
                die();
            }

        }

        // Delete data from Database
        // Sql query to delete data from Database
        $sql = "DELETE FROM tbl_category WHERE id=$id";
        // Execute query
        $res =mysqli_query($conn,$sql);
        // check whether the data is delete from database or not
        if($res==true)
        {
            // set session message and redirect
            $_SESSION['delete']="<div class='success'>Category deleted successfully.</div>";
            // Redirect to manage_category
            header('location:'.SITEURL.'admin/manage-category.php');
            
        }
        else
        {
            // set fail message and redirecs
            $_SESSION['delete']="<div class='error'>Failed to delete category.</div>";
            // Redirect to manage-category page
            header('location:'.SITEURL.'admin/manage-category.php');
        
            
        }

    }
    else
    {
        // Redirect to manage_category page
        header('location:'.SITEURL.'admin/manage-category.php');

    }
    ?>