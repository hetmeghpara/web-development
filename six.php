<?php
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input function
    function sanitizeInput($data) {
        return htmlspecialchars(stripslashes(trim($data)));
    }

    // Collect and sanitize inputs
    $name = sanitizeInput($_POST['name']);
    $surname = sanitizeInput($_POST['surname']);
    $fatherName = sanitizeInput($_POST['fatherName']);
    $email = sanitizeInput($_POST['email']);
    $number = sanitizeInput($_POST['number']);
    $paymentPlan = sanitizeInput($_POST['paymentPlan']);
    $paymentMethod = sanitizeInput($_POST['paymentMethod']);

    // You could validate further or save to database here

    // Display confirmation
    echo "<!DOCTYPE html>";
    echo "<html lang='en'>";
    echo "<head><meta charset='UTF-8'><title>Registration Confirmation</title></head>";
    echo "<body style='font-family: Arial; background: #f4f4f4; padding: 20px;'>";
    echo "<h2 style='color: green;'>Registration Successful!</h2>";
    echo "<p><strong>Name:</strong> $name</p>";
    echo "<p><strong>Surname:</strong> $surname</p>";
    echo "<p><strong>Father's Name:</strong> $fatherName</p>";
    echo "<p><strong>Email:</strong> $email</p>";
    echo "<p><strong>Number:</strong> $number</p>";
    echo "<p><strong>Payment Plan:</strong> $paymentPlan</p>";
    echo "<p><strong>Payment Method:</strong> $paymentMethod</p>";
    echo "</body></html>";
} else {
    // Redirect if accessed without submitting the form
    header("Location: enroll.html"); // Adjust to your actual HTML filename
    exit();
}
?>
