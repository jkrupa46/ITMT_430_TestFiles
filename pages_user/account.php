<?php
include "../server.php";

if (!isset($_SESSION['username'])) {
  header('location: ../index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>User Page - Settings</title>
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/admin.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat|Roboto&display=swap" rel="stylesheet">
  </head>
  <body>
    <header>
      <nav class="nav">
          <ul>
            <li><a href="map.php">Map</a></li>
            <li><a href="notifications.php">Notifications</a></li>
            <li><a href="settings.php">Settings</a></li>
          </ul>
      </nav>
      <nav class="nav" id="user_acc"><li><ul><a class="active" href="account.php"><?php echo $_SESSION['username']; ?></a></ul></li></nav>
      <nav class="nav" id="logout"><li><ul><a href="../logout.php">Logout</a></ul></li></nav>
    </header>
    <main>
      <nav class="profile">
        <a href="account.php">Account</a>
        <a href="">Security</a>
      </nav>
      <div class="subheader">
        <h2>Change Username</h2>
      </div>
      <button class="chg_btn" id="myBtn" onclick="pop_up()">Change Username</button>
      <div id="myModal" class="modal">
        <form action="" method="POST" class="modal-content">
          <span class="close">&times;</span>
          <label for="cur_user">New Username</label>
          <input type="text" name="new_user" required>

          <label for="new_user">Confirm Username</label>
          <input type="text" name="comf_user" required>
          
          <button type="submit" id="chg_btn_final" name="chg_btn_final">Change Username</button>
        </form>
      </div>
    </main>
    <footer>
        <p><a href="mailto:akukuc@hawk.iit.edu">Email: akukuc@hawk.iit.edu</a></p>
        <p><a href="https://github.com/">Team4-2020r</a></p>
        <script src="../javascript/script.js"></script>
    </footer>
    <script>
          // Get the modal
      var modal = document.getElementById("myModal");

      // Get the button that opens the modal
      var btn = document.getElementById("myBtn");

      // Get the <span> element that closes the modal
      var span = document.getElementsByClassName("close")[0];

      // When the user clicks the button, open the modal 
      btn.onclick = function() {
        modal.style.display = "block";
      }

      // When the user clicks on <span> (x), close the modal
      span.onclick = function() {
        modal.style.display = "none";
      }

      // When the user clicks anywhere outside of the modal, close it
      window.onclick = function(event) {
        if (event.target == modal) {
          modal.style.display = "none";
        }
      }
    </script>
  </body>
</html>