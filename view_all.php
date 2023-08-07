<html>
<head>
  <title>CMS TFPx Deetabase</title>
  <link rel="StyleSheet" type="text/css" href="theme.css"/>
</head>
<body>

<script src="showHideElements.js"></script>

<h1 align="center">CMS TFPx Deetabase</h1>

<?php
  session_start();
  if ($_SESSION["username"] != "")
  {
    echo "Current User: ".$_SESSION["firstname"]." ".$_SESSION["lastname"]."<br/> \n";
    echo "Affiliation: ".$_SESSION["affiliation"]."<br/> \n";
    echo "Privilege: ".$_SESSION["privilege"]."<br/> \n";

    echo "<br/> \n";
    echo "<p> \n";
    echo "<h2> Dees Produced </h2> \n";
    echo "<table> \n";
    echo " <tr> \n";
    echo "  <th> ID </th> \n";
    echo "  <th> Operators </th> \n";
    echo "  <th> Manufactured On </th> \n";
    echo "  <th> Carbon Fiber Top </th> \n";
    echo "  <th> Carbon Fiber Bottom </th> \n";
    echo "  <th> Carbon Foam </th> \n";
    echo "  <th> Periphery </th> \n";
    echo "  <th> Modules Included </th> \n";
    echo "  <th> X-Ray Evaluation </th> \n";
    echo "  <th> CMM Evaluation </th> \n";
    echo " </tr> \n";

    $json = file_get_contents('./databaseURL.json');
    $json_data = json_decode($json,true);
    $cleardb_server = $json_data["Host"];
    $cleardb_username = $json_data["Username"];
    $cleardb_password = $json_data["Password"];
    $cleardb_db = $json_data["Database"];
    $connection = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);

    $sqlQuery = "SELECT id, operators, manufacture_datetime, carbon_fiber_top_serial_num, carbon_fiber_bottom_serial_num, 
    carbon_foam_serial_num, periphery_serial_num, modules_included, xray_evaluation, cmm_evaluation FROM dees";
    $queryResult = mysqli_query($connection, $sqlQuery);
    while ($map_output = mysqli_fetch_assoc($queryResult))
    {
      echo "<tr> \n";
    //   echo " <td> ".$map_output["id"]." ".$map_output["operators"]." </td> \n";
      echo " <td> ".$map_output["id"]." </td> \n";
      echo " <td> ".$map_output["operators"]." </td> \n";
      echo " <td> ".$map_output["manufacture_datetime"]." </td> \n";
      echo " <td> ".$map_output["carbon_fiber_top_serial_num"]." </td> \n";
      echo " <td> ".$map_output["carbon_fiber_bottom_serial_num"]." </td> \n";
      echo " <td> ".$map_output["carbon_foam_serial_num"]." </td> \n";
      echo " <td> ".$map_output["periphery_serial_num"]." </td> \n";
      echo " <td> ".$map_output["modules_included"]." </td> \n";
      echo " <td> ".$map_output["xray_evaluation"]." </td> \n";
      echo " <td> ".$map_output["cmm_evaluation"]." </td> \n";
      echo "</tr> \n";
    }
    mysqli_close($connection);

    echo "</table> \n";

      } else header("location: index.php");
?>


<br/><br/>
<a href="main.php">Back</a>
<br/>

<div class="footer"><i>Made by Raghav Sarangi (rs977@cornell.edu) with support from Souvik Das (souvik@purdue.edu)</i></div>

</body>
</html>