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
                    <div class="nav-button" style="background: linear-gradient(95deg, rgba(0, 0, 0, 0.76), rgb(99, 99, 235));"><img src="alumni-icon.png" style="filter: brightness(0) invert(1);"/> <a href="alumni-login.php" style="color: white;"><li>Alumni</li></a></div>
                    <div class="nav-button"><img src="icon-admin.png"><a href="admin-login.php"><li>Admin</li></a></div> 
                    <div class="nav-button"><img src="about-icon.png"><a href="about.php"><li>About</li></a></div> 
                </ul>
            </div>
        </nav>
        </header>
        <?php
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

$remember = "";

if(isset($_POST['login'])) {
    $usernameemail = $_POST['email'];
    $password = $_POST['pass'];
    if(isset($_POST['remember'])){ // <-- Corrected typo here
        $remember = $_POST['remember'];
    }

    // Prepare SQL statement
    $sql = "SELECT alumni_id, username, email FROM TABLE_USER WHERE (username = ? OR email = ?) AND password = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sss", $usernameemail, $usernameemail, $password);
    
    // Execute SQL statement
    mysqli_stmt_execute($stmt);

    // Store result
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        // User found
        $_SESSION["user_id"] = $row['alumni_id']; 
        $_SESSION["user"] = $row['username']; 
        $_SESSION["email"] = $row['email']; 
        if(!empty($remember)){ // Check if remember checkbox is checked
            setcookie("remember_email/username", $usernameemail, time() + 3600*24*365 );
            setcookie("remember", $remember, time() + 3600*24*365 );
        }
        else {
            setcookie("remember_email/username", "", time() - 36000); // Clear cookies if remember is not checked
            setcookie("remember", "", time() - 36000);
        }
        header("Location: alumni-dashboard.php");
        exit;
    } else {
        // Login failed
        echo '<script>alert("Login failed. Invalid username or password."); window.location.href = "alumni-sign-up.php";</script>';
        exit;
    }
}

if(isset($_SESSION["user"])){
    header("Location: alumni-dashboard.php");
    exit;
}
?>
        <div class="alumni-container">
        <div class="blur-background"></div>
        <div class="create-account">
                <div class="create-account-inner-container">
                <form action ="alumni-sign-up.php"  method="POST" >
                    <h1>Login</h1>
                    <input class="textbox-alumni" type="text" id="email" name="email" placeholder="Email Or Username" value="<?php echo isset($_COOKIE['remember_email/username']) ? $_COOKIE['remember_email/username'] : ''; ?>" required/>
                    <input class="textbox-alumni" type="password" id ="password" required placeholder ="Password" name="pass" />
                    <label class="remember-me-label"><input type="checkbox" name = "remember" class="check" <?php if(isset($_COOKIE["remember"])) 
                    { ?> checked <?php } elseif(!empty($remember)) { ?> checked <?php } ?>>Remember Me </label><br>
                    <input class="create-account-button" type ="submit" value ="Login" name="login"/>
                    
                </form>
                </div>  
            </div>
            <div class="welcome-login">
                    <h1>WELCOME BACK TO </h1>
                    <h1>QUEZON CITY</h1>
                    <h1>UNIVERSITY </h1>
                    <h1>ALUMNI WEBSITE</h1>>
                    <h2>Don't have an account?</h2>
                    <button type="submit" class="welcome-login-button" onclick="location.href='alumni-login.php'">Sign Up</button>

      
            <script>
                window.history.forward();
            </script>
        <script src ="main.js"></script>    
       
    </body>
</html>