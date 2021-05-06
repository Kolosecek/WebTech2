<?php
require_once "backend/classes/Database.php";
require_once "backend/classes/Ucitel.php";
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
$email = $_SESSION["email"];
$stmt = $conn->prepare("SELECT * FROM ucitel WHERE email=?");
$stmt->execute([$email]);
$result = $stmt->fetchAll(PDO::FETCH_CLASS, "Ucitel");

?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
        <link href='https://use.fontawesome.com/releases/v5.8.1/css/all.css'>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://www.w3schools.com/lib/w3.js"></script>
    </head>


    <body>
        <h1>Exam</h1>
        <a class="btn btn-primary" href="exams.php">List of Exams</a>
        <a class="btn btn-primary" href="profile.php">Profile</a>

        <?php
        if(isset($_REQUEST["id"]))
        {
            $conn = (new Database())->getConnection();
            $stmt = $conn->prepare("SELECT * FROM test where id=?");
            $stmt->execute([$_REQUEST["id"]]);
            $test = $stmt->fetchAll(PDO::FETCH_CLASS, "Exam");
            if($test)
            {
                foreach ($test as $t)
                {
                    $title = $t->getTitle();
                    $time = $t->getTime();
                    $ID = $t->getId();
                    $code = $t->getTestCode();
                    echo "<h1>$title</h1>
                          <p>$code</p>
                          <p>$time</p>";
                }
                $conn = (new Database())->getConnection();
                $stmt = $conn->prepare("SELECT * FROM otazka WHERE test_id=?");
                $stmt->execute([$ID]);
                $questions = $stmt->fetchAll(PDO::FETCH_CLASS, "Question");

                echo"<h2>Exam Questions</h2><div>";
                foreach ($questions as $q)
                {
                    echo $q->getRow();
                }
                echo"</div>";
            }
            else
                echo "<h1>Exam not found</h1>";
        }
        $stmt2 = $conn->prepare("SELECT * FROM otazka WHERE test_id=? AND ucitel_email=?");
        $stmt2->execute([$_REQUEST["id"],$email]);
        $qTest = $stmt2->fetchAll(PDO::FETCH_CLASS, "Question");
        ?>

        <h1 class="h3 mb-3 fw-normal">Exam questions</h1>

        <table class="table">
            <thead>
            <th scope="col">#</th>
            <th scope="col">Question</th>
            <th scope="col">Type</th>
            <th scope="col">Test ID</th>
            <th scope="col"></th>
            </thead>

            <tbody>
            <?php
            foreach ($qTest as $q2)
            {
                echo $q2->getTableRowTest();
            }
            ?>
            </tbody>
        </table>

        <form method="GET" action="backend/controller_exam.php" id="formToSend2" enctype="multipart/form-data">
            <h1 class="h3 mb-3 fw-normal">Add question to exam</h1>
            <input style="display: none" name="type" type="text" value="new_question_to_exam" class="form-control">
            <input style="display: none" name="testId" type="testId" value='<?php echo $_REQUEST["id"]?>' class="form-control">

            <label for="type" class="form-label">Choose the question to add</label>
            <select class="form-select" id="question_add" name="question_add">
            <?php
            $email = $_SESSION["email"];
            $stmt = $conn->prepare("SELECT * FROM otazka WHERE test_id IS NULL AND ucitel_email=?");
            $stmt->execute([$email]);
            $result = $stmt->fetchAll();
            foreach ($result as $r)
            {
                echo  '<option value="'.$r["id"]. '">'.$r["question"] . "</short>";
            }
            ?>
            </select>
            <input type="submit" value="Add this question to exam" class="btn btn-primary">
        </form>

    </body>
    <script src="javascript/new_exam.js"></script>
</html>