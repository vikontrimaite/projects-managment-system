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
    $sql = 'DELETE FROM Projects WHERE id = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $_GET['id']);
    $res = $stmt->execute();

    $stmt->close();
    mysqli_close($conn);

    header("Location: " . strtok($_SERVER["REQUEST_URI"], '?'));
    die();
}

// update
if(isset($_GET['action']) and $_GET['action'] == 'update'){
    echo '<div style="background-color: lightgreen;">
        <form action="" method="POST">
            <p>Update your existing project name!</p>

            <p class="id-line">Your project ID is: ' . $_GET['id'] . ' </p>

            <label for="project_name">Enter a new project name: </label>
            <input type="text" name="project_name" >
    
            <input type="submit" name ="update-proj" value="Update!">
        </form>
    </div>';

}
if(isset($_POST['update-proj'])) {

    $updated_project_name = $_POST['project_name'];
        
            $sql = "UPDATE Projects SET name = ? WHERE id = ?";
            $stmt = $conn->prepare($sql); 
            $stmt->bind_param('si', $updated_project_name, $_GET['id'] );
            $res = $stmt->execute();
        
            $stmt->close();
            mysqli_close($conn);
        
            header("Location: " . strtok($_SERVER["REQUEST_URI"], '?'));
            die();
    }

// add new project
if(isset($_POST['add-project'])) {
        $newProject = $_POST['add-project'];
        if ($newProject == '') {
            echo 'Project name cannot be empty. Please enter a name!';
        } else {
        $sql = "INSERT INTO Projects (name)
        VALUES ('$newProject');";
        if (mysqli_query($conn, $sql)) {
        echo "New record created successfully!";
        } else {
        echo "Error: " . $sql . "
        " . mysqli_error($conn);
        }
        mysqli_close($conn);

        header("Location: " . strtok($_SERVER["REQUEST_URI"], '?'));
        die();
    }
}

echo '<table>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Employees</th>
                <th>Actions</th>
            </tr>';

$sql = 'SELECT Projects.id, Projects.name, group_concat(concat_ws(", ", Employees.employee_name)) as Employees from Projects
inner join Employees on Projects.name=Employees.project_name 
group by project_name order by Projects.name;';
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        echo 
        '<tr>
            <td>' . $row["id"] . '</td>
            <td>' . $row["name"] . '</td>
            <td>' . $row["Employees"] . '</td>
            <td> 
            <a href="?action=delete&id='  . $row['id'] . '"><button>DELETE</button></a>
            <a href="?action=update&id='  . $row['id'] . '"><button>UPDATE</button></a>
            </td>
        </tr>';
    }
} else {
    echo "0 results";
}

echo '</table>';

?>

    <div style="background-color: lightblue;">
        <form action="" method="POST">
            <p>Add a new project!</p>
            <label for="add-project">Enter a new project's name: </label>
            <input type="text" name="add-project">
            <input type="submit" value="Add">
        </form>
    </div>

</body>

</html>