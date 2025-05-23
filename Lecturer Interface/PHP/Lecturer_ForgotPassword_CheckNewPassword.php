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
if (isset($_GET['email'])) {
    $emailencode = $_GET['email'];
    $email = base64_decode(urldecode($emailencode));
    

    
    // Now you have the $email variable in this script
} else {
    echo "Email not provided.";
}

// Check if the user is logged in
if (isset($_GET['email'])) {
    // Get the user_id from the session
    $emailencode = $_GET['email'];
    $email = base64_decode(urldecode($emailencode));

    $user_id = getUserIDFromDatabase($email, $conn);
    // Add the "TP" prefix if needed
    $prefixed_user_id = "TP" . $user_id;

    // Check if it's a POST request
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Check if the new passwords match 
        if ($_POST["NewUserPassword"] == $_POST["RetypeNewUserPassword"]) {
            // Hash the new password before storing
            $newPassword = password_hash($_POST["NewUserPassword"], PASSWORD_BCRYPT);

            // Update the password in the database
            $updatePasswordQuery = "UPDATE instructor_password SET Instructor_PASSWORD=? WHERE Instructor_USER_ID=?";
            $stmt = mysqli_prepare($conn, $updatePasswordQuery);
            mysqli_stmt_bind_param($stmt, "ss", $newPassword, $user_id);

            if (mysqli_stmt_execute($stmt)) {
                echo '<script> alert("Password updated successfully") </script>';
                echo '<script>window.location.href = "/Group Assignment/Lecturer Interface/LecturerLoginPage.html";</script>';
                    $_SESSION = array();

                    // Destroy the session
                    session_destroy();
            } else {
                echo '<script> alert("Error updating password: ")</script>' . mysqli_stmt_error($stmt);
                echo '<script>window.location.href = "/Group Assignment/Lecturer Interface/Lecturer_ForgotPassword_ChangePasswordPage.php?email=<?php urlencode(base64_encode($email)); ?>";</script>';
            }

            // Close the statement
            mysqli_stmt_close($stmt);
        } else {
            echo '<script> alert("New passwords do not match") </script>';
            echo '<script> history.go(-1) </script>';
            echo '<script>window.location.href = "/Group Assignment/Lecturer Interface/Lecturer_ForgotPassword_ChangePasswordPage.php?email=<?php echo urlencode(base64_encode($email)); ?>";</script>';

        }
    }
} else {
    echo '<script> alert("Email Not Found") </script>'; // Handle the case where the user is not logged in
    echo '<script>window.location.href = "/Group Assignment/Lecturer Interface/Lecturer_ForgotPassword_CheckEmail.html";</script>';
}

function getUserIDFromDatabase($email, $conn) {
    $stmt = $conn->prepare("SELECT Instructor_USER_ID FROM instructor_email WHERE Instructor_Email = ?");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Check if a row was returned
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['Instructor_USER_ID'];
    } else {
        return false;
    }
}

// Close the connection
mysqli_close($conn);
?>
