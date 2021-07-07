<?php include('partials/menu.php'); ?>
<?php include('../config/constants.php'); ?>

    <!--Main content sections starts-->
    <div class="main-content">
    <div class="wrapper">
            <h1>Manage Admin</h1>

            <br/>
            

            <?php
                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add'];//Diplay Session message
                    unset($_SESSION['add']);//Removing session message
                }
                if(isset($_SESSION['delete']))
                {
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }
                if(isset($_SESSION['update']))
                {
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }
                if(isset($_SESSION['user-not-found']))
                {
                    echo $_SESSION['user-not-found'];
                    unset($_SESSION['user-not-found']);
                }
            ?>
            
            
            <br/><br/>

            <!--Button to add Admin-->
            <a href="add-admin.php" class="btn-primary">Add Admin</a>

            <br/><br/></br>
            <table class="tbl-full">
                <tr>
                    <th>S.N.</th>
                    <th>Full Name</th>
                    <th>Username</th>
                    <th>Actions</th>
                </tr>

                <?php 
                    // Quey to Get all Admin;
                    $sql = "SELECT * FROM tbl_admin";
                    // Execute the query
                    $res = mysqli_query($conn,$sql);

                    // Check whether the query is executed or not
                    if($res==True)
                    {
                        // count rows to check wheter we have data in database or not
                        $count = mysqli_num_rows($res);//Function to get all the rows in database

                        $sn =1; //create a variable and assign the value

                        // check the num of rows
                        if($count>0){
                            // we have data in database
                            while($rows=mysqli_fetch_assoc($res))
                            
                            {
                                // using while loop to get all the data from database
                                // while loop will run as long as we have data in database
                                // get indivudual data
                                $id = $rows['id'];
                                $full_name = $rows['full_name'];
                                $username = $rows['username'];

                                // display the values in our table
                                ?>
                                <tr>
                                    <td><?php echo $sn++; ?></td>
                                    <td><?php echo $full_name; ?></td>
                                    <td><?php echo $username; ?></td>
                                    <td>
                                        <a href='<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>' class="btn-primary">Change password</a>
                                        <a href='<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>' class="btn-secondary">Update Admin</a>
                                        <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a>
                                        

                                    </td>
                                </tr>
                                

                                <?php

                            }

                        }
                        else{
                            // we do not have data in database

                        }
                    }

                ?>

               
            </table>
    </div>
    </div>

<?php include('partials/footer.php'); ?>