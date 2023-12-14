<?php
require_once("../include/pdo.inc.php");
require_once("../class/client.class.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST["nomClient"];
    $prenom = $_POST["prenomClient"];
    $rue = $_POST["rueClient"];
    $codePostal = $_POST["codePostalClient"];
    $ville = $_POST["villeClient"];
    $email = $_POST["emailClient"];
    $password = $_POST["passwordClient"];
    $statut = $_POST["statueClient"];
    $valide = $_POST["validClient"];

    $client = new Client($con);
    $client->insert($nom, $prenom, $rue, $codePostal, $ville, $email, $password, $statut, $valide);
    
    // Rediriger vers la page client.pages.php après l'insertion
    header("Location: ../pages/client.pages.php");
    exit();
}
?>