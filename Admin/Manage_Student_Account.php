<?php
session_start();
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
if (isset($_SESSION['user_id'])) {
    // Get the user_id from the session
    $user_id = $_SESSION['user_id'];

    // Add the "TP" prefix
    $prefixed_user_id = "A" . $user_id;

    // Display an alert with the prefixed user_id
    // echo "<script>alert('Your Prefixed User ID: $prefixed_user_id');</script>";
}else {
    // User is not logged in, redirect to login page
    header("Location: /Group Assignment/Admin/LoginPage.html");
    exit(); // Make sure to stop the script execution after redirecting
}
// Query to join the tables and fetch data
$query = "SELECT CONCAT('TP', users.USER_ID) AS Prefixed_User_ID, users.USER_ID, users.First_Name, users.Last_Name, users.Gender, userpassword.PASSWORD, email.Email
          FROM users
          JOIN userpassword ON users.USER_ID = userpassword.USER_ID
          JOIN email ON users.USER_ID = email.USER_ID";

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
<body>
    <script src="/Group Assignment/MenuBarAddClass.js" defer></scriptsrc></script>
    <div class="AllHeader">
        <div class="Header">
            <img src="/Group Assignment/Picture/logo.png" alt="Logo" style="height: 50px;">
            <h1>| CourseVerse</h1>
            <h3>| Welcome <?php echo $prefixed_user_id ?></h3>

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
        <button onclick="window.location.href='/Group Assignment/Admin/AdminHome.php'">Back</button>
    </div>
    <table id="Student-Data">
        <tr>
            <th>Prefixed User ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Gender</th>
            <th>Student-Email</th>
            <th>Student-Password</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        <?php
        while ($row = $result->fetch_assoc()){
            echo '<tr>';
            echo '<td>'.$row['Prefixed_User_ID'].'</td>';
            echo '<td>'.$row['First_Name'].'</td>';
            echo '<td>'.$row['Last_Name'].'</td>';
            echo '<td>'.$row['Gender'].'</td>';
            echo '<td>'.$row['Email'].'</td>';
            echo '<td>'.$row['PASSWORD'].'</td>';
            echo '<td><a class="edit-btn" href="Admin_Student_Profile.php?user_id='.$row['USER_ID'].'">Edit</a></td>';
            echo '<td><a class="delete-btn" href="/Group Assignment/Admin/PHP/Delete_Student_Account.php?user_id='.$row['USER_ID'].'">Delete</a></td>';
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
