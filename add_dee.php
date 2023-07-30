<html>
<head>
  <title>CMS TFPx Deetabase</title>
  <link rel="StyleSheet" type="text/css" href="theme.css"/>
</head>
<body>

<h1 align="center"> CMS TFPx Deetabase </h1>

<?php
  session_start();
  if ($_SESSION["username"] != "")
  {
    echo "Current User: ".$_SESSION["firstname"]." ".$_SESSION["lastname"]."<br/> \n";
    echo "Affiliation: ".$_SESSION["affiliation"]."<br/> \n";
    echo "Privilege: ".$_SESSION["privilege"]."<br/> \n";

    echo "<br/> \n";
    echo "<p> \n";
    if ($_SESSION["privilege"] == "Editor" || $_SESSION["privilege"] == "Administrator")
    {
      echo " <h3 align='center'> This form allows you to add details of any produced Dees. </h3> \n";
      echo "<form action='add_dee.php' method='post' enctype='multipart/form-data'> \n";
      echo " <b>Operators</b><br/>        <textarea name='operators' rows='1' cols='60'></textarea> <br/><br/> \n ";
      echo " <b>Date & Time of Manufacture</b><br/> <input type='datetime-local' name='manufacture_datetime'>";
      echo "<br/> \n";
      echo "<br/> \n";
      echo "<fieldset>";
      echo "<legend>Components</legend>";
      echo " <b>Carbon Fiber Top Serial #</b><br/>        <input type='text' name='carbon_fiber_top_serial_num'> <br/><br/> \n";
      echo " <b>Carbon Fiber Bottom Serial #</b><br/>        <input type='text' name='carbon_fiber_bottom_serial_num'> <br/><br/> \n";
      echo " <b>Carbon Foam Serial #</b><br/>        <input type='text' name='carbon_foam_serial_num'> <br/><br/> \n";
      echo " <b>Periphery Serial #</b><br/>        <input type='text' name='periphery_serial_num'> <br/><br/> \n";
      echo " <b>IDs of Modules Included</b><br/>        <textarea name='modules_included' rows='2' cols='60'></textarea> <br/><br/> \n"; 
      echo "</fieldset>";
      echo "<br/> \n";
      echo "<br/> \n";
      echo "<b>X-Ray Evaluation</b><br/> <textarea name='xray_evaluation' rows='5' cols='60'></textarea>";
      echo "<br/> \n";
      echo "<br/> \n";
      echo " <input type='submit' value='Upload Data' name='submit'> \n";
      echo "</form>";
    }
    else echo "<b>WARNING</b>: You are not an Editor and therefore do not have the privilege level needed to add sheets. Please contact database management if you think this is an error.<br/> \n";
    echo "</p> \n";

  }
?>

<?php

  if (isset($_POST["submit"]))
  {
    $operators = $_POST['operators'];
    $manufacture_datetime = $_POST['manufacture_datetime'];
    $carbon_fiber_top_serial_num = $_POST['carbon_fiber_top_serial_num'];
    $carbon_fiber_bottom_serial_num = $_POST['carbon_fiber_bottom_serial_num'];
    $carbon_foam_serial_num = $_POST['carbon_foam_serial_num'];
    $periphery_serial_num = $_POST['periphery_serial_num'];
    $modules_included = $_POST['modules_included'];
    $xray_evaluation = $_POST['xray_evaluation'];

    $json = file_get_contents('./databaseURL.json');
    $json_data = json_decode($json,true);
    $cleardb_server = $json_data["Host"];
    $cleardb_username = $json_data["Username"];
    $cleardb_password = $json_data["Password"];
    $cleardb_db = $json_data["Database"];
    $connection = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);

                $userId = $_SESSION["userId"];
                // $dateTime = date("Y-m-d H:i:s");
                $sqlQuery = "INSERT INTO dees (operators, carbon_fiber_top_serial_num, carbon_fiber_bottom_serial_num, 
                carbon_foam_serial_num, periphery_serial_num, manufacture_datetime, modules_included, xray_evaluation)
                             VALUES ('".$operators."',
                                     '".$carbon_fiber_top_serial_num."',
                                     '".$carbon_fiber_bottom_serial_num."',
                                     '".$carbon_foam_serial_num."',
                                     '".$periphery_serial_num."',
                                     '".date('Y-m-d H:i:s', strtotime($manufacture_datetime))."',
                                     '".$modules_included."',
                                     '".$xray_evaluation."')";
                $output = mysqli_query($connection, $sqlQuery);
                // printf("Affected rows (INSERT): %d\n", $connection->affected_rows);
                echo "<b>LOG</b>: Database entry created.<br/> \n";
            }

?>

<br/>
<a href="main.php">Back</a>
<br/>

<p align="right">
Author: Raghav Sarangi <br/>
Cornell University, 2023 <br/>
rs977@cornell.edu
</p>

</body>
</html>