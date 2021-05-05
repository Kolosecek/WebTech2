<?php
require_once "classes/Ucitel.php";
require_once "classes/Database.php";

session_start();

$type = $_REQUEST["type"];

if($type == "login")
{
    $email = $_REQUEST["email"];
    $password = $_REQUEST["password"];
    $db = new Database();
    $conn = $db->getConnection();
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT * FROM ucitel WHERE email=?");
    $stmt->execute([$email]);
    $result = $stmt->fetchAll(PDO::FETCH_CLASS, "Ucitel");
    if($result == null)
    {
        echo "0";
    }
    else
    {
        if(password_verify($password,$result[0]->getPasswordHash()))
        {

            $_SESSION["loggedin"] = true;
            $_SESSION["email"] = $email;
            echo "../skuska/profile.php";
        }
    }
}