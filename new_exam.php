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

$db = new Database();
$conn = $db->getConnection();
$email = $_SESSION["email"];
$id = "";

$stmt = $conn->prepare("SELECT * FROM ucitel WHERE email=?");
$stmt->execute([$email]);
$result = $stmt->fetchAll(PDO::FETCH_CLASS, "Ucitel");
$id = $result[0]->getId();

?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Online Exam - Create new exam</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <link href='https://use.fontawesome.com/releases/v5.8.1/css/all.css'>
        <link rel="stylesheet" href="styles.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://www.w3schools.com/lib/w3.js"></script>
        <script src='https://unpkg.com/mathlive/dist/mathlive.min.js'></script>
        <script src="https://kit.fontawesome.com/e73d803768.js" crossorigin="anonymous"></script>
    </head>

    <body>
        <?php include_once "header.html" ?>
        <div class="exams_content">
            <img src="graphic.png" alt="" id="bg_blurred">
            <div class="table_wrapper">
                <h1 style="font-family: 'Asap', sans-serif; text-align: center">Add a new exam</h1>
                <hr style="width: 90%; height: 2px; background-color: black !important;">

                <form method="GET" action="backend/controller_exam.php" id="formToSend3" enctype="multipart/form-data">
                    <input style="display: none" name="type" type="text" value="new_exam" class="form-control">
                    <?php
                    echo "<input style='display: none' name='creator' type='text' value=$id class='form-control'>";
                    ?>
                    <div class='mb-3'>
                        <label for="title">Title</label>
                        <input type="text" id="title" class="form-control" name="title" placeholder="Exam Title" required autofocus>
                    </div>
                    <div class='mb-3'>
                        <label for="time" class="form-label">Length</label>
                        <input type="time" id="time" name="time" required><br>
                    </div>

                    <h4 style="font-family: 'Asap', sans-serif; text-align: center">Choose templates questions</h4>

                    <div id="temp_quest_wrapper">
                        <?php
                            $stmt = $conn->prepare("SELECT * FROM otazka WHERE test_id IS NULL");
                            $stmt->execute();
                            $result = $stmt->fetchAll();

                            foreach ($result as $index => $question) {
                                $number = $index + 1;
                                $id = $question["id"];
                                if ($question["type"] == "math") {
                                    echo "<div class='mb-3' style='display: flex; align-items: center'>
                                            <input type='checkbox' name='questions[]' value='$id' style='width: 20px; height: 20px; margin-right: 10px '>
                                            <label style='display: flex;align-items: center;'>{$number}. Otázka: <math-field read-only style='pointer-events: none;color:  black; margin-left: 3px'>{$question["question"]}</math-field></label><br>
                                          </div>";
                                } else {
                                    echo "<div class='mb-3' style='display: flex; align-items: center'>
                                            <input type='checkbox' name='questions[]' value='$id' style='width: 20px; height: 20px; margin-right: 10px '>
                                            <label>{$number}. Otázka: {$question["question"]}</label><br>
                                          </div>";
                                }
                            }
                        ?>
                    </div>

                    <input type="submit" class='btn btn-grad grow' value="Add" style="width: 100px; text-transform: none;">
                </form>
            </div>
        </div>
    </body>
    <script src="javascript/new_exam.js"></script>
</html>