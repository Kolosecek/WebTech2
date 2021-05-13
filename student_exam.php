<?php
require_once "backend/classes/Database.php";
require_once "backend/classes/Ucitel.php";
require_once "backend/classes/Exam.php";

session_start();

$code_test = $_REQUEST["testID"];
$studentName= $_REQUEST["studentName"];
$studentID= $_REQUEST["studentID"];

$conn = (new Database())->getConnection();
$checkDuplicate = $conn->prepare("SELECT * FROM test where test_code=? AND student_id=?");
$checkDuplicate->execute([$code_test,$studentID]);
$TestDuplicate = $checkDuplicate->fetchAll(PDO::FETCH_CLASS, "Exam");
if ($TestDuplicate) {} else {
    $stmt = $conn->prepare("SELECT * FROM test where test_code=?");
    $stmt->execute([$code_test]);
    $exam = $stmt->fetchAll(PDO::FETCH_CLASS, "Exam");
    $id = $exam[0]->duplicate($code_test,$studentName,$studentID);
}
?>


<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Online Exam</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <link href='https://use.fontawesome.com/releases/v5.8.1/css/all.css'>
        <link rel="stylesheet" href="styles.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://www.w3schools.com/lib/w3.js"></script>
        <script src="https://kit.fontawesome.com/e73d803768.js" crossorigin="anonymous"></script>
    </head>


    <body>
        <?php include_once "header_student_exam.html" ?>
        <div class="exams_content">
            <img src="graphic.png" alt="" id="bg_blurred">
            <div id="newAnswerFormWrapper" style="color: white">
                <?php if ($TestDuplicate) {
                    echo "<i class='fas fa-hand-paper fa-10x' style='margin-bottom: 20px;'></i>
                          <hr style='width: 80%; height: 2px; background-color: white !important;'>
                          <h2 style='font-family:Asap'>Student with ID <u>$studentID</u> already answered this test.</h2>";
                    echo "<a class='btn btn-grad grow' href='index.php'>Go back</a>";
                } else {
                    echo "<h2>Welcome, $studentName</h2>
                          <hr style='width: 80%; height: 2px; background-color: white !important;'>";
                    echo "<h4>To start writing exam {$exam[0]->getTitle()} with the code {$exam[0]->getTestCode()}, click the button below.</h4>";
                    echo "<h4>Exam duration {$exam[0]->getTime()}</h4>";
                    echo "<a class='btn btn-grad grow' href='student_active_exam.php?id=$id&code_test=$code_test&studentID=$studentID' style='width: 200px'>
                            <div>
                                <i class='fas fa-play fa-2x'></i>
                            </div>
                          <div>Start exam</div>
                          </a>";
                }?>
            </div>
        </div>
    </body>
</html>
