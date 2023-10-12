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
        <section class="conteneur" id="tableau_typebien">
            <form action="../php/typebien.update.php" method="post">
                <table class="tableau">
                    <thead class="tableau_entete">
                        <tr>
                            <th>ID Type Bien</th>
                            <th>Libellé Type Bien</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="tableau_corps">
                        <?php
                        $oTypes = new Typebien($con);
                        $result = $oTypes->select();
                        if ($result->rowCount() > 0) {
                            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                echo "<tr>";
                                echo "<td>", $row['id_type_bien'], "</td>";
                                echo "<td>", $row['lib_type_bien'], "</td>";
                                echo "<td><a class='bouton-danger' href='../php/delete/typebien.delete.php?id_type_bien=", $row['id_type_bien'], "'>Supprimer</a>  <a class='bouton-primaire' href='../php/update/typebien.update.php?id_type_bien=", $row['id_type_bien'], "'>Modifier</a></td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<p>Aucun résultat trouvé.</p>";
                        }
                        ?>
                    </tbody>
                </table>
            </form>
            <form action="../php/typebien.insert.php" method="post" class="formulaire-insertion">
                <label for="libtypebien" class="formulaire-label">Nouveau type de bien : </label>
                <input type="text" name="libtypebien" id="libtypebien" class="formulaire-input">
                <input type="submit" value="Ajouter un type de bien" class="bouton-primaire">
            </form>
        </section>
    </main>
</body>

</html>