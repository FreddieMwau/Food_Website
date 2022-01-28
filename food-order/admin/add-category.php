<?php 
ini_set('error_reporting',E_ALL);
include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br><br>

        <?php
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>
        <br><br>

        <!-- Add category start here -->
        <!-- action is blank cause we are processing the form in the same page -->
        <form action="" method="POST" enctype="multipart/form-data">  <!-- Allows to upload photos -->
            <table class="tbl-30">  
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Category Title">
                    </td>
                </tr>

                <tr>
                    <td>Select image: </td>
                    <td>
                        <input type="file" name="pic">
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <!-- Add category end here -->

        <?php
            // check if submit button is clicked?
            if(isset($_POST['submit'])){
                // get the value from the form
                $title = $_POST['title'];

                // for radio button check whether the button is selected? to avoid errors
                if(isset($_POST['featured'])){
                    // get the value selected
                    $featured = $_POST['featured'];
                } else {
                   // set the default value
                   $featured = "No";
                }

                if(isset($_POST['active'])){
                    $active = $_POST['active'];
                } else {
                    $active = "No";
                }

                // check whether image is selected? and set value for image name accordingly
                //print_r displays the value of an array
                if(isset($_FILES['pic']['name'])){
                    // upload the image
                    // we need image name, source path and destination path
                    $image_name = $_FILES['pic']['name'];

                    if($image_name != ""){

                        // Auto rename our image
                        // get extension of our image (jpeg, jpg, png)
                        $ext = end(explode('.', $image_name));
                        $image_name = "Food_Category_".rand(000, 999).'.'.$ext;
                        
                        $source_path = $_FILES['pic']['tmp_name'];

                        $destination_path = "../images/category/".$image_name;

                        // finally upload image
                        if(move_uploaded_file($_FILES['pic']['tmp_name'], $destination_path))
                        {
                            echo "moved";
                        }else{
                            echo "failed";
                            $_SESSION['upload'] = "<div class='error text-center'>
                                                        <b>Failed to upload image.</b>
                                                    </div>";
                            header('location:'.HOMEURL.'admin/add-category.php');
                            // stop the process 
                            die();
                            //echo $_FILES['pic']['error'];
                        }

                    }

                    $upload = move_uploaded_file($_FILES['pic']['tmp_name'], $destination_path);

                } else {
                    // don't upload the image and set the image name value as blank
                    $image_name = "";
                }

                // sql query to insert data to db
                $sql = "INSERT INTO tbl_category SET 
                    title='$title',
                    image_name='$image_name',
                    featured='$featured',
                    active='$active'
                ";
                
                // execute query
                $res = mysqli_query($conn, $sql);

                // check whether query and data is inserted successfully??
                if($res == TRUE) {
                    // executed successfully
                    // set message and redirect
                    $_SESSION['add'] = "<div class='success'>
                                            <b>Category added successfully.</b>
                                        </div>";
                    header('location:'.HOMEURL.'admin/manage-category.php');
                } else {
                    // failed to execute
                    // set message and redirect
                    $_SESSION['add'] = "<div class='error'>
                                            <b>Failed to add category.</b>
                                        </div>";
                    header('location:'.HOMEURL.'admin/add-category.php');
                }
            }
        ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>