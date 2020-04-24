<?php
include "../server.php";
include "../fetch.php";

if (!isset($_SESSION['username'])) {
  header('location: ../index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>User Page - Map</title>
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/admin.css">
    <link rel="stylesheet" type="text/css" href="../css/map.css">
    <script src='https://api.mapbox.com/mapbox-gl-js/v1.7.0/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v1.7.0/mapbox-gl.css' rel='stylesheet'/>
    <link href="https://fonts.googleapis.com/css?family=Montserrat|Roboto&display=swap" rel="stylesheet">
  </head>
  <body>
    <header>
      <div id=icon>
      </div>
      <nav class="nav">
        <ul>
          <li><a class="active" href="map.php">Map</a></li>
          <li><a href="notifications.php">Notifications</a></li>
          <li><a href="settings.php">Settings</a></li>
        </ul>
      </nav>
      <nav class="nav" id="user_acc"><li><ul><a href="account.php"><?php echo $_SESSION['username']; ?></a></ul></li></nav>
      <nav class="nav" id="logout"><li><ul><a href="../logout.php">Logout</a></ul></li></nav>
    </header>
    <main>
    <div id="map">
      <script src="../javascript/map.js"></script>
    </div>
    <script src="../javascript/test.js"></script>
    <table id="conditions">
      <thead>
        <tr>
          <th>Beacon ID</th>
          <th>Temperature</th>
          <th>Acceleration</th>
          <th>Latitude</th>
          <th>Longitude</th>
        </tr>
        <tr>
          <td><?php getbeaconids($json_blue);?></td>
          <td><?php math_on_meth($json_blue);?></td>
          <td><?php find_latest_gps_data($json_blue);?></td>
        </tr>
        <tr>
          <td><?php getbeaconids($json_green);?></td>
          <td><?php math_on_meth($json_green);?></td>
          <td><?php find_latest_gps_data($json_green);?></td>
        </tr>
      </thead>
    </table>
    <input class="button" type="button" value=" Add " onclick="update_conditions()">
    </main>
    <footer>
      <p><a href="mailto:akukuc@hawk.iit.edu">Email: akukuc@hawk.iit.edu</a></p>
      <p><a href="https://github.com/">Team4-2020r</a></p>
    </footer>
  </body>
</html>
