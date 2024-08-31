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

/* Form Container */
form {
    max-width: 500px;
    margin: 30px auto;
    padding: 20px;
    background-color: #fff;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
}

/* Form Elements */
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
    resize: vertical;
    min-height: 80px;
}

label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
    color: #333;
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

.error {
    color: #e74c3c;
    font-size: 14px;
    margin-bottom: 15px;
    text-align: center;
}

/* Link Style */
a.button {
    display: inline-block;
    width: calc(50% - 10px);
    text-align: center;
    padding: 10px;
    background-color: #f0f2f5;
    border: 1px solid #ddd;
    border-radius: 5px;
    color: #333;
    font-size: 16px;
    margin-top: 10px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    text-decoration: none;
}

a.button:hover {
    background-color: #ddd;
}



    </style>
</head>
<?php
include 'includes/auth.php'; // Ensure user is authenticated
include 'includes/db.php';

$user_id = $_SESSION['user_id'];

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
        // Insert task into the database
        $stmt = $conn->prepare("INSERT INTO tasks (user_id, title, description, category, due_date, status) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssss", $user_id, $title, $description, $category, $due_date, $status);

        if ($stmt->execute()) {
            header("Location: dashboard.php?task=added");
            exit();
        } else {
            $error = "Failed to add task. Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Task</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <h2>Add New Task</h2>
    
    <form action="add_task.php" method="POST">
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
        
        <input type="text" name="title" placeholder="Task Title" required>
        <textarea name="description" placeholder="Task Description"></textarea>
        
        <label for="category">Category:</label>
        <select name="category" required>
            <option value="Work">Work</option>
            <option value="Personal">Personal</option>
        </select>
        
        <label for="due_date">Due Date:</label>
        <input type="date" name="due_date" required>
        
        <label for="status">Status:</label>
        <select name="status" required>
            <option value="Pending">Pending</option>
            <option value="In Progress">In Progress</option>
            <option value="Completed">Completed</option>
        </select>
        
        <button type="submit">Add Task</button>
        <a href="dashboard.php">Cancel</a>
    </form>
</body>
</html>
