<?php
require_once "classes/Ucitel.php";
require_once "classes/Database.php";
require_once "classes/Question.php";
require_once "classes/Odpoved_student.php";

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

    //echo "/skuska/question.php?id=$question_id";
}
elseif ($type="result"){
    $q_id = $_REQUEST["id"];
    $text = $_REQUEST["text"];
    $t_id = $_REQUEST["test_id"];

    if($q_id != "null"){
        $conn = (new Database())->getConnection();
        $stmt = $conn->prepare("SELECT * FROM odpoved where question_id=? AND correct=1");
        $stmt->execute([$q_id]);
        $result = $stmt->fetchAll(PDO::FETCH_CLASS, "Answer");
        foreach ($result as $r){
            if($text == $r->getText())
            {
                $stmt = $conn->prepare("INSERT INTO odpoved_student (question_id, test_id, odpoved, correct) VALUES (?,?,?,?)");
                $stmt->execute([$q_id, $t_id, $text, 1]);
            }else
            {
                $stmt = $conn->prepare("INSERT INTO odpoved_student (question_id, test_id, odpoved, correct) VALUES (?,?,?,?)");
                $stmt->execute([$q_id, $t_id, $text, 0]);
            }
        }

}

    if(isset($_REQUEST["type"])){

    }
    //echo $q_id." ".$text." ".$t_id;
}

