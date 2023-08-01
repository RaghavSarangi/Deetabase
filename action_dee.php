<?php

$json = file_get_contents('./databaseURL.json');
$json_data = json_decode($json,true);
$cleardb_server = $json_data["Host"];
$cleardb_username = $json_data["Username"];
$cleardb_password = $json_data["Password"];
$cleardb_db = $json_data["Database"];
$connection = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);

$id = $_GET['id'];
$Query="delete from dees where id=$id";
$result=mysqli_query($connection, $Query);
if(!$result)
{
    echo mysqli_error($connection);
    die();
}
else
{
    echo "Dee successfully deleted!";
} 

mysqli_close($connection);
?>

<br/><br/>
<a href="main.php">Back</a>
<br/>