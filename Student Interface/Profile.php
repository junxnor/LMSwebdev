

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
    $prefixed_user_id = "TP" . $user_id;

    // Call the function to get the first name
    $firstname = getFirstNameFromDatabase($user_id, $conn);

    // Call the function to get the first name
    $lastname = getLastNameFromDatabase($user_id, $conn);

    // Email
    $email = getEmailFromDatabase($user_id, $conn);

    //Password
    $password = getPasswordFromDatabase($user_id, $conn);
    
    //Gender
    $gender = getGenderFromDatabase($user_id,$conn);

}else {
    // User is not logged in, redirect to login page
    header("Location: /Group Assignment/Student interface/LoginPage.html");
    exit(); // Make sure to stop the script execution after redirecting
}

// Move the function outside the if block
function getFirstNameFromDatabase($user_id, $conn) {
    $stmt = $conn->prepare("SELECT First_Name FROM users WHERE USER_ID = ?");
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a row was returned
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['First_Name'];
    } else {
        return false;
    }
}

function getLastNameFromDatabase($user_id, $conn) {
    $stmt = $conn->prepare("SELECT Last_Name FROM users WHERE USER_ID = ?");
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a row was returned
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['Last_Name'];
    } else {
        return false;
    }
}

function getEmailFromDatabase($user_id, $conn) {
    $stmt = $conn->prepare("SELECT Email FROM email WHERE USER_ID = ?");
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a row was returned
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['Email'];
    } else {
        return false;
    }
}

function getPasswordFromDatabase($user_id, $conn) {
    $stmt = $conn->prepare("SELECT PASSWORD FROM userpassword WHERE USER_ID = ?");
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a row was returned
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['PASSWORD'];
    } else {
        return false;
    }
}

function getGenderFromDatabase($user_id, $conn) {
    $stmt = $conn->prepare("SELECT Gender FROM users WHERE USER_ID = ?");
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a row was returned
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['Gender'];
    } else {
        return false;
    }
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
        .Profile-Drawer{
            margin: 30px 0px 0px 0px;
        }
        .Profile-Drawer p {
            margin: 0px 0px 0px 0px;
        }

        .Profile-Box {
            margin: -30px 0px 0px 15%;
        }

        .Profile-Box {
            width: 221.5px;
            height: 41.5px;
            border: 1px solid rgb(21, 19, 19);
            padding-top: 15px;
            overflow: auto;
            /* This property hides any content that overflows the box */
             white-space: nowrap; /* This property prevents the text from wrapping to the next line */
            /* text-overflow: ellipsis; */
        }

        output {
            margin: 0px 0px 0px 35%;
            white-space: nowrap;
            
        }

        output p {
            justify-content:flex-start;
            
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

    <div class="Profile">
        <ul class="Profile-Drawer">
        <div class="Profile-Image">
        <?php if ( $gender== "Male"){
        echo '<img width="125px" src="/Group Assignment/Picture/Male Profile Logo.png">';
        }
        else if ($gender == "Female"){
        echo '<img width="125px" src="/Group Assignment/Picture/Female Profile Logo.png">';
        }?>
        </div>
        
        </ul>

        <ul class="Profile-Drawer">
            <p>User ID</p>
            <div class="Profile-Box">
                <output id="UserID" name="UserID" size="25px" type="text"><?php echo "<h3>" . $prefixed_user_id ."</h3>"  ?></output>

            </div>
        </ul>
        <ul class="Profile-Drawer">
            <p>First Name</p>
            <div class="Profile-Box">
                <output id="FirstName" name="FirstName" size="25px" type="text"><?php echo "<h3>" . $firstname ."</h3>" ?></output>

            </div>
        </ul>
        <ul class="Profile-Drawer">
            <p>Last Name</p>
            <div class="Profile-Box">
                <output id="LastName" name="LastName" size="25px" type="text"><?php echo "<h3>" . $lastname ."</h3>" ?></output>

            </div>
        </ul>
        <ul class="Profile-Drawer">
            <p>Email</p>
            <div class="Profile-Box">
                <output id="Email" name="Email" size="25px" type="text"><?php echo "<h3>" . $email ."</h3>" ?></output>

            </div>
        </ul>
        <ul class="Profile-Drawer">
            <p>Password</p>
            <div class="Profile-Box">
                <output id="Password" name="Password" size="25px" type="text"><?php echo "<p>" . $password ."</p>" ?></output>

            </div>
        </ul>

        <div class="">
        <button onclick="window.location.href='/Group Assignment/Student Interface/CheckSecurityWord.php'">Change Password</button>

        </div>
        <br>
        <br>
        <div class="Back-Button">
        <button onclick="window.location.href='/Group Assignment/Student Interface/Course.php'">Back to Home Page</button>
        </div>


    </div>


    </body>

</html>

