<!-- 
========= Site location
========= bien.class.php
========= Classe des biens
========= Date création : 12 oct. 2023
========= Créateur : HLt
-->

<?php

// Inclure fichiers des classes pour encapsulation

include('communes.class.php');
include('typebien.class.php');

class Bien
{
    private $con;
    private $idbien;
    private $nombien;
    private $ruebien;
    private $copbien;
    private $villebien;
    private $superficiebien;
    private $nombrecouchagebien;
    private $nombrechambrebien;
    private $descriptifbien;
    private $referencebien;
    private $statuebien;
    private $idtypebien;

    public function __construct($c)
    {
        $this->con = $c;
    }

    public function getId()
    {
        return $this->idbien;
    }

    public function getNom()
    {
        return $this->nombien;
    }

    public function getRue()
    {
        return $this->ruebien;
    }

    public function getCop()
    {
        return $this->copbien;
    }

    public function getVille()
    {
        return $this->villebien;
    }

    public function getSuperficie()
    {
        return $this->superficiebien;
    }

    public function getNbcouchage()
    {
        return $this->nombrecouchagebien;
    }

    public function getNbchambre()
    {
        return $this->nombrechambrebien;
    }

    public function getDesc()
    {
        return $this->descriptifbien;
    }

    public function getRef()
    {
        return $this->referencebien;
    }

    public function getStatue()
    {
        return $this->statuebien;
    }

    public function getIdTypebien()
    {
        return $this->idbien;
    }

    public function getLibCommune($idc)
    {
        $oCommune = new Communes($this->con);
        $libCom = $oCommune->selectLibById($idc);
        return $libCom;
    }

    public function getCodeCommune($idc)
    {
        $oCommune = new Communes($this->con);
        $libCom = $oCommune->selectCodeById($idc);
        return $libCom;
    }

    public function getLibTB($idtb)
    {
        $oType = new Typebien($this->con);
        $libTB = $oType->selectLibById($idtb);
        return $libTB;
    }

    public function setRue($r)
    {
        $this->ruebien = $r;
    }

    public function setCop($c)
    {
        $this->copbien = $c;
    }

    public function setVille($v)
    {
        $this->villebien = $v;
    }

    public function setSup($s)
    {
        $this->superficiebien = $s;
    }

    public function setNbcouchage($ncou)
    {
        $this->nombrecouchagebien = $ncou;
    }

    public function setNbchambre($ncha)
    {
        $this->nombrechambrebien = $ncha;
    }

    public function setDesc($d)
    {
        $this->descriptifbien = $d;
    }

    public function setRef($r)
    {
        $this->referencebien = $r;
    }

    public function setStat($stat)
    {
        $this->statuebien = $stat;
    }

    public function setIdtypebien($idtb)
    {
        $this->idtypebien = $idtb;
    }

    public function select()
    {
        $sql = "SELECT * FROM bien WHERE valid_bien = 1";
        $stmt = $this->con->query($sql);
        return $stmt;
    }

    public function insert($n, $r, $idc, $sup, $ncou, $ncha, $desc, $ref, $stat, $idtb)
    {
        $data = [
            ":nombien" => $n,
            ":ruebien" => $r,
            ":idcommune" => $idc,
            ":superficiebien" => $sup,
            ":nbcouchagebien" => $ncou,
            ":nbchambrebien" => $ncha,
            ":descriptifbien" => $desc,
            ":referencebien" => $ref,
            ":statutbien" => $stat,
            ":idtypebien" => $idtb
        ];
        $sql = "INSERT INTO bien (nom_bien, rue_bien, id_commune, superficie_bien, nombre_couchage_bien, nombre_chambre_bien, descriptif_bien, reference_bien, statut_bien, id_type_bien) VALUES (:nombien, :ruebien, :idcommune, :superficiebien, :nbcouchagebien, :nbchambrebien, :descriptifbien, :referencebien, :statutbien, :idtypebien)";
        $stmt = $this->con->prepare($sql);
        $stmt->execute($data);
    }

    public function update($id, $n, $r, $idc, $sup, $ncou, $ncha, $desc, $ref, $stat, $idtb)
    {
        $data = [
            ":idbien" => $id,
            ":nombien" => $n,
            ":ruebien" => $r,

            ":idcommune" => $idc,
            ":superficiebien" => $sup,
            ":nbcouchagebien" => $ncou,

            ":nbchambrebien" => $ncha,
            ":descriptifbien" => $desc,
            ":referencebien" => $ref,

            ":statutbien" => $stat,
            ":idtypebien" => $idtb
        ];
        $sql = "UPDATE bien SET nom_bien = :nombien, rue_bien = :ruebien, id_commune = :idcommune, superficie_bien = :superficiebien, nombre_couchage_bien = :nbcouchagebien, nombre_chambre_bien = :nbchambrebien, descriptif_bien = :descriptifbien, reference_bien = :referencebien, statut_bien = :statutbien, id_type_bien = :idtypebien WHERE id_bien = :idbien";
        $stmt = $this->con->prepare($sql);
        $stmt->execute($data);
    }

    public function delete($id)
    {
        $data = [":idbien" => $id];
        $sql = "UPDATE bien SET valid_bien = 0 WHERE id_bien = :idbien";
        $stmt = $this->con->prepare($sql);
        $stmt->execute($data);
    }

    public function selectById($id)
    {
        $data = [":idbien" => $id];
        $sql = "SELECT nom_bien FROM bien WHERE id_bien = :idbien";
        $stmt = $this->con->prepare($sql);
        $stmt->execute($data);
        return $stmt;
    }
}

?>