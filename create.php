<?php
session_start();

// May I visit this page? Check the SESSION
if (!isset($_SESSION['user'])) {
    // Redirect if not logged in
    header('Location: login.php');
    exit;
}

/** @var mysqli $db */

// Setup connection with database
require_once 'includes/database.php';


//Get name from the SESSION
$name = $_SESSION['user']['name'];

// Close the connection
mysqli_close($db);

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/create.css">
    <title>Admin create post pagina</title>
    <script src="./js/main.js"></script> <!-- linken naar js bestand -->

</head>
<body>

<h1>Maak een nieuwe blogpost</h1>

<div class="postlabel">
<form action="submit_post.php" method="POST">
    <label for="post_text"></label><br>
    <textarea id="post_text" name="post_text" rows="4" cols="50" required></textarea><br><br>
    <input class="button" type="submit" value="Post publiceren">
</form>
</div>

</body>
</html>
