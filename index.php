<?php
session_start();
$_SESSION["loggedin"] = false;

if(!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] !== true)
{
    header("location: index.php");
    exit;
}

?>


<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>WEBTE2 - Skúška</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
        <link href='https://use.fontawesome.com/releases/v5.8.1/css/all.css'>
        <link href="styles.css" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Asap&display=swap" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://www.w3schools.com/lib/w3.js"></script>
        <script src="https://kit.fontawesome.com/e73d803768.js" crossorigin="anonymous"></script>
    </head>

    <body>
        <div class="content" style="height: auto">
            <div id="illustration">
                <img src="graphic.png" alt="" style=" width: 100%;">
            </div>
            <div id="login">
                <main class="form-signin">
                    <div class="forms">
                        <form method="GET" action="backend/controller_login.php" id="formToSend" enctype="multipart/form-data">
                            <div class="inputs">
                                <img class="mb-4" src="img.png" width="72" height="62">
                                <h1 class="h3 mb-3 fw-normal">Sign in</h1>
                                <div class='mb-3'>
                                    <input style="display: none" name="type" type="text" value="login" class="form-control">
                                    <label for="inputEmail" class="visually-hidden">Email address</label>
                                    <input type="email" id="inputEmail" class="form-control" name="email" placeholder="Email address" required autofocus>
                                </div>
                                <div class='mb-3'>
                                    <input type="password" id="inputPassword" class="form-control" name="password" placeholder="Password" required>
                                    <label for="inputPassword" class="visually-hidden">Password</label>
                                </div>
                                <div class='mb-3'>
                                    <button class="w-100 btn btn-lg btn-primary grow btn-index" type="submit">Sign in</button>
                                </div>
                                <p>Don't have account? <a href="register.php">Sign up</a></p>
                            </div>
                        </form>
                    </div>
                    <hr>
                    <div class="forms">
                        <form method="GET" action="backend/controller_login.php" id="formToSend2" enctype="multipart/form-data">
                            <div class="inputs">
                                <img class="mb-4" src="img.png" width="72" height="62">

                                <h1 class="h3 mb-3 fw-normal">Connect to exam</h1>
                                <div class='mb-3'>
                                    <input style="display: none" name="type" type="text" value="login" class="form-control" required>
                                    <label for="studentName" class="visually-hidden">Student Name</label>
                                </div>
                                <div class='mb-3'>
                                    <input type="text" id="studentName" class="form-control" name="studentName" placeholder="Your Name" required autofocus>
                                    <label for="studentID" class="visually-hidden">Student ID</label>
                                </div>
                                <div class='mb-3'>
                                    <input type="text" id="studentID" class="form-control" name="studentID" placeholder="Your Student ID" required>
                                    <label for="testID" class="visually-hidden">Exam ID</label>
                                </div>
                                <div class='mb-3'>
                                    <input type="text" id="testID" class="form-control" name="testID" placeholder="Exam ID" required>
                                </div>

                                <button class="w-100 btn btn-lg btn-primary grow btn-index" type="button" onclick="redirect()">Next</button>
                            </div>
                        </form>
                    </div>
                </main>
            </div>
        </div>
        <?php include_once "footer.html" ?>
        <script src="javascript/index.js"></script>
        <script>
            function redirect(){
                let testID = document.getElementById("testID").value;
                let studentID = document.getElementById("studentID").value;
                let studentName = document.getElementById("studentName").value;

                if (testID && studentID && studentName) {
                    window.location.href= "student_exam.php?testID="+testID+"&studentID="+studentID+"&studentName="+studentName;
                }
            }
        </script>
    </body>
</html>

