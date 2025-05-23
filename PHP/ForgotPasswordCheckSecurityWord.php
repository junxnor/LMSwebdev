<?php
session_start();


// Database connection parameters
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'courseverse';

// Create a database connection
$conn = new mysqli($host, $username, $password, $database);

// Initialize the variable outside the conditional block
// $SecurityWordFromDatabase = null;

if (isset($_GET['email'])) {
    $emailencode = $_GET['email'];
    $email = base64_decode(urldecode($emailencode));

    

    $USER_ID = getUserIDFromDatabase($email, $conn);
    // Now you have the $email variable in this script


    $SecurityWordFromDatabase = getSecurityWordFromDatabase($USER_ID, $conn);
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the email and password from the form
    // $user_id = $_POST["user_id"]; // Assuming user_id is coming from your form
    $SecurityWord = $_POST["SecurityWord"];

    

    
    if ($SecurityWord !== false && $SecurityWordFromDatabase !== false && $SecurityWord === $SecurityWordFromDatabase && $SecurityWord !== null && $SecurityWord !== '') {
        
        // Both values are the same, proceed to change password page
        header("Location: /Group Assignment/Student Interface/ForgotPasswordChangePasswordPage.php?email=" . urlencode(base64_encode($email)));
        exit();

    } else {
        // Values do not match, handle the error
        echo '<script> alert("Security Word is incorrect.")</script>';
        echo '<script>history.go(-1);</script>'; // Go back to the previous page
        exit();
    }
    
    
}
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

function getSecurityWordFromDatabase($USER_ID, $conn) {
    $stmt = $conn->prepare("SELECT SecurityWord FROM userpassword WHERE USER_ID = ?");
    $stmt->bind_param('i', $USER_ID); // Assuming USER_ID is an integer
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
