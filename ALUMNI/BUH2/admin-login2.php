<?php
    // Create connection to Oracle
/*$conn = oci_connect("system", "duplication", "//localhost:1522/orcl.mshome.net");

if (!$conn) {
  
$m = oci_error();
  
echo $m['message'], "\n";
 
exit;

}

    session_start();

    
    if(isset($_POST['login'])){
        $username = $_POST['user'];
        $password = $_POST['pass'];

        
        $sql = "SELECT * FROM admin_login WHERE username = :username AND password = :password";
        $stmt = oci_parse($conn, $sql);
        oci_bind_by_name($stmt, ':username', $username);
        oci_bind_by_name($stmt, ':password', $password);
        oci_execute($stmt);
        
        
        $row = oci_fetch_assoc($stmt);

        if($row){
            $_SESSION["user"] = $row['username'];

            header("Location: admin-dashboard.php");
            oci_close($conn);
            exit;
        } else {
            
            echo '<script>alert("Login failed. Invalid username or password."); window.location.href = "admin-login.php";</script>';
            exit;
        }
    }

   
    if(isset($_SESSION["user"])){
        header("Location: admin-dashboard.php");
        exit;
    }*/
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
                <div class="nav-button"><img src="home.png"/> <a href="index2.php"><li>Home</li></a></div>
                    <div class="nav-button"><img src="events-icon.png" /><a href="events2.php"><li>Events</li></a></div>
                    <div class="nav-button" ><img src="community-icon.png " /><a href="community2.php">My Community</a></div>
                    <div class="nav-button"><img src="alumni-icon.png" /><a href="#"><li>Add Alumni</li></a></div>
                    <div class="nav-button"><img src="alumni-icon.png" /><a href="#"><li>Alumni List</li></a></div>
                    <div class="nav-button"><img src="icon-admin.png"><a href="admin-login2.php"><li>Admin</li></a></div> 
                    <div class="nav-button"><img src="about-icon.png"><a href="about2.php"><li>About</li></a></div> 
                    <div class="nav-button">  <img src="about-icon.png"><a href="logout-alumni.php"><li>Logout</li></a></div> 
                </ul>
            </div>
        </nav>
        </header>
        <div class="alumni-container">
            
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
            
        </div>

        
        <script src ="main.js"></script>
    </body>
</html>