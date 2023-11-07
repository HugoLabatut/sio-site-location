<!-- 
========= Site location
========= bien.traitement.php
========= Traitement du tableau-formulaire présent dans pages/typebien.pages.php
========= Date création : 12 oct. 2023
========= Créateur : HLt
-->

<?php
require_once("../include/pdo.inc.php");
require_once("../class/bien.class.php");

$oBien = new Bien($con);

if (isset($_POST['update'])) {
    $nombien = $_POST['nombien'];
    $ruebien = $_POST['ruebien'];
    $cpbien = $_POST['cpbien'];
    $villebien = $_POST['villebien'];
    $supbien = $_POST['supbien'];
    $nbcouchbien = $_POST['nbcouchbien'];
    $nbchambbien = $_POST['nbchambbien'];
    $descbien = $_POST['descbien'];
    $refbien = $_POST['refbien'];
    $statbien = $_POST['statbien'];
    $idbien = $_POST['update'];
    $idtbien = $_POST['idtbien'];
    $oBien->update($idbien, $nombien, $ruebien, $cpbien, $villebien, $supbien, $nbcouchbien, $nbchambbien, $descbien, $refbien, $statbien, $idtbien);
    header("location:../pages/bien.pages.php");
} elseif (isset($_POST['delete'])) {
    $idbien = $_POST['delete'];
    $oBien->delete($idbien);
    header("location:../pages/bien.pages.php");
}
?>