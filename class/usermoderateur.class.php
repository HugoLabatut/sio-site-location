<!-- 
========= Site location
========= usermoderateur.class.php
========= Classe des modérateurs
========= Date création : 17 oct. 2023
========= Créateur : HLt
-->

<?php

class Usermoderateur
{
    private $con;
    private $idmodo;
    private $nommodo;
    private $prenommodo;
    private $mailmodo;
    private $pwmodo;

    public function __construct($c)
    {
        $this->con = $c;
    }

    public function getId()
    {
        return $this->idmodo;
    }

    public function getNom()
    {
        return $this->nommodo;
    }

    public function getPrenom()
    {
        return $this->prenommodo;
    }

    public function getMail()
    {
        return $this->mailmodo;
    }

    public function getPassword()
    {
        return $this->pwmodo;
    }

    public function setNom($n)
    {
        $this->nommodo = $n;
    }

    public function setPrenom($p)
    {
        $this->prenommodo = $p;
    }

    public function setMail($m)
    {
        $this->mailmodo = $m;
    }

    public function setPassword($pw)
    {
        $this->pwmodo = $pw;
    }

    public function select()
    {
        $sql = "SELECT * FROM usermoderateur";
        $stmt = $this->con->query($sql);
        return $stmt;
    }

    public function insert($n, $p, $m, $pw)
    {
        $encryptpw = hash('sha256', $pw);

        $data = [
            ":nommodo" => $n,
            ":prenommodo" => $p,
            ":mailmodo" => $m,
            ":pwmodo" => $encryptpw
        ];
        $sql = "INSERT  INTO usermoderateur (nom_moderateur, prenom_moderateur, mail_moderateur, pass_moderateur) VALUES (:nommodo, :prenommodo, :mailmodo, :pwmodo)";
        $stmt = $this->con->prepare($sql);
        $stmt->execute($data);
    }

    public function update($id, $n, $p, $m, $pw)
    {
        $encryptpw = hash('sha256', $pw);

        $data = [
            ":idmodo" => $id,
            ":nommodo" => $n,
            ":prenommodo" => $p,
            ":mailmodo" => $m,
            ":pwmodo" => $encryptpw
        ];
        $sql = "UPDATE usermoderateur SET nom_moderateur = :nommodo, prenom_moderateur = :prenommodo, mail_moderateur = :mailmodo, pass_moderateur = :pwmodo WHERE id_moderateur = :idmodo";
        $stmt = $this->con->prepare($sql);
        $stmt->execute($data);
    }

    public function delete($id)
    {
        $data = [":idmodo" => $id];
        $sql = "DELETE FROM usermoderateur WHERE id_moderateur = :idmodo";
        $stmt = $this->con->prepare($sql);
        $stmt->execute($data);
    }

    public function selectById($id)
    {
        $data = [":idmodo" => $id];
        $sql = "SELECT nom_moderateur, prenom_moderateur, mail_moderateur FROM usermoderateur WHERE id_moderateur = :idmodo";
        $stmt = $this->con->prepare($sql);
        $stmt->execute($data);
        return $stmt;
    }
}

?>