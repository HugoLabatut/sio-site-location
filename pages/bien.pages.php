<!-- 
========= Site location
========= typebien.pages.php
========= Liste les types de biens
========= Date création : 10 oct. 2023
========= Créateur : HLt
-->

<?php

require_once("../include/pdo.inc.php");
require_once("../class/bien.class.php");

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Type de biens - Logérance</title>
</head>

<body>
    <?php // include("../template/header.template.php"); ?>
    <main>
        <section class="conteneur" id="tableau_typebien">
            <form action="../php/bien.traitement.php" method="post">
                <table class="tableau">
                    <thead class="tableau_entete">
                        <tr>
                            <th>ID Bien</th>
                            <th>Libellé Bien</th>
                            <th>Rue Bien</th>
                            <th>Code postal Bien</th>
                            <th>Ville Bien</th>
                            <th>Superficie Bien</th>
                            <th>Nombre couchage</th>
                            <th>Nombre chambre</th>
                            <th>Descriptif</th>
                            <th>Référence</th>
                            <th>Statut</th>
                            <th>ID Type Bien</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="tableau_corps">
                        <?php
                        $oBiens = new Bien($con);
                        $result = $oBiens->select();
                        if ($result->rowCount() > 0) {
                            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                echo "<tr>";
                                echo "<td>", $row['id_bien'], "</td>";
                                echo "<td><input type='text' name='nombien' value='", $row['nom_bien'], "'></td>";
                                echo "<td><input type='text' name='ruebien' value='", $row['rue_bien'], "'></td>";
                                echo "<td><input type='text' name='cpbien' value='", $row['cop_bien'], "'></td>";
                                echo "<td><input type='text' name='villebien' value='", $row['ville_bien'], "'></td>";
                                echo "<td><input type='text' name='superficiebien' value='", $row['superficie_bien'], "'></td>";
                                echo "<td><input type='text' name='nbcouchagebien' value='", $row['nombre_couchage_bien'], "'></td>";
                                echo "<td><input type='text' name='nbchambrebien' value='", $row['nombre_chambre_bien'], "'></td>";
                                echo "<td><textarea name='descbien' id='descbien' cols='30' rows='10'>", $row['descriptif_bien'],"</textarea></td>";
                                echo "<td><input type='text' name='refbien' value='", $row['reference_bien'], "'></td>";
                                echo "<td><input type='text' name='statuebien' value='", $row['statue_bien'], "'></td>";
                                echo "<td><input type='text' name='idtypebien' value='", $row['id_type_bien'], "'></td>";
                                echo "<td><button class='btn btn-primary' name='update' value='", $row['id_bien'], "' type=submit'>Modifier</button>
                                <button class='btn btn-danger name='delete' value='", $row['id_bien'], "' type=submit'>Supprimer</button></td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<p>Aucun résultat trouvé.</p>";
                        }
                        ?>
                    </tbody>
                </table>
            </form>
            <form action="../php/bien.insert.php" method="post" class="formulaire-insertion">
                <label for="nouveaubien" class="formulaire-label">Nouveau bien : </label>
                <input type="text" name="nombien" id="nombien" class="formulaire-input" placeholder="Nom du bien">
                <input type="text" name="ruebien" id="ruebien" class="formulaire-input" placeholder="Rue du bien">
                <input type="text" name="cpbien" id="cpbien" class="formulaire-input" placeholder="Code postal du bien">
                <input type="text" name="villebien" id="villebien" class="formulaire-input" placeholder="Ville du bien">
                <input type="text" name="supbien" id="supbien" class="formulaire-input"
                    placeholder="Superficie du bien">
                <input type="text" name="nbcouchbien" id="nbcouchbien" class="formulaire-input"
                    placeholder="Nombre de couchages">
                <input type="text" name="nbchambbien" id="nbchambbien" class="formulaire-input"
                    placeholder="Nombre de chambres">
                <textarea name="descbien" id="descbien" cols="30" rows="10"
                    placeholder="Description du bien"></textarea>
                <input type="text" name="refbien" id="refbien" class="formulaire-input" placeholder="Référence du bien">
                <input type="text" name="statbien" id="statbien" class="formulaire-input" placeholder="Statut du bien">
                <input type="text" name="idtbien" id="idtbien" class="formulaire-input" placeholder="Type de bien">
                <input type="submit" value="Ajouter un bien" class="bouton-primaire">
            </form>
        </section>
    </main>
</body>

</html>