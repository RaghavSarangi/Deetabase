<html>
<head>
  <title>CMS TFPx Deetabase</title>
  <link rel="StyleSheet" type="text/css" href="theme.css"/>
</head>
<body>


<?php
$id = $_GET['id'];

$json = file_get_contents('./databaseURL.json');
$json_data = json_decode($json,true);
$cleardb_server = $json_data["Host"];
$cleardb_username = $json_data["Username"];
$cleardb_password = $json_data["Password"];
$cleardb_db = $json_data["Database"];
$connection = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);



$Query="select * from dees where id=$id";
    $result=mysqli_query($connection, $Query);
    if(!$result)
    {
        echo mysqli_error($connection);
        die();
    }
else
{
    echo "<table> \n";
    echo " <tr> \n";
    echo "  <th> ID </th> \n";
    echo "  <th> Operators </th> \n";
    echo "  <th> Manufactured On </th> \n";
    echo "  <th> Carbon Fiber Top</th> \n";
    echo "  <th> Carbon Fiber Bottom</th> \n";
    echo "  <th> Carbon Foam</th> \n";
    echo "  <th> Periphery</th> \n";
    echo "  <th> Modules Included </th> \n";
    echo "  <th> X-Ray Evaluation </th> \n";
    echo "  <th> CMM Evaluation </th> \n";
    echo " </tr> \n";
    $map_output = mysqli_fetch_assoc($result);

    $id = $map_output['id']; 
    $operators = $map_output["operators"];
    $datetime = $map_output["manufacture_datetime"];
    $carbon_fiber_top_serial_num = $map_output["carbon_fiber_top_serial_num"];
    $carbon_fiber_bottom_serial_num = $map_output["carbon_fiber_bottom_serial_num"];
    $carbon_foam_serial_num = $map_output["carbon_foam_serial_num"];
    $periphery_serial_num = $map_output["periphery_serial_num"];
    $modules_included = $map_output["modules_included"];
    $xray_evaluation = $map_output["xray_evaluation"];
    $cmm_evaluation = $map_output["cmm_evaluation"];

    echo "<tr id=$id> \n";
    echo " <td> ".$id." </td> \n";
    echo " <td> ".$operators." </td> \n";
    echo " <td> ".$datetime." </td> \n";
    echo " <td> ".$carbon_fiber_top_serial_num." </td> \n";
    echo " <td> ".$carbon_fiber_bottom_serial_num." </td> \n";
    echo " <td> ".$carbon_foam_serial_num." </td> \n";
    echo " <td> ".$periphery_serial_num." </td> \n";
    echo " <td> ".$modules_included." </td> \n";
    echo " <td> ".$xray_evaluation." </td> \n";
    echo " <td> ".$cmm_evaluation." </td> \n";
    echo " <td > \n";
    echo "</table> \n";
} 

?>
<div class="footer"><i>Made by Raghav Sarangi (rs977@cornell.edu) with support from Souvik Das (souvik@purdue.edu)</i></div>

</body>
</html>