<?php
require_once "backend/classes/Database.php";
require_once "backend/classes/Ucitel.php";
require_once "backend/classes/Exam.php";

session_start();

$code_test = $_REQUEST["testID"];
$studentName= $_REQUEST["studentName"];
$studentID= $_REQUEST["studentID"];

$conn = (new Database())->getConnection();

$checkDuplicate = $conn->prepare("SELECT * FROM test where test_code=? AND student_id=?");
$checkDuplicate->execute([$code_test,$studentID]);
$TestDuplicate = $checkDuplicate->fetchAll(PDO::FETCH_CLASS, "Exam");
if($TestDuplicate){

}
else{
    $stmt = $conn->prepare("SELECT * FROM test where test_code=?");
    $stmt->execute([$code_test]);
    $exam = $stmt->fetchAll(PDO::FETCH_CLASS, "Exam");
    $id = $exam[0]->duplicate($code_test,$studentName,$studentID);
}
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Exam</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <link href='https://use.fontawesome.com/releases/v5.8.1/css/all.css'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://www.w3schools.com/lib/w3.js"></script>
</head>


<body>
<h1>Exam</h1>
<?php
if ($TestDuplicate){
    echo "<h2>Študent s ID $studentID tento test už riešil.</h2>";
    echo "<a class='btn btn-primary' href='index.php'>Spať na pôvodnú stránku</a>";
}
else{
    echo '<h2>Welcome, '. $studentName .'</h2>';
    echo '<h3>To start writing exam ' . $exam[0]->getTitle().' with the code ' .$exam[0]->getTestCode() . ' click the button below</h3>';
    echo '<h3>Exam duration ' . $exam[0]->getTime().'</h3>';
    echo "<a class='btn btn-primary' href='student_active_exam.php?id=$id'>Start exam</a>";
}

?>



</body>
</html>
