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

$databaseError = null;
if (!isset($db) || $db->connect_error) {
    $databaseError = "Verbinding met de database mislukt: " . ($db->connect_error ?? 'Onbekende fout');
}

// Haal alle posts op uit de database met de gebruikersnaam
$posts = [];
if (!$databaseError) {
    $query = "
        SELECT p.id, p.post_text, p.creationDate, u.firstname, u.lastname
        FROM posts p
        JOIN users u ON p.userId = u.user_id
        ORDER BY p.creationDate DESC
    ";
    $result = $db->query($query);

    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $posts[] = $row; // Voeg elk post-record toe aan de array
        }
    } else {
        echo "Er is een fout opgetreden bij het ophalen van de posts: " . $db->error;
    }
}

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
    <link rel="stylesheet" href="./css/nieuws-update.css">
    <title>admin edit page</title>
    <script src="./js/main.js"></script> <!-- linken naar js bestand -->

</head>
<body>

<button><a class= "buttontext" href="create.php">Blogpost aanmaken</a></button> <!-- link naar create.php -->
<button><a class= "buttontext" href="logout.php">Uitloggen</a></button> <!-- link naar logout.php -->

<h1>Nieuws & Updates</h1>
        <!-- Toon de foutmelding als die er is -->
        <?php if ($databaseError): ?>
            <p style="color: red;"><?php echo $databaseError; ?></p>
        <?php endif; ?>

        <!-- Hier kun je de posts weergeven als de database werkt -->
        <?php if (!$databaseError && !empty($posts)): ?>
            <?php foreach ($posts as $post): ?>
                <div class="post">
                    <h2><?php echo htmlspecialchars($post['firstname'] . ' ' . $post['lastname']); ?></h2>
                    <p><?php echo htmlspecialchars($post['post_text']); ?></p>
                    <p><?php echo htmlspecialchars($post['creationDate']); ?></p>
                </div>
            <?php endforeach; ?>
        <?php elseif (!$databaseError): ?>
            <p>Er zijn momenteel geen berichten om weer te geven.</p>
        <?php endif; ?>

</body>
</html>
