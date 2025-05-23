<?php
session_start();

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    // Get the user_id from the session
    $user_id = $_SESSION['user_id'];

    // Add the "TP" prefix
    $prefixed_user_id = "A" . $user_id;

    // Display an alert with the prefixed user_id
    // echo "<script>alert('Your Prefixed User ID: $prefixed_user_id');</script>";
}else {
    // User is not logged in, redirect to login page
    header("Location: /Group Assignment/Student interface/LoginPage.html");
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

        }

        .Box-1 {
            width: 250px;
            height: 300px;
            border: 1px solid black;
            margin: 10px 10px 0 0px;
            position: relative;


        }

        .Logo-1,
        .Box-1 button,
        .Box-1 h4 {
            justify-content: center;
        }


        .Logo-1 {
            width: 100px;
            padding-left: 60px;
            padding-top: 30px;
        }
        
        
        .Box-1 button {
            margin: 35px 44px 20px 47.5px;
            padding-top: 10px;
            padding-bottom: 10px;
            text-align: center;
            padding-left: 50px;
            padding-right: 50px;
            cursor: pointer;
        }

        .Logo-2 img {
            margin: 20px 0px 0px 45px;
            width: 150px;
        }

        .Create-Course-Button {
            margin: 35px 44px 20px 35px;
            padding-top: 10px;
            padding-bottom: 10px;
            text-align: center;
        }

        .Create-Course-Button button {
            padding: 10px;
            background-color: rgb(57, 111, 227);
            cursor: pointer;
        }

        .Course-Box1-Text {
            width: 250px;
            height: 45px;
        }

        .Box-1 h4 {
            padding-top: 5px;
            text-align: center;

        }


        .Box-2 {
            width: 250px;
            height: 300px;
            border: 1px solid black;
            margin: 10px 0px 0 30px;
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
        .Box-2-Button button{
            margin: 30px 44px 20px 47.5px;
            padding-top: 10px;
            padding-bottom: 10px;
            text-align: center;
            padding-left: 50px;
            padding-right: 50px;
            cursor: pointer;
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

                    <li onclick="window.location.href='/Group Assignment/Admin/Profile.php'">Profile</li>
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
    <br>
    <br>
    <div class="Course-Box">
        <div class="Box-1">
            <div class="Logo-1">
                <img src="/Group Assignment/Picture/Course-logo.png" alt="Course-logo">
            </div>
            <br>
            <div class="Course-Box1-Text">
                <h4>Manage Student Account</h4>
            </div>
            <button onclick="window.location.href='/Group Assignment/Admin/Manage_Student_Account.php'">Manage</button>
        </div>

        <div class="Box-2">
            <div class="Logo-2">
                <img src="/Group Assignment/Picture/Create-Group-Lecturer-Course.png" alt="Logo Create Group">
            </div>
            <br>
            <div class="Course-Box1-Text">
                <h4>Manage Lecturer Account</h4>
            </div>
            <div class="Create-Course-Button">
                <button onclick="window.location.href='/Group Assignment/Admin/Manage_Lecturer_Account.php'">Manage</button>
            </div>
        </div>

        <div class="Box-2" >
            <div class="Math-1">
                <img src="/Group Assignment/Picture/Math Module.jpeg" alt="Picture of Module-Math">
            </div>
            <h4>Manage Token</h4>
            <div class="Box-2-Button">
            <button onclick="window.location.href='/Group Assignment/Admin/Manage_Token.html'">Manage</button>
            </div>

            
        </div>


    </div>
</body>

</html>