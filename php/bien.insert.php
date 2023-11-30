<?php
require_once("../include/pdo.inc.php");
require_once("../class/typebien.class.php");
require_once("../class/bien.class.php");
require_once("../class/communes.class.php");

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
$tbien = $_POST['typebien'];

var_dump($nomb);
var_dump($rueb);
var_dump($copb);
var_dump($vilb);
var_dump($supb);
var_dump($coub);
var_dump($chab);
var_dump($desb);
var_dump($refb);
var_dump($statb);
var_dump($tbien);



// header("location:../pages/typebien.pages.php");
?>