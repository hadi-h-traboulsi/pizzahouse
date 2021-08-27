<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add food</h1>
        <br><br>

        <form action=""method="POST"enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Title of the Food">
                    </td>
                </tr>
                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea type="description" col="30" rows="5" placeholder="Description of the food."></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>
                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>    
                </tr>
                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">
                            
                            <?php 
                                // create php code to display categories from database
                                // 1.Create sql to get all active categories from database
                                $sql ="SELECT * FROM tbl_category WHERE active='Yes'";

                                // execute the query
                                $res =mysqli_query($conn,$sql);

                                // count the rows to check whether we have categories or not
                                $count=mysqli_num_rows($res);
                                // If count is greater than zero, we have categories else we do not have categories
                                if($count>0)
                                {
                                    // We have categories
                                    while($row=mysqli_fetch_assoc($res))
                                    {
                                        // get the details of categories
                                        $id = $row['id'];
                                        $title =$row['title'];
                                        
                                        ?>
                                        <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                        <?php
                                    }
                                }
                                else
                                {
                                    // We do not have category
                                    ?>
                                    <option value="0">No category found</option>
                                    <?php
                                }
                                // 2.Display on dropdown

                                ?>


                                // 2.Display on dropdown
                            
                            ?>



                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>


            </table>
        
        </form>

        <?php
            // check whether the button is clicked or not
            if(isset($_POST['submit']))
            {
                // Add the food in database
                  // 1.Get the data from form 
                $title =$_POST['title'];
                $description =$_POST['description'];
                $price=$_POST['price'];
                $category=$_POST['category'];

                // check whether the radio button for featured and active are checked or not
                if(isset($_POST['featured']))
                {
                    $featured =$_POST['featured'];
                }
                else
                {
                    $featured = "No";//Setting the default value
                }
                if(isset($_POST['active']))
                {
                    $active =$_POST['active'];
                }
                else
                {
                    $active ="No";//setting the default value
                }

              

                // 2.Upload the image if selected
                // check whether the select image is clicked or not and upload the image only if the image is selected
                if(isset($_FILES['image']['name']))
                {
                    // Get the details of the selected image
                    $image_name=$_FILES['image']['name'];

                    // check whether the image is selected or not and upload image only if selected
                    if($image_name !="")
                    {
                        // image is selected
                        // rename the image
                        // Get the extension of selected image (jpg,png,gif,etc.) "Hadi-Trboulsi.jpg"
                        $ext = end(explode('.',$image_name));
                        // Create new name for image
                        $image_name ="Food-Name".rand(0000,9999).".".$ext;//New image name maybe "Food-Name-675.jpg"
                        //B.Upload the image
                        // Get the src path and destination path

                        // source path is the current location of the image(مسار المصدر هو الموقع الحالي للصورة)
                        $src = $_FILES['image']['tmp_name'];
                        // Destination path for the image to be uploaded(مسار الوجهة للصورة المراد تحميلها)
                        $dst = "../images/food/".$image_name;
                        
                        // Finally upload the food image 
                        $upload = move_uploaded_file($src,$dst);

                        // check whether image uploaded or not
                        if($upload==false)
                        {
                            $_SESSION['upload-image']="<div class='error'>Failed to upload image.</div>";
                            header('loaction:'.SITEURL.'admin/manage-food.php');
                            // Stop the process
                            die();
                        }



                    }

                }
                else
                {
                    $image_name="";//Setting the default value as blank
                }

                // 3.Insert into database

                // Create sql query to save or add food
                // Rq:For  numerical we do not need to pass value inside quotes '' But for strings it is compulsory to add quotes ''
                $sql2 ="INSERT INTO tbl_food SET
                    title ='$title',
                    description ='$description',
                    price = $price,
                    image_name='$image_name',
                    category_id='$category',
                    featured ='$featured',
                    active='$active'
                    ";
                // Execute the query
                $res2 = mysqli_query($conn,$sql2);

                if($res2==true)
                {
                    // Data inserted successfully
                    $_SESSION['add']="<div class='success'>Food added successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }


                // 4.Redirect with message to manage-food page
            }

        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>