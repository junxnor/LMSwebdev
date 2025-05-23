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
        header("Location: /Group Assignment/Student Interface/Check_Token.php?email=" . urlencode(base64_encode($email)));

    } else {
        // User with the provided email does not exist
        echo "Error: Email not found.";
        echo '<script> history.go(-1) </script>';
        echo '<script>window.location.href = "/Group Assignment/Student Interface/Email_Token.html";</script>';
    }

}


// Function to retrieve USER_ID from the database based on email
function getUserIDFromDatabase($email, $conn) {
    $stmt = $conn->prepare("SELECT USER_ID FROM email WHERE Email = ?");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Check if a row was returned
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['USER_ID'];
    } else {
        return false;
    }
}
?>