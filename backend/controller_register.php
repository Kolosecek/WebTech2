<?php
require_once "classes/Database.php";
require_once "classes/Ucitel.php";

$type = $_REQUEST["type"];

if ($type == "signup") {
    $name = $_REQUEST["name"];
    $surname = $_REQUEST["surname"];
    $email = $_REQUEST["email"];
    $password = password_hash($_REQUEST["password"],PASSWORD_BCRYPT);
    $db = new Database();
    $conn = $db->getConnection();
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT * FROM ucitel WHERE email=?");
    $stmt->execute([$email]);
    $result = $stmt->fetchAll(PDO::FETCH_CLASS, "Ucitel");

    if($result != null) {
        echo "0";
    } else {

        $sql2 = "INSERT INTO ucitel (email,password_hash,name,surname) VALUES ('$email', '$password', '$name','$surname')";
        $conn->exec($sql2);
        session_start();
        $_SESSION["loggedin"] = true;
        $_SESSION["email"] = $email;
        echo "../skuska/profile.php";
    }
}