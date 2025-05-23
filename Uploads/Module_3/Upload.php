<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if a file was uploaded without errors
    if (isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {
        $target_dir = "uploads/"; // Change this to the desired directory for uploaded files
        $target_file = $target_dir . basename($_FILES["file"]["name"]);
        $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if the file is allowed (you can modify this to allow specific file types)
        $allowed_types = array("jpg", "jpeg", "png", "gif", "pdf", "docx");

        if (!in_array($file_type, $allowed_types)) {
            // Display the alert for invalid file type
            displayAlert('Sorry, only JPG, JPEG, PNG, GIF, and PDF files are allowed.');
        } else {
            // Move the uploaded file to the specified directory
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                // File upload success, now store information in the database
                $filename = $_FILES["file"]["name"];
                $filesize = $_FILES["file"]["size"];
                $filetype = $_FILES["file"]["type"];

                // Database connection
                $db_host = "localhost";
                $db_user = "root";
                $db_pass = "";
                $db_name = "courseverse";

                $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Insert the file information into the database (using "module1" instead of "files")
                $sql = "INSERT INTO module3 (filename, filesize, filetype) VALUES ('$filename', $filesize, '$filetype')";

                if ($conn->query($sql) === TRUE) {
                    // Display a success message with JavaScript
                    displayAlert("The file $filename has been uploaded and the information has been stored in the database.");
                } else {
                    // Display the alert for database error
                    displayAlert("Sorry, there was an error uploading your file and storing information in the database: " . $conn->error);
                }

                $conn->close();
            } else {
                // Display the alert for file upload error
                displayAlert('Sorry, there was an error uploading your file.');
            }
        }
    } else {
        // Display the alert for no file uploaded
        displayAlert('No file was uploaded.');
    }
}

// Function to display JavaScript alert and redirect to index.php
function displayAlert($message) {
    echo "<script>alert('$message'); window.location.href = 'LecturerUploadSlides';</script>";
}
?>

</body>
</html>
