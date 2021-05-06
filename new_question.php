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

//$db = new Database();
//$conn = $db->getConnection();
//$email = $_SESSION["email"];
//$name = "";
//$surname = "";
//
//$stmt = $conn->prepare("SELECT * FROM ucitel WHERE email=?");
//$stmt->execute([$email]);
//$result = $stmt->fetchAll(PDO::FETCH_CLASS, "Ucitel");
//
//$name = $result[0]->getName();
//$surname = $result[0]->getSurname();
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


    <body onload="init()">
        <h1>Add a new question</h1>
        <a class="btn btn-primary" href="questions.php">List of already existing questions</a>
        <a class="btn btn-primary" href="profile.php">Profile</a>

        <form method="GET" action="backend/controller_question.php" id="formToSend2" enctype="multipart/form-data">
            <h1 class="h3 mb-3 fw-normal">Connect to exam</h1>
            <input style="display: none" name="mode" type="text" value="new_question" class="form-control">
            <?php
            $email =$_SESSION["email"];
            echo"<input style='display: none' name='email' type='text' value=$email class='form-control'>";
            $conn = (new Database())->getConnection();
            $stmt = $conn->prepare("SELECT * FROM test");
            $stmt->execute();
            $tests = $stmt->fetchAll(PDO::FETCH_CLASS, "Exam");
            echo"<label for='exams' class='form-label'>Choose the exam</label><select class='form-select' id='exams' name='exam'>";
            foreach ($tests as $t){
                $tID = $t->getId();
                $tTitle = $t->getTitle();
                echo"<option value=$tID>$tTitle</option>";
            }
            echo"<option value='0'>Template Question</option>";
            echo"</select>";
            ?>
            <label for="type" class="form-label">Choose the type of question</label>
            <select class="form-select" id="type" name="type">
                <option value="short">Short</option>
                <option value="multi">Multi</option>
                <option value="compare">Compare</option>
                <option value="draw">Draw</option>
                <option value="math">Math</option>
            </select>
            <label for="question">Question</label>
            <input type="text" id="question" class="form-control" name="question" placeholder="Question" required autofocus>
            <div id="short-question">
                <label for="shortAns">Answer</label>
                <input type="text" id="shortAns" class="form-control" name="shortAns" placeholder="Answer" autofocus>
            </div>
            <div id="multi-question" style="display:none;">multi question</div>
            <div id="compare-question" style="display:none;">compare question</div>
            <div id="draw-question" style="display:none;">
                <canvas id="canvas" width="400" height="400" style="border:2px solid;"></canvas>
                <div>Choose Color</div>
                <div id="green" style="width:10px;height:10px;background:green;" onclick="switchColor(this)"></div>
                <div id="blue" style="width:10px;height:10px; background:blue;" onclick="switchColor(this)"></div>
                <div id="red" style="width:10px;height:10px; background:red;" onclick="switchColor(this)"></div>
                <div id="yellow" style="width:10px;height:10px; background:yellow;" onclick="switchColor(this)"></div>
                <div id="orange" style="width:10px;height:10px; background:orange;" onclick="switchColor(this)"></div>
                <div id="black" style="width:10px;height:10px; background:black;" onclick="switchColor(this)"></div>
                <div>Eraser</div>
                <div id="white" onclick="switchColor(this)"></div>
                <img id="canvasimg" style="display:none;">
                <input type="button" value="clear" id="clr" size="23" onclick="erase()">
                <button type="button" onclick="saveDrawing()">Save drawing</button>
            </div>
            <div id="math-question" style="display:none;">
                <div style="font-size: 32px; margin: 3em; padding: 8px; border-radius: 8px; border: 1px solid rgba(0, 0, 0, .3); box-shadow: 0 0 8px rgba(0, 0, 0, .2);" id="mathfield" smart-mode>
                </div>
                <input style="display: none" name="latex" id="latex" type="text" value="" class="form-control">
            </div>

            <input type="submit" value="add new question" class="btn btn-primary">
        </form>

    </body>
    <script src="javascript/new_question.js"></script>
    <script src='https://unpkg.com/mathlive/dist/mathlive.min.js'></script>
    <script src="javascript/canvas.js"></script>
    <script>
        var element = MathLive.makeMathField(document.getElementById('mathfield'),  {
            virtualKeyboardMode: "manual",
            virtualKeyboards: 'numeric functions symbols roman greek',
            smartMode: true
        });
        $("#formToSend2").submit(function(e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
            let latex = document.getElementById('latex').value = element.getValue("latex");
            let form = $(this);
            let url = form.attr('action');

            $.ajax({
                type: "GET",
                url: url,
                data: form.serialize(), // serializes the form's elements.
                success: function(data) {
                    console.log(data);
                    //window.location.href = data;
                }
            });
        });
    </script>
</html>