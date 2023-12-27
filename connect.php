<?php
    $host="localhost";
    $user="root";
    $pass= "";
    $db= "task_manager";

    $conn = mysqli_connect($host, $user, $pass, $db);
    if (!$conn) {
        die("Something went wrong");
    }
?>