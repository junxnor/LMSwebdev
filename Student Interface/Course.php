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
}else {
    // User is not logged in, redirect to login page
    header("Location: /Group Assignment/Student interface/LoginPage.html");
    exit(); // Make sure to stop the script execution after redirecting
}
?>


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

        }

        .Box-1 {
            width: 250px;
            height: 300px;
            border: 1px solid black;
            margin: 10px 10px 0 0px;
            position: relative;


        }

        .Logo-1,
        .Box-1 input,
        .Box-1 h4 {
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

        .Box-1 h4 {
            padding-top: 5px;
            text-align: center;
        }


        .Box-2 {
            width: 250px;
            height: 300px;
            border: 1px solid black;
            margin: 10px 15px 0 0px;
            position: relative;
            pointer-events: all;
            cursor: pointer;

        }

        .Math-1 img {
            width: 250px;
        }

        .Box-2 progress {
            align-items: center;
            width: 240px;
            margin-left: 5px;

        }

        .Box-2 h4 {
            padding-top: 5px;
            text-align: center;

        }

        
    </style>
    <link rel="stylesheet" href="/GROUP ASSIGNMENT/CSS/MenuBar.css">
</head>
<body>
    <script src="/GROUP ASSIGNMENT/MenuBarAddClass.js" defer></script>

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
                    <li onclick="window.location.href='/Group Assignment/PHP/LogOut.php'">Log Out</li>
                </ul>
            </div>
        </nav>

    </div>
    <br>
    <br>
    <hr>
    <div class="Course-Header">
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
    </div>
    <hr>
    <div class="Course-Box">
        <div class="Box-1">
            <div class="Logo-1">
                <img src="/Group Assignment/Picture/Course-logo.png" alt="Course-logo">
            </div>
            <br>
            <h4>Welcome Back</h4>
        </div>

        <div class="Box-2" onclick="window.location.href='/Group Assignment/Uploads/Module_1/Module 1.html'">
            <div class="Math-1">
                <img src="/Group Assignment/Picture/Math Module.jpeg" alt="Picture of Module-Math">
            </div>
            <h4>Module 1</h4>
            <center><label>Your Progress: </label></center>
            <progress id="Math-1-Progress" value="0" max="100">

            </progress>
        </div>

        <div class="Box-2" onclick="window.location.href='/Group Assignment/Uploads/Module_2/module%202.html'">
            <div class="Math-1">
                <img src="/Group Assignment/Picture/Math Module.jpeg" alt="Picture of Module-Math">
            </div>
            <h4>Module 2</h4>
            <center><label>Your Progress: </label></center>
            <progress id="Math-1-Progress" value="0" max="100">

            </progress>
        </div>

        <div class="Box-2" onclick="window.location.href='/Group Assignment/Uploads/Module_3/module%203.html'">
            <div class="Math-1">
                <img src="/Group Assignment/Picture/Math Module.jpeg" alt="Picture of Module-Math">
            </div>
            <h4>Module 3</h4>
            <center><label>Your Progress: </label></center>
            <progress id="Math-1-Progress" value="0" max="100">

            </progress>
        </div>

        <div class="Box-2" onclick="window.location.href='/Group Assignment/Uploads/Module_4/module%204.html'">
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