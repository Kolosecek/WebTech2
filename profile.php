<?php
require_once "backend/classes/Database.php";
require_once "backend/classes/Ucitel.php";

session_start();

if(!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] !== true)
{
    header("location: index.php");
    exit;
}

$db = new Database();
$conn = $db->getConnection();
$email = $_SESSION["email"];
$name = "";
$surname = "";

$stmt = $conn->prepare("SELECT * FROM ucitel WHERE email=?");
$stmt->execute([$email]);
$result = $stmt->fetchAll(PDO::FETCH_CLASS, "Ucitel");

$name = $result[0]->getName();
$surname = $result[0]->getSurname();
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Online Exam - Profile</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <link href='https://use.fontawesome.com/releases/v5.8.1/css/all.css'>
        <link rel="stylesheet" href="styles.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://www.w3schools.com/lib/w3.js"></script>
        <script src="https://kit.fontawesome.com/e73d803768.js" crossorigin="anonymous"></script>

    </head>


    <body>
        <?php include_once "header.html" ?>
        <div class="content bg-lg" style="justify-content: center;">
            <img src="graphic.png" alt="" id="bg_blurred">
            <div id="profile_title">
                <h1>Hello <?= $name . " " . $surname . "!"?></h1>
            </div>
            <div id="profile_btns">
                <div class="profile_menu">
                    <button class="btn btn-primary btn-lg grow menu_btn" onclick="allExams()">List of already existing exams</button>
                </div>
                <div class="profile_menu">
                    <button class="btn btn-primary btn-lg grow menu_btn" onclick="newExam()">Create new exam</button>
                </div>
                <div class="profile_menu">
                    <button class="btn btn-primary btn-lg grow menu_btn" onclick="newQuestion()">Create new questions</button>
                </div>
                <div class="profile_menu">
                    <button class="btn btn-primary btn-lg grow menu_btn" onclick="logout()">Log Out</button>
                </div>
            </div>
        </div>

    </body>
    <script src="javascript/profile.js"></script>
</html>