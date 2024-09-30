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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <title>admin edit page</title>
    <script src="./js/main.js"></script> <!-- linken naar js bestand -->

</head>
<body>

<div id="header"></div> <!-- Zorg ervoor dat deze div bestaat om je header in te laden -->
<button class="button is-primary is-outlined"><a href="create.php">Add blog</a></button> <!-- link naar create.php -->
<button class="button is-primary is-outlined"><a href="logout.php">Uitloggen</a></button> <!-- link naar logout.php -->


<div id="footer"></div> <!-- Zorg ervoor dat deze div bestaat om je footer in te laden -->

</body>
</html>
