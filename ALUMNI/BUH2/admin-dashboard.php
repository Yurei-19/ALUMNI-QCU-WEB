<!DOCTYPE html>
<html lang ="en">
    <head>
        <title>ALUMNI</title>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel ="stylesheet" href ="style.css"/>
        
    </head>
    <body>
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
                    <div class="nav-button"><img src="icon-admin.png"/><a href="create-admin.php"><li>Create Admin </li></a></div>
                    <div class="nav-button"><img src="about-icon.png"><a href="about3.php"><li>About</li></a></div>
                    <div class="nav-button">  <img src="logout-icon.png"><a href="#" id="openModalLink"><li>Logout</li></a></div>   
                </ul>
            </div>
        </nav>
        </header>
        <div class="pop-up-container">
            
            <p>You Successfully Logged In As <span class="highlight-admin">Administrator!</span></p>
            <button class="close-button-admin-dashboard" type="button" id="close">OK</button>
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
                <a href="logout.php" class="modal-log-out-button">Logout</a>
                </div>
                </div>

            </div>
        </div>
        <script>  window.history.forward(); </script>
        <script src ="main.js">
            // Get the modal

        </script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </body>
</html>