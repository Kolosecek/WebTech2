<?php
require_once "classes/Ucitel.php";
require_once "classes/Database.php";
require_once "classes/Question.php";
$correct = 0;
$type = $_REQUEST["type"];



if ($type == "new_answer")
{
    if(isset($_REQUEST["correct"])){
        $correct = $_REQUEST["correct"];
    }
    $q_ID = $_REQUEST["question_id"];
    $q_type = $_REQUEST["q_type"];

    $conn = (new Database())->getConnection();

    if($q_type == "short"){
        $text = $_REQUEST["answer"];
        $stmt = $conn->prepare("UPDATE odpoved SET text=? WHERE question_id=?");
        $stmt->execute([$text, $q_ID]);
    }

    if($q_type == "multi"){
        $stt = $conn->prepare("SELECT * FROM odpoved WHERE question_id=? AND correct=1");
        $stt->execute([$q_ID]);
        $cor = $stt->fetchAll(PDO::FETCH_CLASS, "Answer");
        if($cor){
            $text = $_REQUEST["answer"];
            $stmt = $conn->prepare("INSERT INTO odpoved (text,correct,question_id) VALUES(?,?,?)");
            $stmt->execute([$text,0,$q_ID]);
        }else{
            $text = $_REQUEST["answer"];
            $stmt = $conn->prepare("INSERT INTO odpoved (text,correct,question_id) VALUES(?,?,?)");
            $stmt->execute([$text,$correct,$q_ID]);
        }

    }
    if($q_type == "math"){
        $text = $_REQUEST["latex"];
        $find = $conn->prepare("SELECT * FROM odpoved WHERE question_id=?");
        $find->execute([$q_ID]);
        $found = $find->fetchAll(PDO::FETCH_CLASS, "Question");
        if($found){
            $stmt = $conn->prepare("UPDATE odpoved SET text=? WHERE question_id=?");
            $stmt->execute([$text, $q_ID]);
        }
        else{
            $stmt = $conn->prepare("INSERT INTO odpoved (text,correct,question_id) VALUES(?,?,?)");
            $stmt->execute([$text,$correct,$q_ID]);
        }
    }
    if ($q_type == "compare"){
        $text1 = $_REQUEST['text1'];
        $text2 = $_REQUEST['text2'];
        $stmt = $conn->prepare("INSERT INTO drag(question_id, text1, text2) VALUES(?, ?, ?)");
        $stmt->execute([$q_ID, $text1, $text2]);
    }
}
elseif ($type == "delete"){
    $conn = (new Database())->getConnection();
    $stmt = $conn->prepare("DELETE FROM odpoved WHERE id=?");
    $stmt->execute([$_REQUEST["id"]]);
    echo "done";
}
