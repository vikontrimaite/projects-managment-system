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

   ?>

   <h1>Hello! Please choose which table you would like to see:</h1>
   <p>
    <a href="projects.php" class="links">projects</a>
    or
                <a href="employees.php" class="links">employees</a>
   </p>


</body>

</html>

<?php
    mysqli_close($conn);
    

?>
