<?php
require_once "backend/classes/Database.php";
require_once "backend/classes/Question.php";
require_once "backend/classes/Exam.php";
require_once "backend/classes/Answer.php";
require_once "backend/classes/Drag.php";

session_start();

if(!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] !== true) {
    header("location: index.php");
    exit;
}

$email = $_SESSION["email"];

?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Online Exam - Question detail</title>
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

    <body style="    background-image: linear-gradient(to right, #50C9C3 0%, #96DEDA 51%, #50C9C3 100%);">
        <?php include_once "header.html" ?>
        <div class="exams_content" style="justify-content: space-evenly;">
        <!--    <img src="graphic.png" alt="" id="bg_blurred">-->
            <div id="examInfoWrapper" style="width: 72%;justify-content: center; align-items: center; padding: 60px; margin-bottom: 60px">
                <h1 style="font-family: 'Asap', sans-serif; color: white; text-align: center;">Question detail</h1>
                <hr style="width: 50%; height: 2px; background-color: white !important;">

                <?php
                if(isset($_REQUEST["id"])) {
                    $q_ID = $_REQUEST["id"];
                    $conn = (new Database())->getConnection();
                    $stmt = $conn->prepare("SELECT * FROM otazka where id=? AND ucitel_email=?");
                    $stmt->execute([$_REQUEST["id"],$email]);
                    $question = $stmt->fetchAll(PDO::FETCH_CLASS, "Question");
                    if($question) {
                        foreach ($question as $t) {
                            $question = $t->getQuestion();
                            $type = $t->getType();
                            $ID = $t->getId();
                            if ($type != "math") {
                                echo "<div id='questTitleTypeWrapper'><span><b>Question:</b> $question</span>
                                          <span><b>Type:</b> $type</span></div>";
                            }
                            elseif ($type === "math") {
                                echo "<math-field read-only class='mathfld' style='color: white'>$question</math-field><p>Type: $type</p>";
                            }
                        }
                        $stmt2 = $conn->prepare("SELECT * FROM odpoved WHERE question_id=?");
                        $stmt2->execute([$ID]);
                        $answers = $stmt2->fetchAll(PDO::FETCH_CLASS, "Answer");

                        if($type !== "draw") {
                            echo "
                                <div id='examInfoWrapper' style='width: 70%; align-items: center; font-family: Asap; border: 1px solid white'>
                                    <h3 style='color: white'>Question answers</h3>
                                    <div style='display: flex; flex-direction: column; width: 70%'>";
                            $correctExist = 0;
                            foreach ($answers as $a) {
                                if($correctExist != 1){
                                    $correctExist = $a->getCorrect();
                                }
                                if ($a->getCorrect() == 1 && $type != "compare"){
                                    echo "
                                        <div style='display: flex; flex-direction: row; align-items: center; color: white'>
                                            <div style='width: 20px; vertical-align: center'><i class='fas fa-check grow' style='color: #57EE01'></i></div>{$a->getRow()}
                                        </div>";
                                }
                                else {
                                    echo "
                                        <div style='display: flex; flex-direction: row; align-items: center; color: white;'>
                                            <div style='width: 20px; vertical-align: center'><i class='fas fa-times' style='color: red;'></i></div>{$a->getRow()}
                                        </div>";
                                }
                            }

                            // COMPARE
                            if ($type === "compare"){
                                $stmt4 = $conn->prepare("SELECT * FROM drag where question_id=?");
                                $stmt4->execute([$_REQUEST["id"]]);
                                $drag = $stmt4->fetchAll(PDO::FETCH_CLASS, "Drag");
                                echo "
                                <div class='container'>
                                    <div class='row'>
                                        <div class='col'>
                                            <ul style='color: white'>";
                                                foreach ($drag as $d){
                                                    $t1 = $d->getText1();
                                                    echo"<li>$t1</li>";
                                                }
                                                echo "
                                            </ul>
                                        </div>
                                        <div class='col'>
                                            <ul style='color: white'>";
                                                foreach ($drag as $d){
                                                    $t2 = $d->getText2();
                                                    echo "<li>$t2</li>";
                                                }
                                                echo "
                                            </ul>
                                        </div>
                                    </div>
                                </div>";
                            }
                            echo "</div></div></div>";
                        }
                    } else {
                        echo "<h1>Question not found</h1>";
                    }
                }

                if($type !== "draw") {
                    $rightTitle = ($type === "math" || $type === "short") ? "Change right answer" : "Add new answer";

                    echo"<div id='newAnswerFormWrapper'>
                            <h1 style='text-align: center; color: white;'>$rightTitle</h1>
                            <form method='GET' action='backend/controller_answer.php' id='formToSend2' enctype='multipart/form-data' style='display: contents' class='newAnswerForm'>
                                <input style='display: none' name='type' type='text' value='new_answer' class='form-control'>
                                <input style='display: none' name='question_id' type='text' value='$q_ID' class='form-control'>";

                    // MULTI
                    if($type === "multi" && $correctExist==0) {
                        echo "
                            <div class='mb-3'>                            
                                <input type='text' id='ans' class='form-control' name='answer' placeholder='Type your answer' required autofocus style='margin: 0'>
                            </div>
                            <div class='mb-3'>
                                <label for='correct' class='form-label' style='color: white'>Is the answer correct ?</label>
                                <select class='form-select' id='correct' name='correct' style='width: 340px'>
                                    <option value='1'>Yes</option>
                                    <option value='0'>No</option>
                                </select>
                            </div>
                            <input style='display: none' name='latex' id='latex' type='text' value='' class='form-control'>
                            <div style='display: none;' id='mathfield' smart-mode></div>
                            <input style='display: none' name='q_type' type='text' value='multi' class='form-control'>";
                    }
                    elseif ($type === "multi" && $correctExist != 0) {
                        echo "<div class='mb-3'>
                                <input type='text' id='ans' class='form-control' name='answer' placeholder='Answer' required autofocus>
                                <input style='display: none' name='correct' type='text' value='0' class='form-control'>
                                <input style='display: none' name='latex' id='latex' type='text' value='' class='form-control'>
                                <div style='display: none;' id='mathfield' smart-mode></div>
                                <input style='display: none' name='q_type' type='text' value='multi' class='form-control'></div>";
                    }
                    // SHORT
                    elseif ($type === "short"){
                        echo "
                            <input type='text' id='ans' class='form-control' name='answer' placeholder='Answer' required autofocus>
                            <input style='display: none' name='latex' id='latex' type='text' value='' class='form-control'>
                            <div style='display: none;' id='mathfield' smart-mode></div>
                            <input style='display: none' name='q_type' type='text' value='short' class='form-control'>";
                    }
                    // MATH
                    elseif ($type === "math") {
                        if ($answers) {
                            $ttt = $answers[0]->getText();
                        } else {
                            $ttt = "Žiadna odpoveď neexistuje";
                        }
                        echo "
                            <div class='mb-3' style='margin-top: 20px;'>
                                <div class='mathField' id='mathfield' smart-mode></div>
                                <input style='display: none' name='latex' id='latex' type='text' value='' class='form-control'>
                                <input style='display: none' name='correct' type='text' value='1' class='form-control'>
                                <input style='display: none' name='q_type' type='text' value='math' class='form-control'>
                            </div>";
                    }
                    // COMPARE
                    elseif ($type == "compare") {
                        echo"
                            <div class='mb-3'>
                                <label for='text1' class='form-label' style='color: white'>Text 1</label>
                                <input name='text1' id='text1' type='text' value='' class='form-control'>
                            </div>
                            <div class='mb-3'>
                                <label for='text2' class='form-label' style='color: white'>Text 2</label>
                                <input name='text2' id='text2' type='text' value='' class='form-control'>
                            </div>                        
                                <input style='display: none' name='correct' type='text' value='1' class='form-control'>
                                <input style='display: none' name='q_type' type='text' value='compare' class='form-control'>
                                <div style='display: none;' id='mathfield' smart-mode>
                            </div>";
                    }
                    echo "  <input type='submit' class='btn btn-grad grow' value='Add' style='box-shadow: none; width: 100px; text-transform: none;'></form>";
                }?>
            </div>
        </div>
    

        <script>
            let element = MathLive.makeMathField(document.querySelector('div[id="mathfield"]'),  {
                virtualKeyboardMode: "manual",
                virtualKeyboards: 'numeric functions symbols roman greek',
                smartMode: true
            });
            $("#formToSend2").submit(function(e) {
                e.preventDefault(); // avoid to execute the actual submit of the form.
                if(element.getValue("latex")){
                    document.getElementById("latex").value = element.getValue("latex");
                }
                let form = $(this);
                let url = form.attr('action');

                $.ajax({
                    type: "GET",
                    url: url,
                    data: form.serialize(), // serialize the form's elements.
                    success: function(data) {
                        console.log(data);
                        console.log("success");
                        location.reload();
                        //window.location.href = data;
                    }
                });
            });
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
        <?php include_once "footer.html"?>
    </body>
</html>