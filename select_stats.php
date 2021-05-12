<?php 
require_once "backend/classes/Database.php";
require_once "backend/classes/Exam.php";
require_once "backend/classes/Question.php";

session_start();

if(!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] !== true)
{
    header("location: index.php");
    exit;
}

$db = new Database();
$conn = $db->getConnection();
$stmt = $conn->prepare("SELECT * FROM test WHERE student_name IS NOT NULL AND student_id IS NOT NULL AND result IS NOT NULL");
$stmt->execute();
$tests = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    <label for="tests">Choose a test:</label>

    <select name="tests" id="tests">
        <?php 
            foreach ($tests as $test) {
                echo "<option value=" . $test['test_code'] . ">" . $test['title'] . ' (' . $test['test_code'] . ")</option>";
            }
        ?>
    </select>
    <button id="submit-pdf-btn">Get PDF</button>
    <div id="result"></div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="javascript/select_stats.js"></script>
</body>
</html>