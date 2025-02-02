<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "testdb");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the search query
$searchQuery = $_POST['query'];

// Query to search alumni by name
if (!empty($searchQuery)) {
    $sql = "SELECT * FROM ADD_ALUMNI_LIST WHERE firstname LIKE '%$searchQuery%' OR lastname LIKE '%$searchQuery%' OR middlename LIKE '%$searchQuery%' OR CONCAT(firstname, ' ', lastname) LIKE '%$searchQuery%' OR CONCAT(firstname, ' ', middlename) LIKE '%$searchQuery%' OR middlename LIKE '%$searchQuery%' OR CONCAT(firstname, ' ', lastname) LIKE '%$searchQuery%' OR CONCAT(middlename, ' ', lastname) LIKE '%$searchQuery%'";
} else {
    $sql = "SELECT * FROM ADD_ALUMNI_LIST";
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<div class='clickable-div' onclick='toggleDisplayList(" . $row["add_id"] . ")'>";
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
    echo "No results found";
}

// Close connection
$conn->close();
?>