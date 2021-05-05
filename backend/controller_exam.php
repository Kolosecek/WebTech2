<?php
require_once "classes/Ucitel.php";
require_once "classes/Database.php";
require_once "classes/Question.php";

$type = $_REQUEST["type"];
$time = $_REQUEST["time"];
$title = $_REQUEST["title"];
$creator_id = $_REQUEST["creator"];
$test_code = bin2hex(openssl_random_pseudo_bytes(10)); // 20 chars

if ($type == "new_exam")
{
    $conn = (new Database())->getConnection();
    $stmt = $conn->prepare("INSERT INTO test (title,time,test_code,creator_id,isActive) VALUES(?,?,?,?,?)");
    $stmt->execute([$title, $time, $test_code,$creator_id,0]);
    header("https://wt49.fei.stuba.sk/skuska/exams.php");
}