<?php
// Database connection parameters
$host = "localhost";
$username = "root";
$password = "";
$dbname = "testdb";

// Retrieve add_id from POST request
$add_id = $_POST['add_id'] ?? null;

try {
    if ($add_id !== null) {
        // Connect to the database
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Transfer data based on add_id
        $stmt = $conn->prepare("INSERT INTO reject_alumni_list SELECT * FROM add_alumni WHERE add_id = :add_id");
        $stmt->bindParam(':add_id', $add_id);
        $stmt->execute();

        // Delete data from source_table after transfer
        $deleteStmt = $conn->prepare("DELETE FROM add_alumni WHERE add_id = :add_id");
        $deleteStmt->bindParam(':add_id', $add_id);
        $deleteStmt->execute();

        // Close connection
        $conn = null;

        // Return success response
        echo json_encode(array('success' => true));
    } else {
        // Return error response if add_id is not provided
        echo json_encode(array('error' => 'Add ID is missing.'));
    }
} catch (PDOException $e) {
    // Return error response
    echo json_encode(array('error' => 'Data transfer failed: ' . $e->getMessage()));
}
?>
