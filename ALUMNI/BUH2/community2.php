<?php
session_start();
$conn = new mysqli("localhost", "root", "", "testdb");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if(isset($_POST['post-button'])) {
 
    $postContent = $_POST['post-content'];
    $alumni_id = $_SESSION["user_id"];
    // Prepare and execute SQL query to insert data into the database
    $insertQuery = "INSERT INTO post_table (alumni_id, postcontent, like_count) VALUES (?, ?, 0)"; // Added like_count with a value of 0
    $stmt = $conn->prepare($insertQuery);
    $stmt->bind_param("is", $alumni_id, $postContent);

    if ($stmt->execute()) {
        echo '<script>alert("Post added successfully!"); window.location.href = "community2.php";</script>';
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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
                <button type="button" class="button-kyusimunity" onclick="window.location.href='community2.php'">Kyusimunity</button>
                <button type="button" class="button-topics"  onclick="window.location.href='topics2.php'">Topics</button>
                <button type="button" class="button-asks2"  onclick="window.location.href='asks.php'">Asks</button>
            </div>
        </div>
        <div class="scrollable">
            <div class="top-community-container-kyusimunity">
                <form action="community2.php" method="POST">
                    <textarea class="top-community-textarea" name="post-content" required placeholder="Share what's in your mind"></textarea>
                    <button type="submit" id="postButton" name="post-button">Post</button>
                </form>
            </div>
            <div class="bottom-community-container-kyusimunity">
            <?php

$conn = new mysqli("localhost", "root", "", "testdb");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve posts from the database
$selectQuery = "SELECT post_table.post_id, post_table.postcontent, post_table.like_count, post_table.alumni_id, alumni_profile.firstname, alumni_profile.middlename, alumni_profile.lastname, alumni_profile.profile_picture
FROM post_table
LEFT JOIN add_alumni_profile AS alumni_profile ON post_table.alumni_id = alumni_profile.alumni_id;
";
$result = $conn->query($selectQuery);

// Check if there are posts available
if ($result->num_rows > 0) {
    // Loop through each row to display posts
    while ($row = $result->fetch_assoc()) {
        $postId = $row["post_id"];
        $postContent = $row["postcontent"];
        $alumniId = $row["alumni_id"];
        $likeCount =$row["like_count"];

        // Display each post
        echo "<div class='post-container' id='post_" . $postId . "'>";
        echo "<p class='posted-content'>$postContent</p>";
        echo "<img src='" . $row["profile_picture"] . "' alt='Profile Picture' class='posted-profile'><br><br>";
        echo "<p class='posted-name'>" . $row["firstname"] . " " . $row["middlename"]. " " .  $row["lastname"] ."</p>";
        echo " <div class='likes-container'>
        <span class='like-count'>$likeCount</span>
        <button class='like-btn' onclick='likePost($postId)'><i class='fas fa-thumbs-up '></i></button>
        <button class='unlike-btn' onclick='unlikePost($postId)'><i class='fas fa-thumbs-down'></i></button>
        
                </div>";
        echo"</div>";
    }
} else {
    echo "No posts found.";
}

// Close connection
$conn->close();
?>

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