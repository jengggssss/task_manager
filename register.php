<?php
// Include the connection file
include("connect.php");

// Check if the form is submitted
if(isset($_POST["register"])) {
    // Escape user inputs for security
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);

    // Hash the password (use a secure hashing algorithm)
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // SQL query to insert user data into the database
    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$hashed_password')";

    // Perform the query and check for success
    if (mysqli_query($conn, $sql)) {
        session_start();
        $_SESSION["register"] = "Registration successful. You can now log in.";
        header("Location: login.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
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
    <title>User Registration</title>
    <style>
    body {
        background: url('download 1.jpeg');
        background-size: cover;
    }
    .container {
        
        padding: 20px; 
        margin-top: 20px; 
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); 
    }

    header {
        background-color: lightsalmon; 
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
    .show-password-icon {
            cursor: pointer;
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
        }

</style>
</head>
<body>
    <div class="container">
        <header class="d-flex justify-content-between my-4">
            <p><b>User Registration</b></p>
            <div>
                <a href="login.php" class="btn btn-primary">Login</a>
            </div>
        </header>
        <form action="register.php" method="post">
            <div class="form-element my-4">
                <input type="text" class="form-control" name="username" placeholder="Username" required>
            </div>
            <div class="form-element my-4 position-relative">
                <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                <i class="show-password-icon" onclick="togglePasswordVisibility('password')">Show Password</i>
            </div>
            <div class="form-element">
                <input type="submit" class="btn btn-success" name="register" value="Register">
            </div>
        </form>
    </div>
    <script>
        function togglePasswordVisibility(passwordFieldId) {
            var passwordField = document.getElementById(passwordFieldId);
            passwordField.type = passwordField.type === 'password' ? 'text' : 'password';
        }
    </script>
</body>
</html>