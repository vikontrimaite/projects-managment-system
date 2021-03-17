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




// update
if(isset($_GET['action']) and $_GET['action'] == 'update'){
    echo '<div style="background-color: grey;">
        <form action="" method="POST">
            <p>Update your employee!</p>

            <label for="employee_name">Enter a new employee name: </label>
            <input type="text" name="employee_name">

            <label for="project_name"> Assign project for an employee: </label>
            <select id="project_name" name="project_name">';
            
            
            
            $sql = "SELECT name FROM Projects;";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        echo 
        '<option  value="' . $row["name"] . '">' . 
        $row["name"] . '</option>';
    }
}

            echo '</select>
            <input type="submit" name ="update-empl" value="Update">
        </form>
    </div>';


    // $query = mysql_query ("SELECT * FROM Employees;");

    // while ($row = mysql_fetch_array ($query)) 
    // {
    //     $id = $row['id']; 
    //     $employee_name = $row['employee_name'];
    //     $project_name = $row['project_name'];
    //     // $date = $row['date'];
    //     // $category = $row['category'];
    //     // $content = $row['content'];
    // }

}
if(isset($_POST['update-empl'])) {

    


    // $id = $_POST['id'];
    $updated_employee_name = $_POST['employee_name'];
    $updated_project_name = $_POST['project_name'];

        
            $sql = "UPDATE Employees SET employee_name = ?, project_name = ? WHERE id = ?";
            $stmt = $conn->prepare($sql); 

            $stmt->bind_param('ssi', $updated_employee_name, $updated_project_name, $_GET['id'] );
            var_dump($stmt);
            $res = $stmt->execute();
            var_dump($res);
        
            $stmt->close();
            mysqli_close($conn);
        
            header("Location: " . strtok($_SERVER["REQUEST_URI"], '?'));
            die();
        
    }
    

    
    
    // `// $sql = 'UPDATE FROM Employees WHERE id = ?';`
    // $name = $_POST['name'];
    // $project = $_POST['project'];

    // $sql = 'UPDATE Employees
    // SET
    // `id` = <{id: }>,
    // `name` = <{name: }>,
    // `surname` = <{surname: }>,
    // `salary` = <{salary: }>
    // WHERE `id` = <{expr}>;
    // ';
    // // $stmt = $conn->prepare($sql);
    // // $stmt->bind_param('i', $_GET['id']);
    // // $res = $stmt->execute();

    // $stmt->close();
    // mysqli_close($conn);

    // header("Location: " . strtok($_SERVER["REQUEST_URI"], '?'));
    // die();



// add new employee
if(isset($_POST['add-empl'])) {
    $newName = $_POST['add-empl'];
    if ($newName == '') {
        echo 'Name cannot be empty. Please enter a name!';
    } else {
        $sql = "INSERT INTO Employees (employee_name)
        VALUES ('$newName')";
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
                <th>Project</th>
                <th>Actions</th>
            </tr>';

$sql = "SELECT id, employee_name, project_name FROM Employees order by employee_name;";
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
            <a href="?action=update&id='  . $row['id'] . '"><button>UPDATE</button></a>
            </td>
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

    <!-- <div style="background-color: grey;">
        <form action="" method="POST">
            <p>Update your employee!</p>

            <label for="add-empl">Enter a new employee's name: </label>
            <input type="text" name="name">

            <label for="add-empl"> Assign project for an employee: </label>
            <input type="text" name="project">

            <input type="submit" name ="update_empl" value="Update">
        </form>
    </div> -->

</body>
</html>



