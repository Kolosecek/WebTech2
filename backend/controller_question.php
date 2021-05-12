<?php
require_once "classes/Ucitel.php";
require_once "classes/Database.php";
require_once "classes/Question.php";
require_once "classes/Drag.php";
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
    if(isset($_REQUEST["text"])){
        $text = $_REQUEST["text"];
    }
    if (isset($_REQUEST["test_id"])){
        $t_id = $_REQUEST["test_id"];
    }
    if (isset($_REQUEST["text1"])){
        $text1 = $_REQUEST["text1"];
    }
    if (isset($_REQUEST["text2"])){
        $text2 = $_REQUEST["text2"];
    }

    if($q_id != "null"){

        $conn = (new Database())->getConnection();
        $findTestQuestion = $conn->prepare("SELECT * FROM otazka WHERE id=?");
        $findTestQuestion->execute([$q_id]);
        $foundTestQuestion = $findTestQuestion->fetchAll(PDO::FETCH_CLASS, "Question");
        if ($foundTestQuestion[0]->getType() == "compare"){
            $foundRightAns= 0;


            $questionString = "[Template]".$foundTestQuestion[0]->getQuestion();
            $findTemplateQuestion = $conn->prepare("SELECT * FROM otazka WHERE test_id IS NULL AND question=? AND type=?");
            $findTemplateQuestion->execute([$questionString,$foundTestQuestion[0]->getType()]);
            $foundTemplateQuestion = $findTemplateQuestion->fetchAll(PDO::FETCH_CLASS, "Question");

            $stmt = $conn->prepare("SELECT * FROM drag where question_id=?");
            $stmt->execute([$foundTemplateQuestion[0]->getId()]);
            $result = $stmt->fetchAll(PDO::FETCH_CLASS, "Drag");
            foreach ($result as $r){
                $rText1 = $r->getText1();
                $rText2 = $r->getText2();
                if($rText1 == $text1 && $rText2 == $text2){
                    $foundRightAns = 1;
                    $right = $conn->prepare("INSERT INTO odpoved_student (question_id, test_id, text1,text2, correct) VALUES (?,?,?,?,?)");
                    $right->execute([$q_id, $t_id, $text1,$text2, 1]);
                }

            }
            if ($foundRightAns == 0){
                $right = $conn->prepare("INSERT INTO odpoved_student (question_id, test_id, text1,text2, correct) VALUES (?,?,?,?,?)");
                $right->execute([$q_id, $t_id, $text1,$text2, 0]);
            }
        }
        else{
            if($foundTestQuestion[0]->getType() == "math"){
                $oldstr = $foundTestQuestion[0]->getQuestion();
                $questionString = substr_replace($oldstr, "[Template]", 6, 0);
                //$questionString = "[Template]".$foundTestQuestion[0]->getQuestion();
            }
            else{
                $questionString = "[Template]".$foundTestQuestion[0]->getQuestion();
            }
            $findTemplateQuestion = $conn->prepare("SELECT * FROM otazka WHERE test_id IS NULL AND question=? AND type=?");
            $findTemplateQuestion->execute([$questionString,$foundTestQuestion[0]->getType()]);
            $foundTemplateQuestion = $findTemplateQuestion->fetchAll(PDO::FETCH_CLASS, "Question");

            $stmt = $conn->prepare("SELECT * FROM odpoved where question_id=? AND correct=1");
            $stmt->execute([$foundTemplateQuestion[0]->getId()]);
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
    }
    //echo $q_id." ".$text." ".$t_id;
}

