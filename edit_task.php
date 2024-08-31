<head>
    <style>

      /* assets/css/styles.css */

/* General Styles */
body {
    font-family: Arial, sans-serif;
    background-color: #f0f2f5;
    color: #333;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

h2 {

    color: #4a90e2;

    margin-bottom: 90px; 
    margin-top: 20px; 
    text-align: center;
}


form {
    max-width: 500px;
    width: 100%;
    padding: 20px;
    background-color: #fff;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    margin: 0 auto;
}

input[type="text"],
input[type="date"],
textarea,
select {
    width: calc(100% - 22px);
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 14px;
    background-color: #f9f9f9;
    color: #333;
}

textarea {
    height: 100px;
    resize: vertical;
}

button {
    width: 100%;
    padding: 10px;
    background-color: #4a90e2;
    border: none;
    border-radius: 5px;
    color: #fff;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #0066cc;
}

a {
    color: #4a90e2;
    text-decoration: none;
    display: inline-block;
    margin-top: 15px;
    font-size: 14px;
}

a:hover {
    text-decoration: underline;
}

.error {
    color: #e74c3c;
    font-size: 14px;
    margin-bottom: 15px;
}

    </style>
</head>
<?php
include 'includes/auth.php'; // Ensure user is authenticated
include 'includes/db.php';

$user_id = $_SESSION['user_id'];

if (isset($_GET['id'])) {
    $task_id = $_GET['id'];

    // Fetch the task details
    $stmt = $conn->prepare("SELECT title, description, category, due_date, status FROM tasks WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $task_id, $user_id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($title, $description, $category, $due_date, $status);
        $stmt->fetch();
    } else {
        $error = "Task not found or you do not have permission to edit this task.";
    }
} else {
    $error = "No task ID provided.";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $due_date = $_POST['due_date'];
    $status = $_POST['status'];

    // Validate form data
    if (empty($title) || empty($category) || empty($due_date) || empty($status)) {
        $error = "All fields are required.";
    } else {
        // Update task in the database
        $stmt = $conn->prepare("UPDATE tasks SET title = ?, description = ?, category = ?, due_date = ?, status = ? WHERE id = ? AND user_id = ?");
        $stmt->bind_param("ssssssi", $title, $description, $category, $due_date, $status, $task_id, $user_id);

        if ($stmt->execute()) {
            header("Location: dashboard.php?task=updated");
            exit();
        } else {
            $error = "Failed to update task. Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Task</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <h2>Edit Task</h2>
    
    <form action="edit_task.php?id=<?php echo htmlspecialchars($task_id); ?>" method="POST">
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
        
        <input type="text" name="title" placeholder="Task Title" value="<?php echo htmlspecialchars($title); ?>" required>
        <textarea name="description" placeholder="Task Description"><?php echo htmlspecialchars($description); ?></textarea>
        
        <label for="category">Category:</label>
        <select name="category" required>
            <option value="Work" <?php echo $category == 'Work' ? 'selected' : ''; ?>>Work</option>
            <option value="Personal" <?php echo $category == 'Personal' ? 'selected' : ''; ?>>Personal</option>
        </select>
        
        <label for="due_date">Due Date:</label>
        <input type="date" name="due_date" value="<?php echo htmlspecialchars($due_date); ?>" required>
        
        <label for="status">Status:</label>
        <select name="status" required>
            <option value="Pending" <?php echo $status == 'Pending' ? 'selected' : ''; ?>>Pending</option>
            <option value="In Progress" <?php echo $status == 'In Progress' ? 'selected' : ''; ?>>In Progress</option>
            <option value="Completed" <?php echo $status == 'Completed' ? 'selected' : ''; ?>>Completed</option>
        </select>
        
        <button type="submit">Update Task</button>
        <a href="dashboard.php">Cancel</a>
    </form>
</body>
</html>
