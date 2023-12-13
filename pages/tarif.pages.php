<!-- 
========= Site location
========= typebien.pages.php
========= Liste les types de biens
========= Date création : 03 dec. 2023
========= Créateur : HLt
-->

<?php

require_once("../include/pdo.inc.php");
require_once("../class/tarif.class.php");
require_once("../class/bien.class.php");

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tarifs - Logérance</title>
</head>

<body>
    <?php include("../template/header.template.php"); ?>
    <main>
        <div class="container-fluid" style="margin-top: 2rem;" id="tableau_typebien">
            <div class="row">
                <div class="col" id="tableau_typebien">
                    <form class="card" action="../php/typebien.traitement.php" method="post">
                        <div class="card-header">
                            <h2>Liste des tarifs</h2>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead class="table">
                                    <tr>
                                        <th scope="col">ID Tarif</th>
                                        <th scope="col">Date début tarif</th>
                                        <th scope="col">Date fin tarif</th>
                                        <th scope="col">Prix</th>
                                        <th scope="col">Bien concerné</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="tableau_corps">
                                    <?php
                                    $oTarifs = new Tarif($con);
                                    $oBiens = new Bien($con);
                                    $lesTarifs = $oTarifs->select();
                                    $lesBiens = $oBiens->select();
                                    foreach ($lesTarifs as $unTarif) {
                                        $idt = $unTarif['id_tarif'];
                                        $nomp = 'nomphoto' . $idp;
                                        echo "<tr>";
                                        echo "<th scope='row' name='idtarif' id='idtarif'>", $unTarif['id_tarif'], "</th>";
                                        echo "<td>", $unTarif['date_debut_tarif'], "</td>";
                                        echo "<td>", $unTarif['date_fin_tarif'], "</td>";
                                        echo "<td>", $unTarif['prix_loc_tarif'], "</td>";
                                        foreach ($lesBiens as $unBien) {
                                            if ($lesBiens['id_bien'] == $lesTarifs['id_bien']) {
                                                echo "<td>", $unBien['lib_bien'], "</td>";
                                            }
                                        }
                                        echo "<td><button class='btn btn-primary' name='update' value='", $unTarif['id_tarif'], "' type=submit'>Modifier</button>
                                                    <button class='btn btn-danger' name='delete' value='", $unTarif['id_tarif'], "' type=submit'>Supprimer</button></td>";
                                        echo "</tr>";
                                        echo "</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</body>

</html>