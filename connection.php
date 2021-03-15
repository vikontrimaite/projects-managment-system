<?php

$servername = "localhost";
$username = "root";
$password = "mysql";
$dbname = "ProjectsManagment";

$conn = mysqli_connect($servername, $username, $password, $dbname); // Create connection

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";

?>