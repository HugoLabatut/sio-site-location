<?php
require_once("../../include/pdo.inc.php");
require_once("../../class/typebien.class.php");

$idtypebien = $_GET['id_type_bien'];

$oUpdateType = new Typebien($con);
$libtypebien = $oUpdateType->selectById($idtypebien);
?>