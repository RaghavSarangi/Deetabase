<?php

  session_start();

  if (isset($_POST["newLocation"]) && isset($_POST[sheetstring]))
  {
    $searchstring = $_POST["searchstring"];
    $searchLocation = $_POST["searchLocation"];
    $thicknessMean_lo = $_POST["thicknessMean_lo"];
    $thicknessMean_hi = $_POST["thicknessMean_hi"];
    $thicknessStdDev_lo = $_POST["thicknessStdDev_lo"];
    $thicknessStdDev_hi = $_POST["thicknessStdDev_hi"];
    $sheetstring = $_POST["sheetstring"];
    $newLocation = $_POST["newLocation"];
    $moverId = $_SESSION["userId"];
    $movingTime = date("Y-m-d H:i:s");

    $json = file_get_contents('./databaseURL.json');
    $json_data = json_decode($json,true);
    $cleardb_server = $json_data["Host"];
    $cleardb_username = $json_data["Username"];
    $cleardb_password = $json_data["Password"];
    $cleardb_db = $json_data["Database"];
    $connection = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);
    $sqlQuery = "UPDATE sheets SET location='".$newLocation."', moverId='".$moverId."', movingTime='".$movingTime."' WHERE sheetstring='".$sheetstring."'";
    if (mysqli_query($connection, $sqlQuery))
    {
      $_SESSION["searchstring"] = $searchstring;
      $_SESSION["location"] = $searchLocation;
      $_SESSION["thicknessMean_lo"] = $thicknessMean_lo;
      $_SESSION["thicknessMean_hi"] = $thicknessMean_hi;
      $_SESSION["thicknessStdDev_lo"] = $thicknessStdDev_lo;
      $_SESSION["thicknessStdDev_hi"] = $thicknessStdDev_hi;
      header("location: searchpart.php");
    }
  }

?>