<?php
// Assuming your database connection details
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

// Initialize variables to store feedback data
$Q1 = $Q2 = $Q3 = $Q4 = $Q5 = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["search"])) {
    // Get the student USER_ID from the form
    $studentUserId = $_GET["search"];

    // Query to retrieve feedback data for the given USER_ID
    $sql = "SELECT * FROM feedback WHERE user_id = '$studentUserId'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch feedback data
        $row = $result->fetch_assoc();
        $Q1 = $row["Q1"];
        $Q2 = $row["Q2"];
        $Q3 = $row["Q3"];
        $Q4 = $row["Q4"];
        $Q5 = $row["Q5"];
    } else {
        // Handle the case when no data is found for the given USER_ID
        echo "No feedback found for the student with USER_ID: $studentUserId";
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

        .login-button {
            margin-left: 90%;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            text-align: center;

        }

        .Student-ID-Box {
            width: 250px;
            height: 35.5px;
            margin: -25px 0px 0px 80px;
            border: 1px solid black;
        }

        .Student-Feedbacks {
            width: 90%;
            height: 35.5px;
            border: 1px solid black;
            margin: 5px 0px 0px 2%;
        }

        .Button button {
            width: 20%;
            height: 35.5px;
        }

        .Back-Module-Button button {
            width: 20%;
            height: 35.5px;

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
    <div class="Feedbacks-Box">
        <h3>Check Student Feedbacks</h3>
        <form action="/GROUP ASSIGNMENT/Grade&Feedback/LecturerFeedback.php" method="get">
        <div class="Q1">
            <input type="text" placeholder="Type Student USER_ID" name="search">
            <button type="submit">Submit</button>
        </div>
        </form>
        <br>
        <hr>
        <br>
        <div class="Q1">
            <label>Q1. Do you satisfied with this module?</label>
            <div class="Student-Feedbacks">
                <output id="Q1" type="text" size="25" name="Q1"><?php echo $Q1; ?></output>
            </div>
        </div>
        <br>
        <hr>
        <br>
        <div class="Q1">
            <label>Q2. Do you satisfied with the lecturer teaching method?</label>
            <div class="Student-Feedbacks">
                <output id="Q2" type="text" size="25" name="Q2"><?php echo $Q2; ?></output>
            </div>
        </div>
        <br>
        <hr>
        <br>
        <div class="Q1">
            <label>Q3. Is the Material similar to the Lecturer Class?</label>
            <div class="Student-Feedbacks">
                <output id="Q3" type="text" size="25" name="Q3"><?php echo $Q3; ?></output>
            </div>
        </div>
        <br>
        <hr>
        <br>
        <div class="Q1">
            <label>Q4. Any comment for the Learning Material on making changes?</label>
            <div class="Student-Feedbacks">
                <output id="Q4" type="text" size="25" name="Q4"><?php echo $Q4; ?></output>
            </div>
        </div>
        <br>
        <hr>
        <br>
        <div class="Q1">
            <label>Q5. Any comment to the Lecturer?</label>
            <div class="Student-Feedbacks">
                <output id="Q5" type="text" size="25" name="Q5"><?php echo $Q5; ?></output>
            </div>
        </div>
        <br>
        <hr>
        <br>

        <div class="Back-Module-Button">
            <button onclick="window.location.href='/GROUP ASSIGNMENT/Lecturer Interface/LecturerCoursePage.php'">Back to Module</button>
        </div>
    </div>

</body>
</html>