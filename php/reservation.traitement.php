<?php

require_once("../include/pdo.inc.php");
require_once("../class/reservation.class.php");

if ($_POST['add']) {
    $oResa = new Reservation($con);
    $commentaire = $_POST['commentaire'];
    $start = date('Y-m-d H:i:s', strtotime($_POST["start"]));
    $end = date('Y-m-d H:i:s', strtotime($_POST["end"]));
    $idbien = 1;
    $idclient = 1;

    var_dump($commentaire);
    var_dump($start);
    var_dump($end);

    /*
    $oResa->insert($start, $end, $commentaire, $idbien, $idclient);

    $insertedId = $con->lastInsertId();

    header('Content-Type: application/json');
    echo '{"id":"' . $insertedId . '"}';
    */
}

?>