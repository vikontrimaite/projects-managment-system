<?php

include('connection.php');
?>


<!DOCTYPE html>
<html lang="en">
<?php
include('head.php');
?>
<body>
    <?php

include('header.php');


echo '<table>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Project</th>
                <th>Actions</th>
            </tr>';

$sql = "SELECT id, employee_name, project_name FROM Employees;";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        echo 
        '<tr>
            <td>' . $row["id"] . '</td>
            <td>' . $row["employee_name"] . '</td>
            <td>' . $row["project_name"] . '</td>
            <td>delete update</td>
        </tr>';
    }
} else {
    echo "0 results";
}

echo '</table>';

?>
</body>
</html>



