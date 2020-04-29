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
    <title>Administrative Page - Notifications</title>
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
            <li><a class="active" href="notifications.php">Notifications</a></li>
            <li><a href="settings.php">Settings</a></li>
            <li><a href="beacons.php">Beacons</a></li>
          </ul>
      </nav>
      <nav class="nav" id="user_acc"><li><ul><a href="account.php"><?php echo $_SESSION['username']; ?></a></ul></li></nav>
      <nav class="nav" id="logout"><li><ul><a href="../logout.php">Logout</a></ul></li></nav>
    </header>
    <main>
      <form>
        <table id="notifications">
          <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Notification Type</th>
            <th>Enable</th>
          </tr>
          <tr>
            <td><input type="text" id="firstname" name="firstname"></td>
            <td><input type="text" id="lastname" name="lastname"></td>
            <td><input type="email" id="email" name="email"></td>
            <td><input type="tel" id="phonenumber" name="phonenumber"></td>
            <td>
              <label class="container">Email
                <input type="checkbox" aria-label="Toggle Email Notification">
                <span class="checkmark"></span>
              </label>
              <label class="container">SMS
                <input type="checkbox" aria-label="Toggle SMS Notification">
                <span class="checkmark"></span>
              </label>
            </td>
            <td>
              <label class="switch">
                <input type="checkbox">
                <span class="slider round"></span>
              </label>
            </td>
          </tr>
        </table>
      </form>
      <button class="button" type="button" value=" Add " onclick="add_user()">Add New User</button>
    </main>
    <footer>
      <p><a href="mailto:akukuc@hawk.iit.edu">Email: akukuc@hawk.iit.edu</a></p>
      <p><a href="https://github.com/">Team4-2020r</a></p>
      <script src="../javascript/script.js"></script>
    </footer>
  </body>
</html>
