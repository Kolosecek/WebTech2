<?php
require_once "Database.php";

class Ucitel {
    private $name;
    private $surname;
    private $email;
    private $password_hash;
    private $id;


    public function getName()
    {
        return $this->name;
    }


    public function getSurname()
    {
        return $this->surname;
    }


    public function getEmail()
    {
        return $this->email;
    }


    public function getId()
    {
        return $this->id;
    }


    public function getPasswordHash()
    {
        return $this->password_hash;
    }

    public function update(){
        $conn = (new Database())->getConnection();
        $stmt = $conn->prepare("UPDATE ucitel SET name=? AND surname=? AND email=? WHERE id=?");
        $stmt->execute([$this->name,$this->surname,$this->email,$this->id]);
    }
}