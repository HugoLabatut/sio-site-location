<!-- 
========= Site location
========= typebien.insert.php
========= Traitement de l'insertion d'un type de bien
========= Date création : 10 oct. 2023
========= Créateur : HLt
-->


<?php
require_once("../include/pdo.inc.php");
require_once("../class/typebien.class.php");

$nouveauLibTypebien = $_POST['libtypebien'];

$oNouveauType = new Typebien($con);

$oNouveauType->insert($nouveauLibTypebien);

header("location:../pages/typebien.pages.php");
?>