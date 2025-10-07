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

// Retrieve all feedback from database
$sql = "SELECT * FROM feedback ORDER BY submission_date DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #ff9800 0%, #ff7043 50%, #ffcc80 100%);
            margin: 0;
            padding: 20px;
            min-height: 100vh;
        }
        .dashboard {
            background: rgba(255, 255, 255, 0.95);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.1);
            max-width: 1000px;
            margin: 0 auto;
        }
        h1 {
            color: #4e260e;
            text-align: center;
            margin-bottom: 30px;
        }
        .feedback-item {
            background: #fff;
            border: 1px solid #ff9800;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        .feedback-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        .feedback-name {
            font-weight: bold;
            color: #4e260e;
        }
        .feedback-date {
            color: #ff9800;
            font-size: 0.9em;
        }
        .feedback-experience {
            background: #ff9800;
            color: white;
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 0.8em;
            display: inline-block;
            margin-bottom: 10px;
        }
        .feedback-comments {
            color: #333;
            line-height: 1.5;
        }
        .no-feedback {
            text-align: center;
            color: #666;
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="dashboard">
        <h1>Feedback Dashboard</h1>
        
        <?php if ($result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <div class="feedback-item">
                    <div class="feedback-header">
                        <span class="feedback-name"><?php echo htmlspecialchars($row['name']); ?></span>
                        <span class="feedback-date"><?php echo date('M d, Y H:i', strtotime($row['submission_date'])); ?></span>
                    </div>
                    <div class="feedback-experience"><?php echo htmlspecialchars($row['experience']); ?></div>
                    <div><strong>Email:</strong> <?php echo htmlspecialchars($row['email']); ?></div>
                    <div class="feedback-comments">
                        <strong>Comments:</strong><br>
                        <?php echo nl2br(htmlspecialchars($row['comments'])); ?>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="no-feedback">No feedback submitted yet.</div>
        <?php endif; ?>
        
        <div style="text-align: center; margin-top: 30px;">
            <a href="page9.html" style="background: #ff9800; color: white; padding: 10px 20px; text-decoration: none; border-radius: 4px;">Back to Feedback Form</a>
        </div>
    </div>
</body>
</html>

<?php
$conn->close();
?>