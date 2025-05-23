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

        .Progress-CheckBox-Notes {
            margin: 0px 0px 0px 85%;
        }

        .Progress-CheckBox input {
            margin: 0px 0px 0px 90%;
        }

        .Grades-and-Feedbacks-Box {
            margin: 0px 0px 0px 80%;
        }

        .Grades-and-Feedbacks-Box button {
            padding: 10px;
        }


    </style>
    <br>
    <br>
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
    <div class="Module1-LectureSlides-Header">
        <h1>Module 2</h1>
        <p><a href="/Group Assignment/Student Interface/Course.php"> Dashboard</a> / <a href="/Group Assignment/Uploads/Module_2/module%202.html">Module 2</a> / Learning Material / Lecturer
            Slides </p>
    </div>
<hr>
</body>
</html>


<?php
// Database connection details
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "courseverse";

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch the uploaded files from the database
$sql = "SELECT * FROM module2";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Uploaded files</title>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2>Uploaded Files</h2>
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>File Name</th>
            <th>File Size</th>
            <th>File Type</th>
            <th>Download</th>
        </tr>
        </thead>
        <tbody>
        <?php
        // Display the uploaded files and download links
        $sql = "SELECT * FROM module2";
            $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $file_path = "uploads/" . $row['filename'];
                ?>
                <tr>
                    <td><?php echo $row['filename']; ?></td>
                    <td><?php echo $row['filesize']; ?> bytes</td>
                    <td><?php echo $row['filetype']; ?></td>
                    <td><a href="<?php echo $file_path; ?>" class="btn btn-primary" download>Download</a></td>
                </tr>
                <?php
            }
        } else {
            ?>
            <tr>
                <td colspan="4">No files uploaded yet.</td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
</div>

</body>
</html>

<?php
$conn->close();
?>