<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin Sign Up</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
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

    if(isset($_POST['signup'])){
        
        $username = $_POST['user'];
        $password = $_POST['pass'];
        $cpassword = $_POST['cpass'];
        
        // Check if username already exists
        $check_username_query = "SELECT * FROM admin_login WHERE username='$username'";
        $check_username_result = mysqli_query($connection, $check_username_query);
        $count_username = mysqli_num_rows($check_username_result);

        if($count_username > 0) {
            echo '<script>alert("Username already exists!"); window.location.href = "admin-signup.php";</script>';
            exit();
        }

        // Insert new admin record
        $insert_admin_query = "INSERT INTO admin_login (username, password) VALUES ('$username', '$password')";
        $insert_admin_result = mysqli_query($connection, $insert_admin_query);

        if($insert_admin_result) {
            echo '<script>alert("Admin registered successfully!"); window.location.href = "admin-login.php";</script>';
        } else {
            echo '<script>alert("Error occurred while registering admin!"); window.location.href = "admin-signup.php";</script>';
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
              <h1 class="alumni">ADMIN DASHBOARD</h1>
            </div>
        <nav>
            <div class="nav">
                <ul>
                <div class="nav-button"><img src="home.png"/> <a href="index3.php"><li>Home</li></a></div>
                    <div class="nav-button"><img src="events-icon.png" /><a href="events3.php"><li>Add Events</li></a></div>
                    <div class="nav-button" ><img src="monitoring.png " /><a href="community3.php">Monitoring</a></div>
                    <div class="nav-button"><img src="checkmark.png" /><a href="approval.php"><li>Approval</li></a></div>
                    <div class="nav-button"><img src="crossmark.png" /><a href="archive.php"><li>Archive</li></a></div>
                    <div class="nav-button" style="background: linear-gradient(95deg, rgba(0, 0, 0, 0.76), rgb(99, 99, 235));"><img src="icon-admin.png" style="filter: brightness(0) invert(1);"/> <a href="create-admin.php" style="color: white;"><li>Create Admin</li></a></div> 
                    <div class="nav-button"><img src="about-icon.png"><a href="about3.php"><li>About</li></a></div>
                    <div class="nav-button">  <img src="logout-icon.png"><a href="#" id="openModalLink"><li>Logout</li></a></div>   
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
                    
            </div>
        <div class="create-account">
            <div class="create-account-inner-container">
                <form action="admin-signup.php" method="POST">
                    <h1>Create Admin Account</h1>
                    <input class="textbox-alumni" type="text" id="name" placeholder="Username" name="user" required />
                    <input class="textbox-alumni" type="password" id="password" name="pass" required
                        placeholder="Password" />
                    <input class="textbox-alumni" type="password" name="cpass" id="pass" placeholder="Re-type Password"
                        required />
                    <input class="create-account-button" type="submit" value="Sign Up" name="signup" />
                </form>
            </div>
        </div>
    </div>
    <button class="close-button-admin-dashboard" type="button" id="close" style="display:none;">X</button>
    <div id="myModal" class="modal">
            <div class="modal-content">
                <h1 class="log-out-h1">Log Out</h1>
                <p class="log-out-p">Are you sure you want to log out?</p>
                <div class="grey-box">
                <div class="transparent-border-box">
                <span class="close">Cancel</span>
                </div>
                <div class="blue-border-box">
                <a href="logout-alumni.php" class="modal-log-out-button">Logout</a>
                </div>
                </div>

            </div>
        </div>
    <script src="main.js"></script>
</body>

</html>
