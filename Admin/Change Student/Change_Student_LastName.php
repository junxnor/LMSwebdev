<?php
session_start();

// Check if the user is logged in
if (isset($_GET['user_id'])) {
    // Get the user_id from the session
    $user_id = $_GET['user_id'];

    // Add the "TP" prefix
    $prefixed_user_id = "TP" . $user_id;

    // Display an alert with the prefixed user_id
    // echo "<script>alert('Your Prefixed User ID: $prefixed_user_id');</script>";
}else {
    echo '<script>alert("Invalid user ID.");</script>';
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

                    <li onclick="window.location.href='/Group Assignment/Admin/Profile.php'">Profile</li>
                </ul>
                    
                <ul class="LogOutButton">
                    <li onclick="window.location.href='/Group Assignment/PHP/LogOut.php'">Log Out</li>
                </ul>
            </div>
        </nav>

        <br>
        <br>
        <hr>
        <div class="Change-Password-Box">
            <form action="/Group Assignment/Admin/Change Student/PHP/Change_Student_LastName.php?user_id=<?php echo $user_id?>" method="post" onsubmit="return CheckPassword()">
            <label>New Last Name:</label>
            <input type="text" name="NewLastName" placeholder="Please enter a New Last Name" id="LastName" required><br>
            <br>
            <button type="submit">Change</button>
        </form>
        </div>

    </div>
    <hr>
    <br>
    <br>
    <div class="Back-Button">
        <button onclick="window.location.href='/Group Assignment/Admin/Manage_Student_Account.php'">Back</button>
    </div>
</body>
</html>