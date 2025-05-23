<?php
session_start();

// Database connection parameters
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'courseverse';

// Create a database connection
$conn = new mysqli($host, $username, $password, $database);

if (isset($_GET['user_id']) && isset($_GET['token_id'])) {
    // Get the user_id and token_id from the query parameters
    $user_id = $_GET['user_id'];
    $token_id = $_GET['token_id'];


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $answer = $_POST["Answer"];

        // Insert data into the database
        $stmt = $conn->prepare("UPDATE token SET Token_Answer = ? WHERE Token_ID = ? AND Instructor_USER_ID = ?");
        $stmt->bind_param("sii", $answer, $token_id, $user_id);

        if ($stmt->execute()) {
            // Data inserted successfully, show alert and redirect
            echo '<script>alert("Data inserted successfully");</script>';
            // Redirect to Admin_View_Student_Token.php with user_id parameter
            echo '<script>window.location.href = "/Group Assignment/Admin/Lecturer Token/Admin_View_Lecturer_Token.php?user_id=' . $user_id .'&token_id=' . $token_id .  '";</script>';
            exit();
        } else {
            echo '<script>alert("Error: ' . $stmt->error . '");</script>';

            echo '<script> history.go(-1) </script>';
            echo '<script>window.location.href = "/Group Assignment/Admin/Lecturer Token/Admin_Lecturer_Token.php?user_id=' . $user_id . '&token_id=' . $token_id . '";</script>';
        }

        // Close the statement
        $stmt->close();
    }
}

// Close the connection
$conn->close();
?>
