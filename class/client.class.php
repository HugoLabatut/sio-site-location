<!-- 
========= Site location
========= client.class.php
========= Classe des clients
========= Date création : 12 oct. 2023
========= Créateur : HLt
-->

<?php

class Client
{
    private $con;
    private $idclient;
    private $nomclient;
    private $prenomclient;
    private $rueclient;
    private $copclient;
    private $villeclient;
    private $mailclient;
    private $passwordclient;
    private $statueclient;
    private $validclient;

    public function __construct($c)
    {
        $this->con = $c;
    }

    public function getId()
    {
        return $this->idclient;
    }

    public function getNom()
    {
        return $this->nomclient;
    }

    public function getPrenom()
    {
        return $this->prenomclient;
    }

    public function getRue()
    {
        return $this->rueclient;
    }

    public function getCop()
    {
        return $this->copclient;
    }

    public function getVille()
    {
        return $this->villeclient;
    }

    public function getMail()
    {
        return $this->mailclient;
    }

    public function getPassword()
    {
        return $this->passwordclient;
    }

    public function getStatue()
    {
        return $this->statueclient;
    }

    public function getValid()
    {
        return $this->validclient;
    }

    public function setNom($n)
    {
        $this->nomclient = $n;
    }

    public function setPrenom($p)
    {
        $this->prenomclient = $p;
    }

    public function setRue($rue)
    {
        $this->rueclient = $rue;
    }

    public function setCop($cop)
    {
        $this->copclient = $cop;
    }

    public function setVille($v)
    {
        $this->villeclient = $v;
    }

    public function setMail($m)
    {
        $this->mailclient = $m;
    }

    public function setPassword($pw)
    {
        $this->passwordclient = $pw;
    }

    public function setStatue($stat)
    {
        $this->statueclient = $stat;
    }

    public function setValid($val)
    {
        $this->validclient = $val;
    }

    public function select()
    {
        $sql = "SELECT * FROM client";
        $stmt = $this->con->query($sql);
        return $stmt;
    }

    public function insert($n, $p, $r, $c, $v, $m, $pw, $stat, $val)
    {
        $encryptpw = hash('sha256', $pw);

        $data = [
            ":nomclient" => $n,
            ":prenomclient" => $p,
            ":rueclient" => $r,
            ":copclient" => $c,
            ":villeclient" => $v,
            ":mailclient" => $m,
            ":mdpclient" => $encryptpw,
            ":statueclient" => $stat,
            ":validclient" => $val
        ];
        $sql = "INSERT INTO client (nom_client, prenom_client, rue_client, cop_client, ville_client, mail_client, password_client, statue_client, valid_client) VALUES (:nomclient, :prenomclient, :rueclient, :copclient, :villeclient, :mailclient, :mdpclient, :statueclient, :validclient)";
        $stmt = $this->con->prepare($sql);
        $stmt->execute($data);
    }

    public function update($id, $n, $p, $r, $c, $v, $m, $pw, $stat, $val)
    {
        $encryptpw = hash('sha256', $pw);

        $data = [
            ":nomclient" => $n,
            ":prenomclient" => $p,
            ":rueclient" => $r,
            ":copclient" => $c,
            ":villeclient" => $v,
            ":mailclient" => $m,
            ":mdpclient" => $encryptpw,
            ":statueclient" => $stat,
            ":validclient" => $val
        ];
        $sql = "UPDATE client SET nom_client = :nomclient, prenom_client = :prenomclient, rue_client = :rueclient, cop_client = :copclient, ville_client = :villeclient, mail_client = :mailclient, password_client = :mdpclient, statue_client = :statueclient, valid_client = :validclient WHERE id_client = :idclient";
        $stmt = $this->con->prepare($sql);
        $stmt->execute($data);
    }

    public function delete($id)
    {
        $data = [":idclient" => $id];
        $sql = "DELETE FROM client WHERE id_client = :idclient";
        $stmt = $this->con->prepare($sql);
        $stmt->execute($data);
    }

    public function selectById($id)
    {
        $data = [":idclient" => $id];
        $sql = "SELECT nom_client, prenom_client, rue_client, cop_client, ville_client, password_client, statue_client, valid_client FROM client WHERE id_client = :idclient";
        $stmt = $this->con->prepare($sql);
        $stmt->execute($data);
        return $stmt;
    }
}

?>