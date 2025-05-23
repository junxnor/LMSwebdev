<?php 
session_start();

if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
}

if (isset($_GET['Token_ID'])) {
    $token_id = $_GET['Token_ID'];
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
    <form action="/Group Assignment/PHP/Check_Token_Password.php" method="post">
    <!-- Include existing input fields -->
    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">

    <!-- Add hidden input field for token_id -->
    <input type="hidden" name="token_id" value="<?php echo $token_id; ?>">
        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
        <label>Password For The Token You Created</label>
        <input type="password" name="Password" maxlength="30" placeholder="Please insert your password">
        <button type="submit">Submit</button>
    </form>
</body>
</html>