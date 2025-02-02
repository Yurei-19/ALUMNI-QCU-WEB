
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
         
              <h1 class="alumni">ADMIN DASHBOARD</h1>
            </div>
        <nav>
            <div class="nav">
                <ul>
                <div class="nav-button"><img src="home.png"/> <a href="index3.php"><li>Home</li></a></div>
                    <div class="nav-button"><img src="events-icon.png" /><a href="events3.php"><li>Add Events</li></a></div>
                    <div class="nav-button" style="background: linear-gradient(95deg, rgba(0, 0, 0, 0.76), rgb(99, 99, 235));"><img src="monitoring.png" style="filter: brightness(0) invert(1);"/> <a href="community3.php" style="color: white;"><li>Monitoring</li></a></div>
                    <div class="nav-button"><img src="checkmark.png" /><a href="approval.php"><li>Approval</li></a></div>
                    <div class="nav-button"><img src="crossmark.png" /><a href="archive.php"><li>Archive</li></a></div>
                    <div class="nav-button"><img src="icon-admin.png"/><a href="create-admin.php"><li>Create Admin </li></a></div>
                    <div class="nav-button"><img src="about-icon.png"><a href="about3.php"><li>About</li></a></div>
                    <div class="nav-button">  <img src="logout-icon.png"><a href="#" id="openModalLink"><li>Logout</li></a></div>   
                </ul>
            </div>
        </nav>
        </header>
        <div class="community-container">
        <div class="left-community-container">
            <div class="top-left-community-container">
               
            </div>
            <div class="bottom-left-community-container">
                <button type="button" class="button-kyusimunity" onclick="window.location.href='community3.php'">Kyusimunity</button>
                <button type="button" class="button-topics"  onclick="window.location.href='topics3.php'">Topics</button>
    
            </div>
        </div>
        <div class="scrollable">
       
            <div class="bottom-community-container-kyusimunity" style="height: 850px;">
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
        <span class='like-count'>$likeCount Likes</span>
        
       
                </div>";
                echo "<form action='delete-post.php' method='post' onsubmit='return confirm(\"Are you sure you want to delete this topic?\");'>";
echo "<input type='hidden' name='post_id' value='$postId'>";
echo "<button type='submit' name='delete_post' class='delete-button-profile'><i class='fas fa-trash'> Delete</i></button>";
echo "</form>";
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
    </div>
      
       
        <button class="close-button-admin-dashboard" type="button" id="close" style="display: none;">X</button>
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
        <script src ="main.js">
            // Get the modal

        </script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </body>
</html>