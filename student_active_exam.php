<?php
require_once "backend/classes/Database.php";
require_once "backend/classes/Ucitel.php";
require_once "backend/classes/Exam.php";
require_once "backend/classes/Question.php";
session_start();
$conn = (new Database())->getConnection();


$stmt = $conn->prepare("SELECT * FROM test where id=?");
$stmt->execute([1]);
$exam = $stmt->fetchAll(PDO::FETCH_CLASS, "Exam");

$stmt = $conn->prepare("SELECT * FROM otazka where test_id=?");
$stmt->execute([1]);
$exam = $stmt->fetchAll(PDO::FETCH_CLASS, "Question");

echo var_dump($exam);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Exam</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <link href='https://use.fontawesome.com/releases/v5.8.1/css/all.css'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://www.w3schools.com/lib/w3.js"></script>
</head>
<body>
</body>
</html>
