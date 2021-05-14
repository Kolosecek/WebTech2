<?php

require_once "backend/classes/Database.php";
require_once "backend/classes/Exam.php";
require_once "backend/classes/Answer.php";
require_once "backend/classes/Question.php";
require_once "backend/classes/Odpoved_student.php";

require 'vendor/autoload.php';

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
    <style>
        *{ font-family: DejaVu Sans; font-size: 12px !important;}
    </style>
</head>
<body>

<?php

use mikehaertl\wkhtmlto\Pdf;

if (isset($_GET['code'])) {
    $pdf = new Pdf;
    $pdf->addPage('https://wt49.fei.stuba.sk/skuska/exam_results.php?code=' . $_GET['code']);
    
    ob_end_clean();
    if (!$pdf->send('exam_' . $_GET['code'] . 'pdf', false, array('Content-Length' => false,) )) {
        $error = $pdf->getError();
        echo $error;
    }
}



?>
</table>

</body>
</html>

