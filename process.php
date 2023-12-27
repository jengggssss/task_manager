<?php
    include("connect.php");
    if(isset($_POST["create"])){
        $task_name = mysqli_real_escape_string($conn,$_POST["task_name"]); 
        $task_description = mysqli_real_escape_string($conn,$_POST["task_description"]); 
        $sql = "INSERT INTO tasks (task_name, task_description) VALUES ('$task_name', '$task_description')";
        if (mysqli_query($conn,$sql)) {
            session_start();
            $_SESSION["create"] = "Task Added Successfully";
            header("Location:index.php");
        }
        else {
            echo "error";
        }
    }

    if(isset($_POST["edit"])){
        $id = mysqli_real_escape_string($conn,$_POST["id"]); 
        $task_name = mysqli_real_escape_string($conn,$_POST["task_name"]); 
        $task_description = mysqli_real_escape_string($conn,$_POST["task_description"]);
        $sql = "UPDATE tasks SET task_name = ' $task_name', task_description = '$task_description' WHERE id=$id";
        if (mysqli_query($conn,$sql)) {
            session_start();
            $_SESSION["update"] = "Task Updated Successfully";
            header("Location:index.php");
        }
        else {
            echo "error";
        }
    }
?>  
    
