<?php
require_once 'includes/database.php';

// Controleer of de databaseverbinding succesvol is
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
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Nieuws & Updates</title>
    <link rel="stylesheet" href="./css/nieuws-update.css">
</head>
<body>
<header>
        <img src="./img/logo.png" alt="logo">
        <nav>
            <a href="index.html">Home</a>
            <a href="overons.html">Over ons</a>
            <a href="het-project.html">Het project</a>
            <a href="demo.html">Demo</a>
            <a href="roadmap.html">Roadmap</a>
            <a href="nieuws-update.php">Nieuws & updates</a>
        </nav>
    </header>

    <h1>Nieuws & Updates</h1>

<div id="header"></div> <!-- Zorg ervoor dat deze div bestaat om je header in te laden -->
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
      
        <footer>

        <div class="group1">
            <a href="index.html">Home</a>
            <a href="overons.html">Over ons</a>
            <a href="project.html">Het project</a>
            <a href="demo.html">Demo</a>
            <a href="roadmap.html">Roadmap</a>
            <a href="nieuw-update.php">Nieuws & updates</a>
        </div>
        <div class="group2">
            <p>Social media </p>
            <img src="./img/ig-logo.webp" alt="instagram logo">
            <img src="./img/x-logo.png" alt="Twitter logo">
            <img src="./img/github-logo.png" alt="github logo">
            <img src="./img/facebook.png" alt="facebook logo">
        </div>
        <div class="group3">
            <a href="">Privacyverklaring</a>
            <a href="">Algemene voorwaarden</a>
            <a href="">Cookie beleid</a>
            <a href="">Contact</a>
            <a href="login.php">ONLY ADMIN</a>
        </div>

</footer>
</body>
</html>
