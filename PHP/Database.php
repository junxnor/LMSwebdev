
<?php
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

// SQL query to retrieve USER_ID from the 'user' table and add the prefix 'TP'
$sql = "SELECT u.USER_ID, CONCAT('TP', u.USER_ID) AS TP_USER_ID, other_table.column_name
        FROM user u
        LEFT JOIN other_table ON u.user_id = other_table.user_id";

// Execute the query
$result = $conn->query($sql);

// Check if the query was successful
if ($result === FALSE) {
    die("Error: " . $conn->error);
}

// Fetch the result
while ($row = $result->fetch_assoc()) {
    $user_id = $row['USER_ID'];
    $tp_user_id = $row['TP_USER_ID'];
    $other_column = $row['column_name'];

    // Display or use the retrieved values
    echo "User ID: $user_id, TP User ID: $tp_user_id, Other Column: $other_column<br>";
}

// Close the connection
$conn->close();

?>

