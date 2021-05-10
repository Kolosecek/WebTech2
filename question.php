<?php
require_once "backend/classes/Database.php";
require_once "backend/classes/Question.php";
require_once "backend/classes/Exam.php";
require_once "backend/classes/Answer.php";
require_once "backend/classes/Drag.php";

session_start();

if(!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] !== true)
{
    header("location: index.php");
    exit;
}
$email = $_SESSION["email"];
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
    <title>Online Exam - Question detail</title>
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
<div class="exams_content">
    <img src="graphic.png" alt="" id="bg_blurred">
    <h1 style="font-family: 'Asap', sans-serif">Question detail</h1>
    <hr style="width: 50%; height: 2px; background-color: black !important;">



    <?php
    if(isset($_REQUEST["id"]))
    {
        $q_ID = $_REQUEST["id"];
        $conn = (new Database())->getConnection();
        $stmt = $conn->prepare("SELECT * FROM otazka where id=? AND ucitel_email=?");
        $stmt->execute([$_REQUEST["id"],$email]);
        $question = $stmt->fetchAll(PDO::FETCH_CLASS, "Question");
        if($question)
        {
            foreach ($question as $t)
            {
                $question = $t->getQuestion();
                $type = $t->getType();
                $ID = $t->getId();
                if ($type != "math")
                {
                    echo "<h1>$question</h1>
                              <p>Type: $type</p>";
                }
                elseif ($type == "math")
                {
                    echo"<math-field read-only style='font-size: 32px; margin: 3em; padding: 8px; border-radius: 8px; border: 1px solid rgba(0, 0, 0, .3); box-shadow: 0 0 8px rgba(0, 0, 0, .2);'>$question</math-field><p>$type</p>";
                }
            }
            $stmt2 = $conn->prepare("SELECT * FROM odpoved WHERE question_id=?");
            $stmt2->execute([$ID]);
            $answers = $stmt2->fetchAll(PDO::FETCH_CLASS, "Answer");

            if($type !="draw"){
                echo"<div id='examInfoWrapper' style='width: 40%; align-items: center; font-family: Asap'>
                             <h1 style='color: white'>Question answers</h1>
                             <div style='display: flex; flex-direction: column;'>";
                $correctExist = 0;
                foreach ($answers as $a)
                {
                    if($correctExist != 1){
                        $correctExist = $a->getCorrect();
                    }
                    if ($a->getCorrect() == 1 && $type != "compare"){
                        echo
                            "<div style='display: flex; flex-direction: row; align-items: center; color: white'>
                                               <div style='width: 20px; vertical-align: center'><i class='fas fa-check grow' style='color: #57EE01'></i></div>".
                            $a->getRow().
                            "</div>";
                    }
                    else {
                        echo
                            "<div style='display: flex; flex-direction: row; align-items: center; color: white;'>
                                               <div style='width: 20px; vertical-align: center'><i class='fas fa-times' style='color: red;'></i></div>".
                            $a->getRow().
                            "</div>";
                    }

                }
                if ($type == "compare"){
                    $stmt4 = $conn->prepare("SELECT * FROM drag where question_id=?");
                    $stmt4->execute([$_REQUEST["id"]]);
                    $drag = $stmt4->fetchAll(PDO::FETCH_CLASS, "Drag");
                    echo"<div class='container'><div class='row'><div class='col'><ul style='color: white'>";
                    foreach ($drag as $d){
                        $t1 = $d->getText1();
                        echo"<li>$t1</li>";
                    }
                    echo"</ul></div><div class='col'><ul style='color: white'>";
                    foreach ($drag as $d){
                        $t2 = $d->getText2();
                        echo"<li>$t2</li>";
                    }
                    echo"</ul></div></div></div>";
                }
                echo"</div></div>";
            }
        }
        else
            echo "<h1>Question not found</h1>";
    }

    if($type != "draw"){
        echo"<div id='newAnswerFormWrapper'>
        <h1 style='text-align: center; color: white'>Add new answer</h1>
        <form method='GET' action='backend/controller_answer.php' id='formToSend2' enctype='multipart/form-data'>
            <input style='display: none' name='type' type='text' value='new_answer' class='form-control'>";
    }
    ?>

            <div id="newAnswerFormWrapper">
                <h1 style="text-align: center; color: white">Add new answer</h1>
                <form method="GET" action="backend/controller_answer.php" id="formToSend3" enctype="multipart/form-data">
                    <input style="display: none" name="type" type="text" value="new_answer" class="form-control">
                    <?php
                    echo"<input style='display: none' name='question_id' type='text' value='$q_ID' class='form-control'>";
                    ?>
                    <input type="text" id="q_type" class="form-control" name="q_type" placeholder="Type" required autofocus value="<?php echo $type ?>" hidden>
                    <?php if($type == "multi" && $correctExist==0)
                    {
                    echo '<div class="mb-3">
                            <label for="ans" class="form-label" style="color: white">Answer</label>
                            <input type="text" id="ans" class="form-control" name="answer" placeholder="Type your answer" required autofocus style="margin: 0">
                            </div>
                          <div class="mb-3">
                            <label for="correct" class="form-label" style="color: white">Is the answer correct ?</label>
                            <select class="form-select" id="correct" name="correct" style="width: 340px">
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                          </div>
                          <input style="display: none" name="latex" id="latex" type="text" value="" class="form-control">
                          <div style="visibility: hidden;" id="mathfield" smart-mode></div>';
            }
            elseif ($type == "multi" && $correctExist!=0){
                echo '<label for="ans" class="form-label">Answer</label>
                          <input type="text" id="ans" class="form-control" name="answer" placeholder="Answer" required autofocus>
                          <input style="display: none" name="correct" type="text" value="0" class="form-control">
                          <input style="display: none" name="latex" id="latex" type="text" value="" class="form-control">
                          <div style="visibility: hidden;" id="mathfield" smart-mode></div>';
            }
            elseif ($type == "short"){
                echo '<label for="ans" class="form-label">Answer</label>
                          <input type="text" id="ans" class="form-control" name="answer" placeholder="Answer" required autofocus>
                          <input style="display: none" name="latex" id="latex" type="text" value="" class="form-control">
                          <div style="visibility: hidden;" id="mathfield" smart-mode></div>';
            }
            elseif ($type == "math"){
                if ($answers){
                    $ttt = $answers[0]->getText();
                }
                else
                    $ttt = "x=0";
                echo"<label for='rightAns'>Right Answer</label>><math-field id='rightAns' read-only style='font-size: 32px; margin: 3em; padding: 8px; border-radius: 8px; border: 1px solid rgba(0, 0, 0, .3); box-shadow: 0 0 8px rgba(0, 0, 0, .2);'>$ttt</math-field>";
                echo'
                        <label for="correct" class="form-label">Change the right answer</label>
                          <div style="font-size: 32px; margin: 3em; padding: 8px; border-radius: 8px; border: 1px solid rgba(0, 0, 0, .3); box-shadow: 0 0 8px rgba(0, 0, 0, .2);" id="mathfield" smart-mode>
                        </div>
                        <input style="display: none" name="latex" id="latex" type="text" value="" class="form-control">
                        <input style="display: none" name="correct" type="text" value="1" class="form-control">';
            }
            elseif ($type == "compare"){
                echo'
                        <label for="text1" class="form-label">Text 1</label>
                        <input name="text1" id="text1" type="text" value="" class="form-control">
                        <label for="text2" class="form-label">Text 2</label>
                        <input name="text2" id="text2" type="text" value="" class="form-control">
                        <input style="display: none" name="correct" type="text" value="1" class="form-control">';
                    }
                    else
                    {

                    }?>
                    <input type="submit" class='btn btn-grad grow' value="Add" style="box-shadow: none; width: 100px; text-transform: none;
 ">
<!--                    <input type="submit" value="Add" class="btn btn-primary">-->
                </form>
            </div>
        </div>
    </body>
    <script src="javascript/new_answer.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <script src='https://unpkg.com/mathlive/dist/mathlive.min.js'></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://www.w3schools.com/lib/w3.js"></script>
    <script>
        var element = MathLive.makeMathField(document.getElementById('mathfield'),  {
            virtualKeyboardMode: "manual",
            virtualKeyboards: 'numeric functions symbols roman greek',
            smartMode: true
        });
        $("#formToSend3").submit(function(e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
            let latex = document.getElementById('latex').value = element.getValue("latex");
            let form = $(this);
            let url = form.attr('action');

            <!--                    <input type="submit" value="Add" class="btn btn-primary">-->
        </form>
    </div>
</div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
<script src='https://unpkg.com/mathlive/dist/mathlive.min.js'></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://www.w3schools.com/lib/w3.js"></script>
<script src='https://unpkg.com/mathlive/dist/mathlive.min.js'></script>
<script>
    var element = MathLive.makeMathField(document.querySelector('div[id="mathfield"]'),  {
        virtualKeyboardMode: "manual",
        virtualKeyboards: 'numeric functions symbols roman greek',
        smartMode: true
    });
    $("#formToSend2").submit(function(e) {
        e.preventDefault(); // avoid to execute the actual submit of the form.
        if(element.getValue("latex")){
            document.getElementById("latex").value = element.getValue("latex");
        }
        else{

        }
        let form = $(this);
        let url = form.attr('action');

        $.ajax({
            type: "GET",
            url: url,
            data: form.serialize(), // rializes the form's elements.
            success: function(data) {
                console.log(data);
                //window.location.href = data;
            }
        });
    });
</script>
<script>

    var btns = document.querySelectorAll('a[ansID]');
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
                }
            });
        });
    }
</script>
</html>