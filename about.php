<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha384-GLhlTQ8iNl4i6T730jyo7FqZx3MVBxT+1iF0uH&dGJ8fuL5F5TtC5WvuwjUhDI5" crossorigin="anonymous">
    <title>About Us</title>
    <style>
        body {
            background: url('hehe.jpeg');
            background-size: cover;
            margin: 0;
            padding: 0;
        }

        .container {
            padding: 20px;
            margin-top: 20px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            background-color: rgba(255, 255, 255, 0.5);
        }

        header {
            background-color: rgba(173, 216, 230, 0.5);
            color: black;
            padding: 10px;
            border-radius: 5px;
        }

        h2 {
            margin-top: 20px;
        }

        p {
            line-height: 1.6;
        }
        .navbar-nav .active a {
            background-color: lightseagreen; 
            color: #fff; 
            border: 2px;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link btn btn-primary" href="dashboard.php"><i class="fas fa-home"></i> Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-primary " href="index.php"><i class="fas fa-tasks"></i> Task List</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link " href="about.php"><i class="fas fa-info-circle"></i> About</a>
                    </li>
                    <li class="nav-item">
                         <a class="nav-link btn btn-primary " href="profile.php"><i class="fas fa-user"></i> Profile</a>
                     </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-danger" href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <header>
        <h2>ABOUT</h2>
        <p>
            A Task Manager web application is a software tool designed to help users organize, track, and manage their tasks and activities. These applications are typically accessible through a web browser, making them convenient for users who want to access their tasks from different devices.
        </p>
 
        </header>

       
        <h2>Our Team Members</h2>            
                <img src="jessa.jpg" alt="Jessa's Photo" style="max-width: 100px; border-radius: 50%;">
                <p>Ma. Jessa Padilla Adlaon is a dedicated and passionate team member. She excels in task management and brings creativity to our projects.</p>
                
                <img src="leny.jpg" alt="Leny's Photo" style="max-width: 100px; border-radius: 50%;">
                <p>Leny Rose Gestupa Juguan is a detail-oriented and organized individual. Her problem-solving skills contribute to the success of our projects.</p>
          
       
    </div>

</body>

</html>