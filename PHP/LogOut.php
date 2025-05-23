<?php

session_start();

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

echo '<script>
        alert("Log Out Successfully.");
        window.location.href = "/Group Assignment/HomePage.html";
      </script>';
exit();
?>

