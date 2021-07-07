<?php


// include constants.php file here
include("../config/constants.php"); 


// 1.Get the if od admin to be deleted
$id = $_GET['id'];

// 2.create sql query to delete admin
$sql = "DELETE FROM tbl_admin WHERE id=$id";

// Execute the query
$res = mysqli_query($conn,$sql);

// check wheter th query executed successfully or not
if($res==True)
{
    // query executed successfully and Admin Deleted
    // echo "Admin Deleted";
    $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully.</div>";
    // Redirect to manage-admin page
    header('location:'.SITEURL.'admin/manage-admin.php');
}
else
{
    // Failed to delete admin
    // echo "Failed to Delete Admin";
    $_SESSION['delete']= "<div class='error'>Failed to Delete Admin. Try Again Later.</div>";
    header('location:'.SITEURL.'admin/manage-admin.php');
}

// 3.Redirect to manage-admin page with message (success/error)

?>
