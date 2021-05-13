<?php
require_once "backend/classes/Database.php";
require_once "backend/classes/Ucitel.php";
require_once "backend/classes/Exam.php";

session_start();

if(!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] !== true)
{
    header("location: index.php");
    exit;
}

$conn = (new Database())->getConnection();
$stmt = $conn->prepare("SELECT * FROM test WHERE isActive=0");
$stmt->execute();
$tests = $stmt->fetchAll(PDO::FETCH_CLASS, "Exam");

$stmt2 = $conn->prepare("SELECT * FROM test WHERE isActive=1");
$stmt2->execute();
$testsActive = $stmt2->fetchAll(PDO::FETCH_CLASS, "Exam");

$stmt2 = $conn->prepare("SELECT * FROM test WHERE isActive=2");
$stmt2->execute();
$testsClosed = $stmt2->fetchAll(PDO::FETCH_CLASS, "Exam");
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Online Exam - Exams</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <link rel="stylesheet" href="styles.css">
        <link href='https://use.fontawesome.com/releases/v5.8.1/css/all.css'>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://www.w3schools.com/lib/w3.js"></script>
        <script src="https://kit.fontawesome.com/e73d803768.js" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    </head>

    <body>
        <?php include_once "header.html" ?>
        <div class="exams_content">
            <img src="graphic.png" alt="" id="bg_blurred">
            <h1 style="font-family: 'Asap', sans-serif" id="examsTitle">Your template exams</h1>

            <hr style="width: 50%; height: 2px; background-color: black !important;">

            <div style="display: flex; flex-direction: row; justify-content: center; width: 40%">
                <a class="btn exams_btn grow" href="new_exam.php"><i class="fas fa-folder-plus fa-lg"></i> Create new exam</a>
                <span class="btn exams_btn grow" id="btn1"><i class="fas fa-pen-alt fa-lg"></i> Show active exams</span>
                <span class="btn exams_btn grow" id="btn2" style="display: none"><i class="fas fa-list fa-lg"></i> Show template exams</span>
            </div>

    <!--        <h1 class="h3 mb-3 fw-normal">Template exams</h1>-->
            <div class="table_wrapper" id="allExamsTable">
                <table class="table">
                    <thead>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Exam Code</th>
                        <th scope="col">Length</th>
                        <th scope="col" style="text-align: center">Action</th>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($tests as $t)
                    {
                        echo $t->getRow();
                    }
                    ?>
                    </tbody>
                </table>
                <h2>Closed exams</h2>
                <table class="table">
                    <thead>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Student</th>
                        <th scope="col">Result</th>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($testsClosed as $t)
                    {
                        echo $t->getRow2();
                    }
                    ?>
                    </tbody>
                </table>





                <?php
                if(!$tests)
                    echo "<h1 style='text-align: center; font-family:'Asap'>You have no template exams</h1>";
                ?>
            </div>

            <div class="table_wrapper" id="activeExamsTable" style="display: none">
                <table class="table">
                    <thead>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Exam Code</th>
                    <th scope="col">Length</th>
                    <th scope="col" style="text-align: center;">Action</th>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($testsActive as $t2){
                            echo $t2->getRow();
                        }
                        ?>
                    </tbody>
                </table>


                <?php
                if(!$testsActive)
                    echo "<h1 style='text-align: center; font-family:'Asap'>You have no active exams</h1>";
                ?>
            </div>
        </div>
        <?php include_once "footer.html" ?>
    </body>
    <script src="javascript/new_exam.js"></script>
    <script>
        let btn1 = document.getElementById("btn1");
        let btn2 = document.getElementById("btn2");
        btn1.addEventListener('click',(() => {
            $("#allExamsTable").css('display', 'none');
            $("#activeExamsTable").css('display', 'block');
            $("#btn1").css('display', 'none');
            $("#btn2").css('display', 'block');
            $("#examsTitle").html("Your active exams");
        }))
        btn2.addEventListener('click',(() => {
            $("#allExamsTable").css('display', 'block');
            $("#activeExamsTable").css('display', 'none');
            $("#btn1").css('display', 'block');
            $("#btn2").css('display', 'none');
            $("#examsTitle").html("Your template exams");

        }))
    </script>
</html>