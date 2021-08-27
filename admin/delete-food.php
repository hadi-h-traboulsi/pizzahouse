<?php 
    include('../config/constants.php');
    if(isset($_GET['id']) && isset($_GET['image_name'])) //either use && or AND
    {
        // Process to delete
        // echo "Process to delete";
        
        //1. Get id and image_name
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        // 2.Remove the image if available
        // check whether the image is available or not and delete only if available
        if($image_name !="")
        {
            // if has image and need to remove from folder
            // Get the image path
            $path = "../images/food/".$image_name;

            // remove image file from folder
            $remove = unlink($path);

            // check whether the image is removed or not
            if($remove ==false)
            {
                // Failed to remove image
                $_SESSION['upload']="<div class='error'>Failed to remove image file.</div>";
                header('location:'.SITEURL.'admin/manage-food.php');
                // Stop the processing delete food
                // die function is to exit the process
                die();
            }

        }

        // 3.Delete food from database
        $sql ="DELETE FROM tbl_food WHERE id=$id";
        // execute the query
        $res = mysqli_query($conn,$sql);

        // check whether the query is executed or not and set session message respectively
        if($res == true)
        {
            // food deleted
            $_SESSION['delete']="<div class='success'>food deleted successfully.</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }
        else
        {
            $_SESSION['delete']="<div class='error'>Failed to delete food.</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }

        // 4.Redirect to manage-food page with message

    }
    else
    {
        $_SESSION['unauthorize']="<div class='error'>Unauthorized access.</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
    }


?>