<?php
require_once "Database.php";


class Ucitel {
    private $name;
    private $surname;
    private $email;
    private $password_hash;
    private $id;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
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