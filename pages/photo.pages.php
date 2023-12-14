<!-- 
========= Site location
========= typebien.pages.php
========= Liste les types de biens
========= Date création : 03 dec. 2023
========= Créateur : HLt
-->

<?php

require_once("../include/pdo.inc.php");
require_once("../class/photo.class.php");

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Photos - Logérance</title>
</head>

<body>
    <?php include("../template/header.template.php"); ?>
    <main>
        <div class="container-fluid" style="margin-top: 2rem;" id="tableau_typebien">
            <div class="row">
                <div class="col" id="tableau_typebien">
                    <form class="card" action="../php/typebien.traitement.php" method="post">
                        <div class="card-header">
                            <h2>Liste des photos</h2>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead class="table">
                                    <tr>
                                        <th scope="col">ID Photo</th>
                                        <th scope="col">Nom et lien de la photo</th>
                                        <th scope="col">Appercu</th>
                                    </tr>
                                </thead>
                                <tbody class="tableau_corps">
                                    <?php
                                    $oPhotos = new Photo($con);
                                    $lesPhotos = $oPhotos->select();
                                    foreach ($lesPhotos as $unePhoto) {
                                        $idp = $unePhoto['id_photo'];
                                        $nomp = 'nomphoto' . $idp;
                                        echo "<tr>";
                                        echo "<th scope='row' name='idtypebien' id='idtypebien'>", $unePhoto['id_photo'], "</th>";
                                        echo "<td><a href='", $unePhoto['lien_photo'], "'>", $unePhoto['nom_photo'], "</td>";
                                        echo "<td><img src='", $unePhoto['lien_photo'], "' width='100'></td>";
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