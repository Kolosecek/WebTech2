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


<table class="table table-bordered">
<?php

//header("Content-type:application/pdf");

use Dompdf\Dompdf;
use Dompdf\Options;

if (isset($_GET['code'])) {
    $dompdf = new Dompdf();
    $options = new Options();
    $options->setIsHtml5ParserEnabled( true );
    $dompdf->setOptions($options);
    
    $html = file_get_contents("https://wt49.fei.stuba.sk/skuska/exam_results2.php?code=" . $_GET['code']);
    //$html = str_replace(' ', '&nbsp;', $html);
    $html = preg_replace('/>\s+</', '><', $html);
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'landscape');
    $dompdf->render();
    ob_end_clean();
    $dompdf->stream();
}



?>
</table>

</body>
</html>

