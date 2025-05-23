<?php
// download.php

// Assuming you have a file path passed as a parameter
$file_path = $_GET['file_path'];

// Check if the file path is provided and valid
if (isset($file_path) && file_exists($file_path)) {
    // Set the Content-Disposition header
    header('Content-Disposition: attachment; filename="' . basename($file_path) . '"');
    // Output the file content
    readfile($file_path);
    exit();
} else {
    // Handle error if file path is not valid
    echo 'File not found.';
}
?>
