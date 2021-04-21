<?php
session_start();
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: profile.php");
    exit;
}
?>

<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Zadanie 1</title>
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
    <link href="style.css" rel="stylesheet">
</head>

<body class="text-center">

<main class="form-signin">
    <form method="GET" action="backend/controller_register.php" id="formToSend" enctype="multipart/form-data">
        <img class="mb-4" src="img.png" width="72" height="62">
        <h1 class="h3 mb-3 fw-normal">Please sign up</h1>
        <input style="display: none" name="type" type="text" value="signup" class="form-control">
        <label for="inputEmail" class="visually-hidden">Email address</label>
        <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" required autofocus>
        <label for="inputPassword" class="visually-hidden">Password</label>
        <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
        <label for="inputName" class="visually-hidden">Name</label>
        <input type="text" id="inputName" class="form-control" name="name" placeholder="Name" required>
        <label for="inputSurname" class="visually-hidden">Surname</label>
        <input type="text" id="inputSurname" class="form-control" name="surname" placeholder="Surname" required>
        <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
        <p>Already have account? <a href="index.php">Click here</a></p>
    </form>
</main>

</body>
<script>
    $("#formToSend").submit(function(e) {

        e.preventDefault(); // avoid to execute the actual submit of the form.
        var form = $(this);
        var url = form.attr('action');

        $.ajax({
            type: "POST",
            url: url,
            data: form.serialize(), // serializes the form's elements.
            success: function(data)
            {
                if(data == 0)
                    alert("Email already in use"); // show response from the php script.
                else
                    //window.location.href = data;
                    console.log(data);
            }
        });


    });
</script>
</html>