<?php include('server.php') ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Account Creation</title>
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat|Roboto&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/100/three.min.js"></script>
    <script src="https://www.vantajs.com/dist/vanta.net.min.js"></script>
  </head>
  <body id="vantajs">
    <script src="javascript/script.js"></script>
      <div class="container" id="create_cont">
        <form id="signup" action="" method="POST">
          <label for="username">Username</label>
          <input type="text" id="username" name="username">
          <label for="password"> Password</label>
          <input type="password" id="password_1" name="password_1">
          <label for="password">Confirm Password</label>
          <input type="password" id="password_2" name="password_2">
          <div id="lower">
            <input id="create" name="create" type="submit" value="Create Account">
          </div>
          <div class="log_err"><?php include('errors.php'); ?></div>
        </form>
      </div>
      <footer>
        <p><a href="mailto:akukuc@hawk.iit.edu">Email: akukuc@hawk.iit.edu</a></p>
        <p><a href="https://github.com/">Team4-2020r</a></p>
    </footer>
  </body>
</html>
