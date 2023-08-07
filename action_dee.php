<html>
<head>
  <title>CMS TFPx Deetabase</title>
  <link rel="StyleSheet" type="text/css" href="theme.css"/>
</head>
<body>

<?php
session_start();
if ($_SESSION["username"] != ""){

$json = file_get_contents('./databaseURL.json');
$json_data = json_decode($json,true);
$cleardb_server = $json_data["Host"];
$cleardb_username = $json_data["Username"];
$cleardb_password = $json_data["Password"];
$cleardb_db = $json_data["Database"];
$connection = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);

$id = $_GET['id'];
if (isset($_POST['action'])) 
{
$action = $_POST['action'];
if ($action == 'View') {
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
}

else if ($action == 'Edit') {
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
    // $id = $map_output['id']; 
    $operators = $map_output["operators"];
    $datetime = $map_output["manufacture_datetime"];
    $carbon_fiber_top_serial_num = $map_output["carbon_fiber_top_serial_num"];
    $carbon_fiber_bottom_serial_num = $map_output["carbon_fiber_bottom_serial_num"];
    $carbon_foam_serial_num = $map_output["carbon_foam_serial_num"];
    $periphery_serial_num = $map_output["periphery_serial_num"];
    $modules_included = $map_output["modules_included"];
    $xray_evaluation = $map_output["xray_evaluation"];
    $cmm_evaluation = $map_output["cmm_evaluation"];

    echo " <h3 align='center'> This form allows you to update the details of Dee #$id. </h3> \n";
    echo "<br/> \n";
    echo '<form action="action_dee.php?id='.$id.'" method="post" enctype="multipart/form-data">';
    echo '<div class="row">';
    echo '<div class="column left">';
    echo " <b>Operators</b><br/>        <textarea name='operators' rows='1' cols='60'>$operators</textarea> <br/><br/> \n ";
    echo "</div>";
    echo '<div class="column right">';
    echo " <b>Date & Time of Manufacture</b><br/> <input type='datetime-local' name='manufacture_datetime' value='$datetime'>";
    echo "</div>";
    echo "</div>";

    echo "<fieldset>";
    echo "<legend><i>Components</i></legend>";

    echo '<div class="row">';

    echo '<div class="column left">';
    echo " <b>Carbon Fiber Top Serial #</b><br/>        <input type='text' name='carbon_fiber_top_serial_num' value='$carbon_fiber_top_serial_num'> <br/><br/> \n";
    echo " <b>Carbon Fiber Bottom Serial #</b><br/>        <input type='text' name='carbon_fiber_bottom_serial_num' value='$carbon_fiber_bottom_serial_num'> <br/><br/> \n";
    echo " <b>Carbon Foam Serial #</b><br/>        <input type='text' name='carbon_foam_serial_num' value='$carbon_foam_serial_num'> <br/><br/> \n";
    echo " <b>Periphery Serial #</b><br/>        <input type='text' name='periphery_serial_num' value='$periphery_serial_num'> <br/><br/> \n";
    echo "</div>";

    echo '<div class="column right">';
    echo "<b>IDs of Modules Included</b><br/>        <textarea name='modules_included' rows='4' cols='60'>$modules_included</textarea> <br/><br/> \n"; 
    echo "</div>";

    echo "</div>";
    echo "</fieldset>";
    echo "<br/> \n";


    echo '<div class="row">';

    echo '<div class="column left">';
    echo "<b>X-Ray Evaluation</b><br/> <textarea name='xray_evaluation' rows='5' cols='60'>$xray_evaluation</textarea>";
    echo "</div>";

    echo '<div class="column right">';
    echo "<b>CMM Evaluation</b><br/> <textarea name='cmm_evaluation' rows='5' cols='60'>$cmm_evaluation</textarea>";
    echo "</div>";

    echo "</div>";

    echo "<br/> \n";
    echo " <input type='submit' value='Upload Data' name='submit'> \n";
    echo "</form>";

    }
}


else if ($action == 'Delete') {
    $Query="delete from dees where id=$id";
    $result=mysqli_query($connection, $Query);
    if(!$result)
    {
        echo mysqli_error($connection);
        die();
    }
    else
    {
        echo "<b>LOG</b>: Dee #$id successfully deleted.<br/> \n";
    } 
}
}

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
    $cmm_evaluation = $_POST['cmm_evaluation'];


    $sqlQuery = "update dees set operators ='$operators', carbon_fiber_top_serial_num ='$carbon_fiber_top_serial_num',
    carbon_fiber_bottom_serial_num='".$carbon_fiber_bottom_serial_num."', 
    carbon_foam_serial_num='".$carbon_foam_serial_num."', periphery_serial_num='".$periphery_serial_num."',
    manufacture_datetime='".date('Y-m-d H:i:s', strtotime($manufacture_datetime))."',
    modules_included='".$modules_included."', xray_evaluation='".$xray_evaluation."', cmm_evaluation='".$cmm_evaluation."'
     where id='".$id."';";
    $output = mysqli_query($connection, $sqlQuery);
    // printf("Affected rows (INSERT): %d\n", $connection->affected_rows);
    echo "<b>LOG</b>: Dee #$id updated.<br/> \n";
            }

mysqli_close($connection);

        } else header("location: index.php");
        
?>

<br/><br/>
<a href="main.php">Back</a>
<br/>


</body>
</html>