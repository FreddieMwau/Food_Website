<?php 

    // Start Session
    session_start();

    define('LOCALHOST', 'localhost');
    define('DB_USERNAME', 'fred');
    define('DB_PASSWORD', '123456');
    define('DB_NAME', 'food-order');
    define('HOMEURL', 'http://localhost/food-order/');

    // execute query and save data in db
    // msqli_query posts the data and die will stop the process if there's an error and mysqli_error will display the error

    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error()); // database connection
    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());  //selecting database
?>