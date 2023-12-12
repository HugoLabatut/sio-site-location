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
require_once("../class/photo.class.php");

if (isset($_POST['update'])) {
    $idb = $_POST['update'];
    $nomb = $_POST["nombien"];
    $rueb = $_POST["ruebien"];
    $idc = $_POST["idcommune"];
    $supb = $_POST["supbien"];
    $coub = $_POST["coubien"];
    $chab = $_POST["chabien"];
    $desb = $_POST["desbien"];
    $refb = $_POST["refbien"];
    $statb = $_POST["statbien"];
    $idtb = $_POST["idtbien"];

    var_dump($idb, $nomb, $rueb, $idc, $supb, $coub, $chab, $desb, $refb, $statb, $idtb);

    $oBien = new Bien($con);

    if ($statb == "libre") {
        $oBien->update($idb, $nomb, $rueb, $idc, $supb, $coub, $chab, $desb, $refb, '0', $idtb);
    } else {
        $oBien->update($idb, $nomb, $rueb, $idc, $supb, $coub, $chab, $desb, $refb, '1', $idtb);
    }
    header('location:../pages/biens.pages.php');
} elseif (isset($_POST['update_photo'])) {
    $idb = $_POST['update_photo'];
    $unePhotoNom = $_FILES['photobien']['name'];
    $unePhotoTemp = $_FILES['photobien']['tmp_name'];
    var_dump($unePhotoNom);
    var_dump($unePhotoTemp);
    move_uploaded_file($unePhotoTemp, '../res/img/' . $unePhotoNom);
    $lienPhoto = "../res/img/" . $unePhotoNom;
    $oPhoto = new Photo($con);
    $oPhoto->insert($unePhotoNom, $lienPhoto, $idb);
    header('location:../pages/biens.pages.php');
}

?>