<?php
session_start();

include("connect.php");

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION["username"];

$sql = "SELECT * FROM users WHERE username = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($result && mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
} else {
    // Handle error with more details
    echo "Error fetching user information: " . mysqli_error($conn);
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
    <title>User Profile</title>
    <style>
        body {
            background: url('baba.jpeg');
            background-size: cover;
        }

        .container {
            background-color: rgba(173, 216, 230, 0.5);
            padding: 20px;
            margin-top: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);

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
                <li class="nav-item">
                <a class="nav-link btn btn-primary" href="about.php"><i class="fas fa-info-circle"></i> About</a>
                </li>
                <li class="nav-item active">
                <a class="nav-link " href="edit_user_profile.php"><i class="fas fa-user"></i>Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-danger" href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container">
    <div class="col-md-6">
        <h4>User Profile</h4>
        <h4>Welcome, <?php echo htmlspecialchars($user["username"]); ?>!</h4>
                <a href="edit_user_profile.php" class="btn btn-secondary mt-2">
                    <i class="fas fa-edit"></i> Edit Profile
                </a>
            </form>
        </div>
    </div>
</body>

</html>
