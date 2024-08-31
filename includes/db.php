<?php
$servername = "localhost";
$username = "root"; // Default XAMPP username
$password = ""; // Default XAMPP password is empty
$dbname = "todo_app";

// Create a new MySQLi connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    // Log error to file or system log
    error_log("Database connection failed: " . $conn->connect_error, 3, 'error.log');
    // Display a user-friendly message
    die("Oops! Something went wrong. Please try again later.");
}

// Connection successful
?>
