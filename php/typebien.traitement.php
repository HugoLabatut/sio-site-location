<!-- 
========= Site location
========= typebien.traitement.php
========= Traitement du tableau-formulaire présent dans pages/typebien.pages.php
========= Date création : 12 oct. 2023
========= Créateur : HLt
-->

<?php
require_once("../include/pdo.inc.php");
require_once("../class/typebien.class.php");

$oTypeBien = new Typebien($con);

if (isset($_POST['update'])) {
    $libtbien = $_POST['libtypebien'];
    $idtbien = $_POST['update'];
    $oTypeBien->update($idtbien, $libtbien);
    header("location:../pages/typebien.pages.php");
} elseif (isset($_POST['delete'])) {
    $idtbien = $_POST['delete'];
    $oTypeBien->delete($idtbien);
    header("location:../pages/typebien.pages.php");
}
?>