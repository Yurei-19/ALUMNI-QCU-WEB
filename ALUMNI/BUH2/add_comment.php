<?php
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Establish database connection
    $conn = new mysqli("localhost", "root", "", "testdb");

    // Check if the connection was successful
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve form data
    $post_id = $_POST["ask_id"]; // Assuming 'ask_id' is the name of the hidden input field containing the post ID
    $commenter_id = $_SESSION["user_id"]; // Assuming 'user_id' is the session variable containing the user ID
    $comment_content = $_POST["comment_content"];

    // Prepare SQL statement to insert the comment into the database
    $insertQuery = "INSERT INTO comments (post_id, commenter_id, comment_content) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($insertQuery);
    $stmt->bind_param("iis", $post_id, $commenter_id, $comment_content);

    // Execute the statement
    if ($stmt->execute()) {
        // Comment inserted successfully
        header("Location: topics2.php");
    } else {
        // Error occurred while inserting comment
        echo "Error: " . $insertQuery . "<br>" . $conn->error;
    }

    // Close statement
    $stmt->close();
    // Close connection
    $conn->close();
} else {
    // Redirect to the page where the form is located (if needed)
    header("Location: topics2.php");
    exit();
}
?>
