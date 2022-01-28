<?php include('../config/constants.php'); ?>
<html>
    <head>
        <title>Login - Food Order System</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>
        <div class="login">
            <h1 class="text-center">Login</h1>
            <br><br>

            <?php
                if(isset($_SESSION['login'])){
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }

                if(isset($_SESSION['no-login-msg'])){
                    echo $_SESSION['no-login-msg'];
                    unset($_SESSION['no-login-msg']);
                }
            ?>

            <br><br>

            <!-- Login Form Starts Here -->
            <form action="" method="POST" class="text-center">
                Username: 
                <br>
                <input type="text" name="username" placeholder="Enter username">
                <br><br>
                Password: 
                <br>
                <input type="password" name="password" placeholder="Enter password">
                <br> <br>
                <input type="submit" name="submit" value="Log In" class="btn-primary">
                <br><br>
            </form>
            <!-- Login Form Ends Here -->

            <p class="text-center">Created By - Joking Genius</p>
        </div>
    </body>
</html>

<?php 
    // check whether submit btn works
    if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";


        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);

        if($count == 1){
            $_SESSION['login'] = "<div class='success text-center'>
                                    <b>Log in successful.</b>
                                </div>";
            $_SESSION['user'] = $username;  //to check whether the user is logged in? and logout will unset it.
            header('location:'.HOMEURL.'admin/');
        } else {
            $_SESSION['login'] = "<div class='error text-center'>
                                    <b>Username and password didn't match.</b>
                                  </div>";
            header('location:'.HOMEURL.'admin/login.php');
        }
    }
?>