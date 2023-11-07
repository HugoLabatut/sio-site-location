<!-- 
========= Site location
========= communes.class.php
========= Classe des communes
========= Date création : 17 oct. 2023
========= Créateur : HLt
-->

<?php 

class Communes
{
    private $con;
    private $idcom;
    private $typecom;
    private $codecom;
    private $codereg;
    private $codedep;
    private $codecol;
    private $codearr;
    private $typenomclair;
    private $nomclair;
    private $nomclairtyporiche;
    private $libcom;
    private $codecanton;
    private $codecomparente;

    public function __construct($c)
    {
        $this->con = $c;
    }

    public function getId()
    {
        return $this->idcom;
    }

    public function getCodecom()
    {
        return $this->codecom;
    }

    public function setCodecom($ccom)
    {
        $this->codecom = $ccom;
    }

    public function getCodereg()
    {
        return $this->codereg;
    }

    public function setCodereg($creg)
    {
        $this->codereg = $creg;
    }

    public function getCodedep()
    {
        return $this->codedep;
    }

    public function setCodedep($cdep)
    {
        $this->codedep = $cdep;
    }

    public function getCodecol()
    {
        return $this->codecol;
    }

    public function setCodecol($ccol)
    {
        $this->codecol = $ccol;
    }

    public function getCodearr()
    {
        return $this->codearr;
    }

    public function setCodearr($carr)
    {
        $this->codearr = $carr;
    }

    public function getTypenomclair()
    {
        return $this->typenomclair;
    }

    public function setTypenomclair($tnc)
    {
        $this->typenomclair = $tnc;
    }

    public function getNomclair()
    {
        return $this->nomclair;
    }

    public function setNomclair($nc)
    {
        $this->nomclair = $nc;
    }

    public function getNomclairtyporiche()
    {
        return $this->nomclairtyporiche;
    }

    public function setNomclairtyporiche($nctp)
    {
        $this->nomclairtyporiche = $nctp;
    }

    public function getLibcom()
    {
        return $this->libcom;
    }

    public function setLibcom($lc)
    {
        $this->libcom = $lc;
    }

    public function getCodecanton()
    {
        return $this->codecanton;
    }

    public function setCodecanton($ccan)
    {
        $this->codecanton = $ccan;
    }

    public function getCodecomparente()
    {
        return $this->codecomparente;
    }

    public function setCodecomparente($ccp)
    {
        $this->codecomparente = $ccp;
    }

    public function select()
    {
        $sql = "SELECT * FROM communes";
        $stmt = $this->con->query($sql);
        return $stmt;
    }

    public function selectById($id)
    {
        $data = [":idcom" => $id];
        $sql = "SELECT libelle_commune FROM communes WHERE id_commune = :idcom";
        $stmt = $this->con->prepare($sql);
        $stmt->execute($data);
        return $stmt;
    }
}

?>
