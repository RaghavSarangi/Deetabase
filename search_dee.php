<html>
<head>
  <title>CMS TFPx Deetabase</title>
  <link rel="StyleSheet" type="text/css" href="theme.css"/>
</head>
<body>

<script src="JSFunctions.js"></script>

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
    echo "<form action='search_dee.php' method='post' enctype='multipart/form-data'> \n";
    
   
    echo " Specify <b>ID</b> directly: <input type='int' name='id_search'/> <br/> \n";
    echo "<br/>";
    echo "<b>OR</b> <br/>";
    

    echo '<div class="row">';

    echo '<div class="column left">';
    echo '<h3>Filter by Attributes: </h3>';

    // echo " AND <b>Current Location</b>: \n";
    // echo " <select name='location'> \n";
    // echo "  <option value='Any'>Any</option> \n";

    // $json = file_get_contents('./databaseURL.json');
    // $json_data = json_decode($json,true);
    // $cleardb_server = $json_data["Host"];
    // $cleardb_username = $json_data["Username"];
    // $cleardb_password = $json_data["Password"];
    // $cleardb_db = $json_data["Database"];
    // $connection = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);
    // $sqlQuery = "SELECT affiliation FROM affiliations";
    // $queryResult = mysqli_query($connection, $sqlQuery);
    // while ($map_output = mysqli_fetch_assoc($queryResult))
    //   echo "  <option value='".$map_output["affiliation"]."'>".$map_output["affiliation"]."</option> \n";
    // mysqli_close($connection);

    // echo " </select> <br/><br/> \n";

    echo "<b>Operators</b>: <input type='text' name='operator_search' value='%'/> <br/> \n";
    echo " AND <b>Manufacturing Datetime Range</b>:  <input type='datetime-local' name='manufacture_datetime_search_start' value='2023-01-01T09:00'> 
    to <input type='datetime-local' name='manufacture_datetime_search_end' value='2024-12-31T17:00'> <br/> \n";
    echo " AND <b>Carbon Fiber Serial Num (Top or Bottom)</b>: <input type='text' name='carbon_fiber_search' value='%'/> <br/> \n";
    echo " AND <b>Carbon Foam Serial Num</b>: <input type='text' name='carbon_foam_search' value='%'/> <br/> \n";
    echo " AND <b>Periphery Serial Num</b>: <input type='text' name='periphery_search' value='%'/> <br/> \n";
    echo " <input type='submit' value='Search'> \n";
    echo "</form> \n";
    echo "</p> \n"; 
    echo "</div>";

    echo '<div class="column right" style = "background-color:linen">';
    echo '<i>Wildcards allowed: ';
    echo "<ul> \n";
    echo " <li> <b>%</b> Represents zero or more characters. For example, 'bl%' finds bl, black, blue, and blob. </li> \n";
    echo " <li> <b>_</b> Represents a single character. For example, h_t finds hot, hat, and hit. </li> \n";
    echo " <li> <b>[]</b> Represents any single character within the brackets. For example,	h[oa]t finds hot and hat, but not hit. </li> \n";
    echo " <li> <b>^</b> Represents any character not in the brackets. For example, h[^oa]t finds hit, but not hot and hat. </li> \n";
    echo " <li> <b>-</b> Represents a range of characters. For example,	c[a-b]t finds cat and cbt. </li> \n";
    echo "</ul> </i> \n";
    echo "</div>";

    echo "</div>";

  }
  else header("location: index.php");
?>

<?php
  $goodArguments = false;
  if (isset($_SESSION["operator_search"]))
  {
    if ($_SESSION["operator_search"] != "")
    {
      $operator_search       = $_SESSION["operator_search"];       unset($_SESSION["operator_search"]);
      $carbon_fiber_search     = $_SESSION["carbon_fiber_search"];   unset($_SESSION["carbon_fiber_search"]);
      $carbon_foam_search     = $_SESSION["carbon_foam_search"];   unset($_SESSION["carbon_foam_search"]);
      $id_search = $_SESSION["id_search"];       unset($_SESSION["id_search"]);
      $manufacture_datetime_search_start = date('Y-m-d H:i:s', strtotime($_SESSION["manufacture_datetime_search_start"]));   unset($_SESSION["manufacture_datetime_search_start"]);
      $manufacture_datetime_search_end = date('Y-m-d H:i:s', strtotime($_SESSION["manufacture_datetime_search_end"]));   unset($_SESSION["manufacture_datetime_search_end"]);
      $periphery_search = $_SESSION["periphery_search"]; unset($_SESSION["periphery_search"]);
      $goodArguments = true;
    }
  }
  else if (isset($_POST["operator_search"]))
  {
    if ($_POST["operator_search"] != "")
    {
      $operator_search  = $_POST["operator_search"];
      $carbon_fiber_search  = $_POST["carbon_fiber_search"];
      $carbon_foam_search = $_POST["carbon_foam_search"];
      $manufacture_datetime_search_start = $_POST['manufacture_datetime_search_start'];
      $manufacture_datetime_search_end = $_POST['manufacture_datetime_search_end'];
      $periphery_search = $_POST['periphery_search'];
      $goodArguments = true;
    }
    else echo "You must enter some information. <br/> \n";
  }

  if ($goodArguments)

  {
    $json = file_get_contents('./databaseURL.json');
    $json_data = json_decode($json,true);
    $cleardb_server = $json_data["Host"];
    $cleardb_username = $json_data["Username"];
    $cleardb_password = $json_data["Password"];
    $cleardb_db = $json_data["Database"];
    $connection = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);
    

    if ($_POST["id_search"] != "") {
        $id_search = $_POST['id_search'];
        $sqlQuery = "SELECT * FROM dees WHERE id = $id_search;";
    }
    else {
    $sqlQuery = "SELECT * FROM dees WHERE 
                operators LIKE '".$operator_search."' AND
                (carbon_fiber_top_serial_num LIKE '".$carbon_fiber_search."' OR 
                carbon_fiber_bottom_serial_num LIKE '".$carbon_fiber_search."') AND 
                carbon_foam_serial_num LIKE '".$carbon_foam_search."' AND
                periphery_serial_num LIKE '".$periphery_search."' AND
                manufacture_datetime BETWEEN '$manufacture_datetime_search_start' AND '$manufacture_datetime_search_end'
                ;";
    }
    $queryResult = mysqli_query($connection, $sqlQuery);

    if (mysqli_num_rows($queryResult) == 0) {echo "<h2 style='text-align:center'> No results found! </h2> \n";}
    else {

    // echo "<br/> \n";
    echo "<p> \n";
    echo "<h2> Dees Produced </h2> \n";
    echo "<table> \n";
    echo " <tr> \n";
    echo "  <th> ID </th> \n";
    echo "  <th> Operators </th> \n";
    echo "  <th> Manufacturing Datetime </th> \n";
    echo "  <th> Carbon Fiber Top Serial # </th> \n";
    echo "  <th> Carbon Fiber Bottom Serial # </th> \n";
    echo "  <th> Carbon Foam Serial # </th> \n";
    echo "  <th> Periphery Serial # </th> \n";
    echo "  <th> Modules Included </th> \n";
    echo "  <th> X-Ray Evaluation </th> \n";
    echo " </tr> \n";
    $itemNumber = 0;
    while ($map_output = mysqli_fetch_assoc($queryResult))
{

    ++$itemNumber;

    $id = $map_output['id']; 
    $operators = $map_output["operators"];
    $datetime = $map_output["manufacture_datetime"];
    $carbon_fiber_top_serial_num = $map_output["carbon_fiber_top_serial_num"];
    $carbon_fiber_bottom_serial_num = $map_output["carbon_fiber_bottom_serial_num"];
    $carbon_foam_serial_num = $map_output["carbon_foam_serial_num"];
    $periphery_serial_num = $map_output["periphery_serial_num"];
    $modules_included = $map_output["modules_included"];
    $xray_evaluation = $map_output["xray_evaluation"];

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
    echo " <td > \n";

    // The sheet can be deleted if the privilege is Administrator
    if ($_SESSION["privilege"] == "Editor" || $_SESSION["privilege"] == "Administrator")
    {
      echo '<form method="post" action="delete_dee.php?id='.$id.'" onsubmit="javascript:return confirm(\'Are you sure you want to delete this Dee?\');">';
      echo "<input type='submit' name='id' value='Delete'></input>";
      echo "</form>";
    }
    echo " </td > \n";
    echo "</tr> \n";
    


    }

    mysqli_close($connection);

    echo "</table> \n";

  }
}

?>

<br/><br/>
<a href="main.php">Back</a>
<br/>

<p align="right">
Author: Raghav Sarangi <br/>
Cornell University, 2023 <br/>
rs977@cornell.edu
</p>

</body>
</html>