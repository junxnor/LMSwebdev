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
if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];

    // Perform the delete operation
    $delete_query = "DELETE FROM instructor WHERE Instructor_USER_ID = $user_id";
    $result = $conn->query($delete_query);

    // Check if the deletion was successful
    if ($result) {
        echo "<script>alert('User deleted successfully');</script>";
        echo "<script>
                setTimeout(function(){
                    window.location.href = '/Group Assignment/Admin/Manage_Lecturer_Account.php';
                }, 1000); // Redirect after 1 second
              </script>";
    } else {
        echo "<script>alert('Error deleting user');</script>";
        echo "<script>
                setTimeout(function(){
                    window.location.href = '/Group Assignment/Admin/Manage_Lecturer_Account.php';
                }, 1000); // Redirect after 1 second
              </script>";
    }
} else {
    echo "<script>alert('Invalid user ID');</script>";
    echo "<script>
            setTimeout(function(){
                window.location.href = '/Group Assignment/Admin/Manage_Lecturer_Account.php';
            }, 1000); // Redirect after 1 second
          </script>";
}

// Close the connection
$conn->close();

exit();
?>
