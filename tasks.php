<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.html");
    exit;
}

require 'db.php';
$user_id = $_SESSION['user_id'];
$category = $_GET['category'];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['task'])) {
    $task = $_POST['task'];
    $due_date = $_POST['due_date']; // Add due date
    $stmt = $conn->prepare("INSERT INTO tasks (user_id, category, task, due_date) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $user_id, $category, $task, $due_date); // Bind due date parameter
    $stmt->execute();
}

$tasks = $conn->query("SELECT * FROM tasks WHERE user_id = $user_id AND category = '$category'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo ucfirst($category); ?> Tasks</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <script>
        function confirmDelete(taskId, category) {
            if (confirm("Are you sure you want to delete this task?")) {
                window.location.href = 'delete.php?id=' + taskId + '&category=' + encodeURIComponent(category);
            }
        }
    </script>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center"><?php echo ucfirst($category); ?> Tasks</h2>
        <form action="" method="post" class="mt-4">
        <div class="input-group mb-4">
    <input type="text" name="task" class="form-control" placeholder="New Task" required style="width: 50%">
    <input type="date" name="due_date" class="form-control" required style="width: 70%">
    <div class="input-group-append">
        <button class="btn btn-primary" type="submit" style="width: 100%">Add Task</button>
    </div>
</div>
        </form>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Task</th>
                    <th>Status</th>
                    <th>Due Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $tasks->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['task']); ?></td>
                    <td><?php echo htmlspecialchars($row['status']); ?></td>
                    <td><?php echo htmlspecialchars($row['due_date']); ?></td>
                    <td>
                        <a href="edit.php?id=<?php echo $row['id']; ?>&category=<?php echo urlencode($category); ?>" class="btn btn-sm btn-warning">Edit</a>
                        <a href="javascript:void(0);" onclick="confirmDelete(<?php echo $row['id']; ?>, '<?php echo $category; ?>')" class="btn btn-sm btn-danger">Delete</a>
                        <a href="done.php?id=<?php echo $row['id']; ?>&category=<?php echo urlencode($category); ?>" class="btn btn-sm btn-success">Mark as Done</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <div class="text-center mt-4">
            <a href="home.php" class="btn btn-secondary">Back to Home</a>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
