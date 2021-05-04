<?php
require_once "classes/Ucitel.php";
require_once "classes/Database.php";
require_once "classes/Question.php";
$type = $_REQUEST["type"];
$text = $_REQUEST["answer"];
$correct = $_REQUEST["correct"];
$q_ID = $_REQUEST["question_id"];
if ($type == "new_answer"){
    $conn = (new Database())->getConnection();
    $stmt = $conn->prepare("INSERT INTO odpoved (text,correct,question_id) VALUES(?,?,?)");
    $stmt->execute([$text,$correct,$q_ID]);
}