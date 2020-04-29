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
    <title>Administrative Page - Settings</title>
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
            <li><a class="active" href="settings.php">Settings</a></li>
            <li><a href="beacons.php">Beacons</a></li>
          </ul>
      </nav>
      <nav class="nav" id="user_acc"><li><ul><a href="account.php"><?php echo $_SESSION['username']; ?></a></ul></li></nav>
      <nav class="nav" id="logout"><li><ul><a href="../logout.php">Logout</a></ul></li></nav>
    </header>
    <main>
      <form>
        <table id="settings">
          <tr>
            <th>Truck</th>
            <th>Data</th>
            <th>Constraints</th>
            <th>Value</th>
          </tr>
          <tr>
            <td>
              <div class="select-style">
                <select>
                  <option value="1">Truck 1</option>
                  <option value="2">Truck 2</option>
                  <option value="3">Truck 3</option>
                  <option value="4">Truck 4</option>
                  <option value="5">Truck 5</option>
                </select>
              </div>
            </td>
            <td>
              <div class="select-style">
                <select>
                  <option value="1">Data 1</option>
                  <option value="2">Data 2</option>
                  <option value="3">Data 3</option>
                  <option value="4">Data 4</option>
                  <option value="5">Data 5</option>
                </select>
              </div>
            </td>
            <td>
              <div class="select-style">
                <select>
                  <option value="1">Constraint 1</option>
                  <option value="2">Constraint 2</option>
                  <option value="3">Constraint 3</option>
                  <option value="4">Constraint 4</option>
                  <option value="5">Constraint 5</option>
                </select>
              </div>
            </td>
            <td><input type="number" id="value" name="value"></td>
          </tr>
        </table>
      </form>
      <button class="button" type="button" value=" Add " onclick="add_rule()">Add New Rule</button>
    </main>
    <footer>
        <p><a href="mailto:akukuc@hawk.iit.edu">Email: akukuc@hawk.iit.edu</a></p>
        <p><a href="https://github.com/">Team4-2020r</a></p>
        <script src="../javascript/script.js"></script>
    </footer>
  </body>
</html>
