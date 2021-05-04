<?php
require_once "backend/classes/Database.php";
require_once "backend/classes/Ucitel.php";
require_once "backend/classes/Exam.php";

session_start();
if(!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] !== true) {
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
<body>
<h1>Add a new question</h1>
<a class="btn btn-primary" href="new_exam.php">Create new exam</a>
<a class="btn btn-primary" href="profile.php">Profile</a>
<a class="btn btn-primary" href="exams.php">List of already existing exams</a>

<form method="GET" action="backend/controller_question.php" id="formToSend2" enctype="multipart/form-data">
    <h1 class="h3 mb-3 fw-normal">Connect to exam</h1>
    <input style="display: none" name="mode" type="text" value="new_question" class="form-control">
    <?php
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
    <label for="question">Question</label>
    <input type="text" id="question" class="form-control" name="question" placeholder="Question" required autofocus>
    <label for="type" class="form-label">Choose the type of question</label>
    <select class="form-select" id="type" name="type">
        <option value="short">Short</option>
        <option value="multi">Multi</option>
        <option value="compare">Compare</option>
        <option value="draw">Draw</option>
        <option value="math">Math</option>
    </select>
    <div id="short-question">short question</div>
    <div id="multi-question" style="display:none;">multi question</div>
    <div id="compare-question" style="display:none;">compare question</div>
    <div id="draw-question" style="display:none;">draw question</div>
    <div id="math-question" style="display:none;">math question</div>
    
    <input type="submit" value="add new question" class="btn btn-primary">
</form>

</body>
<script src="javascript/new_question.js"></script>
</html>