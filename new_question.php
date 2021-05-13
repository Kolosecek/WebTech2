<?php
require_once "backend/classes/Database.php";
require_once "backend/classes/Ucitel.php";
require_once "backend/classes/Exam.php";

session_start();

if(!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] !== true) {
    header("location: index.php");
    exit;
}

?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Online Exam - Create new question</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <link href='https://use.fontawesome.com/releases/v5.8.1/css/all.css'>
        <link rel="stylesheet" href="styles.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://www.w3schools.com/lib/w3.js"></script>
        <script src="https://kit.fontawesome.com/e73d803768.js" crossorigin="anonymous"></script>
    </head>


    <body onload="init()">
        <?php include_once "header.html" ?>
        <div class="exams_content">
            <img src="graphic.png" alt="" id="bg_blurred">
            <div class="table_wrapper">
                <h1 style="font-family: 'Asap', sans-serif; text-align: center">Add a new question</h1>
                <hr style="width: 90%; height: 2px; background-color: black !important;">

                <form method="GET" action="backend/controller_question.php" id="formToSend3" enctype="multipart/form-data">
                    <input style="display: none" name="mode" type="text" value="new_question" class="form-control">
                    <?php
                        $email = $_SESSION["email"];
                        echo"<input style='display: none' name='email' type='text' value=$email class='form-control'>";
                        $conn = (new Database())->getConnection();
                        $stmt = $conn->prepare("SELECT * FROM test WHERE isActive=0");
                        $stmt->execute();
                        $tests = $stmt->fetchAll(PDO::FETCH_CLASS, "Exam");
                    ?>

                    <div class='mb-3'>
                        <label for='exams' class='form-label'>Choose the exam</label>
                        <select class='form-select input' id='exams' name='exam'>

                        <?php
                            foreach ($tests as $t) {
                                $tID = $t->getId();
                                $tTitle = $t->getTitle();
                                echo"<option value=$tID>$tTitle</option>";
                            }
                        ?>

                        <option value='0'>Template Question</option>";
                        </select>
                    </div>

                    <div class='mb-3'>
                        <label for="type" class="form-label">Choose the type of question</label>
                        <select class="form-select input" id="type" name="type">
                            <option value="short">Short</option>
                            <option value="multi">Multi</option>
                            <option value="compare">Compare</option>
                            <option value="draw">Draw</option>
                            <option value="math">Math</option>
                        </select>
                    </div>

                    <div class='mb-3'>
                        <label for="question" class="form-label">Question</label>
                        <textarea type="text-field" id="question" class="form-control input" name="question" placeholder="Question" autofocus rows="3"></textarea>
                    </div>

                    <div class='mb-3'>
                        <div id="short-question">
                            <label for="shortAns" class="form-label">Answer</label>
                            <input type="text" id="shortAns" class="form-control input" name="shortAns" placeholder="Answer" autofocus>
                        </div>
                    </div>

                    <div id="multi-question" style="display:none;"></div>


                    <div class="container" id="compare-question" style="display:none;">
<!--                        <div class="row">-->
<!--                            <div class="col">-->
<!--                                <ul>-->
<!--                                    <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 1</li>-->
<!--                                </ul>-->
<!--                            </div>-->
<!--                            <div class="col"> <ul id="sortable">-->
<!--                                    <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 1</li>-->
<!--                                </ul>-->
<!--                            </div>-->
<!--                        </div>-->
                    </div>


                    <div id="draw-question" style="display:none;">
<!--                        <canvas id="canvas" width="400" height="400" style="border:2px solid;"></canvas>-->
<!--                        <div>Choose Color</div>-->
<!--                        <div id="green" style="width:10px;height:10px;background:green;" onclick="switchColor(this)"></div>-->
<!--                        <div id="blue" style="width:10px;height:10px; background:blue;" onclick="switchColor(this)"></div>-->
<!--                        <div id="red" style="width:10px;height:10px; background:red;" onclick="switchColor(this)"></div>-->
<!--                        <div id="yellow" style="width:10px;height:10px; background:yellow;" onclick="switchColor(this)"></div>-->
<!--                        <div id="orange" style="width:10px;height:10px; background:orange;" onclick="switchColor(this)"></div>-->
<!--                        <div id="black" style="width:10px;height:10px; background:black;" onclick="switchColor(this)"></div>-->
<!--                        <div>Eraser</div>-->
<!--                        <div id="white" onclick="switchColor(this)"></div>-->
<!--                        <img id="canvasimg" style="display:none;">-->
<!--                        <input type="button" value="clear" id="clr" size="23" onclick="erase()">-->
<!--                        <button type='button' tID='$tId' qID='$qId'>Save drawing</button>-->
<!--                        <img src='' tID='$tId' qID='$qId' alt=''>-->
                    </div>

                    <div id="math-question" style="display:none;">
                        <div style="font-size: 32px; padding: 8px; border-radius: 8px; border: 1px solid rgba(0, 0, 0, .3); box-shadow: 0 0 8px rgba(0, 0, 0, .2);" id="mathfield" smart-mode>
                        </div>
                        <input style="visibility: hidden" name="latex" id="latex" type="text" class="form-control">
                    </div>

                    <input type="submit" class='btn btn-grad grow' value="Add" style="width: 100px; text-transform: none;">
                </form>
            </div>
        </div>
        <?php include_once "footer.html" ?>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="https://www.w3schools.com/lib/w3.js"></script>
        <script src='https://unpkg.com/mathlive/dist/mathlive.min.js'></script>
        <script src="javascript/new_question.js"></script>
        <script src="javascript/canvas.js"></script>
        <script src="javascript/compare.js"></script>
    </body>
</html>