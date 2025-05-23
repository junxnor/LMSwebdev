<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $user_id = isset($_POST['user_id']) ? $_POST['user_id'] : '';
    $token_id = isset($_POST['token_id']) ? $_POST['token_id'] : '';
    $providedPassword = isset($_POST["Password"]) ? $_POST["Password"] : null;

    // Hash the provided password if it is not null
    $hashedPassword = $providedPassword ? password_hash($providedPassword, PASSWORD_DEFAULT) : null;

    // Database connection details
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

    // Query to fetch Token_Password from the database based on Token_ID
    $query = "SELECT Token_Password FROM token WHERE Token_ID = ?";
    $stmt = $conn->prepare($query);

    if (!$stmt) {
        die("Error in preparing statement: " . $conn->error);
    }

    $stmt->bind_param("i", $token_id);
    $stmt->execute();
    $stmt->bind_result($databasePassword);
    $stmt->fetch();

    // Debugging output
    var_dump($providedPassword, $databasePassword);

    // Check if both the database password and the provided password are null
    // Check if both the database password and the provided password are null or empty
if (($databasePassword === null || $databasePassword === '') && ($providedPassword === null || $providedPassword === '')) {
    // Both are null or empty, consider it as a correct password
    header("Location: /Group Assignment/Student Interface/View_Token.php?user_id=" . $user_id . "&Token_ID=" . $token_id);
    exit();
} elseif ($databasePassword !== null && $providedPassword !== null) {
    // Compare the passwords using password_verify()
    if (password_verify($providedPassword, $databasePassword)) {
        // Passwords match, redirect to View_Token.php with user_id and Token_ID
        header("Location: /Group Assignment/Student Interface/View_Token.php?user_id=" . $user_id . "&Token_ID=" . $token_id);
        exit();
    } else {
        // Passwords do not match, display an error message
        echo '<script> alert("Error: Password incorrect") </script>';
        echo '<script> history.go(-1) </script>';
        echo '<script>window.location.href = "/Group Assignment/Student Interface/Check_Token_Password.html";</script>';
    }
} else {
    // If either the database password or the provided password is null or empty
    echo '<script> alert("Error: Invalid password or token ID") </script>';
    echo '<script> history.go(-1) </script>';
    echo '<script>window.location.href = "/Group Assignment/Student Interface/Check_Token_Password.html";</script>';
}


    $stmt->close();

    // Close the connection
    $conn->close();
}
?>
