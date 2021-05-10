<?php
require_once "classes/Ucitel.php";
require_once "classes/Database.php";
require_once "classes/Question.php";

$type = $_REQUEST["mode"];

if ($type == "new_question")
{
    $typeQ = $_REQUEST["type"];
    $question = $_REQUEST["question"];
    $testID = $_REQUEST["exam"];
    $email = $_REQUEST["email"];

    if($typeQ != "math"){
        $conn = (new Database())->getConnection();
        $stmt = $conn->prepare("INSERT INTO otazka (question,type,test_id,ucitel_email) VALUES(?,?,?,?)");

        if($testID == 0)
            $stmt->execute([$question,$typeQ,null,$email]);
        else
            $stmt->execute([$question,$typeQ,$testID,$email]);

        $question_id = $conn->lastInsertId();
    }
    if($typeQ == "short")
    {
        $shortAns = $_REQUEST["shortAns"];
        $stmt = $conn->prepare("INSERT INTO odpoved (text,correct,question_id) VALUES(?,?,?)");
        $stmt->execute([$shortAns,1,$question_id]);
    }
    if($typeQ == "math")
    {
        $latex = $_REQUEST["latex"];
        $conn = (new Database())->getConnection();
        $stmt = $conn->prepare("INSERT INTO otazka (question,type,test_id,ucitel_email) VALUES(?,?,?,?)");

        if($testID == 0)
            $stmt->execute([$latex,$typeQ,null,$email]);
        else
            $stmt->execute([$latex,$typeQ,$testID,$email]);
    }

    if($typeQ == "compare"){
        $conn = (new Database())->getConnection();
        $stmt = $conn->prepare("INSERT INTO otazka (question,type,test_id,ucitel_email) VALUES(?,?,?,?)");
        if($testID == 0)
            $stmt->execute([$question,$typeQ,null,$email]);
        else
            $stmt->execute([$question,$typeQ,$testID,$email]);
    }

    echo "/skuska/question.php?id=$question_id";
}