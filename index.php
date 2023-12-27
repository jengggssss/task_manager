<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Task List</title>
    <style>
        body {
            background: url('yellow.jpeg') ;
            background-size: cover;
           
        }

        .container {
            
          
            padding: 20px;
            margin-top: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        header {
            background-color: pink;
            color: black;
            padding: 10px;
            border-radius: 5px;
        }

        form {
            margin-top: 20px;
        }

        .form-element {
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

    
    <div class="container">
        <header class="d-flex justify-content-between my-4">
            <p><b>Task List</b></p>
            <div>
                <a href="create.php" class="btn btn-primary" >Add New Task</a>
                <a href="logout.php" class="btn btn-danger">Logout</a>
                
            </div>
            
        </header>
        <?php
        session_start();
        if (isset($_SESSION["create"])) {
            ?>
            <div class="alert_alert_success">
                <?php
                echo $_SESSION["create"];
                unset($_SESSION["create"]);
                ?>
            </div>
            <?php
        }
        ?>
        <?php
        if (isset($_SESSION["edit"])) {
            ?>
            <div class="alert_alert_success">
                <?php
                echo $_SESSION["edit"];
                unset($_SESSION["edit"]);
                ?>
            </div>
            <?php
        }
        ?>
        <?php
        if (isset($_SESSION["delete"])) {
            ?>
            <div class="alert_alert_success">
                <?php
                echo $_SESSION["delete"];
                unset($_SESSION["delete"]);
                ?>
            </div>
            
            <?php
        }
        ?>
        <table class="table table-bordered" >
            <thead>
                <tr>
                    <th>#</th>
                    <th>Task Name</th>
                    <th>Task Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include("connect.php");
                $sql = "SELECT * FROM tasks";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_array($result);
                while($row = mysqli_fetch_array($result)) {
                    ?>
                    <tr>
                        <td><?php echo $row["id"]; ?></td>
                        <td><?php echo $row["task_name"]; ?></td>
                        <td><?php echo $row["task_description"]; ?></td>
                        <td>
                            <a href="edit.php?id=<?php echo $row["id"]; ?>" class="btn btn-warning">Edit</a>
                            <a href="delete.php?id=<?php echo $row["id"]; ?>" class="btn btn-danger">Delete</a>
                        </td>
                        
                    </tr>
                    
                    
                    <?php 
                }
                ?>
                
            </tbody>
        </table>
    </div>
</body>
</html>
