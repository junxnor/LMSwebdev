<?php
session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $prefixed_user_id = "S" . $user_id; // Assuming student prefix
} else {
    header("Location: /Group Assignment/Student Interface/StudentLoginPage.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Student Dashboard - CourseVerse</title>

    <style>
        /* Reset and base */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f9ff;
            color: #1a2e6e;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        a {
            color: #3a5dcc;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        /* Header (blue top bar) */
        header {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
            background: #3a5dcc;
            color: white;
            padding: 15px 20px;
            box-shadow: 0 4px 8px rgba(58, 93, 204, 0.3);
        }

        header img {
            height: 50px;
            filter: drop-shadow(0 0 2px rgba(0, 0, 0, 0.2));
        }

        header h1 {
            font-weight: 700;
            font-size: 1.8rem;
            white-space: nowrap;
        }

        /* Container layout */
        .container {
            display: flex;
            flex: 1;
            min-height: 0;
            background: white;
        }

        /* Sidebar */
        nav.sidebar {
            width: 220px;
            background-color: #2e43a5;
            color: white;
            display: flex;
            flex-direction: column;
            padding-top: 20px;
            box-shadow: 3px 0 10px rgba(58, 93, 204, 0.15);
            flex-shrink: 0;
        }

        nav.sidebar ul {
            list-style: none;
            padding: 0 10px;
        }

        nav.sidebar ul li {
            padding: 15px 10px;
            cursor: pointer;
            font-weight: 600;
            border-radius: 6px;
            transition: background-color 0.25s ease;
            user-select: none;
        }

        nav.sidebar ul li:hover {
            background-color: #3a5dcc;
        }

        nav.sidebar .logout {
            margin-top: auto;
            padding-bottom: 20px;
        }

        /* Main content area */
        main.content {
            flex: 1;
            padding: 25px 30px;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
        }

        /* Filter panel */
        .filter-panel {
            margin-bottom: 25px;
            max-width: 320px;
        }

        .filter-panel label {
            font-weight: 600;
            margin-bottom: 6px;
            display: block;
            color: #3a5dcc;
        }

        .filter-panel select {
            width: 100%;
            padding: 8px 12px;
            border: 2px solid #3a5dcc;
            border-radius: 8px;
            font-size: 1rem;
            background: white;
            color: #1a2e6e;
            cursor: pointer;
            transition: border-color 0.3s ease;
        }

        .filter-panel select:focus {
            outline: none;
            border-color: #2749c8;
            box-shadow: 0 0 8px rgba(58, 93, 204, 0.4);
        }

        /* --- Course cards container --- */
        .Course-Box {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }

        /* Individual course box */
        .Box-2 {
            background: white;
            border: 2px solid #3a5dcc;
            border-radius: 14px;
            box-shadow: 0 4px 15px rgba(58, 93, 204, 0.15);
            padding: 15px;
            cursor: pointer;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            display: flex;
            flex-direction: column;
        }

        .Box-2:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 24px rgba(58, 93, 204, 0.3);
        }

        .Box-2 img {
            width: 100%;
            border-radius: 12px;
            object-fit: cover;
            height: 150px;
            margin-bottom: 12px;
        }

        .Box-2 h4 {
            font-weight: 700;
            color: #2749c8;
            margin-bottom: 10px;
            text-align: center;
        }

        .progress-container {
            margin-top: auto;
            text-align: center;
            font-weight: 600;
            color: #3a5dcc;
        }

        progress {
            width: 100%;
            height: 18px;
            border-radius: 12px;
            overflow: hidden;
            appearance: none;
            -webkit-appearance: none;
            margin-top: 6px;
        }

        progress::-webkit-progress-bar {
            background-color: #e6e9f8;
            border-radius: 12px;
        }

        progress::-webkit-progress-value {
            background-color: #3a5dcc;
            border-radius: 12px;
        }

        progress::-moz-progress-bar {
            background-color: #3a5dcc;
            border-radius: 12px;
        }

        /* Responsive tweaks */
        @media (max-width: 900px) {
            nav.sidebar {
                display: none;
            }

            main.content {
                padding: 15px;
            }

            .Course-Box {
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            }
        }
    </style>
</head>

<body>
    <header>
        <img src="/Group Assignment/Picture/logo.png" alt="CourseVerse Logo" />
        <h1>CourseVerse</h1>
        <h1>Welcome - Student <?php echo htmlspecialchars($prefixed_user_id); ?></h1>
    </header>

    <div class="container">
        <nav class="sidebar">
            <ul>
                <li onclick="window.location.href='/Group Assignment/Student Interface/Student_ProfilePage.php'">Profile</li>
            </ul>
            <ul class="logout">
                <li onclick="window.location.href='/Group Assignment/PHP/LogOut.php'">Log Out</li>
            </ul>
        </nav>

        <main class="content">
            <div class="filter-panel">
                <label for="course-filter">Course Overview</label>
                <select id="course-filter" name="course-filter" required>
                    <option value="All Course">All Course</option>
                    <option value="In progress Course">In Progress Course</option>
                    <option value="Pass Course">Pass Course</option>
                    <option value="Future Course">Future Course</option>
                    <option value="Pinned Course">Pinned Course</option>
                    <option value="Course Removed From View">Course Removed From View</option>
                </select>
            </div>

            <main class="content">
                <div class="Course-Box">
                    <div class="Box-2" onclick="window.location.href='/Group Assignment/Uploads/Module_1/Module 1.html'">
                        <img src="/Group Assignment/Picture/Math Module.jpeg" alt="Module 1" />
                        <h4>Module 1</h4>
                        <div class="progress-container">
                            <label>Your Progress:</label>
                            <progress id="Math-1-Progress" value="0" max="100"></progress>
                        </div>
                    </div>

                    <div class="Box-2" onclick="window.location.href='/Group Assignment/Uploads/Module_2/module%202.html'">
                        <img src="/Group Assignment/Picture/Math Module.jpeg" alt="Module 2" />
                        <h4>Module 2</h4>
                        <div class="progress-container">
                            <label>Your Progress:</label>
                            <progress id="Math-2-Progress" value="0" max="100"></progress>
                        </div>
                    </div>

                    <div class="Box-2" onclick="window.location.href='/Group Assignment/Uploads/Module_3/module%203.html'">
                        <img src="/Group Assignment/Picture/Math Module.jpeg" alt="Module 3" />
                        <h4>Module 3</h4>
                        <div class="progress-container">
                            <label>Your Progress:</label>
                            <progress id="Math-3-Progress" value="0" max="100"></progress>
                        </div>
                    </div>

                    <div class="Box-2" onclick="window.location.href='/Group Assignment/Uploads/Module_4/module%204.html'">
                        <img src="/Group Assignment/Picture/Math Module.jpeg" alt="Module 4" />
                        <h4>Module 4</h4>
                        <div class="progress-container">
                            <label>Your Progress:</label>
                            <progress id="Math-4-Progress" value="0" max="100"></progress>
                        </div>
                    </div>
                </div>
            </main>
    </div>
</body>

</html>