<!-- 
========= Site location
========= typebien.class.php
========= Classe des types de biens
========= Date création : 10 oct. 2023
========= Créateur : HLt
-->

<?php

class Typebien
{
    private $con;
    private $idtypebien;
    private $libtypebien;

    public function __construct($c)
    {
        $this->con = $c;
    }

    public function getIdTypebien()
    {
        return $this->idtypebien;
    }

    public function getLibTypebien()
    {
        return $this->libtypebien;
    }

    public function setLibTypebien($l)
    {
        $this->libtypebien = $l;
    }

    public function select()
    {
        $sql = "SELECT * FROM typebien";
        $stmt = $this->con->query($sql);
        return $stmt;
    }

    public function insert($l)
    {
        $data = [":libtypebien" => $l];
        $sql = "INSERT INTO typebien (lib_type_bien) VALUES (:libtypebien)";
        $stmt = $this->con->prepare($sql);
        $stmt->execute($data);
    }

    public function update($id, $l)
    {
        $data = [
            ":idtypebien" => $id,
            ":libtypebien" => $l
        ];
        $sql = "UPDATE typebien SET lib_type_bien = :libtypebien WHERE id_type_bien = :idtypebien";
        $stmt = $this->con->prepare($sql);
        $stmt->execute($data);
    }

    public function delete($id)
    {
        $data = [":idtypebien" => $id];
        $sql = "DELETE FROM typebien WHERE id_type_bien = :idtypebien";
        $stmt = $this->con->prepare($sql);
        $stmt->execute($data);
    }

    public function selectById($id)
    {
        $data = [":idtypebien" => $id];
        $sql = "SELECT lib_type_bien FROM typebien WHERE id_type_bien = :idtypebien";
        $stmt = $this->con->prepare($sql);
        $stmt->execute($data);
        return $stmt;
    }
}

?>