<?php
require_once("../include/pdo.inc.php");
require_once("../class/bien.class.php");

$nouveauNomBien = $_POST['nombien'];
$nouveauRueBien = $_POST['ruebien'];
$nouveauCPBien = $_POST['cpbien'];
$nouveauVilleBien = $_POST['villebien'];
$nouveauSupBien = $_POST['supbien'];
$nouveauNbCouchBien = $_POST['nbcouchbien'];
$nouveauNbChambBien = $_POST['nbchambbien'];
$nouveauDescBien = $_POST['descbien'];
$nouveauRefBien = $_POST['refbien'];
$nouveauStatBien = $_POST['statbien'];
$TypeBien = $_POST['idtbien'];

echo $nouveauNomBien, " ", $nouveauRueBien, " ", $nouveauCPBien, " ", $nouveauVilleBien, " ", $nouveauSupBien, " ", $nouveauNbCouchBien, " ", $nouveauNbChambBien, " ", $nouveauDescBien, " ", $nouveauRefBien, " ", $nouveauStatBien, " ", $TypeBien, "<br>";

$oNouveauType = new Bien($con);

$data = [':typebien' => $TypeBien];

$query = "SELECT id_type_bien FROM typebien WHERE lib_type_bien = :typebien";

$stmt = $con->prepare($query);

$stmt->execute($data);

$IdTypeBien = $stmt->fetch(PDO::FETCH_ASSOC);

if ($IdTypeBien) {
    echo $TypeBien, " = ", $IdTypeBien['id_type_bien'];
}


$oNouveauType->insert($nouveauNomBien, $nouveauRueBien, $nouveauCPBien, $nouveauVilleBien, $nouveauSupBien, $nouveauNbCouchBien, $nouveauNbChambBien, $nouveauDescBien, $nouveauRefBien, $nouveauStatBien, $IdTypeBien['id_type_bien']);

header("location:../pages/bien.pages.php");
?>