<?php
// Start session
session_start();

// Define MySQL database connection parameters
$servername = "localhost"; // Change this to your MySQL server hostname
$username = "root"; // Change this to your MySQL username
$password = ""; // Change this to your MySQL password
$database = "testdb"; // Change this to your MySQL database name

// Create connection to MySQL
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if(isset($_POST['login'])){
    $username = $_POST['user'];
    $password = $_POST['pass'];

    // Prepare SQL statement
    $sql = "SELECT * FROM admin_login WHERE username = ? AND password = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $username, $password);
    
    // Execute SQL statement
    mysqli_stmt_execute($stmt);

    // Store result
    $result = mysqli_stmt_get_result($stmt);

    // Fetch associative array
    $row = mysqli_fetch_assoc($result);

    if($row){
        $_SESSION["user"] = $row['username'];
        mysqli_close($conn);
        header("Location: admin-dashboard.php");
        exit;
    } else {
        echo '<script>alert("Login failed. Invalid username or password."); window.location.href = "admin-login.php";</script>';
        exit;
    }
}

if(isset($_SESSION["user"])){
    header("Location: admin-dashboard.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang ="en">
    <head>
        <title>ALUMNI</title>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel ="stylesheet" href ="style.css"/>
        <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    </head>
    <body>
        <header class="header">
          <div class="logo-text-container">
            <div class="qcu-logo">
              <img src="qculogo.png" alt="QC University">
            </div>
            <div class="headings">
           
              <h1 class="alumni">Login</h1>
            </div>
        <nav>
            <div class="nav">
                <ul>
                <div class="nav-button"><img src="home.png"/> <a href="index.php"><li>Home</li></a></div>
                    <div class="nav-button"><img src="events-icon.png" /><a href="events.php"><li>Events</li></a></div>
                    <div class="nav-button" ><img src="community-icon.png " /><a href="community.php">Community</a></div>
                    <div class="nav-button"><img src="alumni-icon.png" /><a href="alumni-login.php"><li>Alumni</li></a></div>
                    <div class="nav-button" style="background: linear-gradient(95deg, rgba(0, 0, 0, 0.76), rgb(99, 99, 235));"><img src="icon-admin.png" style="filter: brightness(0) invert(1);"/> <a href="admin-login.php" style="color: white;"><li>Admin</li></a></div> 
                    <div class="nav-button"><img src="about-icon.png"><a href="about.php"><li>About</li></a></div> 
                </ul>
            </div>
        </nav>
        </header>
        <div class="alumni-container">
        <div class="blur-background"></div>
            <div class="create-account">
                <div class="create-account-inner-container">
                <form name="form" action ="admin-login.php" method ="POST">
                    <h1>Admin Login</h1>
                    <input class="textbox-alumni"type="text" name ="user" placeholder ="Username" required/>
                    <input class="textbox-alumni" type="password"  name="pass" placeholder ="Password" required/>
                    <input class="create-account-button" type ="submit" value ="Login" name ="login"/>
                </form>
                </div>
            </div>
            <div class="welcome-login">
                    <h1>WELCOME TO </h1>
                    <h1>QUEZON CITY</h1>
                    <h1>UNIVERSITY </h1>
                    <h1>ALUMNI WEBSITE</h1>>
                    
            </div>
        </div>

        <script>  window.history.forward(); </script>
        <script src ="main.js"></script>
    </body>
</html>