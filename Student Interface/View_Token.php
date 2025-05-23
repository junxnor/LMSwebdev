<?php 
session_start();

// Database connection parameters
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'courseverse';

// Create a database connection
$conn = new mysqli($host, $username, $password, $database);

if (isset($_GET['user_id'])){
    // Get the user_id from the session
    $user_id = $_GET['user_id'];
    $token_id = $_GET['Token_ID'];
    $preflixed_token_id = "T" . $token_id;

    $tokenQuestion = getTokenQuestionFromDatabase($user_id,$conn);

    $tokenName = getTokenNameFromDatabase($user_id,$conn);

    $tokenFiles = getTokenFilesFromDatabase($user_id,$conn);

    $tokenAnswer = getTokenAnswerFromDatabase($token_id,$conn);

    $Email = getEmailFromDatabase($user_id,$conn);
}
function getTokenQuestionFromDatabase($user_id, $conn) {
    $stmt = $conn->prepare("SELECT Token_Question FROM token WHERE USER_ID = ?");
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a row was returned
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['Token_Question'];
    } else {
        return false;
    }
}
function getTokenNameFromDatabase($user_id, $conn) {
    $stmt = $conn->prepare("SELECT Token_Name FROM token WHERE USER_ID = ?");
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a row was returned
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['Token_Name'];
    } else {
        return false;
    }
}
function getTokenFilesFromDatabase($token_id, $conn) {
    $stmt = $conn->prepare("SELECT Token_Files FROM token WHERE Token_ID = ?");
    $stmt->bind_param('i', $token_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        
        $row=$result->fetch_assoc();
        return $row['Token_Files'];
    } else {
        return false;
    }
}



function getTokenAnswerFromDatabase($token_id, $conn) {
    $stmt = $conn->prepare("SELECT Token_Answer FROM token WHERE Token_ID = ?");
    $stmt->bind_param('i', $token_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a row was returned
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['Token_Answer'];
    } else {
        return false;
    }
}
function getEmailFromDatabase($user_id, $conn) {
    $stmt = $conn->prepare("SELECT Email FROM token WHERE USER_ID = ?");
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

                    <li onclick="window.location.href='/Group Assignment/Student Interface/Profile.html'">Profile</li>
                </ul>

                <ul class="LogOutButton">
                    <li onclick="window.location.href='/HomePage.html'">Log Out</li>
                </ul>
            </div>
        </nav>

    </div>
    <br>
    <br>
    <hr>
    <div class="wrapper">
        <div class="Token_ID">
            <h4>Token_ID:</h4>
            <p>
                <?php echo $preflixed_token_id; ?>
            </p>
        </div>
        <div class="Email">
            <h4>Email:</h4>
            <p>
                <?php echo $Email; ?>
            </p>
        </div>
        <div class="Token_Name">
            <h4>Subject:</h4>
            <p>
                <?php echo $tokenName; ?>
            </p>
        </div>
        <div class="Token_Question">
            <h4>Question:</h4>
            <p>
                <?php echo $tokenQuestion; ?>
            </p>
        </div>
        <div class="Token_Files">
            <h4>Attachment:</h4>

            <?php 
    $sql = "SELECT Token_Files FROM token WHERE Token_ID = $token_id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);

    if ($row['Token_Files'] != null){
        $imageData = $row['Token_Files'];
        $imageInfo = getimagesizefromstring($imageData);

        if ($imageInfo !== false && isset($imageInfo['mime'])) {
            $mime = $imageInfo['mime'];
            echo '<img src="data:' . $mime . ';base64,' . base64_encode($imageData) . '" width="100px">';
        } else {
            echo 'Invalid image data.';
        }
    } else {
        echo 'No image data available.';
    }

    mysqli_close($conn);
    ?>
        </div>




    </div>


    </div>
    <div class="Token_Answer">
        <h4>Solution:</h4>
        <p>
            <?php echo $tokenAnswer; ?>
        </p>
    </div>
    </div>
    <div class="Back-Button">
        <button onclick="window.location.href='/Group Assignment/Student Interface/Token_Home.html'">Back to Token HomePage</button>
     </div>
</body>

</html>