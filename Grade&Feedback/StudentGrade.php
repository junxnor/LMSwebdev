<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "courseverse";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$finalExamGrade = "";
$groupAssignmentGrade = "";
$individualAssignmentGrade = "";
$overallGPA = "";

// Check if the form is submitted and if the "search" key is set
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["search"])) {

    $userId = $_GET["search"];

    // Query to retrieve grades for the given user ID
    $sql = "SELECT * FROM grade WHERE user_id = '$userId'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            // Assign values, handling undefined keys
            $finalExamGrade = isset($row["final_exam"]) ? $row["final_exam"] : "";
            $groupAssignmentGrade = isset($row["group_assignment"]) ? $row["group_assignment"] : "";
            $individualAssignmentGrade = isset($row["individual_assignment"]) ? $row["individual_assignment"] : "";
            $overallGPA = isset($row["overall_gpa"]) ? $row["overall_gpa"] : "";
        }
    } else {
        echo "No data found for the user ID: $userId";
    }
}

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
            border: 1px solid rgb(21, 19, 19);
        }
        .Grades-Box output{
            text-align: center;
        }
        .Back-Button Button {
            padding: 10px;
            width: 100%;
        }
        
    </style>
    <link rel="stylesheet" href="/Group Assignment/CSS/MenuBar.css">
</head>

<body>
    <script src="/Group Assignment/MenuBarAddClass.js" defer></script>

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

                    <li onclick="window.location.href='/GROUP ASSIGNMENT/Student Interface/Profile.php'">Profile</li>
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
    <div class="Grades-Header">
        <h2>Your Grades</h2>
        <p>This grades is bases on your academic performance</p>
        <p>Please enter your student id to check your personal grades</p>
    </div>
    <hr>
    <form action="/GROUP ASSIGNMENT/Grade&Feedback/StudentGrade.php" method="get">
    <form class="Grades" action="">
        <input type="text" placeholder="Type your USER_ID" name="search">
        <button type="submit">Submit</button>
    </form>          
    <div class="Grades">
        <ul class="Grades-Drawer">
            <p>Final Exam</p>
            <div class="Grades-Box">
                <output id="FinalExam" type="text" size="25px" name="grades"><?php echo $finalExamGrade; ?></output>
            </div>
        </ul>
        <ul class="Grades-Drawer">
            <p>Group-Assignment</p>
            <div class="Grades-Box">
                <output id="GroupAssignment" type="text" size="25px" name="grades"><?php echo $groupAssignmentGrade; ?></output>
            </div>
        </ul>
        <ul class="Grades-Drawer">
            <p>Individual-Assignment</p>
            <div class="Grades-Box">
                <output id="IndividualAssignment" type="text" size="25px" name="grades"><?php echo $individualAssignmentGrade; ?></output>
            </div>
        </ul>
    </div>
    </form>
        <hr>
        <div class="Back-Button">
            <button onclick="window.location.href='/GROUP ASSIGNMENT/Student Interface/Course.php'">Back</button>
        </div>
</body>

</html>