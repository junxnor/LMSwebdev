<?php
session_start();

// Database connection parameters
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'courseverse';

// Create a database connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the user is logged in
if (isset($_GET['user_id'])){
    // Get the user_id from the session
    $user_id = $_GET['user_id'];

    // Add the "TP" prefix if needed
    $prefixed_user_id = "TP" . $user_id;

    // Check if it's a POST request
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Check if the new first name is set in the POST data
        if (isset($_POST["NewEmail"])) {
            // Update the first name in the database
            $newEmail = $_POST["NewEmail"];
    
            $updateFirstNameQuery = "UPDATE instructor_email SET Instructor_Email=? WHERE Instructor_USER_ID=?";
            $stmt = mysqli_prepare($conn, $updateFirstNameQuery);
            mysqli_stmt_bind_param($stmt, "ss", $newEmail, $user_id);
    
            if (mysqli_stmt_execute($stmt)) {
                echo '<script> alert("Email updated successfully") </script>';
                echo '<script>window.location.href = "/Group Assignment/Admin/Admin_Student_Profile.php?user_id=' . $user_id . '";</script>';
            } else {
                echo '<script> alert("Error updating first name: ")</script>' . mysqli_stmt_error($stmt);
                echo '<script>window.location.href = "/Group Assignment/Admin/Change Lecturer/Change_Lecturer_Email.php?user_id=' . $user_id . '";</script>';
            }
    
            // Close the statement
            mysqli_stmt_close($stmt);
        } else {
            echo '<script> alert("New first name not provided") </script>';
            echo '<script> history.go(-1) </script>';
            echo '<script>window.location.href = "/Group Assignment/Admin/Change Lecturer/Change_Lecturer_Email.php?user_id=' . $user_id . '";</script>';
        }
    }
    else {
    echo '<script>alert("Invalid user ID.");</script>';
}
}

// Close the connection
mysqli_close($conn);
?>
