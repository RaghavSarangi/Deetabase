<html>
<head>
  <title>CMS TFPx Deetabase</title>
  <link rel="StyleSheet" type="text/css" href="theme.css"/>
</head>
<body>

<h1 align="center"> CMS TFPx Deetabase </h1>

<div class="login">
<h2> User Registration </h2>
<form action="signup.php" method="post" enctype='multipart/form-data'>
  <b>First Name</b><br/>        <input type="text" name="firstname"> <br/><br/>
  <b>Last Name</b><br/>         <input type="text" name="lastname"> <br/><br/>
  <b>Affiliation</b><br/>
    <select name="affiliation">
      <?php
        $json = file_get_contents('./databaseURL.json');
        $json_data = json_decode($json,true);
        $cleardb_server = $json_data["Host"];
        $cleardb_username = $json_data["Username"];
        $cleardb_password = $json_data["Password"];
        $cleardb_db = $json_data["Database"];
        $conn = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);


        $sqlQuery = "SELECT affiliation FROM affiliations";
        $queryResult = mysqli_query($conn, $sqlQuery);
        while ($map_output = mysqli_fetch_assoc($queryResult))
          echo "      <option value='".$map_output["affiliation"]."'>".$map_output["affiliation"]."</option> \n";
        mysqli_close($conn);
      ?>
    </select><br/><br/>
  <b>Email</b><br/>             <input type="text" name="email"> <br/><br/>
  <b>Username</b><br/>          <input type="text" name="username"> <br/><br/>
  <b>Password</b><br/>          <input type="password" name="userpass"> <br/><br/>
  <b>Confirm Password</b><br/>  <input type="password" name="confirmpass"> <br/><br/>
  <input type="submit" value="Sign Up"/>
</form>
Already have an account? <a href="index.php"> Login here.</a>
</div>
<br/>

<?php
  if (isset($_POST["firstname"]) &&
      isset($_POST["lastname"]) &&
      isset($_POST["affiliation"]) &&
      isset($_POST["email"]) &&
      isset($_POST["username"]) &&
      isset($_POST["userpass"]) &&
      isset($_POST["confirmpass"]))
  {
    $firstname   = $_POST["firstname"];
    $lastname    = $_POST["lastname"];
    $affiliation = $_POST["affiliation"];
    $email       = $_POST["email"];
    $username    = $_POST["username"];
    $userpass    = $_POST["userpass"];
    $confirmpass = $_POST["confirmpass"];

    $allOkay = true;
    if ($firstname == "")          {echo "<b><center>You need to enter a first name.</center></b><br/>"; $allOkay = false;}
    if ($lastname == "")           {echo "<b><center>You need to enter a last name.</center></b><br/>"; $allOkay = false;}
    if ($affiliation == "")        {echo "<b><center>You need to enter an affiliation.</center></b><br/>"; $allOkay = false;}
    if ($email == "")              {echo "<b><center>You need to enter an email.</center></b><br/>"; $allOkay = false;}
    if ($username == "")           {echo "<b><center>You need to enter a username.</center></b><br/>"; $allOkay = false;}
    if ($userpass == "")           {echo "<b><center>You need to enter a password.</center></b><br/>"; $allOkay = false;}
    if ($confirmpass != $userpass) {echo "<b><center>Passwords do not match.</center></b><br/>"; $allOkay = false;}

    if ($allOkay)
    {
      $connection = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);
      $sqlQuery = "SELECT username FROM users WHERE username='".$username."'";
      $output = mysqli_query($connection, $sqlQuery);
      if (mysqli_num_rows($output) == 0)
      {
        $userpass_hashed = password_hash($userpass, PASSWORD_DEFAULT);
        $sqlQuery = "INSERT INTO users (firstname, lastname, affiliation, privilege, email, username, userpass)
                     VALUES (\"".$firstname."\",
                             \"".$lastname."\",
                             \"".$affiliation."\",
                             'Viewer',
                             \"".$email."\",
                             \"".$username."\",
                             \"".$userpass_hashed."\")";
        if (mysqli_query($connection, $sqlQuery)) header("location: index.php");
        else echo "<center><b>ERROR</b>: There has been an error communicating with the mySQL database.</center><br/> \n";
      }
      else echo "<b><center>The username is taken. Please try something else.</center></b><br/> \n";
    }
  }
?>

<div class="footer"><i>Made by Raghav Sarangi (rs977@cornell.edu) with support from Souvik Das (souvik@purdue.edu)</i></div>

</body>
</html>