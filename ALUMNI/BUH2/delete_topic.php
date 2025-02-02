<?php
// delete_post.php
$conn = new mysqli("localhost", "root", "", "testdb");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if(isset($_POST['delete-button']) && isset($_POST['post_id'])) {
    // Get the post ID from the form submission
    $postId = $_POST['post_id'];

    // Sanitize the post ID to prevent SQL injection
    $postId = mysqli_real_escape_string($conn, $postId);

    // Construct the DELETE SQL query
    $deleteQuery = "DELETE FROM asks_table WHERE post_id = $postId";

    // Execute the DELETE query
    if ($conn->query($deleteQuery) === TRUE) {
        // Redirect to the topics page after successful deletion
        header("Location: topics3.php");
        exit(); // Make sure to exit after redirection
    } else {
        // Handle deletion error
        echo "Error deleting post: " . $conn->error;
    }
}

// Close database connection
$conn->close();
?>