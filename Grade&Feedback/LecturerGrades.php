<?php

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "courseverse";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $USER_ID = $_POST['USER_ID'];
    $finalExam = $_POST["FinalExam"];
    $groupAssignment = $_POST["GroupAssignment"];
    $individualAssignment = $_POST["IndividualAssignment"];

    // Insert data into the database
    $sql = "INSERT INTO grade (USER_ID, final_exam, group_assignment, individual_assignment) 
            VALUES ('$USER_ID', '$finalExam', '$groupAssignment', '$individualAssignment')";

    if ($conn->query($sql) === TRUE) {
        echo "Data inserted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
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

        .Grades-Box {
            margin: -30px 0px 0px 50%;
        }

        .Grades-Box input {
            padding: 5%;
        }

        .Grades-Drawer p {
            margin: 0px 0px 0px 0px;
        }

        .Grades-Drawer {
            padding-top: 10px;
        }
        .Grades-Box{
            width: 221.5px;
            height: 41.5px;
            border: 1px solid #0f0e0e;
            
        }
        .Grades-Box output{
            text-align: center;
        }
        .Back-Button Button {
            padding: 10px;
            width: 10%;
        }
        .Submit-Button Button {
            padding: 10px;
            width: 10%;
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
    <form action="/GROUP ASSIGNMENT/Grade&Feedback/LecturerGrades.php" method="post">
    <div class="Grades-Header">
        <h2>Grading System</h2>
        <p>Enter grades based on student ID</p>
    </div>
    <hr>
    <div class="Grades">
        <ul class="Grades-Drawer">
            <p>User ID</p>
            <div class="Grades-Box">
                <input id="user_id" type="text" size="25px" name="USER_ID" placeholder="Put Student ID Here">
            </div>
        </ul>
    <div class="Grades">
        <ul class="Grades-Drawer">
            <p>Final Exam</p>
            <div class="Grades-Box">
                <input id="FinalExam" type="text" size="25px" name="FinalExam" placeholder="Put Student Exam Marks Here">
            </div>
        </ul>
        <ul class="Grades-Drawer">
            <p>Group-Assignment</p>
            <div class="Grades-Box">
                <input id="GroupAssignment" type="text" size="25px" name="GroupAssignment" placeholder="Put Student Exam Marks Here">
            </div>
        </ul>
        <ul class="Grades-Drawer">
            <p>Individual-Assignment</p>
            <div class="Grades-Box">
                <input id="IndividualAssignment" type="text" size="25px" name="IndividualAssignment" placeholder="Put Student Exam Marks Here">
            </div>
        </ul>
        <hr>
        <div class="Submit-Button">
            <input type="submit" value="Submit">
        </div>
        </div>
        </form>

    </div>
    <hr>
    <div class="Back-Button">
        <button onclick="window.location.href='/GROUP ASSIGNMENT/Lecturer Interface/LecturerCoursePage.php'">Back</button>
    </div>
    <hr>


</body>
</html>