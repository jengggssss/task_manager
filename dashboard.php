<?php
// Include the connection file
include("connect.php");

// Check if the user is logged in
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

// Retrieve user data for the dashboard
$username = $_SESSION["username"];
$sql = "SELECT * FROM users WHERE username='$username'";
$result = mysqli_query($conn, $sql);

if ($result) {
    $user = mysqli_fetch_assoc($result);
} else {
    echo "Error fetching user data.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha384-GLhlTQ8iNl4i6T730jyo7FqZx3MVBxT+1iF0uH&dGJ8fuL5F5TtC5WvuwjUhDI5" crossorigin="anonymous">
    <title>User Dashboard</title>
    <style>
        body {
            background: url('haha.jpg') ;
            background-size: cover;
           
        }
    .container {
        padding: 20px;
        margin-top: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        background: rgba(169, 169, 169, 0.7);
    }

    form {
        margin-top: 20px;
    }

    .form-element {
        margin-bottom: 15px;
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
            <li class="nav-item active">
                    <a class="nav-link " href="dashboard.php"><i class="fas fa-home"></i> Home</a>
                    </li>
                <li class="nav-item">
                <a class="nav-link btn btn-primary " href="index.php"><i class="fas fa-tasks"></i> Task List</a>
                </li>
                <li class="nav-item">
                <a class="nav-link btn btn-primary" href="about.php"><i class="fas fa-info-circle"></i> About</a>
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
<div class="container container-main">
<h1>Welcome to Task Manager</h1>
<p>Whether you're a busy professional, a student juggling assignments, or someone simply looking to stay organized, Task Manager is here to simplify your life. Our web application is designed to help you manage your tasks with ease.
</p>
<p><b><i>"Whatever you do, work at it with all your heart, as working for the Lord, not for human masters." - Colossians 3:23 (NIV)</i></b></p>
</div>

</body>

</html>