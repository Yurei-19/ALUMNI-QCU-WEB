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
              <h1 class="alumni">ALUMNI DASHBOARD</h1>
            </div>
        <nav>
            <div class="nav">
                <ul>
                <div class="nav-button"><img src="home.png"/> <a href="index2.php"><li>Home</li></a></div>
                    <div class="nav-button"><img src="events-icon.png" /><a href="events2.php"><li>Events</li></a></div>
                    <div class="nav-button" ><img src="community-icon.png " /><a href="community2.php">My Community</a></div>
                    <div class="nav-button"><img src="alumni-icon.png" /><a href="addalumni.php"><li>Add Information</li></a></div>
                    <div class="nav-button"><img src="alumni-icon.png" /><a href="alumnilist.php"><li>Alumni List</li></a></div>
                
                    <div class="nav-button"><img src="about-icon.png"><a href="about2.php"><li>About</li></a></div> 
                    <div class="nav-button">  <img src="logout-icon.png"><a href="#" id="openModalLink"><li>Logout</li></a></div> 
                </ul>
            </div>
        </nav>
        </header>
        <div class="pop-up-container">
           
            <p>You Successfully Logged In As <span class="highlight-admin">Alumni!</span></p>
            <button class="close-button-admin-dashboard" type="button" id="close">OK</button>
        </div>
        
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
       <script>  window.history.forward(); </script>
        <script src ="main.js">
            // Get the modal

        </script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </body>
</html>