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

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "courseverse";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Escape user inputs for security
    $userID = mysqli_real_escape_string($conn, $_POST['USER_ID']);
    $q1 = mysqli_real_escape_string($conn, $_POST['Q1']);
    $q2 = mysqli_real_escape_string($conn, $_POST['Q2']);
    $q3 = mysqli_real_escape_string($conn, $_POST['Q3']);
    $q4 = mysqli_real_escape_string($conn, $_POST['Q4']);
    $q5 = mysqli_real_escape_string($conn, $_POST['Q5']);

    // SQL query to insert data into the database
    $sql = "INSERT INTO feedback (USER_ID, Q1, Q2, Q3, Q4, Q5) 
            VALUES ('$userID', '$q1', '$q2', '$q3', '$q4', '$q5')";

    // Check if the query was successful
    if ($conn->query($sql) === TRUE) {
        echo "Feedback submitted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
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

        .Selection{
            display: flex;
            justify-content: space-between;
            padding: 10px;
        }
        
        .Comment-Box{
            padding: 10px;
        }
        .Comment-Box input{
            padding: 10px;
            width: 95%; /* Adjust the width as needed */
            margin-bottom: 10px;
        }
        .Submit-Button input {
            padding: 10px;
            width: 100%;
        }
        .Back-Button{
            margin: 7.5px 0px 0px 0px;
        }
        .Back-Button Button {
            padding: 10px;
            width: 30%;
        }
        
    </style>
    <link rel="stylesheet" href="/Group Assignment/CSS/MenuBar.css">
</head>

<body>
    <script src="/Group Assignment/MenuBarAddClass.js" defer></script>

    <div class="AllHeader">
        <div class="Header">
            <img src="/Group Assignment/Picture/Logo.png" alt="Logo" style="height: 50px;">
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
    <div class="Feedbacks-Header">
        <h3>End Semester Module Feedbacks</h3>
        <p>Please answer all the question below by entering your respective student id.</p>
        <form action="/GROUP ASSIGNMENT/Grade&Feedback/StudentFeedback.php" method="post">
        <div class="Selection">
            <input type="text" placeholder="Type your USER ID" name="USER_ID">
        </div>
        <br>
        <hr>
            <label>Q1. Do you satisfied with this module?</label>
            <br>
            <div class="Selection">
                <input type="radio" name="Q1" value="1">1</input>
                <input type="radio" name="Q1" value="2">2</input>
                <input type="radio" name="Q1" value="3">3</input>
                <input type="radio" name="Q1" value="4">4</input>
                <input type="radio" name="Q1" value="5">5</input>
            </div>
            <br>
            <hr>
            <label>Q2. Do you satisfied with the lecturer teaching meathod?</label>
            <div class="Selection">
                <input type="radio" name="Q2" value="1">1</input>
                <input type="radio" name="Q2" value="2">2</input>
                <input type="radio" name="Q2" value="3">3</input>
                <input type="radio" name="Q2" value="4">4</input>
                <input type="radio" name="Q2" value="5">5</input>
            </div>
            <br>
            <hr>
            <label>Q3. Is the Material similar to the Lecturer Class?</label>
            <div class="Selection">
                <input type="radio" name="Q3" value="1">1</input>
                <input type="radio" name="Q3" value="2">2</input>
                <input type="radio" name="Q3" value="3">3</input>
                <input type="radio" name="Q3" value="4">4</input>
                <input type="radio" name="Q3" value="5">5</input>
            </div>
            <br>
            <hr>
            <label>Q4. Any comment for the Learning Material on making changes?</label><br>
            <div class="Comment-Box">
                <input type="text" name="Q4" maxlength="255" size="25" placeholder="Type your Comment here">
            </div>
            <br>
            <hr>
            <label>Q5. Any comment to the Lecturer?</label>
            <div class="Comment-Box">
                <input type="text" name="Q5" maxlength="255" size="25" placeholder="Type your Comment here">
            </div>
            <hr>
            <div class="Submit-Button">
            <button type="submit" onclick="window.location.href='/Group Assignment/Student Interface/Module.html'">Submit</button>
            </div>
        </form>
            <div class="Back-Button">
                <button onclick="window.location.href='/GROUP ASSIGNMENT/Student Interface/Course.php'">Back</button>
    </div>
    </div>

</body>
</html>
