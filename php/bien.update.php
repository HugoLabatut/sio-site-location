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
    $nomb = $_POST['nombien'];
    $rueb = $_POST['ruebien'];
    $cpb = $_POST['cpbien'];
    $vilb = $_POST['vilbien'];
    $supb = $_POST['supbien'];
    $coub = $_POST['coubien'];
    $chab = $_POST['chabien'];
    $desb = $_POST['desbien'];
    $refb = $_POST['refbien'];
    $statb = $_POST['statbien'];
    $typeb = $_POST['typebien'];

    $oBien = new Bien($con);

    // $oBien->update($idb, $nomb, $rueb, $cpb, $vilb, $supb, $coub, $chab, $desb, $refb, $statb, $typeb);
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