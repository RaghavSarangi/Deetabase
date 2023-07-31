<?php

$json = file_get_contents('./databaseURL.json');
$json_data = json_decode($json,true);
$cleardb_server = $json_data["Host"];
$cleardb_username = $json_data["Username"];
$cleardb_password = $json_data["Password"];
$cleardb_db = $json_data["Database"];
$connection = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);

$Query="delete from dees where id=".$_REQUEST['id'];
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


?>

<br/><br/>
<a href="main.php">Back</a>
<br/>