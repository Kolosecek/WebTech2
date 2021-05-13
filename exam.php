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
        <title>Online Exam - Exam detail</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <link rel="stylesheet" href="styles.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
        <link href='https://use.fontawesome.com/releases/v5.8.1/css/all.css'>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://www.w3schools.com/lib/w3.js"></script>
        <script src='https://unpkg.com/mathlive/dist/mathlive.min.js'></script>
        <script src="https://kit.fontawesome.com/e73d803768.js" crossorigin="anonymous"></script>
    </head>

    <body>
    <?php include_once "header.html" ?>
        <div class="exams_content">
            <img src="graphic.png" alt="" id="bg_blurred">
            <h1 style="font-family: 'Asap', sans-serif">Exam detail</h1>
            <hr style="width: 50%; height: 2px; background-color: black !important;">
            <div style="display: flex; flex-direction: row; justify-content: center; width: 30%">
                <a class="btn exams_btn grow" href="exams.php"><i class="fas fa-arrow-circle-left fa-lg"></i> Back to all exams</a>
            </div>

                <?php
                if(isset($_REQUEST["id"])) {
                    $conn = (new Database())->getConnection();
                    $stmt = $conn->prepare("SELECT * FROM test where id=?");
                    $stmt->execute([$_REQUEST["id"]]);
                    $test = $stmt->fetchAll(PDO::FETCH_CLASS, "Exam");
                    if($test) {
                        foreach ($test as $t) {
                            $title = $t->getTitle();
                            $time = $t->getTime();
                            $ID = $t->getId();
                            $code = $t->getTestCode();
                            echo "<div id='examInfoWrapper' style='width: 38%;'>
                                      <h1 class='exam_name'>Name: $title</h1>
                                      <span class='exam_info'><i class='fas fa-hashtag'></i> ID: $ID</span>
                                      <span class='exam_info'><i class='fas fa-key'></i> Code: $code</span>
                                      <span class='exam_info'><i class='far fa-clock'></i> Time: $time h.</span>
                                  </div>
                                  ";
                        }
                        $conn = (new Database())->getConnection();
                        $stmt = $conn->prepare("SELECT * FROM otazka WHERE test_id=?");
                        $stmt->execute([$ID]);
                        $questions = $stmt->fetchAll(PDO::FETCH_CLASS, "Question");
                    } else {
                        echo "<h1>Exam not found</h1>";
                    }
                }
                $stmt2 = $conn->prepare("SELECT * FROM otazka WHERE test_id=? AND ucitel_email=?");
                $stmt2->execute([$_REQUEST["id"],$email]);
                $qTest = $stmt2->fetchAll(PDO::FETCH_CLASS, "Question");
                ?>


            <div class="table_wrapper" style="margin-top: 50px">
                <h1 class="h3 mb-3 fw-normal" style="font-family: 'Asap', sans-serif;">Exam questions</h1>
                <table class="table">
                    <thead>
                        <th scope="col">#</th>
                        <th scope="col">Question</th>
                        <th scope="col">Type</th>
                        <th scope="col">Test ID</th>
                        <th scope="col">Detail</th>
                    </thead>

                    <tbody>
                        <?php foreach ($qTest as $q2) {
                            echo $q2->getTableRowTest();
                        }?>
                    </tbody>
                </table>
            </div>

            <div class="table_wrapper" style="margin-top: 50px;">
                <form method="GET" action="backend/controller_exam.php" id="formToSend2" enctype="multipart/form-data" style="display: contents">
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
                        foreach ($result as $r) {
                            if ($r["type"] != "math") {
                                echo  "<option value='{$r["id"]}'>{$r["question"]}</short></option>";
                            } else {
                                echo  "<option value='{$r["id"]}'><math-field read-only style='pointer-events: none; color: black;'>{$r["question"]}</math-field></short></option>";
                            }
                        }?>
                    </select>
                    <input type="submit" class="btn btn-grad grow" value="Add" style="width: 100px; text-transform: none; margin-top: 35px">
                </form>
            </div>
        </div>
        <?php include_once "footer.html" ?>
    </body>
    <script src="javascript/new_exam.js"></script>
</html>