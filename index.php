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
$cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));

$cleardb_server = $cleardb_url["host"];
$cleardb_username = $cleardb_url["user"];
$cleardb_password = $cleardb_url["pass"];
$cleardb_db = substr($cleardb_url["path"],1);
$active_group = 'default';
$query_builder = TRUE;
// Connect to DB
$conn = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);

if ($mysqli -> connect_errno) {
  echo("Failed to connect to MySQL: " . $mysqli -> connect_error);
  exit();
}
else {echo($conn->host_info . "\n");}

$createAffiliations = mysqli_query($conn, "CREATE TABLE affiliations
(
  id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  affiliation VARCHAR(50)
);");

$createUsers = mysqli_query($conn, "CREATE TABLE users
(
  id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  username VARCHAR(50) NOT NULL UNIQUE,
  userpass VARCHAR(255) NOT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  firstname VARCHAR(100) NOT NULL,
  lastname VARCHAR(50) NOT NULL,
  affiliation VARCHAR(50),
  email VARCHAR(50) NOT NULL,
  privilege VARCHAR(50) NOT NULL
);");


// while ($obj = mysqli_fetch_object($db_list)) {
//     echo("<br>" . $obj->Database);
// }

?>