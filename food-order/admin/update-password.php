<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">

        <h1>Change Password.</h1>
        <br/> <br/>

        <?php 
            if(isset($_GET['id'])){
                $id = $_GET['id'];
            }
        ?>

        <form action="" method="POST">
            <table class="tbl-30">

                <tr>
                    <td>Current Password: </td>
                    <td>
                        <input type="password" name="current_password" placeholder="Current Password">
                    </td>
                </tr>

                <tr>
                    <td>New Password: </td>
                    <td>
                        <input type="password" name="new_password" placeholder="New Password">
                    </td>
                </tr>

                <tr>
                    <td>Confirm Password: </td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Confirm Password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php 
    // Check if submit button is clicked?
    if(isset($_POST['submit'])){
        // Get data from form
        $id = $_POST['id'];
        $current_password = md5($_POST['current_password']);
        $new_password = md5($_POST['new_password']);
        $confirm_password = md5($_POST['confirm_password']);

        // Check whether the user with current id and current password exists?
        $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";

        // execute query
        $res = mysqli_query($conn, $sql);
        if($res == TRUE){
            // check if theres data available?
            $count = mysqli_num_rows($res);
            if($count == 1){
                // user exists and password can be changed.
                // Check whether the current new password and confirm password match?
                if($new_password == $confirm_password){
                    // update password
                    // sql query
                    $sql2 = "UPDATE tbl_admin SET
                            password='$new_password' 
                            WHERE id=$id";
                    // execute query
                    $res2 = mysqli_query($conn, $sql2);
                    if($res2 == TRUE){
                        // Update password if all above is true
                         // display message and redirect
                        $_SESSION['change-password'] = "<div class='success'>
                                                            <b>Password changed successfully!!</b>
                                                        </div>";
                        header('location:'.HOMEURL.'admin/manage-admin.php'); 
                    } else {
                         // display message and redirect
                        $_SESSION['change-password'] = "<div class='error'>
                                                            <b>Failed to change password!!</b>
                                                        </div>";
                        header('location:'.HOMEURL.'admin/manage-admin.php'); 
                    }
                } else {
                    // display message and redirect
                    $_SESSION['pwd-not-match'] = "<div class='error'>
                                                    <b>Password did not match !!</b>
                                                  </div>";
                    header('location:'.HOMEURL.'admin/manage-admin.php'); 
                }
                
            } else {
                // user doesn't exist, set message and redirect
                $_SESSION['user-not-found'] = "<div class='error'>
                                                    <b>User not found !!</b>
                                               </div>";
                header('location:'.HOMEURL.'admin/manage-admin.php'); 
            }
        }

        
    }
?>


<?php include('partials/footer.php'); ?>