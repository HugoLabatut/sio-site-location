<!-- 
========= Site location
========= client.pages.php
========= Liste les clients
========= Date création : 12 oct. 2023
========= Créateur : HLt
-->

<?php

require_once("../include/pdo.inc.php");
require_once("../class/client.class.php");

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Clients - Logérance</title>
</head>

<body>
    <?php include("../template/header.template.php"); ?>
    <main>
        <div class="container-fluid" style="margin-top: 2rem;" id="tableau_clients">
            <div class="row">
                <div class="col-12 col-lg-10" id="tableau_clients">
                    <form class="card" action="../php/client.traitement.php" method="post">
                        <div class="card-header">
                            <h2>Liste des clients</h2>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead class="table">
                                    <tr>
                                        <th scope="col">ID Client</th>
                                        <th scope="col">Nom</th>
                                        <th scope="col">Prénom</th>
                                        <th scope="col">Rue</th>
                                        <th scope="col">Code postal</th>
                                        <th scope="col">Ville</th>
                                        <th scope="col">E-mail</th>
                                        <th scope="col">Statut</th>
                                        <th scope="col">Valide</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="tableau_corps">
                                    <?php
                                    $oClients = new Client($con);
                                    $lesClients = $oClients->select();
                                    foreach ($lesClients as $unClient) {
                                        $idClient = $unClient['id_client'];
                                        $nomClient = 'nomClient' . $idClient;
                                        $prenomClient = 'prenomClient' . $idClient;
                                        $rueClient = 'rueClient' . $idClient;
                                        $codePostalClient = 'codePostalClient' . $idClient;
                                        $villeClient = 'villeClient' . $idClient;
                                        $emailClient = 'emailClient' . $idClient;
                                        $statueClient = 'statueClient' . $idClient;
                                        $validClient = 'validClient' . $idClient;

                                        echo "<tr>";
                                        echo "<th scope='row' name='idClient' id='idClient'>", $unClient['id_client'], "</th>";
                                        echo "<td><input class='form-control' type='text' name='", $nomClient, "' value='", $unClient['nom_client'], "'></td>";
                                        echo "<td><input class='form-control' type='text' name='", $prenomClient, "' value='", $unClient['prenom_client'], "'></td>";
                                        echo "<td><input class='form-control' type='text' name='", $rueClient, "' value='", $unClient['rue_client'], "'></td>";
                                        echo "<td><input class='form-control' type='tex' name='", $codePostalClient, "' value='", $unClient['cop_client'], "'></td>";
                                        echo "<td><input class='form-control' type='text' name='", $villeClient, "' value='", $unClient['ville_client'], "'></td>";
                                        echo "<td><input class='form-control' type='text' name='", $emailClient, "' value='", $unClient['mail_client'], "'></td>";
                                        echo "<td><input class='form-control' type='text' name='", $statueClient, "' value='", $unClient['statue_client'], "'></td>";
                                        echo "<td><input class='form-control' type='text' name='", $validClient, "' value='", $unClient['valid_client'], "'></td>";
                                        echo "<td><button class='btn btn-primary' name='update' value='", $unClient['id_client'], "' type=submit'>Modifier</button>
                                                    <button class='btn btn-danger' name='delete' value='", $unClient['id_client'], "' type=submit'>Supprimer</button></td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
                <div class="col-12 col-lg-2" id="formulaire_clients">
                    <form class="card" action="../php/client.insert.php" method="post" class="card">
                        <div class="card-header">
                            <h4>Ajouter un client</h4>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="nomClient" class="form-label">Nom : </label>
                                <input type="text" name="nomClient" id="nomClient" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="prenomClient" class="form-label">Prénom : </label>
                                <input type="text" name="prenomClient" id="prenomClient" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="rueClient" class="form-label">Rue : </label>
                                <input type="text" name="rueClient" id="rueClient" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="codePostalClient" class="form-label">Code postal : </label>
                                <input type="number" name="codePostalClient" id="codePostalClient" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="villeClient" class="form-label">Ville : </label>
                                <input type="text" name="villeClient" id="villeClient" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="emailClient" class="form-label">E-mail : </label>
                                <input type="text" name="emailClient" id="emailClient" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="statueClient" class="form-label">Statut : </label>
                                <input type="text" name="statueClient" id="statueClient" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="ValideClient" class="form-label">Valide : </label>
                                <input type="text" name="validClient" id="validClient" class="form-control">
                            </div>
                            <!-- Ajoutez ici les champs supplémentaires nécessaires -->
                        </div>
                        <div class="card-footer">
                            <input type="submit" value="Ajouter un client" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</body>

</html>