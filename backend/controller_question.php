<?php
require_once "classes/Ucitel.php";
require_once "classes/Database.php";
require_once "classes/Question.php";
$type = $_REQUEST["mode"];
$typeQ = $_REQUEST["type"];
$question = $_REQUEST["question"];
$testID = $_REQUEST["exam"];

if ($type == "new_question"){
    $conn = (new Database())->getConnection();
    $stmt = $conn->prepare("INSERT INTO otazka (question,type,test_id) VALUES(?,?,?)");
    if($testID == 0)
        $stmt->execute([$question,$typeQ,null]);
    else
        $stmt->execute([$question,$typeQ,$testID]);
}