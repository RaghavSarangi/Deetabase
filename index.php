<html>
<head>
  <title>CMS TFPx Deetabase</title>
  <link rel="StyleSheet" type="text/css" href="theme.css"/>
</head>
<body>

<h1 align="center"> CMS TFPx Deetabase </h1>

<div class="login">
<h2> User Login </h2>
<form action="index.php" method="post" enctype='multipart/form-data'>
  <b>Username</b><br/>     <input type="text" name="username"> <br/><br/>
  <b>Password</b><br/>     <input type="password" name="userpass"> <br/><br/>
  <input type="submit" value="Sign In">
</form>
Don't have an account? <a href="signup.php">Sign up now.</a><br/>
</div>
<br/>


<?php

//Get Heroku ClearDB connection information

// Read the JSON file 
$json = file_get_contents('./databaseURL.json');
  
// Decode the JSON file
$json_data = json_decode($json,true);
  
// Display data
// print_r($json_data);

$cleardb_server = $json_data["Host"];
$cleardb_username = $json_data["Username"];
$cleardb_password = $json_data["Password"];
$cleardb_db = $json_data["Database"];


// Connect to DB
$conn = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);

if ($conn -> connect_errno) {
  echo("Failed to connect to MySQL: " . $mysqli -> connect_error);
  exit();
}
else {echo($conn->host_info . "\n");}

// $db_list = mysqli_query($conn, "SHOW DATABASES");
// while ($obj = mysqli_fetch_object($db_list)) {
//     echo("<br>" . $obj->Database);
// }

?>

<p align="right">
Author: Souvik Das <br/>
Purdue University, 2021 <br/>
souvik@purdue.edu
</p>

</body>
</html>