<?php
require_once "backend/classes/Database.php";
require_once "backend/classes/Ucitel.php";
require_once "backend/classes/Exam.php";

session_start();
if(!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] !== true) {
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
    <title>New question</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <link href='https://use.fontawesome.com/releases/v5.8.1/css/all.css'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://www.w3schools.com/lib/w3.js"></script>
</head>
<body>
<h1>Add a new exam</h1>
<button class="btn btn-primary" onclick="newExam()">Create new exam</button>
<button class="btn btn-primary" onclick="profile()">Profile</button>
<button class="btn btn-primary">List of already existing exams</button>

<form method="GET" action="backend/controller_exam.php" id="formToSend2" enctype="multipart/form-data">
    <h1 class="h3 mb-3 fw-normal">Create new exam</h1>
    <input style="display: none" name="type" type="text" value="new_exam" class="form-control">
    <?php
    echo"<input style='display: none' name='creator' type='text' value=$id class='form-control'>";
    ?>
    <label for="title">Title</label>
    <input type="text" id="title" class="form-control" name="title" placeholder="Exam Title" required autofocus>
    <label for="time" class="form-label">Lenght</label>
    <input type="time" id="time" name="time" required>


    <input type="submit" value="Create new exam" class="btn btn-primary">
</form>

</body>
<script src="javascript/new_exam.js"></script>
</html>