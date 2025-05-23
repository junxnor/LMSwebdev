<?php 
session_start();

// Database connection parameters
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'courseverse';

// Create a database connection
$conn = new mysqli($host, $username, $password, $database);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $GetAdminPassword = $_POST['LecturerPassword'];
    $AdminPassword = "Lecturer123"; // Change to the actual correct password

    if ($GetAdminPassword == $AdminPassword){
        echo '<script> alert("Welcome User") </script>';
        echo '<script>window.location.href = "/Group Assignment/Lecturer Interface/LecturerLoginPage.html";</script>';
    } else {
        echo '<script> alert("Passwords do not match") </script>';
        echo '<script> history.go(-1) </script>';
        echo '<script>window.location.href = "/Group Assignment/Lecturer Interface/Lecturer_verification.html";</script>';
    }
}

// Close the connection
mysqli_close($conn);
?>
