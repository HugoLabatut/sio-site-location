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

// var_dump($_POST['update']);
// var_dump($_POST['delete']);
// var_dump($_POST['libtypebien1']);


$oTypeBien = new Typebien($con);

$lesTypesBien = $oTypeBien->select();

foreach ($lesTypesBien as $unType) {
    $idt = $unType['id_type_bien'];
    // var_dump($idt);
    $nom = 'libtypebien' . $idt;
    // echo $_POST[$nom];
    if (isset($_POST['update'])) {
        if ($idt == $_POST['update']) {
            $nouvLibTBien = $_POST[$nom];
            $nouvIdTBien = $_POST['update'];
            $oTypeBien->update($nouvIdTBien, $nouvLibTBien);
        }
    } elseif (isset($_POST['delete'])) {
        if ($idt == $_POST['delete']) {
            $delIdTBien = $_POST['delete'];
            $oTypeBien->delete($delIdTBien);
        }
    }
}

header('location:../pages/typebien.pages.php');
?>