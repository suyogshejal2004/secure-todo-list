<?php
include 'includes/auth.php'; // Ensure user is authenticated
include 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $task_id = $_POST['task_id'];
    $status = $_POST['status'];

    // Validate form data
    if (empty($task_id) || empty($status)) {
        $error = "All fields are required.";
    } else {
        // Update task status in the database
        $stmt = $conn->prepare("UPDATE tasks SET status = ? WHERE id = ? AND user_id = ?");
        $stmt->bind_param("sii", $status, $task_id, $_SESSION['user_id']);

        if ($stmt->execute()) {
            header("Location: dashboard.php?status=updated");
            exit();
        } else {
            $error = "Failed to update task status. Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Task Status</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <h2>Update Task Status</h2>

    <form action="update_status.php" method="POST">
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>

        <label for="task_id">Task ID:</label>
        <input type="number" name="task_id" placeholder="Enter task ID" required>

        <label for="status">Status:</label>
        <select name="status" required>
            <option value="Pending">Pending</option>
            <option value="In Progress">In Progress</option>
            <option value="Completed">Completed</option>
        </select>

        <button type="submit">Update Status</button>
        <a href="dashboard.php">Cancel</a>
    </form>
</body>
</html>
