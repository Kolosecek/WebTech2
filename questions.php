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

$stmt = $conn->prepare("SELECT * FROM otazka WHERE test_id IS NOT NULL AND ucitel_email=?");
$stmt->execute([$email]);
$qTest = $stmt->fetchAll(PDO::FETCH_CLASS, "Question");

?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Online Exam - All questions</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <link href='https://use.fontawesome.com/releases/v5.8.1/css/all.css'>
        <link rel="stylesheet" href="styles.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
        <script src='https://unpkg.com/mathlive/dist/mathlive.min.js'></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://www.w3schools.com/lib/w3.js"></script>
        <script src='https://unpkg.com/mathlive/dist/mathlive.min.js'></script>
        <script src="https://kit.fontawesome.com/e73d803768.js" crossorigin="anonymous"></script>
    </head>

    <body>
    <?php include_once "header.html" ?>
    <div class="exams_content">

        <img src="graphic.png" alt="" id="bg_blurred">
        <h1 id="examsTitle" style="font-family: 'Asap', sans-serif">Your template questions</h1>
        <hr style="width: 50%; height: 2px; background-color: black !important;">
        <div style="display: flex; flex-direction: row; justify-content: center; width: 30%">
            <a class="btn exams_btn grow" href="new_question.php"><i class="fas fa-plus-circle fa-lg"></i> Create new question</a>
            <span class="btn exams_btn grow" id="btn1"><i class="fas fa-pen-alt fa-lg"></i> Show active questions</span>
            <span class="btn exams_btn grow" id="btn2" style="display: none"><i class="fas fa-list fa-lg"></i> Show template questions</span>
        </div>
        <div class="table_wrapper"id="allQuestionsTable">
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
            <?php
            if(!$qTemplate)
                echo "<h1 style='text-align: center; font-family:'Asap'>You have no template questions</h1>";
            ?>
        </div>
        <div class="table_wrapper" id="activeQuestionsTable" style="display: none">
            <table class="table">
                <thead>
                <th scope="col">Question</th>
                <th scope="col">Type</th>
                <th scope="col"></th>
                </thead>

                <tbody>
                <?php
                foreach ($qTest as $q)
                {
                    echo $q->getTableRowTemplate();
                }
                ?>
                </tbody>
            </table>
            <?php
            if(!$qTest)
                echo "<h1 style='text-align: center; font-family:'Asap'>You have no test questions</h1>";
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
            $("#allQuestionsTable").css('display', 'none');
            $("#activeQuestionsTable").css('display', 'block');
            $("#btn1").css('display', 'none');
            $("#btn2").css('display', 'block');
            $("#examsTitle").html("Your active questions");
        }))
        btn2.addEventListener('click',(() => {
            $("#allQuestionsTable").css('display', 'block');
            $("#activeQuestionsTable").css('display', 'none');
            $("#btn1").css('display', 'block');
            $("#btn2").css('display', 'none');
            $("#examsTitle").html("Your template questions");
        }))
    </script>
    <script>
        let btns = document.querySelectorAll('a[ansID]');
        for (let i = 0;i<btns.length;i++){
            btns[i].addEventListener("click",function (e){
                let id = e.target.getAttribute("ansID");
                let url= "backend/controller_answer.php?type=delete&id="
                url= url+id;
                $.ajax({
                    type: "GET",
                    url: url,
                    success: function(data) {
                        console.log(data);
                        location.reload();
                    }
                });
            });
        }
    </script>
</html>