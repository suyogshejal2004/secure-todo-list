<?php
include 'includes/db.php'; // Include your database connection file

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Check if the token exists and is valid
    $stmt = $conn->prepare("SELECT user_id FROM email_verifications WHERE token = ? AND created_at > NOW() - INTERVAL 1 DAY");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($user_id);
        $stmt->fetch();

        // Update user's email_verified status
        $stmt = $conn->prepare("UPDATE users SET email_verified = 1 WHERE id = ?");
        $stmt->bind_param("i", $user_id);
        if ($stmt->execute()) {
            // Delete the verification token
            $stmt = $conn->prepare("DELETE FROM email_verifications WHERE token = ?");
            $stmt->bind_param("s", $token);
            $stmt->execute();

            echo "Your email has been verified successfully!";
        } else {
            echo "Failed to verify email. Please try again.";
        }
    } else {
        echo "Invalid or expired verification token.";
    }
} else {
    echo "No verification token provided.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Email Verification</title>
</head>
<body>
    <a href="index.php">Go to Login</a>
</body>
</html>
