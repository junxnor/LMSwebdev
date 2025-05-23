<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'courseverse';

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if (isset($_GET['email'])) {
    $emailencode = $_GET['email'];
    $email = base64_decode(urldecode($emailencode));
    

    $USER_ID = getUserIDFromDatabase($email, $conn);
} else {
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

// Query to fetch token records
$query = "SELECT Instructor_USER_ID, Email, Token_Question, Token_ID FROM token";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Token Records</title>
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
    
    


        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        .edit-btn, .delete-btn {
            display: inline-block;
            padding: 5px 10px;
            text-decoration: none;
            color: #ffffff;
            background-color: #007bff;
            border: 1px solid #007bff;
            border-radius: 5px;
            margin-right: 5px;
        }

        .delete-btn {
            background-color: #dc3545;
            border: 1px solid #dc3545;
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
<button class="back-btn" onclick="window.location.href='/Group Assignment/Lecturer Interface/Token/Email_Token.html'">Back</button>
    <table>
        <tr>
            <th>Prefixed User ID</th>
            <th>Email</th>
            <th>Token_ID</th>
            <th>Token_Question</th>
            <th>Action</th>
        </tr>
        <?php
        while ($row = $result->fetch_assoc()) {
            // Add "TP" prefix to USER_ID
            $prefixedUserID = 'L' . $row["Instructor_USER_ID"];
        
            // Add "T" prefix to Token_ID
            $prefixedTokenID = 'T' . $row["Token_ID"];
        
            // Check if the current row's USER_ID matches $USER_ID
            if ($row["Instructor_USER_ID"] == $USER_ID) {
                echo "<tr>";
                echo "<td>" . $prefixedUserID . "</td>";
                echo "<td>" . $row["Email"] . "</td>";
                echo "<td>" . $prefixedTokenID . "</td>";
                echo "<td>" . $row["Token_Question"] . "</td>";
                echo '<td><a class="edit-btn" href="/Group Assignment/Lecturer Interface/Token/Check_Token_Password.php?user_id=' . $USER_ID . '&Token_ID=' . $row["Token_ID"] . '">View Token</a>';
                echo '<a class="delete-btn" href="/Group Assignment/Lecturer Interface/Token/PHP/Delete_Token.php?user_id=' . $USER_ID . '&Token_ID=' . $row["Token_ID"] . '" onclick="return confirm(\'Are you sure?\')">Delete</a></td>';
                echo "</tr>";
            }
        }
        
        
        
        ?>
    </table>

</body>
</html>

<?php
// Close the connection
$conn->close();
?>
