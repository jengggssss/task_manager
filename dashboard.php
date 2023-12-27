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
    <title>User Dashboard</title>
</head>
<body>
    <div class="container">
        <header class="d-flex justify-content-between my-4">
            <p><b>User Dashboard</b></p>
            <div>
                <a href="index.php" class="btn btn-dark">Back to Task List</a>
            </div>
        </header>
        <div>
            <h2>Welcome, <?php echo $user['username']; ?>!</h2>
            <!-- Display other user information here as needed -->
        </div>
        <div>
            <!-- Add content for the dashboard -->
        </div>
        <div>
            <a href="logout.php" class="btn btn-danger">Logout</a>
        </div>
    </div>
</body>
</html>
