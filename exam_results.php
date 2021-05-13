<?php

require_once "backend/classes/Database.php";
require_once "backend/classes/Exam.php";
require_once "backend/classes/Answer.php";
require_once "backend/classes/Question.php";
require_once "backend/classes/Odpoved_student.php";

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link type="text/css" href="bootstrap.min.css" rel="stylesheet" />
        <link type="text/css" href="download_pdf.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
        <style>
            *{ font-family: DejaVu Sans !important;}
        </style>
        <script src='https://unpkg.com/mathlive/dist/mathlive.min.js'></script>
    </head>


    <body>
        <?php try {
            if(isset($_GET['code'])) {
                $db = new Database();
                $conn = $db->getConnection();
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $stmt = $conn->prepare("SELECT * FROM test WHERE test_code = ?");
                $stmt->execute([$_GET['code']]);
                $tests = $stmt->fetchAll(PDO::FETCH_CLASS, "Exam");

                foreach($tests as $test) { //traverse all exams
                    echo "<div class='container'><table class='table table-bordered'>";
                    $stmt2 = $conn->prepare("SELECT * FROM odpoved_student WHERE test_id = ?");
                    $stmt2->execute([$test->getId()]);
                    $answers = $stmt2->fetchAll(PDO::FETCH_CLASS, "Odpoved_student");

                    echo "<caption>Student: ". $test->getStudentName() . "</caption>";
                    echo "<tr><th>Question</th><th>Answer</th></tr>";
                    foreach ($answers as $answer) {
                        $stmt3 = $conn->prepare("SELECT * FROM otazka WHERE id = ?");
                        $stmt3->execute([$answer->getQuestionId()]);
                        $question = $stmt3->fetchAll(PDO::FETCH_CLASS, "Question");
                        if($question[0]->getType() === 'math') {
                            //echo "<math-field read-only class='mathfld' style='color: white'>" . $question[0]->getQuestion() . "</math-field>";
                            echo "<tr><td><div class='mathfield' id='mf'><math-field read-only class='mathfld' style='color: black'> {$question[0]->getQuestion()}</math-field></td></div>";
                        }
                        else if($answer->getText1() === null) {
                            echo "<tr><td>" . $question[0]->getQuestion() . "</td>";
                        }
                        if ($answer->getOdpoved() !== null) {
                            echo "<td>" . $answer->getOdpoved() . "</td></tr>";
                        } else if ($answer->getImgPath() !== null) {
                            echo "<td><img width='150' height='150' alt='canvas' src=backend/" . $answer->getImgPath() . "></td></tr>";
                        } else if ($answer->getText1() !== null) {
                            echo "<td>" . $answer->getText1() . "</td>";
                            echo "<td>" . $answer->getText2() . "</td></tr>";
                        }
                    }
                    echo "</table></div>";
                }
            }
        } catch(PDOException $e) {
            echo $e->getMessage();
        }

        /*
        try {
            if(isset($_GET['code'])) {
                $db = new Database();
                $conn = $db->getConnection();
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $stmt = $conn->prepare("SELECT * FROM test WHERE test_code = ?");
                $stmt->execute([$_GET['code']]);
                $tests = $stmt->fetchAll(PDO::FETCH_CLASS, "Exam");

                foreach($tests as $test) { //traverse all exams
                    $stmt2 = $conn->prepare("SELECT * FROM odpoved_student WHERE test_id = ?");
                    $stmt2->execute([$test->getId()]);
                    $answers = $stmt2->fetchAll(PDO::FETCH_CLASS, "Odpoved_student");

                    echo "<h1>Student: ". $test->getStudentName() . "</h1><br><br>";
                    foreach ($answers as $answer) {
                        $stmt3 = $conn->prepare("SELECT * FROM otazka WHERE id = ?");
                        $stmt3->execute([$answer->getQuestionId()]);
                        $question = $stmt3->fetchAll(PDO::FETCH_CLASS, "Question");
                        if($answer->getText1() === null) {
                            echo "<h2>Question: " . $question[0]->getQuestion() . "</h2><br><br>";
                        }
                        if ($answer->getOdpoved() !== null) {
                            echo "<h2>Answer: " . $answer->getOdpoved() . "</h2><br><br>";
                        } else if ($answer->getImgPath() !== null) {
                            echo "<h2>Answer:&nbsp;<img width='150' height='150' alt='canvas' src=backend/" . $answer->getImgPath() . "></h2><br><br>";
                        } else if ($answer->getText1() !== null) {
                            echo "<h2>Question: " . $answer->getText1() . "</h2><br><br>";
                            echo "<h2>Answer: " . $answer->getText2() . "</h2><br><br>";
                        }
                    }
                }
            }
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
        */?>

        <script>
            let element = MathLive.makeMathField(document.querySelector('div[id="mathfield"]'),  {
                virtualKeyboardMode: "manual",
                virtualKeyboards: 'numeric functions symbols roman greek',
                smartMode: true
            });
        </script>
    </body>
</html>

