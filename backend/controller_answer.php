<?php
require_once "classes/Ucitel.php";
require_once "classes/Database.php";
require_once "classes/Question.php";
$correct = 0;
$type = $_REQUEST["type"];
if($_REQUEST["correct"]){
    $correct = $_REQUEST["correct"];
}
$q_ID = $_REQUEST["question_id"];
$q_type = $_REQUEST["q_type"];
$text1 = $_REQUEST['text1'];
$text2 = $_REQUEST['text2'];


if ($type == "new_answer")
{
    $conn = (new Database())->getConnection();

    if($q_type == "short"){
        $text = $_REQUEST["answer"];
        $stmt = $conn->prepare("UPDATE odpoved SET text=? WHERE question_id=?");
        $stmt->execute([$text, $q_ID]);
    }

    if($q_type == "multi"){
        $text = $_REQUEST["answer"];
        $stmt = $conn->prepare("INSERT INTO odpoved (text,correct,question_id) VALUES(?,?,?)");
        $stmt->execute([$text,$correct,$q_ID]);
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
        $stmt = $conn->prepare("INSERT INTO drag(question_id, text1, text2) VALUES(?, ?, ?)");
        $stmt->execute([$q_ID, $text1, $text2]);
    }

}
