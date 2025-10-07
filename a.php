<?php
if ($_POST) {
    // Get form data from page5.html
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
    $age = isset($_POST['age']) ? $_POST['age'] : '';
    $position = isset($_POST['position']) ? $_POST['position'] : '';
    $experience = isset($_POST['experience']) ? $_POST['experience'] : '';
    
    // Create enrollment data string
    $enrollData = "Name: " . $name . "\n";
    $enrollData .= "Email: " . $email . "\n";
    $enrollData .= "Phone: " . $phone . "\n";
    $enrollData .= "Age: " . $age . "\n";
    $enrollData .= "Position: " . $position . "\n";
    $enrollData .= "Experience: " . $experience . "\n";
    $enrollData .= "Date: " . date('Y-m-d H:i:s') . "\n";
    $enrollData .= "------------------------\n\n";
    
    // Save to text file
    $filename = 'enrollments.txt';
    if (file_put_contents($filename, $enrollData, FILE_APPEND | LOCK_EX)) {
        echo "Enrollment data saved successfully!";
        // Redirect back to page5.html after successful submission
        header("Location: page5.html?success=1");
        exit();
    } else {
        echo "Error saving enrollment data.";
    }
}
?>