<!-- 
========= Site location
========= reservation.class.php
========= Classe des réservations
========= Date création : 17 oct. 2023
========= Créateur : HLt
-->

<?php

class Reservation
{
    private $con;
    private $idresa;
    private $datedebresa;
    private $datefinresa;
    private $comresa;
    private $modoresa;
    private $annulresa;
    private $idbien;
    private $idclient;

    public function __construct($c)
    {
        $this->con = $c;
    }

    public function getId()
    {
        return $this->idresa;
    }

    public function getDatedeb()
    {
        return $this->datedebresa;
    }

    public function getDatefin()
    {
        return $this->datefinresa;
    }

    public function getComresa()
    {
        return $this->comresa;
    }

    public function getModoresa()
    {
        return $this->modoresa;
    }

    public function getAnnulresa()
    {
        return $this->annulresa;
    }

    public function getIdbien()
    {
        return $this->idbien;
    }

    public function getIdclient()
    {
        return $this->idclient;
    }

    public function setDatedeb($dd)
    {
        $this->datedebresa = $dd;
    }

    public function setDatefin($df)
    {
        $this->datefinresa = $df;
    }

    public function setComresa($com)
    {
        $this->comresa = $com;
    }

    public function setAnnulresa($ar)
    {
        $this->annulresa = $ar;
    }

    public function setIdbien($idb)
    {
        $this->idbien = $idb;
    }

    public function setIdclient($idc)
    {
        $this->idclient = $idc;
    }

    public function select()
    {
        $sql = "SELECT * FROM reservation";
        $stmt = $this->con->query($sql);
        return $stmt;
    }

    public function insert($dd, $df, $cr, $idb, $idc)
    {
        $data = [
            ":datedeb" => $dd,
            ":datefin" => $df,
            ":comresa" => $cr,
            ":idbien" => $idb,
            ":idclient" => $idc
        ];
        $sql = "INSERT INTO reservation (date_debut_reservation, date_fin_reservation, commentaire_reservation, id_bien, id_client) VALUES (:datedeb, :datefin, :comresa, :modresa, :annresa, :idbien, :idclient)";
        $stmt = $this->con->prepare($sql);
        $stmt->execute($data);
    }

    public function update($id, $dd, $df, $cr, $mr, $ar, $idb, $idc)
    {
        $data = [
            ":idresa" => $id,
            ":datedeb" => $dd,
            ":datefin" => $df,
            ":comresa" => $cr,
            ":modresa" => $mr,
            ":annresa" => $ar,
            ":idbien" => $idb,
            ":idclient" => $idc
        ];
        $sql = "UPDATE reservation SET id_reservation = :idresa, date_debut_reservation = :datedeb, date_fin_reservation = :datefin, commentaire_reservation = :comresa, moderation_reservation = :modresa, annulation_reservation = :annresa, id_bien = :idbien, id_client = :idclient WHERE id_reservation = :idresa";
        $stmt = $this->con->prepare($sql);
        $stmt->execute($data);
    }

    public function delete($id)
    {
        $data = [":idresa" => $id];
        $sql = "DELETE FROM reservation WHERE id_reservation = :idresa";
        $stmt = $this->con->prepare($sql);
        $stmt->execute($data);
    }

    public function selectById($id)
    {
        $data = [":idresa" => $id];
        $sql = "SELECT date_debut_reservation, date_fin_reservation, commentaire_reservation, moderation_reservation, annulation_reservation, id_bien, id_client FROM reservation WHERE id_reservation = :idresa";
        $stmt = $this->con->prepare($sql);
        $stmt->execute($data);
        return $stmt;
    }
}

?>