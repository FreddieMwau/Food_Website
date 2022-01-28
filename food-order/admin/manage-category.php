<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage categories</h1>
        <br/> <br/>

        <?php
        // set session messages
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }

            if(isset($_SESSION['delete'])){
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }

            if(isset($_SESSION['failed-remove'])){
                echo $_SESSION['failed-remove'];
                unset($_SESSION['failed-remove']);
            }

            if(isset($_SESSION['upload-err'])){
                echo $_SESSION['upload-err'];
                unset($_SESSION['upload-err']);
            }

            if(isset($_SESSION['no-category-found'])){
                echo $_SESSION['no-category-found'];
                unset($_SESSION['no-category-found']);
            }

            if(isset($_SESSION['photo-error'])){
                echo $_SESSION['photo-error'];
                unset($_SESSION['photo-error']);
            }
            
            if(isset($_SESSION['update-category'])){
                echo $_SESSION['update-category'];
                unset($_SESSION['update-category']);
            }
            
        ?>
        <br><br>

        <!-- Button to add admin -->
        <a href="<?php echo HOMEURL; ?>admin/add-category.php" class="btn-primary">Add categories</a>
        <br/> <br/> <br/> 

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
            // query to get all categories from db
                $sql = "SELECT * FROM tbl_category";

                // execute query
                $res = mysqli_query($conn, $sql);

                // count rows
                $count = mysqli_num_rows($res);

                // create serial Number variable and assign its value as 1
                $sn = 1;

                // check if db has values
                if($count > 0) {
                    // has data, get the data and display
                    while($row = mysqli_fetch_assoc($res)){
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        $featured = $row['featured'];
                        $active = $row['active'];

                        // display data in table
                        ?>
                            <tr>
                                <td>
                                    <?php echo $sn++;?>.
                                </td>
                                <td>
                                    <?php
                                        echo $title;
                                    ?>
                                </td>
                                <td>
                                    <?php
                                        // echo $image_name;
                                        // check whether image name is available?
                                        if($image_name != ""){
                                            // dispaly the image
                                            ?>
                                                <img src="<?php echo HOMEURL;?> images/category/<?php echo $image_name;?> " 
                                                    width = "70px">
                                            <?php
                                        } else {
                                            // display error message
                                            echo "<div class = 'error'>
                                                    <i>Image not added.</i>
                                                  </div>"
                                            ;
                                        }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                        echo $featured;
                                    ?>
                                </td>
                                <td>
                                    <?php
                                        echo $active;
                                    ?>
                                </td>
                                <td>
                                    <a href="<?php echo HOMEURL; ?>admin/update-category.php?id=<?php echo $id; ?>" 
                                        class="btn-secondary">Update Category</a>
                                    <a 
                                        href="<?php echo HOMEURL; ?>admin/delete-category.php?id=<?php echo $id;?>&image_name=<?php echo $image_name; ?>" 
                                        class="btn-danger">Delete Category
                                    </a> 
                                </td>
                            </tr>
                        <?php
                    }
                    
                } else {
                    // display the message inside the table
                    ?>
                        <tr>
                            <td colspan="6">
                                <div class="error">
                                    <b>No category added.</b>
                                </div>
                            </td>
                        </tr>
                    <?php
                }

            ?>

        </table>

    </div>

</div>

<?php include('partials/footer.php');?>