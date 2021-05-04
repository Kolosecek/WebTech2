<?php
require_once "backend/classes/Database.php";
require_once "backend/classes/Ucitel.php";
require_once "backend/classes/Exam.php";

session_start();
if(!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] !== true) {
    header("location: index.php");
    exit;
}

$conn = (new Database())->getConnection();
$stmt = $conn->prepare("SELECT * FROM test");
$stmt->execute();
$tests = $stmt->fetchAll(PDO::FETCH_CLASS, "Exam");
$stmt2 = $conn->prepare("SELECT * FROM test WHERE isActive=1");
$stmt2->execute();
$testsActive = $stmt2->fetchAll(PDO::FETCH_CLASS, "Exam");

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
<h1>Your created exams</h1>
<a class="btn btn-primary" href="questions.php">List of Questions</a>
<a class="btn btn-primary" href="profile.php">Profile</a>
<button class="btn btn-primary">List of already existing exams</button>
<h1 class="h3 mb-3 fw-normal">Templates</h1>
<table class="table">
    <thead>
        <th scope="col">#</th>
        <th scope="col">Title</th>
        <th scope="col">Exam Code</th>
        <th scope="col">Length</th>
        <th scope="col"></th>
    </thead>
    <tbody>
        <?php
        foreach ($tests as $t){
            echo $t->getRow();
        }
        ?>
    </tbody>
</table>
<h1 class="h3 mb-3 fw-normal">Active Exams</h1>
<table class="table">
    <thead>
    <th scope="col">#</th>
    <th scope="col">Title</th>
    <th scope="col">Exam Code</th>
    <th scope="col">Length</th>
    <th scope="col"></th>
    </thead>
    <tbody>
    <?php
    foreach ($testsActive as $t2){
        echo $t2->getRow();
    }
    ?>
    </tbody>
</table>
<?php
if(!$testsActive)
    echo"<h1>You have no active exams</h1>";
?>
</body>
<script src="javascript/new_exam.js"></script>
</html>