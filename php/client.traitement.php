<?php
require_once("../include/pdo.inc.php");
require_once("../class/client.class.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["update"])) {
        $id = $_POST["update"];
        $nom = $_POST["nomClient$id"];
        $prenom = $_POST["prenomClient$id"];
        $rue = $_POST["rueClient$id"];
        $codePostal = $_POST["codePostalClient$id"];
        $ville = $_POST["villeClient$id"];
        $email = $_POST["emailClient$id"];
        $statut = $_POST["statueClient$id"];
        $valide = $_POST["validClient$id"];

        $client = new Client($con);
        $client->update($id, $nom, $prenom, $rue, $codePostal, $ville, $email, $statut, $valide);
    } elseif (isset($_POST["delete"])) {
        $id = $_POST["delete"];

        $client = new Client($con);
        $client->delete($id);
    }

    // Rediriger vers la page client.pages.php après la mise à jour ou la suppression
    header("Location: ../pages/client.pages.php");
    exit();
}
?>