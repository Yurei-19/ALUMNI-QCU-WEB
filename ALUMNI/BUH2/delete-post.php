<?php
// delete-post.php
$conn = new mysqli("localhost", "root", "", "testdb");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_post'])) {
    // Get the post ID to be deleted
    if(isset($_POST['post_id'])) {
        $postId = $_POST['post_id'];
        // Delete associated records from post_likes table using prepared statement
        $deleteLikesQuery = $conn->prepare("DELETE FROM post_likes WHERE post_id = ?");
        $deleteLikesQuery->bind_param("i", $postId);
        if ($deleteLikesQuery->execute()) {
            // Proceed with deleting the post
            $deleteQuery = $conn->prepare("DELETE FROM post_table WHERE post_id = ?");
            $deleteQuery->bind_param("i", $postId);
            if ($deleteQuery->execute()) {
                // Redirect to the same page after deletion
                header("Location: {$_SERVER['HTTP_REFERER']}");
                exit();
            } else {
                // Handle deletion error
                echo "Error deleting post: " . $conn->error;
            }
        } else {
            // Handle deletion error for post_likes
            echo "Error deleting post likes: " . $conn->error;
        }
        // Close prepared statement
        $deleteLikesQuery->close();
        $deleteQuery->close();
    } else {
        echo "Post ID is not set.";
    }
    // Close database connection
    $conn->close();
}
?>
<script>
    // JavaScript alert for successful deletion
    alert("Post deleted successfully.");
</script>
