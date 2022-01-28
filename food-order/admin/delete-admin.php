<?php 
    // include constants.php file
    include('../config/constants.php');
    // get the id of admin to be deleted
    $id = $_GET['id'];
    // create sql query to delete admin
    $sql = "DELETE FROM tbl_admin WHERE id=$id";
    // execute the query
    $res = mysqli_query($conn, $sql);
    // check whether the query executed successfully?
    if($res == TRUE) {
        // Query executed successfully and admin deleted
        // create session to display message
        $_SESSION['delete'] = "<div class='success'>
                                    <b>Admin Deleted Successfully.</b>
                               </div>";
        header('location:'.HOMEURL.'admin/manage-admin.php');
    } else {
        // failed to delete admin
        $_SESSION['delete'] = "<div class='error'>
                                    <b>Admin failed to be deleted.</b>
                               </div>";
        header('location:'.HOMEURL.'admin/manage-admin.php');
    }
    // redirect to manage admin page with message (success/error)

?>