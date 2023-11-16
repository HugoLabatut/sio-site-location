<?php
require_once("../include/pdo.inc.php");
require_once("../class/typebien.class.php");
require_once("../class/bien.class.php");
require_once("../class/commune.class.php");

$oNouveauBien = new Bien($con);
$oTypes = new Typebien($con);
$oCommunes = new Communes($con);

$nomb = $_POST['nombien'];
$rueb = $_POST['ruebien'];
$copb = $_POST['cpbien'];
$vilb = $_POST['vilbien'];
$supb = $_POST['supbien'];
$coub = $_POST['coubien'];
$chab = $_POST['chabien'];
$desb = $_POST['desbien'];
$refb = $_POST['refbien'];
$statb = $_POST['statbien'];

header("location:../pages/typebien.pages.php");
?>