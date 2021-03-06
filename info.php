<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Online Exam - About</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link href='https://use.fontawesome.com/releases/v5.8.1/css/all.css'>
    <link rel="stylesheet" href="styles.css">
    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link href="https://fonts.googleapis.com/css2?family=Asap&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://www.w3schools.com/lib/w3.js"></script>
    <script src="https://kit.fontawesome.com/e73d803768.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php include_once "header.html" ?>
    <div class="content bg-lg" style="justify-content: center; flex-direction: column; padding: 0px; height: auto">
        <img src="graphic.png" alt="" id="bg_blurred">


        <div class="table_wrapper" style="margin: 100px; justify-content: center; align-items: center; display: flex; flex-direction: column">
            <h1 style="text-align: center; font-family: 'Asap', sans-serif"><i class="fas fa-address-card"></i>
                About</h1>
            <hr style="width: 90%; height: 2px; background-color: black !important;">

            <div class="contacts-container">
                        <div class="contact">
                            <img src="./assets/photos/adam.jpg" alt="adam_photo">
                            <div class="personal-info">
                                <p>Adam Trebichalsk??</p>
                                <div class="mail">
                                    <i class="far fa-envelope"></i>
                                    <p><a href="mailto:xtrebichalsky@stuba.sk">xtrebichalsky@stuba.sk</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="contact">
                            <img src="./assets/photos/filip.jpg" alt="filip_photo">
                            <div class="personal-info">
                                <p>Filip Michal Gajdo??</p>
                                <div class="mail">
                                    <i class="far fa-envelope"></i>
                                    <p><a href="mailto:xgajdosf@stuba.sk">xgajdosf@stuba.sk</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="contact">
                            <img src="./assets/photos/andrej.png" alt="andrej_photo" style="height: 192px; width: 160px">
                            <div class="personal-info">
                                <p>Andrej Urbanek</p>
                                <div class="mail">
                                    <i class="far fa-envelope"></i>
                                    <p><a href="mailto:xurbaneka1@stuba.sk">xurbaneka1@stuba.sk</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="contact">
                            <img src="./assets/photos/maksim.jpg" alt="maksim_photo">
                            <div class="personal-info">
                                <p>Maksim Mi??tec</p>
                                <div class="mail">
                                    <i class="far fa-envelope"></i>
                                    <p><a href="mailto:xmistec@stuba.sk">xmistec@stuba.sk</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="contact">
                            <img src="./assets/photos/tomas.jpg" alt="tomas_photo" height="192">
                            <div class="personal-info">
                                <p>Tom???? Kukumberg</p>
                                <div class="mail">
                                    <i class="far fa-envelope"></i>
                                    <p><a href="mailto:xkukumberg@stuba.sk"> xkukumberg@stuba.sk</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
        </div>

        <div class="table_wrapper" style="margin-bottom: 100px;">
            <h1 style="margin-top: 20px; font-family: 'Asap', sans-serif"><i class="fas fa-clipboard-check"></i> Checklist
            </h1>
            <hr style="width: 90%; height: 2px; background-color: black !important;">
            <table class="table table-hover table-striped table-bordered done aboutTbl">
                <thead class="table-dark table-hover">
                <tr>
                    <th scope="col">Functionality/Name</th>
                    <th scope="col">Filip Michal Gajdo??</th>
                    <th scope="col">Andrej Urbanek</th>
                    <th scope="col">Adam Trebichalsk??</th>
                    <th scope="col">Maksim Mi??tec</th>
                    <th scope="col">Tom???? Kukumberg</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td style="text-align: left"><b>Sign in/Sign up</b></td>
                    <td><b><i class="fas fa-check"></i></b></td>
                    <td><b><i></i></b></td>
                    <td><b><i></i></b></td>
                    <td><b><i class="fas fa-check"></i></b></td>
                    <td><b><i></i></b></td>
                </tr>
                <tr>
                    <td style="text-align: left"><b>Structure of the DB</b></td>
                    <td><b><i class="fas fa-check"></i></b></td>
                    <td><b><i class="fas fa-check"></i></b></td>
                    <td><b><i class="fas fa-check"></i></b></td>
                    <td><b><i class="fas fa-check"></i></b></td>
                    <td><b><i class="fas fa-check"></i></b></td>
                </tr>
                <tr>
                    <td style="text-align: left"><b>Question - multi choice</b></td>
                    <td><b><i></i></b></td>
                    <td><b><i class="fas fa-check"></i></b></td>
                    <td><b><i></i></b></td>
                    <td><b><i></i></b></td>
                    <td><b><i></i></b></td>
                </tr>
                <tr>
                    <td style="text-align: left"><b>Question - short</b></td>
                    <td><b><i></i></b></td>
                    <td><b><i></i></b></td>
                    <td><b><i class="fas fa-check"></i></b></td>
                    <td><b></b></td>
                    <td><b></b></td>
                </tr>
                <tr>
                    <td style="text-align: left"><b>Question - pairing</b></td>
                    <td><b><i class="fas fa-check"></i></b></td>
                    <td><b><i></i></b></td>
                    <td><b><i></i></b></td>
                    <td><b><i></i></b></td>
                    <td><b><i></i></b></td>
                </tr>
                <tr>
                    <td style="text-align: left"><b>Question - draw</b></td>
                    <td><b><i></i></b></td>
                    <td><b><i></i></b></td>
                    <td><b><i></i></b></td>
                    <td><b><i></i></b></td>
                    <td><b><i class="fas fa-check"></i></b></td>
                </tr>
                <tr>
                    <td style="text-align: left"><b>Question - math</b></td>
                    <td><b><i></i></b></td>
                    <td><b><i></i></b></td>
                    <td><b></b></td>
                    <td><b><i class="fas fa-check"></i></b></td>
                    <td><b></b></td>

                </tr>
                <tr>
                    <td style="text-align: left"><b>Test submit</b></td>
                    <td><b><i class="fas fa-check"></i></b></td>
                    <td><b><i class="fas fa-check"></i></b></td>
                    <td><b><i class="fas fa-check"></i></b></td>
                    <td><b></b></td>
                    <td><b></b></td>
                </tr>
                <tr>
                    <td style="text-align: left"><b>Test - activation/deactivation</b></td>
                    <td><b><i class="fas fa-check"></i></b></td>
                    <td><b><i></i></b></td>
                    <td><b></b></td>
                    <td><b><i class="fas fa-check"></i></b></td>
                    <td><b></b></td>
                </tr>
                <tr>
                    <td style="text-align: left"><b>Test - leave/start info</b></td>
                    <td><b><i></i></b></td>
                    <td><b><i></i></b></td>
                    <td><b></b></td>
                    <td><b></b></td>
                    <td><b></b></td>
                </tr>
                <tr>
                    <td style="text-align: left"><b>Export CSV</b></td>
                    <td><b><i class="fas fa-check"></i></b></td>
                    <td><b><i></i></b></td>
                    <td><b></b></td>
                    <td><b></b></td>
                    <td><b><i class="fas fa-check"></i></b></td>
                </tr>
                <tr>
                    <td style="text-align: left"><b>Export PDF</b></td>
                    <td><b><i class="fas fa-check"></i></b></td>
                    <td><b><i></i></b></td>
                    <td><b></b></td>
                    <td><b></b></td>
                    <td><b><i class="fas fa-check"></i></b></td>
                </tr>
                <tr>
                    <td style="text-align: left"><b>Files completion</b></td>
                    <td><b><i class="fas fa-check"></i></b></td>
                    <td><b><i class="fas fa-check"></i></b></td>
                    <td><b><i class="fas fa-check"></i></b></td>
                    <td><b><i class="fas fa-check"></i></b></td>
                    <td><b><i class="fas fa-check"></i></b></td>
                </tr>
                <tr>
                    <td style="text-align: left"><b>Graphic layout/structure</b></td>
                    <td><b><i></i></b></td>
                    <td><b><i></i></b></td>
                    <td><b><i class="fas fa-check"></i></b></td>
                    <td><b></b></td>
                    <td><b></b></td>
                </tr>
                <tr>
                    <td style="text-align: left"><b>Orientation in the app</b></td>
                    <td><b><i></i></b></td>
                    <td><b><i class="fas fa-check"></i></b></td>
                    <td><b><i class="fas fa-check"></i></b></td>
                    <td><b></b></td>
                    <td><b></b></td>
                </tr>
                </tbody>
            </table>

            <h1 style="margin-top: 50px; font-family: 'Asap', sans-serif"><i class="fas fa-book"></i> Documentation
                </h1>
            <hr style="width: 90%; height: 2px; background-color: black !important;">
            <div id="documentation">
                <h2 style="font-family: Asap">Library for HTML ??? PDF conversion</h2>
                <p>
                    We used an open source command line tool  <a href="https://wkhtmltopdf.org" target="_blank">wkhtmltopdf</a>
                    for HTML to PDF conversion and also the PHP wrapper <a href="https://github.com/mikehaertl/phpwkhtmltopdf" target="_blank">phpwkhtmltopdf</a>
                    to be able to call this tool in PHP code. We installed both of these tools with a <a href="https://getcomposer.org" target="_blank">Composer</a>.
                </p>
                <br>
                <h2 style="font-family: Asap">Library for Math questions</h2>
                <p>
                    We used an open source library  <a href="http://mathlive.io/" target="_blank">Mathlive.io</a>
                    for creating Math question with latex. This library creates custom inputs in which user writes
                    math expressions and they are translated to latex commands. This also works other way around when
                    user inputs latex command and they are translated to text or math expressions. This library also
                    contains custom virtual keyboard for math expression and "smart mode" for automatically detecting math
                    expressions and text in one input. Usage is with custom elements "math-field" or with HTML "div" and then you
                    need to initialize the input.
                </p>
                <br>
                <h2 style="font-family: Asap">Library for Compare questions</h2>
                <p>
                    We used an open source library from JQuery  <a href="https://jqueryui.com/sortable/" target="_blank">Sortable</a>.
                    We are using this library for moving elements and reordering them in the HTML so we can "connect" two columns and they
                    will create row with answer on the exams.
                </p>
                <div id="github" class="grow">
                    <a href="https://github.com/Kolosecek/WebTech2" target="_blank" id="githubLink"><i class="fab fa-github fa-3x" style="color: #6e5494"></i>
                    Our Github Repository</a>
                </div>
            </div>
        </div>
    </div>

    <?php include_once "footer.html" ?>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
</body>
</html>

