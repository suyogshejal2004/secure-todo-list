<head>
    <style>
/* assets/css/styles.css */

body {
    font-family: Arial, sans-serif;
    background-color: #f0f2f5;
    color: #333;
    margin: 0;
    padding: 0;
}

h2 {
    text-align: center;
    color: #4a90e2;
    margin-top: 20px;
}

a {
    text-decoration: none;
    color: #4a90e2;
    margin-right: 10px;
}

a:hover {
    color: #0066cc;
}

.task-list {
    max-width: 800px;
    margin: 30px auto;
    padding: 20px;
    background-color: #fff;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
}

.task-list h3 {
    border-bottom: 2px solid #4a90e2;
    padding-bottom: 10px;
    margin-bottom: 20px;
    color: #4a90e2;
}

.task-list ul {
    list-style: none;
    padding: 0;
}

.task-list li {
    border: 1px solid #ddd;
    padding: 15px;
    margin-bottom: 15px;
    border-radius: 5px;
    background-color: #f9f9f9;
    transition: background-color 0.3s ease;
}

.task-list li:hover {
    background-color: #f0f0f0;
}

.task-list h4 {
    margin: 0 0 10px;
    color: #333;
}

.task-list p {
    margin: 5px 0;
    color: #666;
}

.task-list a {
    color: #4a90e2;
    font-size: 14px;
}

.task-list a:hover {
    color: #0066cc;
}

.task-list a:last-child {
    margin-left: 15px;
    color: #e74c3c;
}

.task-list a:last-child:hover {
    color: #c0392b;
}

button, a.button {
    display: inline-block;
    padding: 10px 15px;
    margin: 10px 0;
    font-size: 16px;
    border: none;
    border-radius: 5px;
    background-color: #4a90e2;
    color: #fff;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button:hover, a.button:hover {
    background-color: #0066cc;
}


</style>

</head>
<?php
include 'includes/auth.php';
include 'includes/db.php';

$user_id = $_SESSION['user_id'];

// Fetch tasks for the logged-in user
$stmt = $conn->prepare("SELECT * FROM tasks WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$tasks = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <script src="assets/js/main.js"></script>
</head>
<body>
    <h2>Welcome to your Dashboard</h2>
    <a href="add_task.php">Add Task</a>
    <a href="logout.php">Logout</a>

    <div class="task-list">
        <h3>Your Tasks</h3>
        <ul>
            <?php foreach ($tasks as $task): ?>
                <li>
                    <h4><?php echo $task['title']; ?></h4>
                    <p><?php echo $task['description']; ?></p>
                    <p>Category: <?php echo $task['category']; ?></p>
                    <p>Status: <?php echo $task['status']; ?></p>
                    <a href="edit_task.php?id=<?php echo $task['id']; ?>">Edit</a>
                    <a href="delete_task.php?id=<?php echo $task['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>
</html>
