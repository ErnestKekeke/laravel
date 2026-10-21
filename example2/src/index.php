<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $title = $_POST['title'];
    $description = $_POST['description'];

    $sql = "INSERT INTO posts (title, description)
            VALUES ('$title', '$description')";

    $conn->query($sql);
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Simple Blog By Ernest Kekeke</title>
<link rel="stylesheet" type="text/css" href="style.css">
<link rel="icon" href="favicon.ico" type="image/x-icon">
</head>
<body>

<h2>Create Post</h2>

<form method="POST">
    <label>Title</label><br>
    <input type="text" name="title" required><br><br>

    <label>Description</label><br>
    <textarea name="description" required></textarea><br><br>

    <button type="submit">Save</button>
</form>

<hr>

<h2>All Posts</h2>

<?php

$result = $conn->query("SELECT * FROM posts ORDER BY created_at DESC");

if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {

        echo "<h3>" . htmlspecialchars($row['title']) . "</h3>";
        echo "<p>" . nl2br(htmlspecialchars($row['description'])) . "</p>";
        echo "<small>" . $row['created_at'] . "</small>";
        echo "<hr>";
    }

} else {
    echo "No posts yet.";
}

?>


<a href="./images/ernestkekeke.jpg">See Author Ernest Kekeke</a>

<script src="script.js"></script>
</body>
</html>