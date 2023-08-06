<html>
<head>
  <title>CMS TFPx Deetabase</title>
  <link rel="StyleSheet" type="text/css" href="theme.css"/>
</head>
<body>


<?php


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


    echo " <h1 align='center'> Dee #$id </h1> \n";
    echo '<div class="row">';
    echo '<div class="column left">';
    echo " <b>Operators</b><br/>        <textarea readonly name='operators' rows='1' cols='60'>$operators</textarea> <br/><br/> \n ";
    echo "</div>";
    echo '<div class="column right">';
    echo " <b>Date & Time of Manufacture</b><br/> <input readonly type='datetime-local' name='manufacture_datetime' value='$datetime'>";
    echo "</div>";
    echo "</div>";
    echo "<fieldset>";
    echo "<legend><i>Components</i></legend>";
    echo '<div class="row">';
    echo '<div class="column left">';
    echo " <b>Carbon Fiber Top Serial #</b><br/>        <input readonly type='text' name='carbon_fiber_top_serial_num' value='$carbon_fiber_top_serial_num'> <br/><br/> \n";
    echo " <b>Carbon Fiber Bottom Serial #</b><br/>        <input readonly type='text' name='carbon_fiber_bottom_serial_num' value='$carbon_fiber_bottom_serial_num'> <br/><br/> \n";
    echo " <b>Carbon Foam Serial #</b><br/>        <input readonly type='text' name='carbon_foam_serial_num' value='$carbon_foam_serial_num'> <br/><br/> \n";
    echo " <b>Periphery Serial #</b><br/>        <input readonly type='text' name='periphery_serial_num' value='$periphery_serial_num'> <br/><br/> \n";
    echo "</div>";
    echo '<div class="column right">';
    echo " <b>IDs of Modules Included</b><br/>        <textarea readonly name='modules_included' rows='4' cols='60'></textarea> <br/><br/> \n"; 
    echo "</div>";
    echo "</div>";
    echo "</fieldset>";
    echo "<br/> \n";
    echo '<div class="row">';
    echo '<div class="column left">';
    echo "<b>X-Ray Evaluation</b><br/> <textarea readonly name='xray_evaluation' rows='5' cols='60'>$xray_evaluation</textarea>";
    echo "</div>";

    echo '<div class="column right">';
    echo "<b>CMM Evaluation</b><br/> <textarea readonly name='cmm_evaluation' rows='5' cols='60'>$cmm_evaluation</textarea>";
    echo "</div>";

    echo "</div>";
} 

?>
<div class="footer"><i>Made by Raghav Sarangi (rs977@cornell.edu) with support from Souvik Das (souvik@purdue.edu)</i></div>

</body>
</html>