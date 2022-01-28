<?php include('partials/menu.php');?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
        <br/> <br/>

        <?php 
            // display details of current admin
            $id = $_GET['id'];
            // create sql query to get the details 
            $sql = "SELECT * FROM tbl_admin WHERE id=$id";
            // Execute query
            $res = mysqli_query($conn, $sql);
            // check whether query is executed?
            if($res == TRUE){
                // check whether the data is available?
                $count = mysqli_num_rows($res);
                // check whether there's admin data? (Secutiry checking)
                if($count == 1) {
                    // get details
                    $row = mysqli_fetch_assoc($res);
                    $fullname = $row['full_name'];
                    $username = $row['username'];
                } else {
                    // redirect to manage admin page
                    header('location:'.HOMEURL.'admin/manage-admin.php');
                }
            }
        ?>
        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $fullname ?>">
                    </td>
                </tr>

                <tr>
                    <td>User Name: </td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username ?>">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>
    </div>
</div>

<?php 
    // check if submit button is clicked?
    if(isset($_POST['submit'])){
        // get all the values from form
        $id = $_POST['id'];
        $fullname = $_POST['full_name'];
        $username = $_POST['username'];

        // sql query to update admin
        $sql = "UPDATE tbl_admin SET 
        full_name='$fullname',
        username='$username'
        WHERE id=$id";

        // execute query
        $res = mysqli_query($conn, $sql);

        // check whether the query is executed?
        if($res == TRUE) {
            // Query executed and admin updated and redirect
            $_SESSION['update'] = "<div class='success'>
                                        <b>Admin Updated Successfully.</b>
                                   </div>";
            header('location:'.HOMEURL.'admin/manage-admin.php');
        } else {
            // Failed to update admin and redirect
            $_SESSION['update'] = "<div class='error'>
                                        <b>Failed to Update Admin.</b>
                                   </div>";
            header('location:'.HOMEURL.'admin/manage-admin.php');
        }
    }
?>

<?php include('partials/footer.php'); ?>