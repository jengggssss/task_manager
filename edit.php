<?php
include("connect.php");

if (isset($_GET["id"])) {
    $id = mysqli_real_escape_string($conn, $_GET["id"]);
    
    $sql = "SELECT * FROM tasks WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $task_name = $row["task_name"];
        $task_description = $row["task_description"];
    } else {
        echo "Error fetching task details.";
        exit;
    }
} else {
    echo "Invalid request. Please provide a task ID.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Edit Task</title>
    <style>
    body {
    background: url('download.jpeg');
    background-size: cover;
}

.container {
    padding: 20px;
    margin-top: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

header {
    background-color: lightgoldenrodyellow;
    color: blue;
    padding: 10px;
    border-radius: 5px;
}

form {
    margin-top: 20px;
}

.form-element {
    margin-bottom: 15px;
}

/* Separate borders for input fields */
.form-control {
    border: 1px solid #ccc;
    border-radius: 4px;
    margin-bottom: 10px;
}

/* Additional styling for the submit button */
.btn-success {
    background-color: #28a745;
    border-color: #28a745;
}

</style>
</head>
<body>
    <div class="container">
        <header class="d-flex justify-content-between my-4">
            <p><b>Edit Task</b></p>
            <div>
                <a href="index.php" class="btn btn-dark">Back to Task List</a>
            </div>
        </header>
        <form action="process.php" method="post">
            <input type="hidden" name="id" value="<?php echo $id ?>">
            <div class="form-element" my-4>
                <input type="text" class="form-control" name="task_name" placeholder="Task Name" value="<?php echo $task_name ?>"> 
                <input type="text" class="form-control" name="task_description" placeholder="Task Description" value="<?php echo $task_description?>"> 
            </div>
            <div class="form-elemet">
                <input type="submit" class="btn btn-success" name="edit" value="Update Task">
            </div>
            
        </form>
    </div>
</body>
</html>
