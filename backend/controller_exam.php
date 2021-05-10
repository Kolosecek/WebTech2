<?php
require_once "classes/Ucitel.php";
require_once "classes/Database.php";
require_once "classes/Question.php";

$type = $_REQUEST["type"];

if ($type == "new_exam")
{
    $time = $_REQUEST["time"];
    $title = $_REQUEST["title"];
    $creator_id = $_REQUEST["creator"];
    $test_code = bin2hex(openssl_random_pseudo_bytes(10)); // 20 chars

    $conn = (new Database())->getConnection();
    $stmt = $conn->prepare("INSERT INTO test (title,time,test_code,creator_id,isActive) VALUES(?,?,?,?,?)");
    $stmt->execute([$title, $time, $test_code,$creator_id,0]);
    $test_id = $conn->lastInsertId();

    foreach ($_REQUEST["questions"] as $questionId)
    {
        $stmt = $conn->prepare("SELECT * FROM otazka WHERE id=? LIMIT 1");
        $stmt->execute([$questionId]);
        $question = $stmt->fetchAll(PDO::FETCH_CLASS, "Question");
        $question[0]->duplicate($test_id);
    }

    echo "/skuska/exam.php?id=$test_id";
}


else if ($type == "new_question_to_exam")
{
    echo "mayday";
    $add_q = $_REQUEST["question_add"];
    $test_id = $_REQUEST["testId"];

    $conn = (new Database())->getConnection();
    $stmt = $conn->prepare("UPDATE otazka SET test_id=? WHERE id=?");
    $stmt->execute([$test_id, $add_q]);
}

if ($type == "exam_submit")
{

}
