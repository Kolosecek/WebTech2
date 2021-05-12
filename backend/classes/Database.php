<?php

function console_log($output, $with_script_tags = true)
{
    if (is_array($output) || is_object($output))
    {
        $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . ');';
    }
    else
    {
        $js_code = 'console.log(' . $output . ');';
    }
    if ($with_script_tags) {
        $js_code = '<script>' . $js_code . '</script>';
    }
    echo $js_code;
}

class Database {
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