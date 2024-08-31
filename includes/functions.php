<?php
function sendResetEmail($email, $reset_link) {
    $subject = "Password Reset Request";
    $message = "Please click the following link to reset your password: " . $reset_link;
    $headers = "From: no-reply@yourdomain.com";

    mail($email, $subject, $message, $headers);
}
?>

<?php
