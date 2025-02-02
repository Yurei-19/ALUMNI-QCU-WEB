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
              <h2 class="qcu">QUEZON CITY UNIVERSITY</h2>
              <h1 class="alumni">ALUMNI</h1>
            </div>
        <nav>
            <div class="nav">
                <ul>
                    <div class="nav-button"><img src="home.png"/> <a href="index.php"><li>Home</li></a></div>
                    <div class="nav-button"><img src="events-icon.png" /><a href="events.php"><li>Events</li></a></div>
                    <div class="nav-button" style="background: linear-gradient(95deg, rgba(0, 0, 0, 0.76), rgb(99, 99, 235));"><img src="community-icon.png" style="filter: brightness(0) invert(1);"/> <a href="community.php" style="color: white;"><li>Community</li></a></div>
                    <div class="nav-button"><img src="alumni-icon.png" /><a href="alumni-login.php"><li>Alumni</li></a></div>
                    <div class="nav-button"><img src="icon-admin.png"><a href="admin-login.php"><li>Admin</li></a></div> 
                    <div class="nav-button"><img src="about-icon.png"><a href="about.php"><li>About</li></a></div> 
                </ul>
            </div>
        </nav>
        </header>
        <div class="community-container">
        <div class="left-community-container">
            <div class="top-left-community-container">
                
            </div>
            <div class="bottom-left-community-container">
                <button type="button" class="button-kyusimunity" onclick="window.location.href='community.php'">Kyusimunity</button>
                <button type="button" class="button-topics"  onclick="window.location.href='topics.php'">Topics</button>
                
            </div>
            
        </div>
        <div class="scrollable">
            <div class="right-community-container">
            <div class="top-community-container-kyusimunity">
                <form action="" method="">
                    <textarea class="top-community-textarea" name="post-content" required placeholder="Share what's in your mind"></textarea>
                    <button type="submit" id="postButton" name="post-button" onclick="redirectToLogin()">Post</button>

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
        echo "<img src='  ' alt='' class='posted-profile' style='background-color: #fff;'><br><br>";
        echo "<p class='posted-name'>". "Anonymous" ."</p>";
        echo " <div class='likes-container'>
        <span class='like-count'>$likeCount Likes</span>
       
        
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
        </div>
    </div>
      
        
    <script>
    function redirectToLogin() {
        // Redirect to the login page
        window.location.href = 'alumni-sign-up.php'; // Replace 'login.html' with the URL of your login page
    }
</script>
       
        <script src ="main.js"></script>
    </body>
</html>