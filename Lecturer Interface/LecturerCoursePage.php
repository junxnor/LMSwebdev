<?php
session_start();

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    // Get the user_id from the session
    $user_id = $_SESSION['user_id'];

    // Add the "TP" prefix
    $prefixed_user_id = "L" . $user_id;

    // Display an alert with the prefixed user_id
    // echo "<script>alert('Your Prefixed User ID: $prefixed_user_id');</script>";
} else {
    // User is not logged in, redirect to login page
    header("Location: /Group Assignment/Lecturer interface/LecturerLoginPage.html");
    exit(); // Make sure to stop the script execution after redirecting
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

        .Course-Box {
            display: flex;
            justify-content: flex-start;
            flex-wrap: wrap; /* Allow items to wrap to the next row */
        }

        .Box-1,
        .Box-2 {
            width: 250px;
            height: 300px;
            border: 1px solid black;
            margin: 10px 10px 0 0px;
            position: relative;
        }

        .Logo-1,
        .Box-1 input,
        .Box-1 h4,
        .Logo-2,
        .Box-2 h4 {
            justify-content: center;
        }

        .Logo-1 {
            width: 100px;
            padding-left: 60px;
            padding-top: 30px;
        }

        .Box-1 input {
            margin: 35px 44px 20px 35px;
            padding-top: 10px;
            padding-bottom: 10px;
            text-align: center;
        }

        .Logo-2 img {
            margin: 20px 0px 0px 45px;
            width: 150px;
        }

        .Create-Course-Button,
        .Box-2 progress {
            margin: 35px 44px 20px 35px;
            padding-top: 10px;
            padding-bottom: 10px;
            text-align: center;
        }

        .Create-Course-Button button {
            padding: 10px;
            background-color: rgb(57, 111, 227);
        }

        .Course-Box1-Text,
        .Box-1 h4,
        .Box-2 h4 {
            padding-top: 5px;
            text-align: center;
        }

        .Math-1 img {
            width: 250px;
        }

        .Box-2 progress {
            align-items: center;
            width: 240px;
            margin-left: 10px;
        }
    </style>
    <link rel="stylesheet" href="/Group Assignment/CSS/MenuBar.css">
</head>

<body>
    <script src="/Group Assignment/MenuBarAddClass.js" defer></scriptsrc></script>
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

                    <li onclick="window.location.href='/Group Assignment/Lecturer Interface/Lecturer_ProfilePage.php'">Profile</li>
                </ul>

                <ul class="LogOutButton">
                    <li onclick="window.location.href='/Group Assignment/PHP/LogOut.php'">Log Out</li>
                </ul>
            </div>
        </nav>

    </div>
    <br>
    <br>
    <hr>
    <h3>Course Overview</h3>
    <select name="Course View" required><br>
        <option value="All Course">All Course</option>
        <option value="In progress Course">In Progress Course</option>
        <option value="Pass Course">Pass Course</option>
        <option value="Future Course">Future Course</option>
        <br>
        <option value="Pinned Course">Pinned Course</option>
        <br>
        <option value="Course Removed From View">Course Removed From View</option>
    </select>
    <div class="Course-Box">
        <div class="Box-1">
            <div class="Logo-1">
                <img src="/Group Assignment/Picture/Course-logo.png" alt="Course-logo">
            </div>
            <br>
            <div class="Course-Box1-Text">
                <h4>Welcome Back</h4>
            </div>
        </div>

        <div class="Box-2">
            <div class="Logo-2">
                <img src="/Group Assignment/Picture/Create-Group-Lecturer-Course.png" alt="Logo Create Group">
            </div>
            <br>
            <div class="Course-Box1-Text">
                <h4>Your courses will be displayed</h4>
            </div>
            <div class="Create-Course-Button">
            </div>
        </div>

        <div class="Box-1" onclick="window.location.href='/Group%20Assignment/Uploads/Module_1/LecturerModule1.html'">
            <div class="Math-1">
                <img src="/Group Assignment/Picture/Math Module.jpeg" alt="Picture of Module-Math">
            </div>
            <h4>Module 1</h4>
            <center><label>Your Progress: </label></center>
            <progress id="Math-1-Progress" value="0" max="100">

            </progress>
        </div>
        <br>

        <div class="Box-1" onclick="window.location.href='/Group%20Assignment/Uploads/Module_2/LecturerModule2.html'">
            <div class="Math-1">
                <img src="/Group Assignment/Picture/Math Module.jpeg" alt="Picture of Module-Math">
            </div>
            <h4>Module 2</h4>
            <center><label>Your Progress: </label></center>
            <progress id="Math-1-Progress" value="0" max="100">

            </progress>
        </div>

        <div class="Box-1" onclick="window.location.href='/Group%20Assignment/Uploads/Module_3/LecturerModule3.html'">
            <div class="Math-1">
                <img src="/Group Assignment/Picture/Math Module.jpeg" alt="Picture of Module-Math">
            </div>
            <h4>Module 3</h4>
            <center><label>Your Progress: </label></center>
            <progress id="Math-1-Progress" value="0" max="100">

            </progress>
        </div>

        <div class="Box-1" onclick="window.location.href='/Group%20Assignment/Uploads/Module_4/LecturerModule4.html'">
            <div class="Math-1">
                <img src="/Group Assignment/Picture/Math Module.jpeg" alt="Picture of Module-Math">
            </div>
            <h4>Module 4</h4>
            <center><label>Your Progress: </label></center>
            <progress id="Math-1-Progress" value="0" max="100">

            </progress>
        </div>
    </div>
</body>

</html>
