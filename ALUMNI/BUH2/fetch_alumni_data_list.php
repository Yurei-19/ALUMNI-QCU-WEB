<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "testdb");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if add_id is set and valid
if (isset($_GET['add_id']) && is_numeric($_GET['add_id'])) {
    $add_id = $_GET['add_id'];

    // Prepare and execute query to fetch alumni data based on ID
    $sql = "SELECT * FROM ADD_ALUMNI_LIST WHERE add_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $add_id); // "i" indicates integer type
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Alumni data found
        $alumni_data = $result->fetch_assoc();
        // Return alumni data as JSON response
        echo json_encode($alumni_data);
    } else {
        // Alumni data not found
        echo json_encode(array('error' => 'Alumni data not found'));
    }
} else {
    // Invalid or missing add_id
    echo json_encode(array('error' => 'Invalid or missing add_id'));
}

// Close statement and connection
$stmt->close();
$conn->close();
?>