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
if (isset($_GET['user_id'])) {
    // Get the user_id from the session
    $user_id = $_GET['user_id'];

    // Add the "TP" prefix
    $prefixed_user_id = "L" . $user_id;

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
    header("Location: /Group Assignment/Admin/Manage_Lecturer_Account.php");
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

function getLastNameFromDatabase($user_id, $conn) {
    $stmt = $conn->prepare("SELECT Instructor_Last_Name FROM instructor WHERE Instructor_USER_ID = ?");
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a row was returned
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['Instructor_Last_Name'];
    } else {
        return false;
    }
}

function getEmailFromDatabase($user_id, $conn) {
    $stmt = $conn->prepare("SELECT Instructor_Email FROM instructor_email WHERE Instructor_USER_ID = ?");
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a row was returned
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['Instructor_Email'];
    } else {
        return false;
    }
}

function getPasswordFromDatabase($user_id, $conn) {
    $stmt = $conn->prepare("SELECT Instructor_Password FROM instructor_password WHERE Instructor_USER_ID = ?");
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a row was returned
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['Instructor_Password'];
    } else {
        return false;
    }
}

function getGenderFromDatabase($user_id, $conn) {
    $stmt = $conn->prepare("SELECT Gender FROM instructor WHERE Instructor_USER_ID = ?");
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
            <div class="Change-Box">
            <button onclick="window.location.href='/Group Assignment/Admin/Change Lecturer/Change_Lecturer_FirstName.php?user_id=<?php echo $user_id?>'">Change First Name</button>
            </div>
        </ul>
        <ul class="Profile-Drawer">
            <p>Last Name</p>
            <div class="Profile-Box">
                <output id="LastName" name="LastName" size="25px" type="text"><?php echo "<h3>" . $lastname ."</h3>" ?></output>

            </div>
            <div class="Change-Box">
            <button onclick="window.location.href='/Group Assignment/Admin/Change Lecturer/Change_Lecturer_LastName.php?user_id=<?php echo $user_id?>'">Change Last Name</button>
            </div>
        </ul>
        <ul class="Profile-Drawer">
            <p>Email</p>
            <div class="Profile-Box">
                <output id="Email" name="Email" size="25px" type="text"><?php echo "<h3>" . $email ."</h3>" ?></output>

            </div>
            <div class="Change-Box">
            <button onclick="window.location.href='/Group Assignment/Admin/Change Lecturer/Change_Lecturer_Email.php?user_id=<?php echo $user_id?>'">Change Email</button>
            </div>
        </ul>
        <ul class="Profile-Drawer">
            <p>Password</p>
            <div class="Profile-Box">
                <output id="Password" name="Password" size="25px" type="text"><?php echo "<p>" . $password ."</p>" ?></output>

            </div>
            <div class="Change-Box">
            <button onclick="window.location.href='/Group Assignment/Admin/Change Lecturer/Change_Lecturer_Password.php?user_id=<?php echo $user_id?>'">Change Password</button>

        </div>
        </ul>

        
        <br>
        <div class="Back">
        <button onclick="window.location.href='/Group Assignment/Admin/Manage_Lecturer_Account.php'">Back</button>
        </div>


    </div>


    </body>

</html>

