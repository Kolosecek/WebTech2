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
            <h1 style="text-align: center; font-family: 'Asap', sans-serif">About</h1>
            <hr style="width: 90%; height: 2px; background-color: black !important;">

            <div class="contacts-container">
                        <div class="contact">
                            <img src="./assets/photos/adam.jpg" alt="adam_photo">
                            <div class="personal-info">
                                <p>Adam Trebichalský</p>
                                <div class="mail">
                                    <i class="far fa-envelope"></i>
                                    <p><a href="mailto:xtrebichalsky@stuba.sk">xtrebichalsky@stuba.sk</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="contact">
                            <img src="./assets/photos/filip.jpg" alt="filip_photo">
                            <div class="personal-info">
                                <p>Filip Michal Gajdoš</p>
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
                                <p>Maksim Mištec</p>
                                <div class="mail">
                                    <i class="far fa-envelope"></i>
                                    <p><a href="mailto:xmistec@stuba.sk">xmistec@stuba.sk</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="contact">
                            <img src="./assets/photos/tomas.jpg" alt="tomas_photo" style="width: 192px">
                            <div class="personal-info">
                                <p>Tomáš Kukumberg</p>
                                <div class="mail">
                                    <i class="far fa-envelope"></i>
                                    <p><a href="mailto:xkukumberg@stuba.sk"> xkukumberg@stuba.sk</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
        </div>

        <div class="table_wrapper" style="margin-bottom: 100px;">
            <h1 style="margin-top: 10px; font-family: 'Asap', sans-serif">Rozdelenie úloh</h1>
            <hr style="width: 90%; height: 2px; background-color: black !important;">
            <table class="table table-hover table-striped table-bordered done aboutTbl">
                <thead class="table-dark table-hover">
                <tr>
                    <th scope="col">Úloha/Meno</th>
                    <th scope="col">Filip Michal Gajdoš</th>
                    <th scope="col">Andrej Urbanek</th>
                    <th scope="col">Adam Trebichalský</th>
                    <th scope="col">Maksim Mištec</th>
                    <th scope="col">Tomáš Kukumberg</th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="text-align: left"><b>Prihlasovanie</b></td>
                        <td><b><i class="fas fa-check"></i></b></td>
                        <td><b><i></i></b></td>
                        <td><b><i></i></b></td>
                        <td><b><i class="fas fa-check"></i></b></td>
                        <td><b><i></i></b></td>
                    </tr>
                    <tr>
                        <td style="text-align: left"><b>Voľba db tabuliek</b></td>
                        <td><b><i class="fas fa-check"></i></b></td>
                        <td><b><i class="fas fa-check"></i></b></td>
                        <td><b><i class="fas fa-check"></i></b></td>
                        <td><b><i class="fas fa-check"></i></b></td>
                        <td><b><i class="fas fa-check"></i></b></td>
                    </tr>
                    <tr>
                        <td style="text-align: left"><b>Otázky - multi choice</b></td>
                        <td><b><i></i></b></td>
                        <td><b><i class="fas fa-check"></i></b></td>
                        <td><b><i></i></b></td>
                        <td><b><i></i></b></td>
                        <td><b><i></i></b></td>
                    </tr>
                    <tr>
                        <td style="text-align: left"><b>Otázky - short</b></td>
                        <td><b><i></i></b></td>
                        <td><b><i></i></b></td>
                        <td><b><i class="fas fa-check"></i></b></td>
                        <td><b></b></td>
                        <td><b></b></td>
                    </tr>
                    <tr>
                        <td style="text-align: left"><b>Otázky - párovacie</b></td>
                        <td><b><i class="fas fa-check"></i></b></td>
                        <td><b><i></i></b></td>
                        <td><b><i></i></b></td>
                        <td><b><i></i></b></td>
                        <td><b><i></i></b></td>
                    </tr>
                    <tr>
                        <td style="text-align: left"><b>Otázky - draw</b></td>
                        <td><b><i></i></b></td>
                        <td><b><i></i></b></td>
                        <td><b><i></i></b></td>
                        <td><b><i></i></b></td>
                        <td><b><i class="fas fa-check"></i></b></td>
                    </tr>
                    <tr>
                        <td style="text-align: left"><b>Otázky - math</b></td>
                        <td><b><i></i></b></td>
                        <td><b><i></i></b></td>
                        <td><b></b></td>
                        <td><b><i class="fas fa-check"></i></b></td>
                        <td><b></b></td>

                    </tr>
                    <tr>
                        <td style="text-align: left"><b>Ukončenie testu</b></td>
                        <td><b><i class="fas fa-check"></i></b></td>
                        <td><b><i class="fas fa-check"></i></b></td>
                        <td><b><i class="fas fa-check"></i></b></td>
                        <td><b></b></td>
                        <td><b></b></td>
                    </tr>
                    <tr>
                        <td style="text-align: left"><b>Testy - aktivácia/deaktivácia</b></td>
                        <td><b><i class="fas fa-check"></i></b></td>
                        <td><b><i></i></b></td>
                        <td><b></b></td>
                        <td><b><i class="fas fa-check"></i></b></td>
                        <td><b></b></td>
                    </tr>
                    <tr>
                        <td style="text-align: left"><b>Testy - leave/start info</b></td>
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
                        <td style="text-align: left"><b>Odovzdanie súborov</b></td>
                        <td><b><i class="fas fa-check"></i></b></td>
                        <td><b><i class="fas fa-check"></i></b></td>
                        <td><b><i class="fas fa-check"></i></b></td>
                        <td><b><i class="fas fa-check"></i></b></td>
                        <td><b><i class="fas fa-check"></i></b></td>
                    </tr>
                    <tr>
                        <td style="text-align: left"><b>Grafický layout/štruktúra</b></td>
                        <td><b><i></i></b></td>
                        <td><b><i></i></b></td>
                        <td><b><i class="fas fa-check"></i></b></td>
                        <td><b></b></td>
                        <td><b></b></td>
                    </tr>
                    <tr>
                        <td style="text-align: left"><b>Orientácia v aplikácii</b></td>
                        <td><b><i></i></b></td>
                        <td><b><i class="fas fa-check"></i></b></td>
                        <td><b><i class="fas fa-check"></i></b></td>
                        <td><b></b></td>
                        <td><b></b></td>
                    </tr>
                </tbody>
            </table>

            <h1 style="margin-top: 50px; font-family: 'Asap', sans-serif">Dokumentácia</h1>
            <hr style="width: 90%; height: 2px; background-color: black !important;">
            <div id="documentation">
                <p>Tu bude dokumentaciabude dokumentaciabude dokumentaciabude dokumentaciabude dokumentaciabude dokumentaciabude dokumentacia
                    bude dokumentaciabude dokumentaciabude dokumentaciabude dokumentaciabude dokumentaciabude dokumentaciabude dokumentacia
                    bude dokumentaciabude dokumentaciabude dokumentaciabude dokumentaciabude dokumentaciabude dokumentaciabude dokumentacia
                </p>
                <div id="github" class="grow">
                    <a href="https://github.com/Kolosecek/WebTech2" target="_blank" id="githubLink"><i class="fab fa-github fa-3x" style="color: #6e5494"></i>
                    Our Github Repository</a>
                </div>
            </div>

            <!--            <table class="table table-hover table-striped table-bordered done aboutTbl ">-->
<!--                <thead class="table-dark table-hover">-->
<!--                <tr>-->
<!--                    <th scope="col">Časti hry/Meno</th>-->
<!--                    <th scope="col">Filip Michal Gajdoš</th>-->
<!--                    <th scope="col">Andrej Urbanek</th>-->
<!--                    <th scope="col">Adam Trebichalský</th>-->
<!--                    <th scope="col">Maksim Mištec</th>-->
<!--                    <th scope="col">Tomáš Kukumberg</th>-->
<!--                </tr>-->
<!--                </thead>-->
<!--                <tbody>-->
<!--                <tr>-->
<!--                    <td><b>Drag & Drop</b></td>-->
<!--                    <td><b><i class="fas fa-check"></i></b></td>-->
<!--                    <td><b><i class="fas fa-check"></i></b></td>-->
<!--                    <td><b><i class="fas fa-check"></i></b></td>-->
<!--                    <td><b><i class="fas fa-check"></i></b></td>-->
<!--                    <td><b><i class="fas fa-check"></i></b></td>-->
<!--                </tr>-->
<!--                <tr>-->
<!--                    <td><b>Nepravidelné tvary</b></td>-->
<!--                    <td><b><i class="fas fa-check"></i></b></td>-->
<!--                    <td><b><i class="fas fa-check"></i></b></td>-->
<!--                    <td><b><i class="fas fa-check"></i></b></td>-->
<!--                    <td><b><i class="fas fa-check"></i></b></td>-->
<!--                    <td><b><i class="fas fa-check"></i></b></td>-->
<!--                </tr>-->
<!--                <tr>-->
<!--                    <td><b>Ukončiteľnosť</b></td>-->
<!--                    <td><b><i class="fas fa-check"></i></b></td>-->
<!--                    <td><b><i class="fas fa-check"></i></b></td>-->
<!--                    <td><b><i class="fas fa-check"></i></b></td>-->
<!--                    <td><b><i class="fas fa-check"></i></b></td>-->
<!--                    <td><b><i class="fas fa-check"></i></b></td>-->
<!--                </tr>-->
<!--                <tr>-->
<!--                    <td><b>Časomiera</b></td>-->
<!--                    <td><b><i class="fas fa-check"></i></b></td>-->
<!--                    <td><b><i class="fas fa-check"></i></b></td>-->
<!--                    <td><b><i class="fas fa-check"></i></b></td>-->
<!--                    <td><b><i class="fas fa-check"></i></b></td>-->
<!--                    <td><b><i class="fas fa-check"></i></b></td>-->
<!--                </tr>-->
<!--                <tr>-->
<!--                    <td><b>Demo</b></td>-->
<!--                    <td><b><i class="fas fa-check"></i></b></td>-->
<!--                    <td><b><i></i></b></td>-->
<!--                    <td></td>-->
<!--                    <td><b><i class="fas fa-check"></i></b></td>-->
<!--                    <td><b><i class="fas fa-check"></i></b></td>-->
<!--                </tr>-->
<!--                </tbody>-->
<!--            </table>-->
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

