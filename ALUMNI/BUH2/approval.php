<!DOCTYPE html>
<html lang="en">
<head>
    <title>ALUMNI</title>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="style.css"/>
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
    </div>
    <nav>
        <div class="nav">
            <ul>
                <!-- Ensure onclick attribute calls toggleDisplay() with appropriate add_id -->
                <div class="nav-button"><img src="home.png"/> <a href="index3.php"><li>Home</li></a></div>
                <div class="nav-button"><img src="events-icon.png"/><a href="events3.php"><li>Add Events</li></a></div>
                <div class="nav-button"><img src="monitoring.png "/><a href="community3.php">Monitoring</a></div>
                <div class="nav-button" style="background: linear-gradient(95deg, rgba(0, 0, 0, 0.76), rgb(99, 99, 235));">
                    <img src="checkmark.png" style="filter: brightness(0) invert(1);"/> <a href="approval.php"
                                                                                            style="color: white;"><li>Approval</li></a>
                </div>
                <div class="nav-button"><img src="crossmark.png"/><a href="archive.php"><li>Archive</li></a></div>
                <div class="nav-button"><img src="icon-admin.png"/><a href="create-admin.php"><li>Create Admin </li></a></div>
                <div class="nav-button"><img src="about-icon.png"><a href="about3.php"><li>About</li></a></div>
                <div class="nav-button"> <img src="logout-icon.png"><a href="#" id="openModalLink"><li>Logout</li></a></div>
            </ul>
        </div>
    </nav>
</header>

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
<h1 class="approval-request-h1">Alumni Request</h1>
<div class="search-container">
    
    <input type="text" id="searchInput" placeholder="Search by name">
    <button class="search-button" onclick="searchAlumniApproval()">
    <i class="fas fa-search search-icon"></i> <!-- Font Awesome search icon -->
    
  </button>
    
</div>
<div class="approval-container">
    <div class="left-side-approval">
        <div class="scrollable1">
          
            <?php
            // Database connection
            session_start();
            $conn = new mysqli("localhost", "root", "", "testdb");

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Query to fetch alumni data
            $sql = "SELECT * FROM ADD_ALUMNI";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='clickable-div' onclick='toggleDisplay(" . $row["add_id"] . ")'>";
                    echo "<div class='profile-picture-approval'>";
                    echo "<img src='" . $row["profile_picture"] . "' alt='Profile Picture'><br><br>";
                    echo "</div>";
                    echo "<div class='profile-info-div'>";
                    echo "<h1 class='h2-profile'>Name:</h1> " . "<span class='h2-profile-value'>" . $row["firstname"] . " " . $row["middlename"] . " " . $row["lastname"] . "</span><br>";
                    echo "<h1 class='h2-profile'>Age: </h1>" . "<span class='h2-profile-value'>" . $row["age"] . "</span><br>";
                    echo "<h1 class='h2-profile'> Course: </h1>" . "<span class='h2-profile-value'>" . $row["course"] . "</span><br>";
                    echo "<h1 class='h2-profile-description'>Description:</h1> " . "<span class='h2-profile-value-description'>" . $row["description"] . "</span><br>";
                   
                    echo "</div>";
                    echo "<h1 class='clickformore'>Click for More Info</h1>";
                    echo "</div>"; // Close alumni-profile div
                }
            } else {
              // echo "0 results";
            }

            // Close connection
            $conn->close();
            ?>
        </div>
    </div>
    <div class="right-side-approval">
        <div id="hiddenDiv" class="hidden-div">
            <div class="hidden-approval-profile" id="alumniDetails">
                <!-- Alumni details fetched via AJAX will be displayed here -->
            </div>
        </div>
    </div>
</div>
<script src="main.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    // JavaScript function to fetch alumni details via AJAX
    

</script>
</body>
</html>
