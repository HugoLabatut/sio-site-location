<!-- 
========= Site location
========= bien.pages.php
========= Liste les biens
========= Date création : 10 oct. 2023
========= Créateur : HLt
-->

<?php

require_once("../include/pdo.inc.php");
require_once("../class/bien.class.php");
require_once("../class/typebien.class.php");
require_once("../class/communes.class.php");
include("../template/header.template.php");
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="../js/tb_autocomplete.js"></script>
    <script src="../js/cp_autocomplete.js"></script>
    <title>Biens - Logérance</title>
</head>

<body>
    <?php ?>
    <main>
        <div class="container-fluid" style="margin-top: 2rem;" id="tableau_bien">
            <div class="row">
                <div class="col-12 col-lg-10" id="tableau_bien">
                    <form class="card" action="../pages/unbien.pages.php" method="post">
                        <div class="card-header">
                            <h2>Liste des biens</h2>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead class="table">
                                    <tr>
                                        <th scope="col">ID Bien</th>
                                        <th scope="col">Nom Bien</th>
                                        <th scope="col">Rue</th>
                                        <th scope="col">Code postal</th>
                                        <th scope="col">Ville</th>
                                        <th scope="col">Superficie (en m²)</th>
                                        <th scope="col">Couchage(s)</th>
                                        <th scope="col">Chambre(s)</th>
                                        <th scope="col">Descriptif</th>
                                        <th scope="col">Réference</th>
                                        <th scope="col">Statut</th>
                                        <th scope="col">Type bien</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="tableau_corps">
                                    <?php
                                    $oBiens = new Bien($con);
                                    $oTypes = new Typebien($con);
                                    $oCommunes = new Communes($con);
                                    $lesTypes = $oTypes->select();
                                    $lesBiens = $oBiens->select();
                                    $lesCommunes = $oCommunes->select();
                                    // var_dump($lesIdTypes);
                                    foreach ($lesBiens as $unBien) {
                                        echo "<tr>";
                                        echo "<th scope='row' name='idbien' id='idbien'>", $unBien['id_bien'], "</th>";
                                        echo "<td>", $unBien['nom_bien'], "</td>";
                                        echo "<td>", $unBien['rue_bien'], "</td>";
                                        foreach ($lesCommunes as $uneCommune) {
                                            if ($unBien['id_commune'] == $uneCommune['id_commune']) {
                                                echo "<td>", $uneCommune['code_commune'], "</td>";
                                                echo "<td>", $uneCommune['libelle_commune'], "</td>";
                                            }
                                        }
                                        echo "<td>", $unBien['superficie_bien'], "</td>";
                                        echo "<td>", $unBien['nombre_couchage_bien'], "</td>";
                                        echo "<td>", $unBien['nombre_chambre_bien'], "</td>";
                                        echo "<td>", $unBien['descriptif_bien'], "</td>";
                                        echo "<td>", $unBien['reference_bien'], "</td>";
                                        echo "<td>";
                                        if ($unBien['statut_bien'] == 0) {
                                            echo "Libre";
                                        } else {
                                            echo "Occupé";
                                        }
                                        echo "</td>";
                                        foreach ($lesTypes as $unType) {
                                            if ($unBien['id_type_bien'] == $unType['id_type_bien']) {
                                                echo "<td>", $unType['lib_type_bien'], "</td>";
                                            }
                                        }
                                        echo "<td><button class='btn btn-primary' name='update' value='", $unBien['id_bien'], "' type=submit'>Modifier</button><button class='btn btn-danger' name='delete' value='", $unBien['id_bien'], "' type=submit'>Supprimer</button></td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
                <div class="col-12 col-lg-2" id="formulaire_bien">
                    <form class="card" action="../php/bien.insert.php" method="post" class="card">
                        <div class="card-header">
                            <h4>Ajouter un bien</h4>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="nombien" class="form-label">Nom du bien : </label>
                                <input type="text" name="nombien" id="nombien" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="ruebien" class="form-label">Rue : </label>
                                <input type="text" name="ruebien" id="ruebien" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="cpbien" class="form-label">Code postal : </label>
                                <input type="text" maxlength="5" onkeyup="autocomplet_commune()" name="cpbien"
                                    id="cpbien" class="form-control">
                                <ul class="list-group" id="listecommunes"></ul>
                            </div>
                            <div class="mb-3">
                                <label for="vilbien" class="form-label">Ville : </label>
                                <input type="text" name="vilbien" id="vilbien" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="vilbien" class="form-label">Superficie (en m²) : </label>
                                <input type="text" name="supbien" id="supbien" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="coubien" class="form-label">Nombre de couchage(s) : </label>
                                <input type="number" name="coubien" id="coubien" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="chabien" class="form-label">Nombre de chambre(s) : </label>
                                <input type="number" name="chabien" id="chabien" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="desbien" class="form-label">Descriptif : </label>
                                <textarea class="form-control" name="desbien" id="desbien" cols="30"
                                    rows="10"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="refbien" class="form-label">Réference : </label>
                                <input type="text" name="refbien" id="refbien" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="statbien" class="form-label">Statut : </label>
                                <select class="form-control" name="statbien" id="statbien">
                                    <option value="libre">Libre</option>
                                    <option value="occupe">Occupé</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="typebien" class="form-label">Type de bien : </label>
                                <input type="text" onkeyup="autocomplet_tbien()" name="typebien" id="typebien"
                                    class="form-control">
                                <ul class="list-group" id="libtypesbien"></ul>
                            </div>
                        </div>
                        <div class="card-footer">
                            <input type="submit" value="Ajouter un bien" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</body>

</html>