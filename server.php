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

if(isset($_POST['chg_btn_pass'])){

        $pass_1 = mysqli_real_escape_string($con, $_POST['new_pass']);
        $pass_2 = mysqli_real_escape_string($con, $_POST['comf_pass']);
        $current_username = $_SESSION['username'];

        if (empty($pass_1)) { array_push($errors, "New Password is Required"); }
        if (empty($pass_2)) { array_push($errors, "Password Confirmation is Required"); }
        if ($pass_1 != $pass_2) {
                array_push($errors, "Passwords Do Not Match");
                                            }

      if (count($errors) == 0) {
        $pass_md5 = md5($pass_1);
            $query = "UPDATE customer SET password = '$pass_md5' WHERE username = '$current_username'";
            mysqli_query($con, $query);

            $_SESSION['success'] = "You have successfully changed your password";
            header("Refresh:0");
    }
}

if(isset($_POST['chg_btn_name'])){

        $fname = mysqli_real_escape_string($con, $_POST['new_fname']);
        $lname = mysqli_real_escape_string($con, $_POST['new_lname']);
        $current_username = $_SESSION['username'];

        if (empty($fname)) { array_push($errors, "First Name is Required"); }
        if (empty($lname)) { array_push($errors, "Last Name is Required"); }
                                            

      if (count($errors) == 0) {
            $query = "UPDATE customer SET first_name = '$fname', last_name = '$lname' WHERE username = '$current_username'";
            mysqli_query($con, $query);

            $_SESSION['success'] = "You have successfully changed your first and last name";
            header("Refresh:0");
    }
}

if(isset($_POST['chg_btn_phone'])){

        $phone_1 = mysqli_real_escape_string($con, $_POST['new_phone']);
        $phone_2 = mysqli_real_escape_string($con, $_POST['comf_phone']);
        $current_username = $_SESSION['username'];

        if (empty($phone_1)) { array_push($errors, "New Phone Number is Required"); }
        if (empty($phone_2)) { array_push($errors, "Phone Number Confirmation is Required"); }
        if ($pass_1 != $pass_2) {
                array_push($errors, "Phone Numbers Do Not Match");
                                            }

      if (count($errors) == 0) {
            $query = "UPDATE customer SET phone = '$phone_1' WHERE username = '$current_username'";
            mysqli_query($con, $query);

            $_SESSION['success'] = "You have successfully changed your phone number";
            header("Refresh:0");
    }
}

if(isset($_POST['sqldump'])){

        $uname1 = mysqli_real_escape_string($con,$_POST['current_us']);
        $password_1 = mysqli_real_escape_string($con,$_POST['current_pass']);
        $password_1 = md5($password_1);
        
        if ($uname1 != "" && $password_1 != ""){
                $sql_query = "select count(*) as cntUser from customer where username='".$uname1."' and password='".$password_1."'";
                $result = mysqli_query($con,$sql_query);
                $row = mysqli_fetch_array($result);
                $count = $row['cntUser'];
                
                if($count > 0){
                        $filename = "backup-" . date("d-m-Y") . ".sql.gz";
                        $mime = "application/x-gzip";
                        
                        header( "Content-Type: " . $mime );
                        header( 'Content-Disposition: attachment; filename="' . $filename . '"' );
                        $dump = "mysqldump -u $user --password=$password $dbname | gzip --best";   
                        
                        passthru($dump);
                }
                else{
                        array_push($errors, "Username or Password is Incorrect");
                }
        }
}
?>