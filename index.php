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
<div class="index-page">
<h1>Hello! Please choose which table you would like to see:</h1>
   
<p>
    <a href="projects.php" class="links">projects</a>
    <span>or</span>
                <a href="employees.php" class="links">employees</a>
   </p>

</div>
  


</body>

</html>

<?php
    mysqli_close($conn);
    

?>
