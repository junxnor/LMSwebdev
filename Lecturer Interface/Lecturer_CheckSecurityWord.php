
<?php 
session_start();

// Database connection parameters
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'courseverse';

// Create a database connection
$conn = new mysqli($host, $username, $password, $database);

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    // Get the user_id from the session
    $user_id = $_SESSION['user_id'];

    // Add the "TP" prefix
    $prefixed_user_id = "L" . $user_id;

    $SecurityWord = getSecurityWordFromDatabase($user_id, $conn);

    // Call the function to get the first name
    $firstname = getFirstNameFromDatabase($user_id, $conn);

}else {
    // User is not logged in, redirect to login page
    header("Location: /Group Assignment/Lecturer interface/LecturerLoginPage.html");
    exit(); // Make sure to stop the script execution after redirecting
}



// Move the function outside the if block
function getFirstNameFromDatabase($user_id, $conn) {
    $stmt = $conn->prepare("SELECT Instructor_First_Name FROM instructor WHERE Instructor_USER_ID = ?");
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a row was returned
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['Instructor_First_Name'];
    } else {
        return false;
    }
}

function getSecurityWordFromDatabase($user_id, $conn) {
    $stmt = $conn->prepare("SELECT SecurityWord FROM instructor_password WHERE Instructor_USER_ID = ?");
    $stmt->bind_param('i', $user_id); // Assuming USER_ID is an integer
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Check if a row was returned
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['SecurityWord'];
    } else {
        return false;
    }
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
    <?php echo "<h3>" . $firstname ."</h3>" ?>
    <form method="post" action="/Group Assignment/Lecturer Interface/PHP/Lecturer_CheckSecurityWord.php">
    <label>Security word</label><br>
            <label>What is your favourite Color?</label><br>
            <input type="text" name="SecurityWord" placeholder="Please Answer it" required><br>
            <button type="submit">Submit</button><br>
    </form>
    
    
</body>
</html>

