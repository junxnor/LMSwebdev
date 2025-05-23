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

                    <li onclick="window.location.href='/Group Assignment/Lecturer Interface/Lecturer_ProfilePage.php'">Profile</li>
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
        <h1>Module 3</h1>
        <p><a href="/Group Assignment/Lecturer Interface/LecturerCoursePage.php"> Dashboard</a> / <a href="/Group%20Assignment/Uploads/Module_3/LecturerModule3.html">Module 3</a> / Learning Material / Lecturer
            Slides </p>
    </div>
<hr>
</body>
</html>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>File upload and download</title>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2>Upload a file</h2>
    <form action="upload.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="file" class="form-label">Select file</label>
            <input type="file" class="form-control" name="file" id="file">
        </div>
        <button type="submit" class="btn btn-primary">Upload file</button>
    </form>
</div>

<div class="container mt-5">
    <h2>Uploaded Files</h2>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>File Name</th>
                <th>File Size</th>
                <th>File Type</th>
                <th>Download</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Fetch the uploaded files from the database
            $db_host = "localhost";
            $db_user = "root";
            $db_pass = "";
            $db_name = "courseverse";

            $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Use "module1" instead of "files"
            $sql = "SELECT * FROM module3";
            $result = $conn->query($sql);

            // Display the uploaded files and download links
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $file_path = "uploads/" . $row['filename'];
                    ?>
                    <tr>
                        <td><?php echo $row['filename']; ?></td>
                        <td><?php echo $row['filesize']; ?> bytes</td>
                        <td><?php echo $row['filetype']; ?></td>
                        <td><a href="<?php echo $file_path; ?>" class="btn btn-primary" download>Download</a></td>
                        <td>
                            <form action='delete.php' method="post">
                                <input type="hidden" name="id" value="<?php echo $row['ID']; ?>">
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="5">No files uploaded yet.</td>
                </tr>
                <?php
            }

            $conn->close();
            ?>
        </tbody>
    </table>
</div>

</body>
</html>