<?php
session_start();
$conn = new mysqli("localhost", "root", "", "testdb");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if(isset($_POST['asks'])) {
 
    $title = $_POST['title'];
    $description = $_POST['description'];
    $related_topic = $_POST['related_topic'];
    $alumni_id = $_SESSION['user_id']; // Assuming 'user_id' is the session variable holding the user's ID

    // Prepare and execute SQL query to insert data into the database
    $insertQuery = "INSERT INTO asks_table (alumni_id, title, description, related_topic) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($insertQuery);
    $stmt->bind_param("isss", $alumni_id, $title, $description, $related_topic);

    if ($stmt->execute()) {
        echo '<script>alert("Asks successfully!"); window.location.href = "asks.php";</script>';
    } else {
        echo "Error: " . $insertQuery . "<br>" . $conn->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
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
                    <div class="nav-button" style="background: linear-gradient(95deg, rgba(0, 0, 0, 0.76), rgb(99, 99, 235));"><img src="community-icon.png" style="filter: brightness(0) invert(1);"/> <a href="community2.php" style="color: white;"><li>My Community</li></a></div>
                    <div class="nav-button"><img src="alumni-icon.png" /><a href="addalumni.php"><li>Add Information</li></a></div>
                    <div class="nav-button"><img src="alumni-icon.png" /><a href="alumnilist.php"><li>Alumni List</li></a></div>
                   
                    <div class="nav-button"><img src="about-icon.png"><a href="about2.php"><li>About</li></a></div> 
                    <div class="nav-button">  <img src="logout-icon.png"><a href="#" id="openModalLink"><li>Logout</li></a></div> 
                </ul>
            </div>
        </nav>
        </header>
        <div class="community-container">
        <div class="left-community-container">
            <div class="top-left-community-container">
                <input type ="text" />
            </div>
            <div class="bottom-left-community-container">
            <button type="button" class="button-asks2"  onclick="window.location.href='profile.php'">Profile</button>   
                <button type="button" class="button-kyusimunity2" onclick="window.location.href='community2.php'">Kyusimunity</button>
                <button type="button" class="button-topics"  onclick="window.location.href='topics2.php'">Topics</button>
                <button type="button" class="button-asks"  onclick="window.location.href='asks.php'">Asks</button>
            </div>
        </div>
        <div class="scrollable">
            <div class="right-community-container-asks">
            <form action="asks.php" method="POST">
  
    <label for="title">Title:</label>
    <input type="text" id="title" name="title" required>
  

    <label for="description">Description:</label>
    <textarea id="description" name="description"  required></textarea>
  
    <label for="related_topic">Related Topic:</label>
    <select id="related_topic" name="related_topic">
      <option value="job">Job</option>
      <option value="qcu">QCU</option>
    </select>

    <button type="submit" value="Submit" name="asks">ASKS</button>
</form>
            </div>
        </div>
    </div>
      
        <button type="button" id="close" style="display: none;">X</button>    
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
        <script src ="main.js">
            // Get the modal

        </script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </body>
</html>