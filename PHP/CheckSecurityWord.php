<?php 
session_start();

// Database connection parameters
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'courseverse';

// Create a database connection
$conn = new mysqli($host, $username, $password, $database);

if (isset($_SESSION['user_id'])) {
    // Get the user_id from the session
    $user_id = $_SESSION['user_id'];

    // Add the "TP" prefix
    $prefixed_user_id = "TP" . $user_id;

    $SecurityWordFromDatabase = getSecurityWordFromDatabase($user_id, $conn);

}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the email and password from the form
    // $user_id = $_POST["user_id"]; // Assuming user_id is coming from your form
    $SecurityWord = $_POST["SecurityWord"];

    

    
    if ($SecurityWord && $SecurityWordFromDatabase !== false && $SecurityWord === $SecurityWordFromDatabase) {
        // Both values are the same, proceed to change password page
        echo '<script> alert("Security Word verification sucessfully.")</script>';
        header("Location: /Group Assignment/Student Interface/ChangePasswordPage.php");
        exit();
    } else {
        // Values do not match, handle the error
        echo '<script> alert("Security Word is incorrect.")</script>';
        echo '<script>history.go(-1);</script>'; // Go back to the previous page
        exit();
    }
    
    
}

function getSecurityWordFromDatabase($user_id, $conn) {
    $stmt = $conn->prepare("SELECT SecurityWord FROM userpassword WHERE USER_ID = ?");
    $stmt->bind_param('i', $user_id); // Assuming USER_ID is an integer
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Check if a row was returned
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['SecurityWord'];
    } else {
        return false;
    }
}

?>
