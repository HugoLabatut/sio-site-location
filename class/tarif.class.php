<!-- 
========= Site location
========= tarif.class.php
========= Classe des tarifs
========= Date création : 16 oct. 2023
========= Créateur : HLt
-->

<?php

class Tarif
{
    private $con;
    private $idtarif;
    private $datedebtarif;
    private $datefintarif;
    private $prixloctarif;
    private $idbien;

    public function __construct($c)
    {
        $this->con = $c;
    }

    public function getId()
    {
        return $this->idtarif;
    }

    public function getDatedeb()
    {
        return $this->datedebtarif;
    }

    public function getDatefin()
    {
        return $this->datefintarif;
    }

    public function getPrixloc()
    {
        return $this->prixloctarif;
    }

    public function getIdBien()
    {
        return $this->idbien;
    }

    public function setDatedeb($dd)
    {
        $this->datedebtarif = $dd;
    }

    public function setDatefin($df)
    {
        $this->datefintarif = $df;
    }

    public function setPrixloc($pl)
    {
        $this->prixloctarif = $pl;
    }

    public function setIdbien($idb)
    {
        $this->idbien = $idb;
    }

    public function select()
    {
        $sql = "SELECT * FROM tarif";
        $stmt = $this->con->query($sql);
        return $stmt;
    }

    public function insert($dd, $df, $pl, $idb)
    {
        $data = [
            ":datedebtarif" => $dd,
            ":datefintarif" => $df,
            ":prixloctarif" => $pl,
            ":idbien" => $idb
        ];
        $sql = "INSERT INTO tarif (date_debut_tarif, date_fin_tarif, prix_loc_tarif, id_bien) VALUES (:datedebtarif, :datefintarif, :prixloctarif, :idbien)";
        $stmt = $this->con->prepare($sql);
        $stmt->execute($data);
    }

    public function update($id, $dd, $df, $pl, $idb)
    {
        $data = [
            ":idtarif" => $id,
            ":datedebtarif" => $dd,
            ":datefintarif" => $df,
            ":idbien" => $idb
        ];
        $sql = "UPDATE tarif SET date_debut_tarif = :datedebtarif, date_fin_tarif = :datefintarif, id_bien = :idbien WHERE id_tarif = :idtarif";
        $stmt = $this->con->prepare($sql);
        $stmt->execute($data);
    }

    public function delete($id)
    {
        $data = [":idtarif" => $id];
        $sql = "DELETE FROM tarif WHERE id_tarif = :idtarif";
        $stmt = $this->con->prepare($sql);
        $stmt->execute($data);
    }

    public function selectById($id)
    {
        $data = [":idtarif" => $id];
        $sql = "SELECT prix_loc_tarif, id_bien FROM tarif WHERE id_tarif = :idtarif";
        $stmt = $this->con->prepare($sql);
        $stmt->execute($data);
        return $stmt;
    }
}

?>