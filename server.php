<?php
include "config.php";
$errors = array();

if(isset($_POST['create'])){

        $username = mysqli_real_escape_string($con, $_POST['username']);
        $password_1 = mysqli_real_escape_string($con, $_POST['password_1']);
        $password_2 = mysqli_real_escape_string($con, $_POST['password_2']);

        if (empty($username)) { array_push($errors, "Username is Required"); }
        if (empty($password_1)) { array_push($errors, "Password is Required"); }
        if ($password_1 != $password_2) {
                array_push($errors, "Passwords Do Not Match");
        }

        $user_check_query = "SELECT * FROM customer WHERE username='$username' LIMIT 1";
        $result = mysqli_query($con, $user_check_query);
        $user = mysqli_fetch_assoc($result);

        if ($user) {
                if ($user['username'] === $username) {
                        array_push($errors, "Username Already Exists");
                }
        }

          if (count($errors) == 0) {
                $password = md5($password_1);

                $query = "INSERT INTO customer (username, create_date, password)
                        VALUES('$username', CURRENT_TIMESTAMP, '$password')";
                mysqli_query($con, $query);
                $_SESSION['username'] = $username;
                $_SESSION['success'] = "You are now logged in";
                header('location: index.php');
        }
}

if(isset($_POST['chg_btn_final'])){

        $username_1 = mysqli_real_escape_string($con, $_POST['new_user']);
        $username_2 = mysqli_real_escape_string($con, $_POST['comf_user']);
        $current_username = $_SESSION['username'];

        if (empty($username_1)) { array_push($errors, "New Username is Required"); }
        if (empty($username_2)) { array_push($errors, "Username Confirmation is Required"); }
        if ($username_1 != $username_2) {
                array_push($errors, "Usernames Do Not Match");
                                            }

      if (count($errors) == 0) {

            $query = "UPDATE customer SET username = '$username_1' WHERE username = '$current_username'";
            mysqli_query($con, $query);

            session_unset();
            $_SESSION['username'] = $username_1;
            $_SESSION['success'] = "You have successfully changed your username";
            header("Refresh:0");
    }
}
?>