<!-- 
========= Site location
========= photo.class.php
========= Classe des photos
========= Date création : 12 oct. 2023
========= Créateur : HLt
-->


<?php

class Photo
{
    private $con;
    private $idphoto;
    private $nomphoto;
    private $lienphoto;
    private $idbien;

    public function __construct($c)
    {
        $this->con = $c;
    }

    public function getId()
    {
        return $this->idphoto;
    }

    public function getNom()
    {
        return $this->nomphoto;
    }

    public function getLien()
    {
        return $this->lienphoto;
    }

    public function getIdBien()
    {
        return $this->idbien;
    }

    public function setNom($n)
    {
        $this->nomphoto = $n;
    }

    public function setLien($l)
    {
        $this->lienphoto = $l;
    }

    public function setIdBien($id)
    {
        $this->idbien = $id;
    }

    public function select()
    {
        $sql = "SELECT * FROM photo";
        $stmt = $this->con->query($sql);
        return $stmt;
    }

    public function insert($n, $l, $id)
    {
        $data = [
            ":nomphoto" => $n,
            ":lienphoto" => $l,
            ":idbien" => $id
        ];
        $sql = "INSERT INTO photo (nom_photo, lien_photo, id_bien) VALUES (:nomphoto, :lienphoto, :idbien)";
        $stmt = $this->con->prepare($sql);
        $stmt->execute($data);
    }

    public function update($id, $n, $l, $idb)
    {
        $data = [
            ":idphoto" => $id,
            ":nomphoto" => $n,
            ":lienphoto" => $l,
            ":idbien" => $idb
        ];
        $sql = "UPDATE photo SET nom_photo = :nomphoto, lien_photo = :lienphoto, id_bien = :idbien WHERE id_photo = :idphoto";
        $stmt = $this->con->prepare($sql);
        $stmt->execute($data);
    }

    public function delete($id)
    {
        $data = [":idphoto" => $id];
        $sql = "DELETE FROM photo WHERE id_photo = :idphoto";
        $stmt = $this->con->prepare($sql);
        $stmt->execute($data);
    }

    public function selectById($id)
    {
        $data = [":idphoto" => $id];
        $sql = "SELECT nom_photo FROM photo WHERE id_photo = :idphoto";
        $stmt = $this->con->prepare($sql);
        $stmt->execute($data);
        return $stmt;
    }
}

?>