<?php
$servername = "localhost";
$username = "root";
$password = "mysql";
$dbname = "ProjectManagment";

$conn = mysqli_connect($servername, $username, $password, $dbname); // Create connection

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";
include('main.php');


// $sql = "SELECT id, name, projects FROM Employees";
// $result = mysqli_query($conn, $sql);

// if (mysqli_num_rows($result) > 0) {
//     while($row = mysqli_fetch_assoc($result)) {
//         echo "id: " . $row["id"]. " - Name: " . $row["name"]. " " . $row["projects"]. "<br>";
//     }
// } else {
//     echo "0 results";
// }

    mysqli_close($conn);
    

?>
