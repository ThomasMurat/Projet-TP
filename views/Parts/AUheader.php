<!DOCTYPE html>
<html lang="fr" dir="ltr">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />    
        <title>AnyManga: Univer Manga</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" />
        <link rel="stylesheet" media="screen" type="text/css" href="assets/css/style.css" />
    </head>
    <body onresize="pageResize()" class="container-fluid">
        <div class="row">
            <header id="topMenuAU" class="float-left fixed-top col-12">
                <div id="menu" class="row">
                    <div class="float-left d-flex align-content-center col-3 col-lg-2 text-center" id="switchUniverseButton">
                        <a class="mx-auto my-auto" href="http://anymanga.fr/MU-<?= $contentName ?>.html"><img src="assets/img/SwitchButtonAU.png" title="Changer d'univers" alt=""></a>
                    </div>
                    <nav class="navbar navbar-expand-lg float-left col-6 col-lg-8 justify-content-center" id="mainMenu">
                        <h1 id="menuTitle"><a href="#" data-toggle="collapse" data-target="#mainMenuContent" class="navbar-toggler row float-left text-white text-center w-100">AnyManga</a></h1>
                        <div class="collapse navbar-collapse col-12" id="mainMenuContent">
                            <ul id="mainMenuList" class="navbar-nav row">
                                <li class="nav-item col-lg-3 d-flex"><a class="text-white text-center w-100" href="AU-productList.html">Animes</a></li>
                                <li class="nav-item col-lg-3 d-flex"><a class="text-white text-center w-100" href="AU-producerList.html">Studios</a></li>
                                <li class="nav-item col-lg-3 d-flex"><a class="text-white text-center w-100" href="AU-discover.html">Découverte</a></li>
                                <li class="nav-item col-lg-3 d-flex"><a class="text-white text-center w-100" href="AU-news.html">Actualités</a></li>
                            </ul>
                        </div> 
                    </nav>
                    <nav class="navbar float-left col-3 col-lg-2 justify-content-center" id="userMenu">
                        <a type="button" data-toggle="collapse" data-target="#userMenuContent" class="navbar-toggler float-left" href="#">
                            <img src="assets/img/iconUser.png" title="Menu utilisateur" alt="Menu utilisateur">
                        </a>
                        <div class="collapse navbar-collapse" id="userMenuContent">
                            <ul id="userMenuList" class="navbar-nav">
                                <li class="nav-item d-flex"><a class="text-white text-center w-100" href="AU-subscrib.html">S'inscrire</a></li>
                                <li class="nav-item d-flex"><a class="text-white text-center w-100" data-toggle="modal" data-target="#login" href="#">Connexion</a></li>
                                <li class="nav-item d-flex"><a class="text-white text-center w-100" href="AU-profil.html">Mon profil</a></li>
                                <li class="nav-item d-flex"><a class="text-white text-center w-100" href="AU-list.html">Mes listes</a></li>
                            </ul>
                        </div>
                    </nav>
                </div>   
            </header>