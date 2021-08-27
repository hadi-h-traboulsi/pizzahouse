<?php include('partials/menu.php'); ?>

<div class= "main-content">
    <div class= "wrapper">
    <h1>Manage Category</h1>

    <br><br><br>

        <!--Button to add Admin-->
        <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">Add Category</a>

        <br><br>

        <?php
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']);

            }
            if(isset($_SESSION['remove'])){
                echo $_SESSION['remove'];
                unset($_SESSION['remove']);

            }
            if(isset($_SESSION['delete'])){
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }
            if(isset($_SESSION['no category found'])){
                echo $_SESSION['no category found'];
                unset($_SESSION['no category found']);
            }
            if(isset($_SESSION['update'])){
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
            if(isset($_SESSION['falied-remove'])){
                echo $_SESSION['falied-remove'];
                unset($_SESSION['falied-remove']);
            }
        ?>
        <br><br><br>
        <table class="tbl-full">
                        <tr>
                            <th>S.N.</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Featured</th>
                            <th>Active</th>
                            <th>Actions</th>
                        </tr>

                    <?php
                        // query to get all categories from database
                        $sql = "SELECT * FROM tbl_category";

                        // Execute Query
                        $res= mysqli_query($conn,$sql);

                        // count rows
                        $count = mysqli_num_rows($res);

                        // Create serial number variable and assign value as 1
                        $sn =1;

                        // check whether we have data in database
                        if($count>0)
                        {
                            // We have data in database
                            // get the data and display
                            while($row = mysqli_fetch_assoc($res))
                            {
                                $id = $row['id'];
                                $title=$row['title'];
                                $image_name = $row['image_name'];
                                $featured = $row['featured'];
                                $active =$row['active'];

                                ?>
                                <tr>
                                    <td><?php echo $sn++; ?></td>
                                    <td><?php echo $title; ?></td>
                                    <td>
                                        <?php 
                                            // check whether image_name is available or not
                                            if($image_name !="")
                                            {
                                                // Display the image
                                                ?>
                                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" width="100px" >
                                                <?php

                                            }
                                            else
                                            {
                                                // Display the message
                                                echo "<div calss='error'>Image not added.</div>";
                                            }
                                        ?>
                                    </td>
                                    <td><?php echo $featured; ?></td>
                                    <td><?php echo $active; ?></td>
                                    <td>
                                        <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>" class="btn-secondary">Update Category</a>
                                        <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Category</a>
                                    </td>




                                <?php

                            }
                        }
                        else
                        {
                            // We do not have data
                            // We'll display the message inside table
                            ?>
                            <tr>
                                <td colspan="6"><div class="error">No Category Added.</div></td>
                            </tr>

                            <?php
                        }

                    ?>
                            
                            

                        
                        

                    
                    </table>
            </div>
        </div>


            
            
<?php include('partials/footer.php'); ?>

