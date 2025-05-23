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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the email from the form
    $email = $_POST["Email"];


    // Retrieve $USER_ID from the database based on the provided email
    $USER_ID = getUserIDFromDatabase($email, $conn);

    // Check if the entered email exists in the 'email' table
    if ($USER_ID !== false) {
        echo "Email verification successful";
        // echo '<script>window.location.href = "/Group Assignment/Student Interface/ForgotPasswordCheckSecurityWord.php";</script>';
        header("Location: /Group Assignment/Admin/Admin_ForgotPassword_CheckSecurityWord.php?email=" . urlencode(base64_encode($email)));

    } else {
        // User with the provided email does not exist
        echo "Error: Email not found.";
        echo '<script> history.go(-1) </script>';
        echo '<script>window.location.href = "/Group Assignment/Admin/CheckEmail.html";</script>';
    }

}


// Function to retrieve USER_ID from the database based on email
function getUserIDFromDatabase($email, $conn) {
    $stmt = $conn->prepare("SELECT Admin_USER_ID FROM admin_email WHERE Admin_Email = ?");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Check if a row was returned
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['Admin_USER_ID'];
    } else {
        return false;
    }
}
?>