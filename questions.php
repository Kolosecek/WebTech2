<?php
require_once "backend/classes/Database.php";
require_once "backend/classes/Question.php";
require_once "backend/classes/Exam.php";

session_start();
if(!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] !== true)
{
    header("location: index.php");
    exit;
}
$email = $_SESSION["email"];
$conn = (new Database())->getConnection();
$stmt = $conn->prepare("SELECT * FROM otazka WHERE test_id IS NULL AND ucitel_email=?");
$stmt->execute([$email]);
$qTemplate = $stmt->fetchAll(PDO::FETCH_CLASS, "Question");
$stmt2 = $conn->prepare("SELECT * FROM otazka WHERE test_id IS NOT NULL AND ucitel_email=?");
$stmt2->execute([$email]);
$qTest = $stmt2->fetchAll(PDO::FETCH_CLASS, "Question");
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>New question</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
        <link href='https://use.fontawesome.com/releases/v5.8.1/css/all.css'>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://www.w3schools.com/lib/w3.js"></script>
    </head>


    <body>
        <h1>Your created questions</h1>
        <a class="btn btn-primary" href="exams.php">List of Exams</a>
        <a class="btn btn-primary" href="profile.php">Profile</a>
        <a class="btn btn-primary" href="new_question.php">Create new question</a>
        <h1 class="h3 mb-3 fw-normal">Template questions</h1>

        <table class="table">
            <thead>
                <th scope="col">Question</th>
                <th scope="col">Type</th>
                <th scope="col"></th>
            </thead>

            <tbody>
                <?php
                foreach ($qTemplate as $q)
                {
                    echo $q->getTableRowTemplate();
                }
                ?>
            </tbody>
        </table>


    </body>
    <script src="javascript/new_exam.js"></script>
</html>