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

// delete
if(isset($_GET['action']) and $_GET['action'] == 'delete'){
    $sql = 'DELETE FROM Employees WHERE id = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $_GET['id']);
    $res = $stmt->execute();

    $stmt->close();
    mysqli_close($conn);

    header("Location: " . strtok($_SERVER["REQUEST_URI"], '?'));
    die();
}


// čia pagal seną pvz, bet reik kitaip, bet esmė gal tokia
// if(isset($_POST['add-empl'])) {
//     $newDir = $_GET['path']. $_POST['add-empl'];
//     if (is_dir($_POST['add-empl'])) {
//         echo '<p style="color: red;">Employee with a name ' . $_POST['add-empl'] . ' exists aleready</p>';
//     } elseif (empty($_POST['add-empl'])) {
//         echo '<p style="color: red;">Employee name cannot be empty. Please enter a new employee name!</p>';
//     } else {
//         mkdir($newDir);
//     }
// }

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
            <td>
            <a href="?action=delete&id='  . $row['id'] . '"><button>DELETE</button></a>
            update</td>
        </tr>';
    }
} else {
    echo "0 results";
}

echo '</table>';

?>

<div style="background-color: violet;">
        <form action="" method="POST">
            <p>Add a new employee!</p>
            <label for="add-empl">Enter a new employee's name: </label>
            <input type="text" name="add-empl">
            <input type="submit" value="Create">
        </form>
    </div>

</body>
</html>



