<?php
require_once("../include/pdo.inc.php");
require_once("../class/bien.class.php");
require_once("../class/typebien.class.php");
require_once('../template/header.template.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../js/jquery.min.js"></script>
    <script src="../js/tb_autocomplete.js"></script>
    <script src="../js/cp_autocomplete.js"></script>
    <title>Modifier un bien - Logérance</title>
</head>

<body>
    <div class="container" style="margin-top: 2rem;" id="fiche_bien">
        <div class="row">
            <div class="col" id="tableau_bien">
                <form class="card" action="../pages/unbien.pages.php" method="post">
                    <div class="card-header">
                        <h2>Modifier un bien</h2>
                    </div>
                    <div class="card-body">
                        <?php
                        // var_dump($_POST['update']);
                        $oBien = new Bien($con);
                        $lesBiens = $oBien->select();
                        $oType = new Typebien($con);
                        $lesTypes = $oType->select();
                        $idBien = $_POST['update'];
                        foreach ($lesBiens as $unBien) {
                            if ($unBien['id_bien'] == $idBien) {
                                echo "<div class='form-group row'>
                                <div class='col'>
                                <label for='nombien'>Bien concerné :</label>
                                <input class='form-control' id='nombien' name='nombien' type='text' value='", $unBien['nom_bien'], "'>
                                </div>
                                </div>";

                                echo "<div class='form-group row'>
                                <div class='col'>
                                <label for='ruebien'>Rue :</label>
                                <input class='form-control' id='ruebien' name='ruebien' type='text' value='", $unBien['rue_bien'], "'>
                                </div>
                                <div class='col'>
                                <label for='cpbien'>Code postal :</label>
                                <input class='form-control' maxlength='5' onkeyup='autocomplet_commune()' id='cpbien' name='cpbien' type='text' value='", $unBien['cop_bien'], "'>
                                </div>
                                <div class='col'>
                                <label for='vilbien'>Ville :</label>
                                <input class='form-control' id='vilbien' onkeyup='autocomplet_commune()' name='vilbien' type='text' value='", $unBien['ville_bien'], "'>
                                <ul class='list-group' id='listecommunes'></ul>
                                </div>
                                </div>";

                                echo "<div class='form-group row'>
                                <div class='col'>
                                <label for='supbien'>Superficie (en m²) :</label>
                                <input class='form-control' id='supbien' name='supbien' type='text' value='", $unBien['superficie_bien'], "'>
                                </div>
                                <div class='col'>
                                <label for='coubien'>Nombre de couchage(s) :</label>
                                <input class='form-control' id='coubien' name='coubien' type='number' value='", $unBien['nombre_couchage_bien'], "'>
                                </div>
                                <div class='col'>
                                <label for='vilbien'>Nombre de chambre(s) :</label>
                                <input class='form-control' id='chabien' name='chabien' type='number' value='", $unBien['nombre_chambre_bien'], "'>
                                </div>
                                </div>";

                                echo "<div class='form-group row'>
                                <div class='col'>
                                <label for='desbien'>Description :</label>
                                <textarea class='form-control' id='desbien' name='desbien'>", $unBien['descriptif_bien'], "</textarea>
                                </div>
                                </div>";

                                echo "<div class='form-group row'>
                                <div class='col'>
                                <label for='refbien'>Réference :</label>
                                <input class='form-control' name='refbien' id='refbien' type='text' value='", $unBien['reference_bien'], "'>
                                </div>
                                <div class='col'>
                                <label for='statbien'>Statut :</label>
                                <select name='statbien' id='statbien' class='form-control'>
                                ";
                                if ($unBien['statue_bien'] == 0) {
                                    echo "<option class='form-control' value='libre'>Libre</option>
                                    <option class='form-control' value='occupe'>Occupé</option>";
                                } else {
                                    echo "<option class='form-control' value='occupe'>Occupé</option>
                                    <option class='form-control' value='libre'>Libre</option>";
                                }
                                echo "</select>
                                </div>
                                <div class='col'>
                                <label for='typebien'>Type :</label>";
                                foreach ($lesTypes as $unType) {
                                    if ($unBien['id_type_bien'] == $unType['id_type_bien']) {
                                        echo "<input class='form-control' onkeyup='autocomplet_tbien()' id='typebien' name='typebien' type='text' value='", $unType['lib_type_bien'], "'>
                                        <ul class='list-group' id='libtypesbien'></ul>";
                                    }
                                }
                                echo "</div>
                                </div>";
                            }
                        }
                        ?>
                        
                    </div>
                    <div class="card-footer">
                        <input type="submit" value="Modifier le bien" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
</body>

</html>