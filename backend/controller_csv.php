<?php
require_once "classes/Database.php";
require_once "classes/Exam.php";


$test_code = $_REQUEST["tCode"];

$conn = (new Database())->getConnection();
$findExams = $conn->prepare("SELECT * FROM test WHERE test_code=? AND isActive=2");
$findExams->execute([$test_code]);
$foundExams = $findExams->fetchAll(PDO::FETCH_CLASS, "Exam");

$csv = array(
    array("studentID","studentName","studentSurname","examResult")
);

foreach ($foundExams as $exam){
    $studentID = $exam->getStudentId();
    $studentFullName = $exam->getStudentName();
    $result = $exam->getResult();
    $tmp = explode(" ",$studentFullName);
    if (count($tmp) == 3){
        $studentName = $tmp[0]." ".$tmp[1];
        $studentSurname = $tmp[2];
    }
    elseif (count($tmp) < 2){
        $studentName = $tmp[0];
        $studentSurname = "NULL";
    }
    else{
        $studentName = $tmp[0];
        $studentSurname = $tmp[1];
    }
    array_push($csv,array($studentID,$studentName,$studentSurname,$result));
}





function array_to_csv_download($array, $filename = "export.csv", $delimiter=";") {
    header('Content-Type: application/csv');
    header('Content-Disposition: attachment; filename="'.$filename.'";');

    // open the "output" stream
    // see http://www.php.net/manual/en/wrappers.php.php#refsect2-wrappers.php-unknown-unknown-unknown-descriptioq
    $f = fopen('php://output', 'w');

    foreach ($array as $line) {
        fputcsv($f, $line, $delimiter);
    }
}


array_to_csv_download($csv,$test_code.".csv",",");