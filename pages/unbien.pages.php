<?php
require_once("../include/pdo.inc.php");
require_once("../class/bien.class.php");
require_once("../class/typebien.class.php");
require_once("../class/communes.class.php");
require_once("../class/photo.class.php");
require_once('../template/header.template.php');
?>


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
                <form class="card" action="../php/bien.traitement.php" enctype="multipart/form-data" method="post">
                    <div class="card-header">
                        <h2>Modifier un bien</h2>
                    </div>
                    <div class="card-body">
                        <?php
                        $oBien = new Bien($con);
                        $oType = new Typebien($con);
                        $oCommune = new Communes($con);
                        $oPhotos = new Photo($con);
                        $lesBiens = $oBien->select();
                        $lesTypes = $oType->select();
                        $lesCommunes = $oCommune->select();
                        $lesPhotos = $oPhotos->select();
                        $idBien = $_POST['update'];
                        if ($idBien == NULL) {
                            echo "<h3>Aucune donnée n'a été selectionnée.</h3>";
                        }
                        foreach ($lesBiens as $unBien) {
                            if ($unBien['id_bien'] == $idBien) {
                                echo "<div class='form-group row'>
                                <div class='col'>
                                <label for='nombien'>Bien concerné :</label>
                                <input class='form-control' id='nombien' name='nombien' type='text' value='", $unBien["nom_bien"], "'>
                                </div>
                                </div>";

                                echo "<div class='form-group row'>
                                <div class='col'>
                                <label for='ruebien'>Rue :</label>
                                <input class='form-control' id='ruebien' name='ruebien' type='text' value='", $unBien['rue_bien'], "'>
                                </div>
                                <div class='col'>";

                                foreach ($lesCommunes as $uneCommune) {
                                    if ($unBien['id_commune'] == $uneCommune['id_commune']) {
                                        echo "<label for='cpbien'>Code postal :</label>
                                        <input class='form-control' maxlength='5' onkeyup='autocomplet_commune()' id='cpbien' name='cpbien' type='text' value='", $uneCommune['code_commune'], "'>
                                        </div>
                                        <div class='col'>
                                        <label for='vilbien'>Ville :</label>
                                        <input class='form-control' id='vilbien' onkeyup='autocomplet_commune()' name='vilbien' type='text' value='", $uneCommune['libelle_commune'], "'>
                                        <ul class='list-group' id='listecommunes'></ul>
                                        </div>
                                        </div>
                                        <input type='text' value='", $uneCommune['id_commune'], "' name='idcommune' id='idcommune' class='form-control' hidden>";
                                    }
                                }

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
                                if ($unBien['statut_bien'] == 0) {
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
                                        <ul class='list-group' id='libtypesbien'></ul>
                                        <input type='text' value='", $unBien['id_type_bien'], "' name='idtbien' id='idtbien' class='form-control' hidden>";
                                    }
                                }
                                echo "</div>
                                </div>";

                                echo "<div class='form-group row'>
                                <div class='col'>
                                <label for='photosbienactuelles'>Photos du bien :</label><br>";
                                foreach ($lesPhotos as $unePhoto) {
                                    if ($unePhoto['id_bien'] == $unBien['id_bien']) {
                                        echo "<img src='../", $unePhoto['lien_photo'], "' width='150'>";
                                    }
                                }
                                echo "</div>
                                </div>";

                                echo "<div class='form-group row'>
                                <div class='col'>
                                <label for='newphotosbien'>Ajouter de nouvelles photos :</label>
                                <input type='file' accept='.png, .jpg, .jpeg' name='photobien' id='photobien' class='form-control'><br>
                                <button type='submit' name='update_photo' value='", $unBien['id_bien'], "' class='btn btn-primary btn-sm'>Ajouter une photo</button>
                                </div>
                                </div>
                                </div>";

                                echo "<div class='card-footer'>
                                <button type='submit' name='update' value='", $unBien['id_bien'], "' class='btn btn-primary'>Modifier le bien</button>
                                </div>";
                            }
                        }
                        ?>
                </form>
            </div>
        </div>
</body>

</html>