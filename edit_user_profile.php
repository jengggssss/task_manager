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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newUsername = mysqli_real_escape_string($conn, $_POST["username"]);
    $newPassword = mysqli_real_escape_string($conn, $_POST["password"]);

    // Validate inputs (add more validation as needed)
    if (empty($newUsername) || empty($newPassword)) {
        echo "Username and password are required.";
        exit();
    }

    // Hash the password
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    $updateSql = "UPDATE users SET username = ?, password = ? WHERE username = ?";
    $stmt = mysqli_prepare($conn, $updateSql);
    mysqli_stmt_bind_param($stmt, "sss", $newUsername, $hashedPassword, $username);
    $updateResult = mysqli_stmt_execute($stmt);

    if ($updateResult) {
        echo "User information updated successfully!";
        // Redirect to profile page after a few seconds
        header("refresh:2;url=profile.php");
        exit();
    } else {
        // Log detailed error information
        error_log("Error updating user information: " . mysqli_error($conn));
        echo "Error updating user information. Please try again later.";
        exit();
    }

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha384-GLhlTQ8iNl4i6T730jyo7FqZx3MVBxT+1iF0uH&dGJ8fuL5F5TtC5WvuwjUhDI5" crossorigin="anonymous">
    <title>Edit User Profile</title>
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
                <li class="nav-item">
                <a class="nav-link " href="profile.php"><i class="fas fa-user"></i> Profile</a>
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
        <h4>Edit User Profile</h4>

        <!-- Form for editing user information -->
        Note: Regarding with the username Example: jessa - Jessa
        <form action="edit_user_profile.php" method="post" class="mt-3">
            <div class="mb-3">
                <label for="newUsername" class="form-label">New Username:</label>
                <input type="text" name="username" class="form-control" id="newUsername" required>
            </div>
            <div class="mb-3">
                <label for="newPassword" class="form-label">New Password:</label>
                <input type="password" name="password" class="form-control" id="newPassword" required>
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Save Changes
            </button>
        </form>
    </div>
</div>
</body>

</html>
