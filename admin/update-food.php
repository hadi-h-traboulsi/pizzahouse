<?php include('partials/menu.php'); ?>

    <div class ="main-content">
        <div class="wrapper">
            <h1>Update Food</h1>
            <br><br>
            <?php
                // check whether the id is set or not
                if(isset($_GET['id']))
                {
                    // get all the details
                    $id =$_GET['id'];
                    // sql query to get the selected food
                    $sql2 = "SELECT * FROM tbl_food WHERE id=$id";
                    // Execute the query
                    $res2 =mysqli_query($conn,$sql2);
                    // get the value based on query executed
                    $row =mysqli_fetch_assoc($res2);
                    // get the individual values of selected food
                    $title =$row['title'];
                    $description =$row['description'];
                    $price =$row['price'];
                    $current_image =$row['image_name'];
                    $current_category =$row['category_id'];
                    $featured =$row['featured'];
                    $active =$row['active'];




                }
                else
                {
                    // Redirect to manage-food.php
                    header('location:'.SITEURL.'admin/manage-food.php');
                }
            
            ?>
            <form action=""method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
            <tr>
                <td>Title: </td>
                <td>
                    <input type="text" name="title" value="<?php echo $title; ?>">
                </td>
            </tr>
            <tr>
                <td>Description: </td>
                <td>
                    <textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea>
                </td>
            
            </tr>
            <tr>
                <td>Price: </td>
                <td>
                    <input type="number" name="price" value="<?php echo $price; ?>">
                </td>
            </tr>
            <tr>
                <td>Current image: </td>
                <td>
                    <?php
                        if($current_image =="")
                        {
                            // image not available
                            echo "<div class='error'>Image not available.</div>";
                        }
                        else
                        {
                            // Image available
                            ?>
                            <img src ="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>"width="150px">
                            <?php
                        }
                    ?>
                </td>
            </tr>
            <tr>
            <tr>
                <td>Select new image: </td>
                <td>
                    <input type="file" name="image">
                </td>
            </tr>
                <td>Category: </td>
                <td>
                 
                    <select name="category">
                        <?php
                            // to display category
                            $sql ="SELECT * FROM tbl_category WHERE active='Yes'";
                            // execute the query
                            $res=mysqli_query($conn,$sql);
                            // count rows
                            $count=mysqli_num_rows($res);
                            // check whether the category is available or not
                            if($count>0)
                            {
                                // category available
                                while($row=mysqli_fetch_assoc($res))
                                {
                                    $category_title = $row['title'];
                                    $category_id =$row['id'];
                                    ?>

                                    <option <?php if($current_category==$category_id){echo "selected";} ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?> </option>

                                    <?php
                                }
                            }
                            else
                            {
                                // category not available
                                echo "<option value='0'>Category not available.</option>";
                            }
                        ?>
                    
                        <option value="0">Test category</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Featured: </td>
                <td>
                    <input <?php if($featured=="Yes"){echo "checked";}?> type ="radio"name="featured" value="Yes">Yes
                    <input <?php if($featured=="No"){echo "checked";}?> type="radio"name="featured"value="No">No
                </td>
            </tr>
            <tr>
                <td>Active: </td>
                <td>
                    <input <?php if($active=="Yes"){echo "checked";}?> type="radio"name="active" value="Yes">Yes
                    <input <?php if($active=="No"){echo "checked";}?> type="radio"name="active"value="No">No
                </td>
            </tr>
            <tr>
                <td colspan="2">
                <input type="hidden"name="id"value="<?php echo $id; ?>">
                <input type="hidden"name="current_image" value="<?php echo $current_image; ?>">
                <input type="submit" name="submit" value="Update Food" class="btn-secondary">
                </td>
            </tr>
            
            
            
            </table>
            
            </form>
            <?php
                if(isset($_POST['submit']))
                {
                    // Echo button "clicked"

                    // 1.Get all the details from form 
                    $id =$_POST['id'];
                    $title =$_POST['title'];
                    $description =$_POST['description'];
                    $price =$_POST['price'];
                    $current_image=$_POST['current_image'];
                    $category =$_POST['category'];
                    $featured=$_POST['featured'];
                    $active=$_POST['active'];

                    // 2.Update the image if selected

                    // check whether the button is clicked or not 
                    if(isset($_FILES['image']['name']))
                    {
                        // Upload button clicked
                        $image_name = $_FILES['image']['name'];//new image name
                        // check whether the file is available or not
                        if ($image_name !="")
                        {
                            // image is availbale
                            // A.uploading new image
                            // rename the image
                            $ext = end(explode('.',$image_name));//gets the extension of the image

                            $image_name ="Food-Name".rand(0000,9999).'.'.$ext;//this will be renamed image
                            // get the source path and destination path

                            $src_path=$_FILES['image']['tmp_name'];//Source path
                            
                            $dest_path="../images/food/".$image_name;//Destination path
                            // upload the image
                            $upload = move_uploaded_file($src_path,$dest_path);
                            // check whether the image is uploaded or not
                            if($upload==false)
                            {
                                // Failed to upload
                                $_SESSION['upload']="<div class='error'>Failed to upload new image.</div>";
                                header('location:'.SITEURL.'admin/manage-food.php');
                                // stop the process
                                die();
                            }
                            // B.remove current_image if available
                            if($current_image !="" )
                            {
                                // current image is available
                                // remove the image
                                $remove_path="../images/food/".$current_image;

                                $remove =unlink($remove_path);
                                // check whether the image is removed or not
                                if($remove==false)
                                {
                                    // failed to remove current image
                                    $_SESSION['upload-failed']="<div class='error'>Fail to remove current image.</div>";
                                    header('location:'.SITEURL.'admin/manage-food.php');
                                    // stop the process
                                    die();
                                }
                            }

                        }
                        else
                        {
                            $image_name=$current_image;//default image when image is not selected
                        }
                    }
                    else
                    {
                        $image_name=$current_image;//default image where button is not selected
                    }

                    // 3.remove the image if new image is uploaded and current image exists

                    // 4.Update the food in database
                    $sql3 ="UPDATE tbl_food SET
                        title='$title',
                        description='$description',
                        price=$price,
                        image_name='$image_name',
                        category_id='$category',
                        featured='$featured',
                        active='$active'
                        WHERE id=$id
                        ";
                        // execute the sql query
                        $res3 =mysqli_query($conn,$sql3);
                        // check whether the query is executed or not
                        if($res3 ==true)
                        {
                            // query executed and food updated
                            $_SESSION['update']="<div class='success'>Food updated successfully.</div>";
                            header('location:'.SITEURL.'admin/manage-food.php');
                        }
                        else
                        {
                            $_SESSION['update']="<div class='error'>Failed to update food.</div>";
                            header('location:'.SITEURL.'admin/manage-food.php');

                        }

                    // Redirect to manage-food with message

                }

            ?>
        </div>


    </div>



<?php include('partials/footer.php'); ?>