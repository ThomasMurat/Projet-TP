<!DOCTYPE html>
<html lang="fr" dir="ltr">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />    
        <title>AnyManga: Univer Manga-<?= $title ?></title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" />
        <link rel="stylesheet" media="screen" type="text/css" href="assets/css/style.css" />
    </head>
    <body onresize="pageResize();<?=($contentName == 'welcome' || $_SERVER['REQUEST_URI'] == '/index.php') ? 'welcomeAdapt();': ''; ?>" class="container-fluid">
        <div class="row">
            <header id="topMenuMU" class="float-left fixed-top col-12">
                <div id="menu" class="row">
                    <div class="float-left d-flex align-content-center col-3 col-lg-2 text-center" id="switchUniverseButton">
                        <a class="mx-auto my-auto" href="http://anymanga.fr/index.php?universe=anime&content=<?= $contentName ?>"><img src="assets/img/manga/switchButton.png" title="Changer d'univers" alt=""></a>
                    </div>
                    <nav class="navbar navbar-expand-lg float-left col-6 col-lg-8 justify-content-center" id="mainMenu">
                        <h1 id="menuTitle"><a href="#" data-toggle="collapse" data-target="#mainMenuContent" class="navbar-toggler row float-left text-white text-center w-100">AnyManga</a></h1>
                        <div class="collapse navbar-collapse col-12" id="mainMenuContent">
                            <ul id="mainMenuList" class="navbar-nav row">
                                <li class="nav-item dropdown col-lg-3 d-flex">
                                    <a class="nav-link dropdown-toggle text-white text-center w-100" href="#" data-toggle="dropdown">Manga</a>
                                    <div class="dropdown-menu w-100">
                                        <a class="dropdown-item text-center w-100" href="index.php?universe=manga&content=productList&licenses=">Licenses</a>
                                        <a class="dropdown-item text-center w-100" href="index.php?universe=manga&content=productList&product=">Oeuvres</a>
                                    </div>
                                </li>                                
                                <li class="nav-item col-lg-3 d-flex"><a class="text-white text-center w-100" href="index.php?universe=manga&content=producerList">Mangaka</a></li>
                                <li class="nav-item col-lg-3 d-flex"><a class="text-white text-center w-100" href="index.php?universe=manga&content=profile">Découverte</a></li>
                                <li class="nav-item dropdown col-lg-3 d-flex">
                                    <a class="nav-link dropdown-toggle text-white text-center w-100" href="#" data-toggle="dropdown">Actualités</a>
                                    <div class="dropdown-menu w-100">
                                        <a class="dropdown-item text-center w-100" href="index.php?universe=manga&content=news&articles=">Articles</a>
                                        <a class="dropdown-item text-center w-100" href="index.php?universe=manga&content=news&calendar=">Agenda</a>
                                    </div>
                                </li>                            
                            </ul>
                        </div> 
                    </nav>
                    <nav class="navbar float-left col-3 col-lg-2 justify-content-center" id="userMenu">
                        <a type="button" data-toggle="collapse" data-target="#userMenuContent" class="navbar-toggler float-left" href="#">
                            <img src="assets/img/iconUser.png" title="Menu utilisateur" alt="Menu utilisateur">
                        </a>
                        <div class="collapse navbar-collapse" id="userMenuContent">
                            <ul id="userMenuList" class="navbar-nav"><?php
                            if($_SESSION['logedIn'] != 1) { ?>
                                <li class="nav-item d-flex"><a class="text-white text-center w-100" href="index.php?universe=manga&content=subscrib">S'inscrire</a></li><?php
                            } 
                            if($_SESSION['logedIn'] == 1) { ?>
                                <li class="nav-item d-flex"><a class="text-white text-center w-100" href="<?= ($_SERVER['REQUEST_URI'] == 'index.php') ? 'index.php?' : $_SERVER['REQUEST_URI'] . '&logOut='; ?>">Déconnexion</a></li><?php
                            }else { ?>
                                <li class="nav-item d-flex"><a class="text-white text-center w-100" data-toggle="modal" data-target="#login" href="#">Connexion</a></li><?php
                            } ?>                                <li class="nav-item d-flex"><a class="text-white text-center w-100" href="index.php?universe=manga&content=profile">Mon profil</a></li>
                                <li class="nav-item d-flex"><a class="text-white text-center w-100" href="index.php?universe=manga&content=lists"><?= 'sessionvalue : ' . $_SESSION['logedIn'] ?></a></li>
                            </ul>
                        </div>
                    </nav>
                </div>   
            </header>