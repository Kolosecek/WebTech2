<?php
require_once "backend/classes/Database.php";
require_once "backend/classes/Ucitel.php";
require_once "backend/classes/Exam.php";
require_once "backend/classes/Question.php";

session_start();

if(!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] !== true)
{
    header("location: index.php");
    exit;
}

$conn = (new Database())->getConnection();
$id = $_REQUEST["id"];

//$test = $conn->prepare("UPDATE test SET isActive=1 WHERE id=?");
//$test->execute([$id]);

$stmt = $conn->prepare("SELECT * FROM test where id=?");
$stmt->execute([$id]);
$exam = $stmt->fetchAll(PDO::FETCH_CLASS, "Exam");

$stmt = $conn->prepare("SELECT * FROM otazka where test_id=?");
$stmt->execute([$id]);
$questions = $stmt->fetchAll(PDO::FETCH_CLASS, "Question");
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Exam - teacher rating</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <link href='https://use.fontawesome.com/releases/v5.8.1/css/all.css'>
    </head>


    <body>

        <?php
            echo Exam::showExamToTeacher($exam[0], $questions);
        ?>



        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="https://www.w3schools.com/lib/w3.js"></script>
        <script src='https://unpkg.com/mathlive/dist/mathlive.min.js'></script>
        <script src="javascript/canvas.js"></script>
        <script src="javascript/compare.js"></script>
        <script>
            let elements = document.querySelectorAll('div[id="mathfield"]');
            let MathElements = [];
            for (let i =0;i<elements.length;i++){
                MathElements.push(MathLive.makeMathField(elements[i],  {
                    virtualKeyboardMode: "manual",
                    virtualKeyboards: 'numeric functions symbols roman greek',
                    smartMode: true
                }))
            }

            function result(){
                let arr = [];
                let tmp = document.getElementsByTagName("input");
                for (let i = 0; i < tmp.length; i++) {
                    arr.push(tmp[i]);
                }
                //console.log(arr);
                for (let i = 0; i < arr.length; i++) {
                    let test_id = document.getElementById("test_id").innerHTML;
                    let url = "";
                    if (arr[i].type != "radio"){
                        url = "backend/controller_question.php?mode=result&id="+arr[i].getAttribute('ansId')+"&text="+arr[i].value+"&test_id="+test_id;
                        $.ajax({
                            type: "GET",
                            url: url,
                            success: function(data) {
                                //console.log(data);
                            }
                        });
                    }

                    else if (arr[i].type == "radio" && arr[i].checked == true){
                        url = "backend/controller_question.php?mode=result&id="+arr[i].getAttribute('ansId')+"&text="+arr[i].value+"&test_id="+test_id;
                        $.ajax({
                            type: "GET",
                            url: url,
                            success: function(data) {
                                //console.log(data);
                            }
                        });
                    }
                }

                for (let i = 0; i < MathElements.length; i++) {
                    let test_id = document.getElementById("test_id").innerHTML;
                    let url = "backend/controller_question.php?mode=result&id="+MathElements[i].element.getAttribute('ansId')+"&text="+MathElements[i].getValue('latex')+"&test_id="+test_id;
                    $.ajax({
                        type: "GET",
                        url: url,
                        success: function(data) {
                            //console.log(data);
                        }
                    });
                }

            }
        </script>
    </body>
</html>
