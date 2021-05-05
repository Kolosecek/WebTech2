<?php
require_once "classes/Ucitel.php";
require_once "classes/Database.php";
require_once "classes/Question.php";
$correct = 0;
$type = $_REQUEST["type"];
$text = $_REQUEST["answer"];
if($_REQUEST["correct"]){
    $correct = $_REQUEST["correct"];
}
$q_ID = $_REQUEST["question_id"];
$q_type = $_REQUEST["q_type"];


if ($type == "new_answer")
{
    $conn = (new Database())->getConnection();

    if($q_type == "short"){
        $stmt = $conn->prepare("UPDATE odpoved SET text=? WHERE question_id=?");
        $stmt->execute([$text, $q_ID]);
    }

    if($q_type == "multi"){
        $stmt = $conn->prepare("INSERT INTO odpoved (text,correct,question_id) VALUES(?,?,?)");
        $stmt->execute([$text,$correct,$q_ID]);
    }


}