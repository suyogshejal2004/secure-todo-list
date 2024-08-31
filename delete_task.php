<?php
// Include authentication and database connection
include 'includes/auth.php'; // Ensure the user is authenticated
include 'includes/db.php';   // Database connection

// Check if task ID is provided in the URL
if (isset($_GET['task_id'])) {
    $task_id = intval($_GET['task_id']);  // Sanitize input
    $user_id = $_SESSION['user_id'];  // Get the user ID from the session

    // Debugging: Check the values (For development purposes)
    error_log("Task ID: $task_id");  // Log the task_id value
    error_log("User ID: $user_id");  // Log the user_id value

    // Check if the task exists for the current user
    $stmt = $conn->prepare("SELECT id FROM tasks WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $task_id, $user_id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Task exists, proceed with deletion
        $stmt->close();  // Close the previous statement

        $delete_stmt = $conn->prepare("DELETE FROM tasks WHERE id = ? AND user_id = ?");
        $delete_stmt->bind_param("ii", $task_id, $user_id);

        if ($delete_stmt->execute()) {
            if ($delete_stmt->affected_rows > 0) {
                // Redirect to the dashboard with a success message
                header("Location: dashboard.php?task=deleted");
                exit();
            } else {
                $error = "Task could not be deleted.";
                error_log("Task deletion failed. No rows affected."); // Log failure
            }
        } else {
            $error = "Failed to delete task. Please try again.";
            error_log("Error deleting task: " . $delete_stmt->error); // Log SQL errors
        }
        $delete_stmt->close();
    } else {
        // Task does not exist for the current user
        $error = "Task not found or you don't have permission to delete it.";
        error_log("Task not found for user or permissions issue."); // Log issue
    }

    $stmt->close();
} else {
    // Redirect to the dashboard with an error if no task ID is provided
    header("Location: dashboard.php?error=Invalid%20request");
    exit();
}
?>
