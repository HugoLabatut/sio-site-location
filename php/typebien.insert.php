<?php
require_once("../include/pdo.inc.php");
require_once("../class/typebien.class.php");

$nouveauLibTypebien = $_POST['libtypebien'];

$oNouveauType = new Typebien($con);

$oNouveauType->insert($nouveauLibTypebien);

header("location:../pages/typebien.pages.php");
?>