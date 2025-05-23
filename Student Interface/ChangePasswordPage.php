<?php
session_start();

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    // Get the user_id from the session
    $user_id = $_SESSION['user_id'];

    // Add the "TP" prefix
    $prefixed_user_id = "TP" . $user_id;

    // Display an alert with the prefixed user_id
    // echo "<script>alert('Your Prefixed User ID: $prefixed_user_id');</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
        <style>
        .Header {
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
        }


        .Header img {
            height: 50px;
            margin-bottom: -4px;
        }
        
        

        
    </style>
    <link rel="stylesheet" href="/Group Assignment/CSS/MenuBar.css">
    
</head>
<body>
    <script src="/Group Assignment/MenuBarAddClass.js" defer></script>
    <script>

        function CheckPassword() {
            
            let password = document.getElementById("Password");
            let retype_password = document.getElementById("RetypePassword").value;




            // Check if any required field is empty
            if (!password.value || !retype_password) {
                alert("Please fill in all required fields");
                return false; // Prevent form submission
            }

            if (password.value.length < 8) {
                alert("Password must be at least 8 characters long");
                return false; // Prevent form submission
            }

            if (!/[A-Z]/.test(password.value) || !/[a-z]/.test(password.value) || !/[!@#$%^&*(),.?":{}|<>]/.test(password.value)) {
                alert("Password must contain at least one uppercase, one lowercase, and one special character");
                return false; // Prevent form submission
            }

            if (password.value !== retype_password) {
                alert("Password does not match, Please Try Again");
                return false; // Prevent form submission
            }

            return true; // Allow form submission
        }

    </script>

    <div class="AllHeader">
        <div class="Header">
            <img src="/Group Assignment/Picture/logo.png" alt="Logo" style="height: 50px;">
            <h1>| CourseVerse</h1>
            <h1>| Welcome <?php echo $prefixed_user_id ?></h1>
        </div>
        <div class="SideBarButton">
            <button id="SideBarButton">&#9776</button>

        </div>

        <nav id="navBar">

            <div class="SideBar">
                <ul class="StudentButton">

                    <div class="SideBarButton-Close">
                        <button id="SideBarButtonClose">&#9776</button>
                    </div>

                    <li onclick="window.location.href='/Group Assignment/Student Interface/Profile.php'">Profile</li>
                </ul>
                    
                <ul class="LogOutButton">
                    <li onclick="window.location.href='/Group Assignment/HomePage.html'">Log Out</li>
                </ul>
            </div>
        </nav>

        <br>
        <br>
        <hr>
        <div class="Change-Password-Box">
            <form action="/Group Assignment/PHP/CheckNewPassword.php" method="post" onsubmit="return CheckPassword()">
            <label>New Password:</label>
            <input type="password" name="NewUserPassword" placeholder="Please enter a Password" id="Password" required><br>
            <label>Retype New Password:</label>
            <input type="password" name="RetypeNewUserPassword" placeholder="Please enter a Retype Password"
                id="RetypePassword" required><br>
            <button type="submit">Change Password</button>
        </form>
        </div>

    </div>
    <hr>
    
</body>
</html>