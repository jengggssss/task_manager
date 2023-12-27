<?php
include("connect.php");

if (isset($_GET["id"])) {
    $id = mysqli_real_escape_string($conn, $_GET["id"]);
    
    $sql = "DELETE FROM tasks WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        session_start();
        $_SESSION["delete"] = "Task Deleted Successfully";
        header("Location: index.php");
        
    } else {
        echo "Error deleting task.";
        exit;
    }
} else {
    echo "Invalid request. Please provide a task ID.";
    exit;
}
?>
