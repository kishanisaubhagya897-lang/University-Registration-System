<?php
include "includes/auth.php";
include "includes/config.php";

$nic = $_GET['nic'];

mysqli_query($conn, "DELETE FROM students WHERE nic='$nic'");

header("Location: view_students.php");
exit();
