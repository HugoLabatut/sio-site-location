<!--
    ===========================================
    =========== SIO SITE LOCATION =============
    ====== Date de début : 14 sept. 2023 ======
    ===== Développement Front-end : CVt =======
    ====== Développement Back-end : HLt =======
    ========= Développement BDD : EQy =========
    ===========================================
-->

<?php
require_once("include/pdo.inc.php");
require_once("class/bien.class.php");
require_once("class/typebien.class.php");
require_once("class/photo.class.php");

// Créer une instance de la classe "Bien"
$bien = new Bien($con);

// Récupérer tous les biens
$biens = $bien->select();

// Récupérer tous les types de biens
$typebien = new Typebien($con);
$typesbiens = $typebien->select();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Accueil - Logérance</title>
</head>

<body>
    <?php include("template/header.template.php"); ?>
    <main>
        <div class="container-fluid" style="margin-top: 2rem;" id="tableau_typebien">
            <div class="row">
                <!-- Votre formulaire pour sélectionner un type de bien -->
                <div class="col-lg-2 d-none d-lg-block">
                    <form method="post">
                        <div id="main-container">
                            <div class="card-header">
                                <h2>Type de bien. </h2>
                            </div>
                            <div class="card-body">
                                <div class="list-group">
                                    <?php
                                    // Afficher chaque type de bien dans une liste
                                    foreach ($typesbiens as $row) {
                                        echo '<button type="submit" class="list-group-item list-group-item-action" name="type_bien" value="' . $row['id_type_bien'] . '">' . $row['lib_type_bien'] . '</button>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Affichage des biens correspondant au type sélectionné -->
                <div class="col-12 col-lg-10" id="tableau_typebien">
                    <div class="card">
                        <div class="card-header">
                            <?php
                            // Vérifiez si un type de bien est sélectionné
                            if (isset($_POST['type_bien'])) {
                                $selected_type = $_POST['type_bien'];

                                // Trouver le nom du type de bien sélectionné
                                foreach ($typesbiens as $row) {
                                    if ($row['id_type_bien'] == $selected_type) {
                                        echo '<h2>Les biens correspondant à ' . $row['lib_type_bien'] . '</h2>';
                                        break;
                                    }
                                }
                            } else {
                                echo '<h2>Tous les biens</h2>';
                            }
                            ?>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <?php
                                // Afficher les biens correspondant au type sélectionné ou tous les biens si aucun type n'est sélectionné
                                if (isset($_POST['type_bien'])) {
                                    foreach ($biens as $rowBien) {
                                        if ($rowBien['id_type_bien'] == $_POST['type_bien']) {
                                            echo '<div class="col-md-4">';
                                            echo '<div class="card">';

                                            // Créez une instance de la classe "Photo"
                                            $photo = new Photo($con);

                                            // Récupérez les photos associées à ce bien
                                            $photosBien = $photo->selectById($rowBien['id_bien']);

                                            // Vérifiez s'il y a des images associées au bien
                                            if ($photosBien->rowCount() > 0) {
                                                $rowPhoto = $photosBien->fetch(PDO::FETCH_ASSOC);
                                                // Affichez la première image associée au bien
                                                echo '<img src="' . $rowPhoto['lien_photo'] . '" class="card-img-top" alt="Image du bien">';
                                            } else {
                                                // Afficher une image par défaut si aucune image n'est associée au bien
                                                echo '<img src="chemin/vers/votre/image-par-defaut.jpg" class="card-img-top" alt="Image par défaut">';
                                            }

                                            echo '<div class="card-body">';
                                            echo '<h5 class="card-title">' . $rowBien['nom_bien'] . '</h5>';
                                            // Ajoutez d'autres détails du bien ici
                                            echo '<a href="#" class="btn btn-primary">Voir détails</a>';
                                            echo '</div>';
                                            echo '</div>';
                                            echo '</div>';
                                        }
                                    }
                                } else {
                                    // Afficher tous les biens si aucun type n'est sélectionné
                                    foreach ($biens as $rowBien) {
                                        echo '<div class="col-md-4">';
                                        echo '<div class="card">';

                                        // Créez une instance de la classe "Photo"
                                        $photo = new Photo($con);

                                        // Récupérez les photos associées à ce bien
                                        $photosBien = $photo->selectById($rowBien['id_bien']);

                                        // Vérifiez s'il y a des images associées au bien
                                        if ($photosBien->rowCount() > 0) {
                                            $rowPhoto = $photosBien->fetch(PDO::FETCH_ASSOC);
                                            // Affichez la première image associée au bien
                                            echo '<img src="' . $rowPhoto['lien_photo'] . '" class="card-img-top" alt="Image du bien">';
                                        } else {
                                            // Afficher une image par défaut si aucune image n'est associée au bien
                                            echo '<img src="res/img/logo-logerance.png" class="card-img-top" alt="Image par défaut">';
                                        }

                                        echo '<div class="card-body">';
                                        echo '<h5 class="card-title">' . $rowBien['nom_bien'] . '</h5>';
                                        // Ajoutez d'autres détails du bien ici
                                        echo '<a href="#" class="btn btn-primary">Voir détails</a>';
                                        echo '</div>';
                                        echo '</div>';
                                        echo '</div>';
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>