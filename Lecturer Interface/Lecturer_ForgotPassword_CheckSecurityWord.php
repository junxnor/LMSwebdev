<?php 
session_start();

// Database connection parameters
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'courseverse';

// Create a database connection
$conn = new mysqli($host, $username, $password, $database);

if (isset($_GET['email'])) {
    $emailencode = $_GET['email'];
    $email = base64_decode(urldecode($emailencode));
    

    $USER_ID = getUserIDFromDatabase($email, $conn);
    // Now you have the $email variable in this script
} else {
    header("Location: /Group Assignment/Lecturer interface/Lecturer_ForgotPassword_CheckEmail.html");
    echo "Email not provided.";
}


function getUserIDFromDatabase($email, $conn) {
    $stmt = $conn->prepare("SELECT Instructor_USER_ID FROM instructor_email WHERE Instructor_Email = ?");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Check if a row was returned
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['Instructor_USER_ID'];
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

    </div>
    <br>
    <br>
    <hr>

    <form method="post" action="/Group Assignment/Lecturer Interface/PHP/Lecturer_ForgotPassword_CheckSecurityWord.php?email=<?php echo urlencode(base64_encode($email)); ?>">
    <label>SECURITY WORD</label><br>
            <label>What is your favourite Color?</label><br>
            <input type="text" name="SecurityWord" placeholder="Please Answer it" required><br>
            <br>
            <button type="submit">Submit</button><br>
    </form>
    <br>
    <br>
    <div class="Back">
        <button onclick="window.location.href='/Group Assignment/Lecturer Interface/Lecturer_ForgotPassword_CheckEmail.html'">back</button>
    </div>
    
</body>
</html>

