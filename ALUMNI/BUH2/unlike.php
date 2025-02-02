<?php
session_start();

// Database connection
$conn = new mysqli("localhost", "root", "", "testdb");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if postId is received via POST request
if(isset($_POST['postId'])) {
    $postId = $_POST['postId'];
    $alumniId = $_SESSION["user_id"]; // Assuming you have a session variable holding the alumni_id

    // Check if the alumni has already liked the post
    $checkQuery = "SELECT * FROM post_likes WHERE alumni_id = ? AND post_id = ?";
    $stmt = $conn->prepare($checkQuery);
    $stmt->bind_param("ii", $alumniId, $postId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Alumni has previously liked the post, proceed with unliking
        $deleteQuery = "DELETE FROM post_likes WHERE alumni_id = ? AND post_id = ?";
        $stmt = $conn->prepare($deleteQuery);
        $stmt->bind_param("ii", $alumniId, $postId);
        $stmt->execute();

        // Update the like count in the post_table
        $updateQuery = "UPDATE post_table SET like_count = like_count - 1 WHERE post_id = ?";
        $stmt = $conn->prepare($updateQuery);
        $stmt->bind_param("i", $postId);
        $stmt->execute();

        // Fetch the updated like count for the post
        $selectQuery = "SELECT like_count FROM post_table WHERE post_id = ?";
        $stmt = $conn->prepare($selectQuery);
        $stmt->bind_param("i", $postId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo $row['like_count'];
        } else {
            echo "0";
        }
    } else {
        echo "You haven't liked this post.";
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}

?>