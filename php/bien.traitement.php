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

var_dump($_POST['update']);
// var_dump($_POST['delete']);
var_dump($_POST['nombien4']);
var_dump($_POST['ruebien4']);
var_dump($_POST['copbien4']);
var_dump($_POST['vilbien4']);
var_dump($_POST['supbien4']);
var_dump($_POST['coubien4']);
var_dump($_POST['chabien4']);
var_dump($_POST['desbien4']);
var_dump($_POST['refbien4']);
var_dump($_POST['statbien4']);
var_dump($_POST['typebien4']);

$oBien = new Bien($con);

?>