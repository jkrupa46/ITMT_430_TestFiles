<?php
    session_start();
    $host = "127.0.0.1"; /* Host name */
    $user = "testuser"; /* User */
    $password = "bar"; /* Password */
    $dbname = "users"; /* Database name */

    $con = mysqli_connect($host, $user, $password,$dbname);
    // Check connection
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
?>