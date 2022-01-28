<?php 
    // include constants.php file
    include('../config/constants.php');
    
    // check whether the values are passed?
    if(isset($_GET['id']) &&  isset($_GET['image_name'])){
        // get the value and delete
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        // remove the physical image file if available?
        if($image_name != ""){
            // image is available & remove it
            $path = "../images/category/".$image_name;
            // remove the image $remove is of boolean
            $remove = unlink($path);

            if($remove == FALSE) {
                // if failed to remove image then add an error message and stop the process
                $_SESSION['photo-error'] = "<div class='error'>
                                                <b>Failed to remove category image.</b>
                                            </div>";
                header('location:'.HOMEURL.'admin/manage-category.php');
                die();
            }
        }

        // delete data from database
        // sql query delete data from database
        $sql = "DELETE FROM tbl_category WHERE id=$id";
        // execute query
        $res = mysqli_query($conn, $sql);

        // check whether data is delete?
        if($res == TRUE) {
            // set success message and redirect 
            $_SESSION['delete'] = "<div class='success'>
                                        <b>Category deleted successfully.</b>
                                   </div>";
            header('location:'.HOMEURL.'admin/manage-category.php');
        } else {
            // set failed message and redirect
            $_SESSION['delete'] = "<div class='error'>
                                        <b>Category not deleted successfully.</b>
                                   </div>";
            header('location:'.HOMEURL.'admin/manage-category.php');
        }
        // redirect to manage category page
    } else {
        // redirect to manage category
        header('location:'.HOMEURL.'admin/manage-category.php');
    }
?>