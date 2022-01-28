<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br/> <br/>

        <?php 
        // Checking whether the session is set or not
            if(isset($_SESSION['add'])){
                echo $_SESSION['add']; // Displaying session message if set
                unset($_SESSION['add']); // Removing session message
            }
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="full_name" placeholder="Enter your name..">
                    </td>
                </tr>

                <tr>
                    <td>User Name: </td>
                    <td>
                        <input type="text" name="user_name" placeholder="Your user name">
                    </td>
                </tr>

                <tr>
                    <td>Password: </td>
                    <td>
                        <input type="password" name="password" placeholder="Password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php include('partials/footer.php'); ?>

<?php 
    // Process the value from form and save in db
    // check whether the submit button is clicked or not
    if(isset($_POST['submit'])) {

        // Get data from form 
        $full_name = $_POST['full_name'];
        $user_name = $_POST['user_name'];
        $password = md5($_POST['password']);  //encrpts password with md5();

        // SQL Query to save data to db
        $sql = "INSERT INTO tbl_admin SET 
            full_name='$full_name',
            username='$user_name',
            password='$password'
        ";

        // Executing query and saving data into db
        $result = mysqli_query($conn, $sql) or die(mysqli_error());

        // Chech whether (Query is executed) data is inserted or not and display appropriate message
        if($result == TRUE) {
            // Session variable to display message
            $_SESSION['add'] = "<div class='success'>
                                    <b>Admin Added Successfully.</b>
                                </div>";
            // redirect page
            header("location:".HOMEURL.'admin/manage-admin.php');
        } else {
            // Session variable to display message
            $_SESSION['add'] = "<div class='error'>
                                    <b>Failed to add Admin.</b>
                                </div>";
            // redirect page
            header("location:".HOMEURL.'admin/add-admin.php');
        }

    } 
?>