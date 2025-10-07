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

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data and sanitize
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $experience = mysqli_real_escape_string($conn, $_POST['experience']);
    $comments = mysqli_real_escape_string($conn, $_POST['comments']);
    
    // Insert data into database
    $sql = "INSERT INTO feedback (name, email, experience, comments, submission_date) 
            VALUES ('$name', '$email', '$experience', '$comments', NOW())";
    
    if ($conn->query($sql) === TRUE) {
        // Get the ID of the inserted record
        $last_id = $conn->insert_id;
        
        // Create JSON log entry
        $json_entry = array(
            'id' => $last_id,
            'name' => $name,
            'email' => $email,
            'experience' => $experience,
            'comments' => $comments,
            'submission_date' => date('Y-m-d H:i:s'),
            'status' => 'success'
        );
        
        // Save to JSON file
        $json_file = 'feedback_log.json';
        $existing_data = array();
        
        if (file_exists($json_file)) {
            $existing_content = file_get_contents($json_file);
            $existing_data = json_decode($existing_content, true) ?: array();
        }
        
        $existing_data[] = $json_entry;
        file_put_contents($json_file, json_encode($existing_data, JSON_PRETTY_PRINT));
        
        echo "<script>
                alert('Thank you for your feedback! Your response has been recorded.');
                window.location.href = 'page9.html';
              </script>";
    } else {
        echo "<script>
                alert('Error: " . $sql . "\\n" . $conn->error . "');
                window.location.href = 'page9.html';
              </script>";
    }
}

// Close connection
$conn->close();
?>