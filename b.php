 <?php 
 
$conn = new mysqli("localhost", "root", "", "event_db"); 
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error); 
 
if (isset($_POST['add'])) { 
    $title = $_POST['title']; 
    $desc = $_POST['description']; 
    $date = $_POST['date']; 
    $status = $_POST['status']; 
    $poster = $_FILES['poster']['name']; 
    move_uploaded_file($_FILES['poster']['tmp_name'], "upload/" . $poster); 
    $conn->query("INSERT INTO events (title, description, date, status, poster) 
                  VALUES ('$title', '$desc', '$date', '$status', '$poster')"); 
} 
 
if (isset($_POST['edit'])) { 
    $id = $_POST['id']; 
    $title = $_POST['title']; 
    $desc = $_POST['description']; 
    $date = $_POST['date']; 
    $status = $_POST['status']; 
    $conn->query("UPDATE events SET title='$title', description='$desc', date='$date', 
status='$status' WHERE id=$id"); 
} 
 
if (isset($_GET['delete'])) { 
    $id = $_GET['delete']; 
    $conn->query("DELETE FROM events WHERE id=$id"); 
} 
 
$events = $conn->query("SELECT * FROM events"); 
?> 
 

<!DOCTYPE html> 
<html> 
<head><title>Event Manager</title></head> 
<body> 
<h2>Event Manager</h2> 
 
<h3>Add New Event</h3> 
<form method="POST" enctype="multipart/form-data"> 
  Title: <input type="text" name="title"><br> 
  Description: <textarea name="description"></textarea><br> 
  Date: <input type="date" name="date"><br> 
  Status:  
  <select name="status"> 
    <option value="open">Open</option> 
    <option value="closed">Closed</option> 
  </select><br> 
  Poster: <input type="file" name="poster"><br> 
  <input type="submit" name="add" value="Add Event"> 
</form> 
<hr> 
<h3>All Events</h3> 
<?php while ($row = $events->fetch_assoc()): ?> 
  <form method="POST"> 
    <input type="hidden" name="id" value="<?= $row['id'] ?>"> 
    Title: <input type="text" name="title" value="<?= $row['title'] ?>"><br> 
    Description: <textarea name="description"><?= $row['description'] ?></textarea><br> 
    Date: <input type="date" name="date" value="<?= $row['date'] ?>"><br> 
    Status:  
    <select name="status"> 
      <option value="open" <?= $row['status']=='open'?'selected':'' ?>>Open</option> 
      <option value="closed" <?= $row['status']=='closed'?'selected':'' ?>>Closed</option> 
    </select><br> 
    <img src="upload/<?= $row['poster'] ?>" width="100"><br> 
    <input type="submit" name="edit" value="Update"> 
    <a href="?delete=<?= $row['id'] ?>">Delete</a> 
  </form> 
  <hr> 
<?php endwhile; ?> 
</body> 
</html>