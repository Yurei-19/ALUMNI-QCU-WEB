<?php
// Check if the delete button is clicked and a post ID is provided
if(isset($_POST['delete-button']) && isset($_POST['post-id'])) {
    // Get the post ID from the form submission
    $postId = $_POST['post-id'];
    
    // Database connection
    $conn = new mysqli("localhost", "root", "", "testdb");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Construct the DELETE SQL query
    $deleteQuery = "DELETE FROM post_table WHERE post_id = $postId";

    // Execute the DELETE query
    if ($conn->query($deleteQuery) === TRUE) {
        echo '<script>alert("Post deleted successfully!"); window.location.href = "profile.php";</script>';
    } else {
        echo "Error deleting post: " . $conn->error;
    }

    // Close connection
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
                <button type="button" class="button-kyusimunity"  onclick="window.location.href='profile.php'">Profile</button>
                <button type="button" class="button-asks2" onclick="window.location.href='community2.php'">Kyusimunity</button>
                <button type="button" class="button-topics"  onclick="window.location.href='topics2.php'">Topics</button>
                <button type="button" class="button-asks2"  onclick="window.location.href='asks.php'">Asks</button>
            </div>
        </div>
        <div class="scrollable">
            <div class="right-community-container-profile">
            <?php
// Database connection
session_start();
$conn = new mysqli("localhost", "root", "", "testdb");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$userid = $_SESSION["user_id"];

// Query to fetch alumni data
$sql = "SELECT * FROM ADD_ALUMNI_PROFILE WHERE alumni_id = $userid";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<div class='main-container-profile'>";
        echo "<div class='profile-picture-main'>";
        echo "<img src='" . $row["profile_picture"] . "' alt='Profile Picture'><br><br>";
        echo "</div>";
        echo "<h1 class='h1-profile'>Name:</h1> "."<span class='h1-profile-value'>" . $row["firstname"]." ".$row["middlename"]." ".$row["lastname"]. "</span><br>";
        echo "<h1 class='h1-profile'>Email: </h1>"."<span class='h1-profile-value'>"  . $row["email"]. "</span><br>";
        echo "<h1 class='h1-profile'> Course: </h1>"."<span class='h1-profile-value'>" . $row["course"]. "</span><br>";
        echo "<h1 class='h1-profile'> Campus: </h1> "."<span class='h1-profile-value'>" . $row["campus"]. "</span><br>";
        echo "<h1 class='h1-profile' id='description'>Description:</h1> "."<span class='h1-profile-value'>" . $row["description"]. "</span><br>";
        echo "</div>";
    }
} else {
    echo "0 results";
}

// Close connection
$conn->close();
?>
 <?php

$conn = new mysqli("localhost", "root", "", "testdb");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$alumniId = $_SESSION["user_id"]; // Get currently logged-in user's ID

// Retrieve posts created by the logged-in user
$selectQuery = "SELECT post_table.post_id, post_table.postcontent, post_table.like_count, post_table.alumni_id, alumni_profile.firstname, alumni_profile.middlename, alumni_profile.lastname, alumni_profile.profile_picture
                FROM post_table
                LEFT JOIN add_alumni_profile AS alumni_profile ON post_table.alumni_id = alumni_profile.alumni_id
                WHERE post_table.alumni_id = $alumniId"; // Filter posts by alumni ID
$result = $conn->query($selectQuery);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $postId = $row["post_id"];
        $postContent = $row["postcontent"];
        $likeCount =$row["like_count"];

        // Display each post with a delete button
        echo "<div class='post-container' id='post_" . $postId . "'>";
        echo "<p class='posted-content'>$postContent</p>";
        echo "<img src='" . $row["profile_picture"] . "' alt='Profile Picture' class='posted-profile'><br><br>";
        echo "<p class='posted-name'>" . $row["firstname"] . " " . $row["middlename"]. " " .  $row["lastname"] ."</p>";
        echo " <div class='likes-container'>
                <span class='like-count'>$likeCount</span>
                <button class='like-btn' onclick='likePost($postId)'><i class='fas fa-thumbs-up'></i></button>
                <button class='unlike-btn' onclick='unlikePost($postId)'><i class='fas fa-thumbs-down'></i></button>
                </div>";
        // Add delete button with a form
        echo "<form method='POST' action='profile.php' class='delete-form' onsubmit='return confirm(\"Are you sure you want to delete this post?\");'>
                <input type='hidden' name='post-id' value='$postId'>
                <button type='submit' name='delete-button' class='delete-button-profile'><i class='fas fa-trash'> Delete</i></button>
                </form>";
        echo"</div>";
    }
} else {
    echo "No posts found.";
}

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