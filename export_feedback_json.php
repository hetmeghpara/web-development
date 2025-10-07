<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "basketball_club";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set content type to JSON
header('Content-Type: application/json');

// Get all feedback from database
$sql = "SELECT * FROM feedback ORDER BY submission_date DESC";
$result = $conn->query($sql);

$feedback_data = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $feedback_data[] = array(
            'id' => $row['id'],
            'name' => $row['name'],
            'email' => $row['email'],
            'experience' => $row['experience'],
            'comments' => $row['comments'],
            'submission_date' => $row['submission_date']
        );
    }
}

// Create JSON response
$response = array(
    'status' => 'success',
    'total_feedback' => count($feedback_data),
    'data' => $feedback_data
);

// Output JSON
echo json_encode($response, JSON_PRETTY_PRINT);

$conn->close();
?>