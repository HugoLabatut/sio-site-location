<?php
// Informations de connexion à la base de données
$dsn = 'mysql:host=localhost;dbname=Fullcalendar';
$username = 'root';
$password = '';

try {
    // Création de l'objet de connexion PDO
    $pdo = new PDO($dsn, $username, $password);

    // Configuration des options PDO
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Votre code ici...

} catch (PDOException $e) {
    // En cas d'erreur de connexion, afficher l'erreur
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
?>