<?php
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "projet-locations"; 

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Autres configurations PDO si nécessaire
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données: " . $e->getMessage());
}
?>
