<?php
include "config.php";

if(isset($_POST['login'])){

    $uname = mysqli_real_escape_string($con,$_POST['username']);
    $password = mysqli_real_escape_string($con,$_POST['password']);
    $password = md5($password);

    if ($uname == "admin" && $password != ""){

        $sql_query = "select count(*) as cntUser from customer where username='".$uname."' and password='".$password."'";
        $result = mysqli_query($con,$sql_query);
        $row = mysqli_fetch_array($result);

        $count = $row['cntUser'];

        if($count > 0){
            $_SESSION['username'] = $uname;
            header('Location: pages_admin/map.php');
        }else{
          $error = "Your Username or Password is Invalid";
        }

    }
    elseif ($uname != "" && $password != ""){

            $sql_query = "select count(*) as cntUser from customer where username='".$uname."' and password='".$password."'";
            $result = mysqli_query($con,$sql_query);
            $row = mysqli_fetch_array($result);

            $count = $row['cntUser'];

            if($count > 0){
                    $_SESSION['username'] = $uname;
                    header('Location: pages_user/map.php');
            }else{
              $error = "Your Username or Password is Invalid";
            }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat|Roboto&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/100/three.min.js"></script>
    <script src="https://www.vantajs.com/dist/vanta.net.min.js"></script>
  </head>
  <body id="vantajs">
    <script src="javascript/script.js" async></script>
      <div class="container">
        <form action="" method="POST">
          <label for="username">Username</label>
          <input type="text" id="username" name="username">
          <label for="password">Password</label>
          <input type="password" id="password" name="password">
          <div id="lower">
            <input type="checkbox"><label class="check" for="checkbox">Keep me logged in</label>
            <input type="submit" id="login" name="login" value="Login">
          </div>
          <div id="lowest">
            <a id="signup" href="register.php">Create an Account</a>
          </div>
        </form>
        <div class="log_err"><?php echo $error; ?></div>
      </div>
      <footer>
        <p><a href="mailto:akukuc@hawk.iit.edu">Email: akukuc@hawk.iit.edu</a></p>
        <p><a href="https://github.com/">Team4-2020r</a></p>
    </footer>
  </body>
</html>
