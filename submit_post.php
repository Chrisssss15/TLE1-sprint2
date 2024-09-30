<?php
require_once 'includes/database.php';

// Verkrijg de userId van de ingelogde gebruiker, dit moet ergens in je applicatie beschikbaar zijn
// Hier gebruiken we een voorbeeldwaarde voor de userId (bijv. 1 voor Daan Banaan)
$userId = 2; // Dit zou normaal moeten worden verkregen via sessies of een ander mechanisme

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verkrijg en ontsnap de invoer om SQL-injectie te voorkomen
    $post_text = mysqli_real_escape_string($db, $_POST['post_text']);

    // Voeg de post toe aan de database met userId
    $query = "INSERT INTO posts (post_text, userId) VALUES ('$post_text', $userId)";

    if ($db->query($query)) {
        header("Location: nieuws-update.php"); // Redirect naar indexpagina na succesvolle toevoeging
        exit;
    } else {
        echo "Er is een fout opgetreden: " . $db->error;
    }
}

$db->close(); // Sluit de databaseverbinding
?>
