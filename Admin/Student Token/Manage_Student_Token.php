<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'courseverse';

// Create a database connection
$conn = new mysqli($host, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to join the tables and fetch data, including Token ID
$query = "SELECT CONCAT('TP', token.USER_ID) AS Prefixed_User_ID, token.USER_ID, CONCAT('T', token.Token_ID) AS Prefixed_Token_ID, token.Token_ID, token.Token_Name, token.Token_Question, token.Token_Answer, email.Email
          FROM token
          JOIN email ON token.USER_ID = email.USER_ID";

$result = $conn->query($query);

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
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f5f5f5;
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
    <div class="Back">
        <button onclick="window.location.href='/Group Assignment/Admin/Manage_Token.html'">Back</button>
    </div>
    <table id="Student-Data">
        <tr>
            <th>Prefixed User ID</th>
            <th>Prefixed Token ID</th> <!-- New column for Prefixed Token ID -->
            <th>Token Name</th>
            <th>Token Question</th>
            <th>Token Answer</th>
            <th>Student-Email</th>
            <th>Manage</th>
            <th>Delete</th>
        </tr>
        <?php
        while ($row = $result->fetch_assoc()){
            echo '<tr>';
            echo '<td>'.$row['Prefixed_User_ID'].'</td>';
            echo '<td>'.$row['Prefixed_Token_ID'].'</td>'; // Display prefixed Token ID
            echo '<td>'.$row['Token_Name'].'</td>';
            echo '<td>'.$row['Token_Question'].'</td>';
            echo '<td>'.$row['Token_Answer'].'</td>';
            echo '<td>'.$row['Email'].'</td>';
            echo '<td><a class="edit-btn" href="/Group Assignment/Admin/Student Token/Admin_Student_Token.php?user_id='.$row['USER_ID'].'&token_id='.$row['Token_ID'].'">Manage</a></td>';
            echo '<td><a class="delete-btn" href="/Group Assignment/Admin/Student Token/PHP/Delete_Student_Token.php?user_id='.$row['USER_ID'].'&token_id='.$row['Token_ID'].'">Delete</a></td>';
            echo '</tr>';
        }
        ?>
    </table>
</body>
</html>

<?php
// Close the connection
$conn->close();
?>
