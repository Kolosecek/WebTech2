<?php 
require_once "backend/classes/Database.php";
require_once "backend/classes/Exam.php";
require_once "backend/classes/Question.php";

session_start();

if(!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] !== true)
{
    header("location: index.php");
    exit;
}

$db = new Database();
$conn = $db->getConnection();
$stmt = $conn->prepare("SELECT * FROM test WHERE student_name IS NOT NULL AND student_id IS NOT NULL AND result IS NOT NULL");
$stmt->execute();
$tests = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Online Exam - Download</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <link href='https://use.fontawesome.com/releases/v5.8.1/css/all.css'>
        <link rel="stylesheet" href="styles.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://www.w3schools.com/lib/w3.js"></script>
        <script src="https://kit.fontawesome.com/e73d803768.js" crossorigin="anonymous"></script>
    </head>

    <body>
        <?php include_once "header.html"?>
        <div class="content bg-lg" style="justify-content: center; flex-direction: column; padding: 0">
            <img src="graphic.png" alt="" id="bg_blurred">
            <div id="downloadWrapper">
                <div id="downloadChoicer">
                    <button id="choose-pdf-btn" class="btn btn-grad grow">Get PDF <i class="fas fa-file-pdf fa-lg" style="color: firebrick; padding-left: 5px"></i></button>
                    <hr style="width:100% ; height: 2px; background-color: white !important;">
                </div>
                <div id="pdfDownloadWrapper" style="display: none" class="down">
                    <label for="tests" style="color: white; font-size: 20px; font-family: 'Asap', sans-serif">Choose a test:</label>
                    <select name="tests" id="tests" class="form-select form-select-sm" style="width: 30%; margin: 20px">

                        <?php
                        foreach ($tests as $test) {
                            echo "<option style='font-family:Asap' value=" . $test['test_code'] . ">" . $test['title'] . ' (' . $test['test_code'] . ")</option>";
                        }
                        ?>
                    </select>
                    <button id="submit-pdf-btn" class="btn btn-grad grow">Download</button>
                </div>
                <div id="csvDownloadWrapper" style="display: none" class="down">
                    <label for="tests" style="color: white; font-size: 20px; font-family: 'Asap', sans-serif">Choose a test:</label>
                    <select name="tests" id="tests" class="form-select form-select-sm" style="width: 30%; margin: 20px">

                        <?php
                        foreach ($tests as $test) {
                            echo "<option style='font-family:Asap' value=" . $test['test_code'] . ">" . $test['title'] . ' (' . $test['test_code'] . ")</option>";
                        }
                        ?>
                    </select>
                    <button id="submit-pdf-btn" class="btn btn-grad grow">Download</button>
                </div>

                <div id="result"></div>
            </div>
        </div>
        <?php include_once "footer.html" ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="javascript/select_stats.js"></script>
        <script>
            $( "#choose-pdf-btn" ).click(function() {
                $("#downloadChoicer").css("display","none");
                $("#pdfDownloadWrapper").css("display","flex");
            });
            $( "#choose-csv-btn" ).click(function() {
                $("#downloadChoicer").css("display","none");
                $("#csvDownloadWrapper").css("display","flex");
            });
        </script>
    </body>

</html>