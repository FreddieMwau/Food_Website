<?php include('partials/menu.php');?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update category</h1>
        <br><br>

        <!-- get the values of selected id -->
        <?php
            // check whether id is set?
            if(isset($_GET['id'])){
                // get all other details
                $id = $_GET['id'];
                // sql query to get all other details
                $sql = "SELECT * FROM tbl_category WHERE id=$id";

                // execute query
                $res = mysqli_query($conn, $sql);
                // count the rows to check whether id is valid 
                $count = mysqli_num_rows($res);

                if($count == 1) {
                    // get data
                    $row = mysqli_fetch_assoc($res);
                    $title = $row['title'];
                    $current_image = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                } else {
                    // redirect
                    $_SESSION['no-category-found'] = "<div class='error'>
                                                        <b>Category not found.</b>
                                                    </div>";
                    header('location:'.HOMEURL.'admin/manage-category.php');
                }
            } else {
                // redirect
                header('location:'.HOMEURL.'admin/manage-category.php');
            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title;?>">
                    </td>
                </tr>

                <!-- diplay current image if available -->
                <tr>
                    <td>Current image: </td>
                    <td>
                        <?php
                            if($current_image != ""){
                                // display image
                                ?>
                                    <img src="<?php echo HOMEURL;?> images/category/<?php echo $current_image; ?>" width="100px">
                                <?php
                            } else {
                                // display message
                                echo "<div class='error'>
                                        <b>
                                            <i>Image not added</i>
                                        </b>
                                      </div>";
                            }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>New image: </td>
                    <td>
                        <input type="file" name="pics">
                    </td>
                </tr>

                <tr>
                    <td>Featured:</td>
                    <td>
                        <input 
                            <?php 
                                if($featured=="Yes")
                                    {echo "checked";} 
                            ?>
                            type="radio" name="featured" value="Yes"> Yes
                        <input
                            <?php 
                                if($featured=="No")
                                    {echo "checked";} 
                            ?>
                            type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active:</td>
                    <td>
                        <input 
                            <?php 
                                if($featured=="Yes")
                                    {echo "checked";} 
                            ?>
                            type="radio" name="active" value="Yes"> Yes
                        <input 
                            <?php 
                                if($featured=="No")
                                    {echo "checked";} 
                            ?>
                            type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php  echo $id; ?>">
                    <input type="submit" name="submit" value="Update category" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>
        <?php
            // check whether button is clicked?
            if(isset($_POST['submit'])){
                // get all the values from our form
                $id = $_POST['id'];
                $title = $_POST['title'];
                $current_image = $_POST['current_image'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];

                // updating new image
                // check if image is set?
                if(isset($_FILES['pics']['name'])){
                    // get the image details
                    $image_name = $_FILES['pics']['name'];
                    // check whether image is available or not
                    if($image_name != ""){
                        // image available
                        //a) upload new image
                         // Auto rename our image
                        // get extension of our image (jpeg, jpg, png)
                        $ext = end(explode('.', $image_name));
                        $image_name = "Food_Category_".rand(000, 999).'.'.$ext;
                        
                        $source_path = $_FILES['pics']['tmp_name'];

                        $destination_path = "../images/category/".$image_name;

                        $upload = move_uploaded_file($_FILES['pics']['tmp_name'], $destination_path);
                    
                        if($upload == FALSE) {
                            $_SESSION['upload'] = "<div class='error'>
                                                        <b>Failed to upload image.</b>
                                                    </div>";
                            header('location:'.HOMEURL.'admin/manage0-category.php');
                        }                        
                        
                        //b) remove current image if its available
                        if($current_image != ""){
                            $remove_path = "../images/category/".$current_image;
                            $remove = unlink($remove_path);

                            // check whether image is removed?
                            // if failed to remove display message and stop processs
                            if($remove == FALSE){
                                // failed to remove image
                                $_SESSION['failed-remove'] = "<div class='error text-center'>
                                                                <b>Failed to remove current image.</b>
                                                            </div>";
                                header('location:'.HOMEURL.'admin/manage-category.php');
                                die();
                            }
                        }

                    } else {
                        $image_name = $current_image;
                    }
                } else {
                    $image_name = $current_image;
                }
                // update to db
                $sql2 = "UPDATE tbl_category SET 
                    title=$title,
                    image_name=$image_name,
                    featured=$featured,
                    active=$active
                    WHERE id=$id
                ";
                // execute query
                $res2 = mysqli_query($conn, $sql2);

                // redirect to manage category with message
                // is query executed?
                if(res2==TRUE){
                    // category updated
                    $_SESSION['update-category'] = "<div class='success text-center'>
                                                        <b>Category updated successfully.</b>
                                                    </div>";
                    header('location:'.HOMEURL.'admin/manage-category.php');
                } else {
                    // failed to update category
                    $_SESSION['update-category'] = "<div class='error text-center'>
                                                        <b>Failed to update category.</b>
                                                    </div>";
                    header('location:'.HOMEURL.'admin/manage-category.php');
                }
            }
        ?>

    </div>
</div>
<?php include('partials/footer.php');?>