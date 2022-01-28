<?php 
    include('../config/constants.php');
    // query to delete all the sessions and redirect to login page
    session_destroy(); //Unsets $_SESSION['user']
    header('location:'.HOMEURL.'admin/login.php');
?>