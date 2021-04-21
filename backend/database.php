<?php
class database{
    private $servername = "localhost";
    private $username = "xgajdosf";
    private $password = "123456";
    private $dbname = "skuska";
    public $conn;

    function getConnection(){
        $this->conn = null;
        try{
            $this->conn = new PDO("mysql:host=".$this->servername.";dbname=".$this->dbname, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Database could not be connected" .$exception->getMessage();
        }
        return $this->conn;
    }

}

/*
 function generateRandomString($length = 10) {
    return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
}
 */