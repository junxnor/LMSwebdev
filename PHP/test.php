<?php
session_start();

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    // Get the user_id from the session
    $user_id = $_SESSION['user_id'];

    // Add the "TP" prefix
    $prefixed_user_id = "TP" . $user_id;

    // Display an alert with the prefixed user_id
    echo "<script>alert('Your Prefixed User ID: $prefixed_user_id');</script>";
}
?>