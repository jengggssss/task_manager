<?php
// Include the connection file
include("connect.php");

// Check if the form is submitted
if (isset($_POST["login"])) {
    // Escape user inputs for security
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);

    // SQL query to retrieve user data from the database
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $sql);

    // Check if the query was successful
    if ($result) {
        // Check if the user exists
        $row = mysqli_fetch_assoc($result);
        if ($row) {
            // Verify the password
            if (password_verify($password, $row['password'])) {
                session_start();
                $_SESSION["username"] = $username;
                header("Location: dashboard.php");
                exit();
            } else {
                echo "Invalid password";
            }
        } else {
            echo "Invalid username";
        }
    } else {
        echo "Error executing the query: " . mysqli_error($conn);
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
        }

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

        /* Additional style for the show password icon */
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
            <p><b>User Login</b></p>
            <div>
                <a href="register.php" class="btn btn-primary">Register</a>
            </div>
        </header>
        <form action="login.php" method="post">
            <div class="form-element my-4">
                <input type="text" class="form-control" name="username" placeholder="Username" required>
            </div>
            <div class="form-element my-4 position-relative">
                <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                <i class="show-password-icon" onclick="togglePasswordVisibility('password')">Show Password</i>
            </div>
            <div class="form-element">
                <input type="submit" class="btn btn-success" name="login" value="Login">
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
