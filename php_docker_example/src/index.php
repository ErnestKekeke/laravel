

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
    echo "All post will be shown here was connected to mysql database <br/>"
?>


<a href="./images/ernestkekeke.jpg" target="_blank">See Author Ernest Kekeke</a>

<script src="script.js"></script>
</body>
</html>