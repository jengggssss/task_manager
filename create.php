<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Add task</title>
    <style>
    body {
        background: url('violet.jpeg') ;
        background-size: cover; 

    .container {
        
        padding: 20px; 
        margin-top: 20px; 
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); 
    }

    header {
        background-color: lightslategray; 
        color: #ffffff; 
        padding: 10px;
        border-radius: 5px;
    }

    form {
        margin-top: 20px; 
    }

    .form-element {
        margin-bottom: 15px; 
    }
}
</style>
</head>
<body>
    <div class="container">
        <header class="d-flex justify-content-between my-4"  >
           <p><b>Add New Task</b></p>
            <div>
                <a href="index.php " class="btn btn-primary" >Back</a>
            </div>
        </header>
            <form action="process.php" method="post">
                <div class="form-element" my-4>
                    <input type="text" class="form-control" name="task_name" placeholder="Task Name" >
                </div>
                <div class="form-element" my-4>
                    <input type="text" class="form-control" name="task_description" placeholder="Task Description" >
                </div>
                <div class="form-elemet">
                    <input type="Submit" class="btn btn-success" name="create" value="Add Task" >
                </div>
            </form>
    </div>
</body>
</html>