<?php
/*session_start();
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.php");
    exit;
}*/

?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Skúška123</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"
            integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js"
            integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
    <link href='https://use.fontawesome.com/releases/v5.8.1/css/all.css'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://www.w3schools.com/lib/w3.js"></script>
</head>
<body>
<main class="form-signin">
    <form method="GET" action="backend/controller_login.php" id="formToSend" enctype="multipart/form-data">
        <img class="mb-4" src="img.png" width="72" height="62">
        <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
        <input style="display: none" name="type" type="text" value="login" class="form-control">
        <label for="inputEmail" class="visually-hidden">Email address</label>
        <input type="email" id="inputEmail" class="form-control" name="email" placeholder="Email address" required autofocus>
        <label for="inputPassword" class="visually-hidden">Password</label>
        <input type="password" id="inputPassword" class="form-control" name="password" placeholder="Password" required>
        <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
        <p>Don't have account? <a href="signup.php">Sign up</a></p>
    </form>

    <form method="GET" action="backend/controller_exam.php" id="formToSend2" enctype="multipart/form-data">
        <img class="mb-4" src="img.png" width="72" height="62">
        <h1 class="h3 mb-3 fw-normal">Connect to exam</h1>
        <input style="display: none" name="type" type="text" value="login" class="form-control">
        <label for="studentName" class="visually-hidden">Student Name</label>
        <input type="text" id="studentName" class="form-control" name="name" placeholder="Your Name" required autofocus>
        <label for="studentID" class="visually-hidden">Student ID</label>
        <input type="text" id="studentID" class="form-control" name="studentID" placeholder="Your Student ID" required>
        <label for="testID" class="visually-hidden">Exam ID</label>
        <input type="text" id="testID" class="form-control" name="testID" placeholder="Exam ID" required>
        <button class="w-100 btn btn-lg btn-primary" type="submit">Next</button>
    </form>
</main>
</body>
<script>
    $("#formToSend").submit(function(e) {

        e.preventDefault(); // avoid to execute the actual submit of the form.
        var form = $(this);
        var url = form.attr('action');

        $.ajax({
            type: "GET",
            url: url,
            data: form.serialize(), // serializes the form's elements.
            success: function(data)
            {
                if(data == 0){
                    alert("User not found, please check your login info")
                }
                else{
                    if(data == 0){
                        alert("Email address not found");
                    }
                    else if(data == 1 ){
                        alert("Wrong password");
                    }
                    else if(data ==2){
                        alert("Wrong 2FA code")
                    }
                    else
                        console.log(data);
                        //window.location.href = data;
                }
            }
        });
    });
    $("#formToSend2").submit(function(e) {

        e.preventDefault(); // avoid to execute the actual submit of the form.
        var form = $(this);
        var url = form.attr('action');

        $.ajax({
            type: "GET",
            url: url,
            data: form.serialize(), // serializes the form's elements.
            success: function(data)
            {
                if(data == 0){
                    alert("User not found, please check your login info")
                }
                else{
                    if(data == 0){
                        alert("Email address not found");
                    }
                    else if(data == 1 ){
                        alert("Wrong password");
                    }
                    else if(data ==2){
                        alert("Wrong 2FA code")
                    }
                    else
                        console.log(data);
                    //window.location.href = data;
                }
            }
        });
    });
</script>
</html>

