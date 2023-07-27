<?php
// Start a session or resume the current session
session_start();

// If the user clicked the logout button
if (isset($_POST['logout'])) {
    // Clear all session variables
    session_unset();

    // Destroy the session
    session_destroy();

    // Redirect to the login page after logout
    header("Location: ../index.html");
    exit();
}
?>