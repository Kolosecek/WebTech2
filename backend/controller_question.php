<?php
require_once "classes/Ucitel.php";
require_once "classes/Database.php";
require_once "classes/Question.php";

$type = $_REQUEST["mode"];
$typeQ = $_REQUEST["type"];
$question = $_REQUEST["question"];
$testID = $_REQUEST["exam"];

if ($type == "new_question")
{
    if($typeQ != "math"){
        $conn = (new Database())->getConnection();
        $stmt = $conn->prepare("INSERT INTO otazka (question,type,test_id) VALUES(?,?,?)");

        if($testID == 0)
            $stmt->execute([$question,$typeQ,null]);
        else
            $stmt->execute([$question,$typeQ,$testID]);

        $last_id = $conn->lastInsertId();
    }
    if($typeQ == "short")
    {
        $shortAns = $_REQUEST["shortAns"];
        $stmt = $conn->prepare("INSERT INTO odpoved (text,correct,question_id) VALUES(?,?,?)");
        $stmt->execute([$shortAns,1,$last_id]);
    }
    if($typeQ == "math")
    {
        $latex = $_REQUEST["latex"];
        $conn = (new Database())->getConnection();
        $stmt = $conn->prepare("INSERT INTO otazka (question,type,test_id) VALUES(?,?,?)");

        if($testID == 0)
            $stmt->execute([$latex,$typeQ,null]);
        else
            $stmt->execute([$latex,$typeQ,$testID]);
    }
}