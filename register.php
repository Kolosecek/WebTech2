<?php

session_start();

if(!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] !== true)
{
    header("location: profile.php");
    exit;
}
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Online Exam - Register</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
        <link href='https://use.fontawesome.com/releases/v5.8.1/css/all.css'>
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Asap&display=swap" rel="stylesheet">
        <link href="styles.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://www.w3schools.com/lib/w3.js"></script>
        <script src="https://kit.fontawesome.com/e73d803768.js" crossorigin="anonymous"></script>

    </head>

    <body>
    <div class="content">
        <div id="illustration">
            <img src="graphic.png" alt="" style=" width: 100%;">
        </div>

        <div id="login">
            <main class="form-signin">
                <div class="forms">
                    <form method="GET" action="backend/controller_register.php" id="formToSend" enctype="multipart/form-data">
                        <div class="inputs">
                            <img class="mb-4" src="img.png" width="72" height="62">
                            <h1 class="h3 mb-3 fw-normal">Sign up</h1>
                            <input style="display: none" name="type" type="text" value="signup" class="form-control">
                            <div class='mb-3'>
                                <label for="inputEmail" class="visually-hidden">Email address</label>
                                <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" required autofocus>
                            </div>
                            <div class='mb-3'>
                                <label for="inputPassword" class="visually-hidden">Password</label>
                                <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
                            </div>
                            <div class='mb-3'>
                                <label for="inputName" class="visually-hidden">Name</label>
                                <input type="text" id="inputName" class="form-control" name="name" placeholder="Name" required>
                            </div>
                            <div class='mb-3'>
                                <label for="inputSurname" class="visually-hidden">Surname</label>
                                <input type="text" id="inputSurname" class="form-control" name="surname" placeholder="Surname" required>
                            </div>
                            <button class="w-100 btn btn-lg btn-primary grow btn-index" type="submit">Sign in</button>
                            <p>Already have account? <a href="index.php">Click here</a></p>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </div>
        <?php include_once "footer.html" ?>
        <script>
            $("#formToSend").submit(function(e)
            {
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
                            window.location.href = data;
                        //console.log(data);
                    }
                });
            });
        </script>
    </body>


</html>