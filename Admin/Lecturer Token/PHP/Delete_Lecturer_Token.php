<?php
session_start();
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'courseverse';

// Create a database connection
$conn = new mysqli($host, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the user_id is set in the URL
if (isset($_GET['user_id']) && isset($_GET['token_id'])) {
    $user_id = $_GET['user_id'];
    $token_id = $_GET['token_id'];

    // Perform the delete operation
    $delete_query = "DELETE FROM token WHERE Instructor_USER_ID = $user_id AND Token_ID = $token_id";
    $result = $conn->query($delete_query);

    // Check if the deletion was successful
    if ($result) {
        echo "<script>alert('Token deleted successfully');</script>";
        echo "<script>window.location.href = '/Group Assignment/Admin/Lecturer Token/Manage_Lecturer_Token.php';</script>";
    } else {
        echo "<script>alert('Error deleting token');</script>";
        echo "<script>window.location.href = '/Group Assignment/Admin/Lecturer Token/Manage_Lecturer_Token.php';</script>";
    }
} else {
    echo "<script>alert('Invalid user ID or token ID');</script>";
    echo "<script>window.location.href = '/Group Assignment/Admin/Lecturer Token/Manage_Lecturer_Token.php';</script>";
}

// Close the connection
$conn->close();
exit();
?>
