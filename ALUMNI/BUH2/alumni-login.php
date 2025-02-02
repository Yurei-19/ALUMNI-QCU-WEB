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
    <?php 
// Define MySQL database connection parameters
$servername = "localhost"; // Change this to your MySQL server hostname
$username = "root"; // Change this to your MySQL username
$password = ""; // Change this to your MySQL password
$database = "testdb"; // Change this to your MySQL database name

// Create connection to MySQL
$connection = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if(isset($_POST['login'])){
    
    $username = $_POST['user'];
    $email = $_POST['email'];
    $password = $_POST['pass'];
    $cpassword = $_POST['cpass'];
    
 
    $sql = "SELECT * FROM TABLE_USER WHERE username=?";
    $stmt = mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    $count_user = mysqli_stmt_num_rows($stmt);
    
    
    $sql = "SELECT * FROM TABLE_USER WHERE email=?";
    $stmt = mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    $count_email = mysqli_stmt_num_rows($stmt);
    
    
    if($count_user == 0 && $count_email == 0){
        if($password == $cpassword){
            $sql = "INSERT INTO TABLE_USER(username, email, password) VALUES(?, ?, ?)";
            $stmt = mysqli_prepare($connection, $sql);
            mysqli_stmt_bind_param($stmt, "sss", $username, $email, $password);
            $success = mysqli_stmt_execute($stmt);
            
            if ($success) {
                echo '<script>alert("User registered successfully!"); window.location.href = "alumni-sign-up.php";</script>';
            } else {
                echo '<script>alert("Error occurred while registering user!"); window.location.href = "alumni-login.php";</script>';
            }
        } else {
            echo '<script>alert("Passwords do not match!"); window.location.href = "alumni-login.php";</script>';
        }
    } else {
        echo '<script>alert("Username or email already exists!"); window.location.href = "alumni-login.php";</script>';
    }
}

// Close the database connection
mysqli_close($connection);
?>


        <header class="header">
          <div class="logo-text-container">
            <div class="qcu-logo">
              <img src="qculogo.png" alt="QC University">
            </div>
            <div class="headings">
              <h1 class="alumni">Sign Up</h1>
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
        <div class="alumni-container">
        <div class="blur-background"></div>
            <div class="welcome-login">
                    <h1>WELCOME TO </h1>
                    <h1>QUEZON CITY</h1>
                    <h1>UNIVERSITY </h1>
                    <h1>ALUMNI WEBSITE</h1>>
                    <h2>Already have an account?</h2>
                    <button type="submit" class="welcome-login-button" onclick="location.href='alumni-sign-up.php'">Login</button>
            </div>
            <div class="create-account">
                <div class="create-account-inner-container">
                <form action = "alumni-login.php" method ="POST" >
                    <h1>Create Account</h1>
                    <input class="textbox-alumni" type="text" id ="name" placeholder ="Username" name ="user" required/>
                    <input class="textbox-alumni"type="email" id ="email" name ="email" placeholder ="Email" required/>
                    <input class="textbox-alumni" type="password" id ="password" name ="pass" required placeholder ="Password"/>
                    <input class="textbox-alumni" type="password" name ="cpass" id ="pass" placeholder="Re-type Password" required/> 
                    <input class="create-account-button" type ="submit" value ="Sign Up" name="login" />
                </form>
                </div>  
            </div>
            
        </div>

        
        <script src ="main.js"></script>
    </body>
</html>