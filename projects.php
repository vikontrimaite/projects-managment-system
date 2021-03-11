<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projects Managment System</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <div class="header">
            <div>
                <a href="#">projects</a>
                <a href="employees.php">employees</a>
            </div>
            <div>
                project managment
            </div>
        </div>
    </header>
    <main>
        <table>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Projects</th>
                <th>Actions</th>
            </tr>

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

$sql = "SELECT id, name, employees FROM Projects";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        echo 
        '<tr>
            <td>' . $row["id"] . '</td>
            <td>' . $row["name"] . '</td>
            <td>' . $row["employees"] . '</td>
            <td>delete update</td>
        </tr>';
    }
} else {
    echo "0 results";
}

?>

        </table>
    </main>
</body>

</html>