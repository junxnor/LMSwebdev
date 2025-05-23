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

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the email and password from the form
    $email = $_POST["Email"];
    $password = $_POST["password"];

    // Hash the password before storing it in the database
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // During login
    // Retrieve $USER_ID from the database based on the provided email
    $USER_ID = getUserIDFromDatabase($email, $conn);

    // Check if the entered email exists in the 'email' table
    if ($USER_ID !== false) {
        // Retrieve hashed password from the 'userpassword' table based on USER_ID
        $hashedPasswordFromDatabase = getPasswordFromDatabase($USER_ID, $conn);

        // Check if the entered password matches the stored hash
        if ($hashedPasswordFromDatabase !== false && password_verify($password, $hashedPasswordFromDatabase)) {
            
            $_SESSION['user_id'] = $USER_ID;
            // Passwords match, proceed with login
            echo "Login successful!";
            // You can redirect the user to another page or perform additional actions here
            echo '<script>window.location.href = "/Group Assignment/Student Interface/Course.php";</script>';
        } else {
            // Passwords do not match, handle the error
            echo '<script> alert("Login failed. Please check your email and password.")';
            echo '<script> history.go(-1) </script>';
            echo '<script>window.location.href = "/Group Assignment/Student Interface/LoginPage.html";</script>';
            exit();
            // echo "Login failed. Please check your email and password.";
            // echo '<script> alert("Error: Email already exists!") </script>';
            // echo '<script> history.go(-1) </script>';
        }
    } else {
        // User with the provided email does not exist
        echo "Login failed. Email not found.";
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

// Function to retrieve hashed password from the database based on USER_ID
function getPasswordFromDatabase($USER_ID, $conn) {
    $stmt = $conn->prepare("SELECT PASSWORD FROM userpassword WHERE USER_ID = ?");
    $stmt->bind_param('i', $USER_ID); // Assuming USER_ID is an integer
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Check if a row was returned
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['PASSWORD'];
    } else {
        return false;
    }
}


// if ($_SESSION['getUserIDFromDatabase'] == $email && $_SESSION['getPasswordFromDatabase'] == $password) {
//     // echo '<script>window.location.href = "/Group Assignment/Student Interface/Course.html";</script>';
//     echo '<script>window.location.href = "test.php";</script>';
//     exit;
// } else {
//     # code...
//     echo "Error: " . $sql . "<br>" . $conn->error;
// }

?>
