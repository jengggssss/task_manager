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
    <title>Task List</title>
    <style>
        body {
            background: url('yellow.jpeg');
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
                    <a class="nav-link btn btn-primary " href="dashboard.php"><i class="fas fa-home"></i> Home</a>
                    </li>
                <li class="nav-item active">
                <a class="nav-link" href="index.php"><i class="fas fa-tasks"></i> Task List</a>
                </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-primary " href="about.php"><i class="fas fa-info-circle"></i> About</a>
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
        <!-- Search Form -->
        <form method="GET" action="">
            <div class="form-element">
                <label for="search">Search</label>
                <input type="text" name="search" id="search" class="form-control" placeholder="Search Tasks" /> 
                <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Search</button>
            </div>
        </form>

        <div class="container">
            <header class="d-flex justify-content-between my-4">
                <p><b>Task List</b></p>
                <div>
                    <a href="create.php" class="btn btn-primary"><i class="fas fa-plus"></i> Add New Task</a>
                </div>
            </header>

            <table class="table table-bordered">
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
                    $recordsPerPage = 5;
                    $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                    $startFrom = ($currentPage - 1) * $recordsPerPage;

                    $sql = "SELECT * FROM tasks";

                    // Adding search functionality
        $searchResultsFound = true; // Variable to track search results

        if (isset($_GET['search']) && !empty($_GET['search'])) {
            $search = mysqli_real_escape_string($conn, $_GET['search']);
            $sql .= " WHERE task_name LIKE '%$search%' OR task_description LIKE '%$search%'";
            $searchResultsFound = mysqli_num_rows(mysqli_query($conn, $sql)) > 0;
        }

        $sql .= " LIMIT $startFrom, $recordsPerPage";

        $result = mysqli_query($conn, $sql);

        if (!$searchResultsFound) {
            echo '<div class="alert alert-warning" role="alert">No search results found.</div>';
        }
                    while ($row = mysqli_fetch_array($result)) {
                        ?>
                        <tr>
                            <td><?php echo $row["id"]; ?></td>
                            <td><?php echo $row["task_name"]; ?></td>
                            <td><?php echo $row["task_description"]; ?></td>
                            <td>
                                <a href="edit.php?id=<?php echo $row["id"]; ?>" class="btn btn-warning"><i class="fas fa-edit"></i> Edit</a>
                                <a href="delete.php?id=<?php echo $row["id"]; ?>" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Delete</a>
                            </td>
                        </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>

            <!-- Pagination -->
            <?php
            $totalRecords = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tasks"));
            $totalPages = ceil($totalRecords / $recordsPerPage);

            echo "<ul class='pagination'>";
            for ($i = 1; $i <= $totalPages; $i++) {
                echo "<li class='page-item'><a class='page-link' href='?page=$i'>" . $i . "</a></li>";
            }
            echo "</ul>";
            ?>
        </div>
    </div>
</body>

</html>