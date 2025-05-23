<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

function getUserIdFromDatabase($email, $conn) {
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

// Database connection parameters
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["Email"];
    $subject = $_POST["Subject"];
    $question = $_POST["Question"];
    $raw_password = isset($_POST["Password"]) ? $_POST["Password"] : null;
    $user_id = getUserIdFromDatabase($email, $conn);

    // Hash the password if it is provided
    $hashed_password = $raw_password ? password_hash($raw_password, PASSWORD_DEFAULT) : null;

    // Process file upload if a file is provided
    if (isset($_FILES["File"]) && $_FILES["File"]["error"] === UPLOAD_ERR_OK) {
        $file_tmp = $_FILES["File"]["tmp_name"];
        $file_content = file_get_contents($file_tmp); // Read file content
    } else {
        if (isset($_FILES["File"])) {
            $error_message = "Error uploading file: " . $_FILES["File"]["error"];
            echo $error_message;
        } else {
            $file_content = null;
        }
    }

    // SQL query to insert data into the database
    $sql = "INSERT INTO token (USER_ID, Email, Token_Name, Token_Question, Token_Files, Token_Password) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Check if the statement was prepared successfully
    if ($stmt) {
        // Bind parameters with their corresponding types
        if ($file_content !== null) {
            // File content is provided, bind as a blob
            $stmt->bind_param("isssss", $user_id, $email, $subject, $question, $file_content, $hashed_password);
        } else {
            // File content is null, bind as a string (or adjust to the appropriate type)
            $stmt->bind_param("isssss", $user_id, $email, $subject, $question, $file_content, $hashed_password);
        }

        // Execute the statement
        if ($stmt->execute()) {
            // Retrieve the last inserted ID
            $last_inserted_id = $conn->insert_id;

            // Redirect to View_Token.php with user_id and token_id
            echo '<script>';
            echo 'alert("Data inserted successfully");';
            echo 'window.location.href = "/Group Assignment/Student Interface/View_Token.php?user_id=' . $user_id . '&Token_ID=' . $last_inserted_id . '";';
            echo '</script>';
        } else {
            echo 'Error executing statement: ' . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        // Handle the case where the statement was not prepared successfully
        echo 'Error preparing statement: ' . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
