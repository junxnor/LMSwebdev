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
function getEmailFromDatabase($user_id, $conn) {
    $stmt = $conn->prepare("SELECT Email FROM email WHERE USER_ID = ?");
    $stmt->bind_param('s', $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Check if a row was returned
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['Email'];
    } else {
        return false;
    }
}
// Check if the user_id is set in the URL
if (isset($_GET['user_id']) && isset($_GET['Token_ID'])) {
    $user_id = $_GET['user_id'];
    $token_id = $_GET['Token_ID'];
    $email =getEmailFromDatabase($user_id, $conn);

    // Perform the delete operation
    $delete_query = "DELETE FROM token WHERE USER_ID = $user_id AND Token_ID = $token_id";
    $result = $conn->query($delete_query);

    // Check if the deletion was successful
    if ($result) {
        echo "<script>alert('Token deleted successfully');</script>";
        header("Location: /Group Assignment/Student Interface/Check_Token.php?email=" . urlencode(base64_encode($email)));
    } else {
        echo "<script>alert('Error deleting token');</script>";
        header("Location: /Group Assignment/Student Interface/Check_Token.php?email=" . urlencode(base64_encode($email)));
    }
} else {
    echo "<script>alert('Invalid user ID or token ID');</script>";
    echo "<script>window.history.back();</script>";
}

// Close the connection
$conn->close();
exit();
?>
