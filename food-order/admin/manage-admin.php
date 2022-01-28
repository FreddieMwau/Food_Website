<?php include('partials/menu.php');?>

        <!-- Main Content section start -->
        <div class="main-content">
            <div class="wrapper">
                <h1>Manage Admin</h1>
                <br/> <br/>

                <?php 
                // success and error messages
                    if(isset($_SESSION['add'])) {
                        echo $_SESSION['add'];  //Displaying session message
                        unset($_SESSION['add']); //Removing session message
                    }
                    if(isset($_SESSION['delete'])){
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    }
                    if(isset($_SESSION['update'])){
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }
                    if(isset($_SESSION['user-not-found'])){
                        echo $_SESSION['user-not-found'];
                        unset($_SESSION['user-not-found']);
                    }
                    if(isset($_SESSION['pwd-not-match'])){
                        echo $_SESSION['pwd-not-match'];
                        unset($_SESSION['pwd-not-match']);
                    }
                    if(isset($_SESSION['change-password'])){
                        echo $_SESSION['change-password'];
                        unset($_SESSION['change-password']);
                    }
                ?>
                <br/><br/>

                <!-- Button to add admin -->
                <a href="add-admin.php" class="btn-primary">Add Admin</a>
                <br/> <br/> <br/> 

                <table class="tbl-full">
                    <tr>
                        <th>S.N.</th>
                        <th>Full Name</th>
                        <th>User Name</th>
                        <th>Actions</th>
                    </tr>

                    <!-- Populating data from db to table -->
                    <?php 
                    // Query to GET all Admin
                        $sql = "SELECT * FROM tbl_admin";
                        // Execute the Query
                        $res = mysqli_query($conn, $sql);
                        // Chech whether the query is executed?

                        if($res == TRUE){
                            // Count rows to check whether there's data in db
                            $count = mysqli_num_rows($res);  // gets the ni of rows in db


                            $sn = 1;   // variable for number of rows in table
                            if($count > 0){
                                // data is present
                                while($rows = mysqli_fetch_assoc($res)) {  //gets all the rows in the db and store is $rows 
                                    // using while loop to get all the data from db 
                                    // get individual data
                                    $id = $rows['id'];
                                    $full_name = $rows['full_name'];
                                    $username = $rows['username'];

                                    // display the values in our table
                                    ?>

                                        <tr>
                                            <td><?php echo $sn++ ?>.</td>
                                            <td><?php echo $full_name ?></td>
                                            <td><?php echo $username ?></td>
                                            <td>
                                                <a href="<?php echo HOMEURL; ?>admin/update-password.php?id=<?php echo $id?>" class="btn-primary">Change password</a>
                                                <a href="<?php echo HOMEURL; ?>admin/update-admin.php?id=<?php echo $id?>" class="btn-secondary">Update</a>
                                                <a href="<?php echo HOMEURL; ?>admin/delete-admin.php?id=<?php echo $id?>" class="btn-danger">Delete</a> 
                                            </td>
                                        </tr>

                                    <?php
                                }
                            } else {

                            }
                        }
                    ?>
            
                </table>

            </div>

        </div>
        <!-- Main Content section ends -->

<?php include('partials/footer.php'); ?>