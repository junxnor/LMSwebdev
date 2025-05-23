<?php 

session_start();

// Change this to your connection info.
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'courseverse';

// Try and connect using the info above.
$conn = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
    // If there is an error with the connection, stop the script and display the error.
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

//sim////////////////////////////
if (!isset($_POST['FirstName'], $_POST['LastName'], $_POST['Email'], $_POST['UserPassword'])) {
    // Could not get the data that should have been sent.
    exit('Please fill up all the required fields!');
}

// Process form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST["FirstName"];
    $last_name = $_POST["LastName"];
    $email = $_POST["Email"];
    $gender = $_POST["Gender"];
    $password = password_hash($_POST["UserPassword"], PASSWORD_BCRYPT); // Hash the password before storing
    $securityword = $_POST["SecurityWord"];

    // Check if the email already exists in the 'email' table
    $emailCheckQuery = "SELECT * FROM admin_email WHERE Admin_Email = '$email'";
    $resultEmailCheck = $conn->query($emailCheckQuery);

    if ($resultEmailCheck === FALSE) {
        echo "Error checking email: " . $conn->error;
    } else {
        if ($resultEmailCheck->num_rows > 0) {
            // Email already exists, display an error message
            echo '<script> alert("Error: Email already exists!") </script>';
            echo '<script> history.go(-1) </script>';
        } else {
            // Insert data into the 'users' table
            $sql = "INSERT INTO admin (Admin_First_Name, Admin_Last_Name, Gender) VALUES ('$first_name', '$last_name' ,'$gender')";
            if ($conn->query($sql) === TRUE) {
                $user_id = mysqli_insert_id($conn);  // Get the auto-incremented USER_ID
                echo "User data inserted successfully!<br>";

                // Insert data into the 'email' table
                $sqlEmail = "INSERT INTO admin_email (Admin_USER_ID, Admin_Email) VALUES ('$user_id', '$email')";
                if ($conn->query($sqlEmail) === TRUE) {
                    echo "Email data inserted successfully!<br>";
                } else {
                    echo "Error: " . $sqlEmail . "<br>" . $conn->error;
                }

                // Insert data into the 'userpassword' table
                $sqlPassword = "INSERT INTO admin_password (Admin_USER_ID, Admin_PASSWORD,SecurityWord) VALUES ('$user_id', '$password','$securityword')";
                if ($conn->query($sqlPassword) === TRUE) {
                    echo "Password data inserted successfully!<br>";
                } else {
                    echo "Error: " . $sqlPassword . "<br>" . $conn->error;
                }


                // Use JavaScript to redirect after successful form submission
                echo '<script>window.location.href = "/Group Assignment/Admin/LoginPage.html";</script>';
                exit;

            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;

                // if ($conn->affected_rows > 0) {
                //  // Use JavaScript to redirect after successful form submission
                // echo '<script>window.location.href = "/Group Assignment/Student Interface/LoginPage.html";</script>';
                // exit;
                // } else {
                // // Handle the case where the insertion was not successful
                // exit('Failed to insert data into the database.');
                // }

            }
        }
    }
}




// Close the database connection
$conn->close();

// echo '<script>window.location.href = "/Group Assignment/Student Interface/LoginPage.html";</script>';
// exit;
?>


