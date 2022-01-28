<?php 

    // Authorization - Access control
    // check if the user is logged in?
    if(!isset($_SESSION['user'])){  //if user session is not set
        // user is not logged in - redirect to login with message
        $_SESSION['no-login-msg'] = "<div class='error text-center'>
                                        <b>Please log in to access Admin Panel</b>
                                    </div>";
        header('location:'.HOMEURL.'admin/login.php');
    }

?>