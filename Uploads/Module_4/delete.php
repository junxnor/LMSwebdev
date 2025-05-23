<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the 'id' parameter is set
    if (isset($_POST['id'])) {
        // Database connection details
        $db_host = "localhost";
        $db_user = "root";
        $db_pass = "";
        $db_name = "courseverse";

        // Create a new mysqli connection
        $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

        // Check the connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Sanitize the 'id' parameter
        $id = $conn->real_escape_string($_POST['id']);

        // Delete the file from the database (using "module4" instead of "module3")
        $delete_query = "DELETE FROM `module4` WHERE `ID`='$id'";
        $delete_result = $conn->query($delete_query);

        // Display the alert and redirect
        if ($delete_result) {
            echo "<script>alert('File deleted successfully.'); window.location.href = '/GROUP ASSIGNMENT/Uploads/Module_4/LecturerUploadSlides.php';</script>";
        } else {
            $error_message = $conn->error;
            echo "<script>alert('Error deleting file: $error_message'); window.location.href = '/GROUP ASSIGNMENT/Uploads/Module_4/LecturerUploadSlides.php';</script>";
        }

        // Close the database connection
        $conn->close();
    } else {
        echo "<script>alert('Invalid request. Please try again.'); window.location.href = '/GROUP ASSIGNMENT/Uploads/Module_4/LecturerUploadSlides.php';</script>";
    }
} else {
    echo "<script>alert('Invalid request method. Please try again.'); window.location.href = '/GROUP ASSIGNMENT/Uploads/Module_4/LecturerUploadSlides.php';</script>";
}
?>

</body>
</html>

