<?php
// Include the connection file
include("connect.php");

// Check if the form is submitted
if(isset($_POST["login"])) {
    // Escape user inputs for security
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);

    // SQL query to retrieve user data from the database
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $sql);

    // Check if the user exists
    if ($result) {
        $row = mysqli_fetch_assoc($result);

        // Verify the password
        if (password_verify($password, $row['password'])) {
            session_start();
            $_SESSION["username"] = $username;
            header("Location: index.php");
            exit();
        } else {
            echo "Invalid password";
        }
    } else {
        echo "Invalid username";
    }
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>User Login</title>
    
    <style>
    body {
        background: url('images.jpeg');
        background-size: cover;

    .container {
        
        padding: 20px; 
        margin-top: 20px; 
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); 
    }

    header {
        background-color: lightseagreen; 
        color: #ffffff; 
        padding: 5px;
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
        <header class="d-flex justify-content-between my-4">
            <p><b>User Login</b></p>
            <div>
            <a href="register.php" class="btn btn-primary">Register</a>
            </div>
           
        </header>
        <form action="login.php" method="post">
            <div class="form-element my-4">
                <input type="text" class="form-control" name="username" placeholder="Username" required>
            </div>
            <div class="form-element my-4">
                <input type="password" class="form-control" name="password" placeholder="Password" required>
            </div>
            <div class="form-element">
                <input type="submit" class="btn btn-success" name="login" value="Login">
            </div>
        </form>
    </div>
</body>
</html>
