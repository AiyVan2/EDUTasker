<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.html");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['task_id'])) {
    $task_id = $_POST['task_id'];
    $task = $_POST['task'];
    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("SELECT * FROM tasks WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $task_id, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $stmt = $conn->prepare("UPDATE tasks SET task = ? WHERE id = ? AND user_id = ?");
        $stmt->bind_param("sii", $task, $task_id, $user_id);
        $stmt->execute();
    }
    header("Location: tasks.php?category=" . urlencode($_POST['category']));
    exit;
}

$task_id = $_GET['id'];
$user_id = $_SESSION['user_id'];
$category = $_GET['category'];
$stmt = $conn->prepare("SELECT * FROM tasks WHERE id = ? AND user_id = ?");
$stmt->bind_param("ii", $task_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    header("Location: home.php");
    exit;
}

$task = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Task</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Edit Task</h2>
        <form action="" method="post" class="mt-3">
            <input type="hidden" name="task_id" value="<?php echo $task_id; ?>">
            <input type="hidden" name="category" value="<?php echo htmlspecialchars($category); ?>">
            <div class="form-group">
                <label for="task">Task</label>
                <input type="text" id="task" name="task" class="form-control" value="<?php echo htmlspecialchars($task['task']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Update Task</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
