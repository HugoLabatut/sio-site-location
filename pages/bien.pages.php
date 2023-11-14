<!-- 
========= Site location
========= typebien.pages.php
========= Liste les types de biens
========= Date création : 10 oct. 2023
========= Créateur : HLt
-->

<?php

require_once("../include/pdo.inc.php");
require_once("../class/typebien.class.php");

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Type de biens - Logérance</title>
</head>

<body>
    <?php include("../template/header.template.php"); ?>
    <main>
        <div class="container-fluid" style="margin-top: 2rem;" id="tableau_typebien">
            <div class="row">
                <div class="col-12 col-lg-10" id="tableau_typebien">
                    <form class="card" action="../php/typebien.traitement.php" method="post">
                        <div class="card-header">
                            <h2>Liste des types de biens</h2>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead class="table">
                                    <tr>
                                        <th scope="col">ID Type Bien</th>
                                        <th scope="col">Libellé Type Bien</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="tableau_corps">
                                    <?php
                                    $oTypes = new Typebien($con);
                                    $result = $oTypes->select();
                                    if ($result->rowCount() > 0) {
                                        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                            echo "<tr>";
                                            echo "<th scope='row'>", $row['id_type_bien'], "</th>";
                                            echo "<td><input class='form-control' type='text' name='libtypebien' value='", $row['lib_type_bien'], "'></td>";
                                            echo "<td><button class='btn btn-primary' name='update' id='update' value='", $row['id_type_bien'], "' type=submit'>Modifier</button>
                                <button class='btn btn-danger name='delete' id='delete' value='", $row['id_type_bien'], "' type=submit'>Supprimer</button></td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<p>Aucun résultat trouvé.</p>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
                <div class="col-12 col-lg-2" id="formulaire_typebien">
                    <form class="card" action="../php/typebien.insert.php" method="post" class="card">
                        <div class="card-header">
                            <h4>Ajouter un type de bien</h4>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="libtypebien" class="form-label">Nouveau type de bien : </label>
                                <input type="text" name="libtypebien" id="libtypebien" class="form-control">
                            </div>
                        </div>
                        <div class="card-footer">
                            <input type="submit" value="Ajouter un type de bien" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</body>

</html>