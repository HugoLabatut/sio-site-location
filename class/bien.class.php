<!-- 
========= Site location
========= bien.class.php
========= Classe des biens
========= Date création : 12 oct. 2023
========= Créateur : HLt
-->

<?php
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

    public function insert($n, $r, $cp, $v, $sup, $ncou, $ncha, $desc, $ref, $stat, $idtb)
    {
        $data = [
            ":nombien" => $n,
            ":ruebien" => $r,
            ":copbien" => $cp,
            ":villebien" => $v,
            ":superficiebien" => $sup,
            ":nbcouchagebien" => $ncou,
            ":nbchambrebien" => $ncha,
            ":descriptifbien" => $desc,
            ":referencebien" => $ref,
            ":statutbien" => $stat,
            ":idtypebien" => $idtb
        ];
        $sql = "INSERT INTO bien (nom_bien, rue_bien, cop_bien, ville_bien, superficie_bien, nombre_couchage_bien, nombre_chambre_bien, descriptif_bien, reference_bien, statut_bien, id_type_bien) VALUES (:nombien, :ruebien, :copbien, :villebien, :superficiebien, :nbcouchagebien, :nbchambrebien, :descriptifbien, :referencebien, :statutbien, :idtypebien)";
        $stmt = $this->con->prepare($sql);
        $stmt->execute($data);
    }

    public function update($id, $n, $r, $cp, $v, $sup, $ncou, $ncha, $desc, $ref, $stat, $idtb)
    {
        $data = [
            ":idbien" => $id,
            ":nombien" => $n,
            ":ruebien" => $r,
            ":copbien" => $cp,
            ":villebien" => $v,
            ":superficiebien" => $sup,
            ":nbcouchagebien" => $ncou,
            ":nbchambrebien" => $ncha,
            ":descriptifbien" => $desc,
            ":referencebien" => $ref,
            ":statuebien" => $stat,
            ":idtypebien" => $idtb
        ];
        $sql = "UPDATE bien SET nom_bien = :nombien, rue_bien = :ruebien, cop_bien = :copbien, ville_bien = :villebien, superficie_bien = :superficiebien, nombre_couchage_bien = :nbcouchagebien, nombre_chambre_bien = :nbchambrebien, descriptif_bien = :descripftifbien, reference_bien = :referencebien, statue_bien = :statuebien, id_type_bien = :idtypebien WHERE id_bien = :idbien";
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