<?php

require_once "backend/classes/Database.php";
require_once "backend/classes/Exam.php";
require_once "backend/classes/Answer.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<table>
<?php

if(isset($_GET['code'])) {
    $db = new Database();
    $conn = $db->getConnection();
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("SELECT * FROM test WHERE test_code = ?");
    $stmt->execute([$_GET['code']]);
    $tests = $stmt->fetchAll(PDO::FETCH_CLASS, "Exam");

    foreach($tests as $test) {
        $i = 0;
        $stmt2 = $conn->prepare("SELECT * FROM odpoved_student WHERE test_id = ?");
        $stmt2->execute([$test->getId()]);
        $answers = $stmt2->fetchAll(PDO::FETCH_CLASS, "Answer");
        print_r($answers);
        if ($i === 0) {
            echo "<tr>";
            for ($j = 1; $j <= count($answers); $j++) {
                echo "<th>Otazka " . $j . "</th>";
                echo "<th>Odpoved " . $j . "</th>";
            }
            echo "</tr>";
            $i++;
        }
        echo "<tr>";
        for ($j = 1; $j <= count($answers); $j++) {
            echo "<td>" . '' . "</td>";
            echo "<td>" . '' . "</td>";
            }
        echo "</tr>";
    }


    
}

?>
</table>

</body>
</html>

