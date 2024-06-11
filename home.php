<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.html");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        /* Additional custom styles */
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f0f0f0;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding-top: 50px;
        }
        h2 {
            color: #333;
            font-weight: 700;
            text-align: center;
            margin-bottom: 30px;
        }
        .nav-pills .nav-link {
            color: #333;
            font-weight: 700;
            border-radius: 0px;
            padding: 10px 20px;
            margin: 0 10px;
            transition: all 0.3s ease;
        }
        .nav-pills .nav-link.active,
        .nav-pills .show > .nav-link {
            background-color: #007bff;
            color: #fff;
        }
        .nav-pills .nav-link:hover {
            background-color: #007bff;
            color: #fff;
        }
        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
            padding: 10px 20px;
            border-radius: 20px;
            transition: all 0.3s ease;
        }
        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></h2>
        <nav class="mt-4">
            <ul class="nav nav-pills justify-content-center">
                <li class="nav-item">
                    <a class="nav-link" href="tasks.php?category=backlogs">Backlogs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="tasks.php?category=meetings">Meetings</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="tasks.php?category=events">Events</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="tasks.php?category=others">Others</a>
                </li>
            </ul>
        </nav>
        <div class="text-center mt-4">
            <a href="logout.php" class="btn btn-danger">Logout</a>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
