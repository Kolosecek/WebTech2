<?php
require_once "backend/classes/Database.php";
require_once "backend/classes/Question.php";
require_once "backend/classes/Exam.php";
require_once "backend/classes/Answer.php";

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

<a class="btn btn-primary" href="questions.php">List of questions</a>
<a class="btn btn-primary" href="profile.php">Profile</a>
<button class="btn btn-primary">List of already existing exams</button>


<?php
if(isset($_REQUEST["id"])){
    $q_ID = $_REQUEST["id"];
    $conn = (new Database())->getConnection();
    $stmt = $conn->prepare("SELECT * FROM otazka where id=?");
    $stmt->execute([$_REQUEST["id"]]);
    $question = $stmt->fetchAll(PDO::FETCH_CLASS, "Question");
    if($question){
        foreach ($question as $t){
            $question = $t->getQuestion();
            $type = $t->getType();
            $ID = $t->getId();
            echo "<h1>$question</h1>
                  <p>$type</p>";
        }
        $stmt2 = $conn->prepare("SELECT * FROM odpoved WHERE question_id=?");
        $stmt2->execute([$ID]);
        $answers = $stmt2->fetchAll(PDO::FETCH_CLASS, "Answer");

        echo"<h1>Question answers</h1><div>";
        foreach ($answers as $a){
            echo $a->getRow();
        }
        echo"</div>";
    }
    else
        echo "<h1>Question not found</h1>";
}
?>
<h1>Add new answer</h1>
<form method="GET" action="backend/controller_answer.php" id="formToSend2" enctype="multipart/form-data">
    <input style="display: none" name="type" type="text" value="new_answer" class="form-control">
    <?php
    echo"<input style='display: none' name='question_id' type='text' value='$q_ID' class='form-control'>";
    ?>
    <label for="ans">Answer</label>
    <input type="text" id="ans" class="form-control" name="answer" placeholder="Question" required autofocus>
    <label for="correct" class="form-label">Is the answer correct ?</label>
    <select class="form-select" id="correct" name="correct">
        <option value="1">Yes</option>
        <option value="0">No</option>
    </select>
    <input type="submit" value="add new question" class="btn btn-primary">
</form>

</body>
<script src="javascript/new_answer.js"></script>
</html>