<?php
// Define MySQL database connection parameters
$servername = "localhost"; // Change this to your MySQL server hostname
$username = "root"; // Change this to your MySQL username
$password = ""; // Change this to your MySQL password
$database = "testdb"; // Change this to your MySQL database name

// Create connection to MySQL
$connection = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from form
    $eventDate = $_POST['event-date'];
    $eventName = $_POST['event-name'];
    $eventDescription = $_POST['event-description'];

    // Prepare and bind parameters
    $sql = "INSERT INTO event_table (eventDate, eventName, eventDescription) VALUES (?, ?, ?)";
    $statement = mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($statement, "sss", $eventDate, $eventName, $eventDescription);
    
    // Execute statement
    if (mysqli_stmt_execute($statement)) {
        // Close MySQL connection
        mysqli_close($connection);

        // Redirect back to the HTML form or any other page
        header("Location: events3.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($connection);
    }
} else {
    // If form is not submitted, redirect back to the HTML form
    header("Location: index.html");
    exit();
}
?>