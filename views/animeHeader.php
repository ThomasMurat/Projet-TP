<!DOCTYPE html>
<html lang="fr" dir="ltr">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />    
        <title>AnyManga: Univer Anime-<?= $title ?></title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" />
        <link rel="stylesheet" media="screen" type="text/css" href="assets/css/style.css" />
    </head>
    <body onresize="pageResize();<?=($contentName == 'welcome' || $_SERVER['REQUEST_URI'] == '/index.php') ? 'welcomeAdapt();': ''; ?>" class="container-fluid animeUniverse">
        <div class="row">
            <header id="topMenuAU" onresize="follow();" class="float-left fixed-top col-12">
                <div id="menu" class="row">
                    <div class="float-left d-flex align-content-center col-3 col-lg-2 text-center" id="switchUniverseButton">
                        <a class="mx-auto my-auto" href="http://anymanga.fr/index.php?universe=manga&content=<?= $contentName ?>"><img src="assets/img/anime/switchButton.png" title="Changer d'univers" alt=""></a>
                    </div>
                    <nav class="navbar navbar-expand-lg float-left col-6 col-lg-8 justify-content-center" id="mainMenu">
                        <h1 id="menuTitle"><a href="#" data-toggle="collapse" data-target="#mainMenuContent" class="navbar-toggler row float-left text-white text-center w-100">AnyManga</a></h1>
                        <div class="collapse navbar-collapse col-12" id="mainMenuContent">
                            <ul id="mainMenuList" class="navbar-nav row">
                                <li class="nav-item col-lg-3 text-center">
                                    <div class="float-left w-100">
                                        <a class="text-white text-center w-100" href="#productsSubMenu" data-toggle="collapse">Anime</a>
                                    </div>
                                    <div class="collapse hide float-left w-100" id="productsSubMenu">
                                        <a class="float-left text-white text-center w-100" href="index.php?universe=anime&content=productList&licenses=">Licenses</a>
                                        <a class="float-left text-white text-center w-100" href="index.php?universe=anime&content=productList&products=">Oeuvres</a>
                                    </div>
                                </li> 
                                <li class="nav-item col-lg-3 d-flex"><a class="text-white text-center w-100" href="index.php?universe=anime&content=producerList">Studios</a></li>
                                <li class="nav-item col-lg-3 d-flex"><a class="text-white text-center w-100" href="index.php?universe=anime&content=discover">Découverte</a></li>
                                <li class="nav-item col-lg-3 text-center">
                                    <div class="float-left w-100">
                                        <a class="text-white text-center w-100" href="#newsSubMenu" data-toggle="collapse">Actualités</a>
                                    </div>
                                    <div class="collapse hide float-left w-100" id="newsSubMenu">
                                        <a class="float-left text-white text-center w-100" href="index.php?universe=anime&content=news&articles=">Articles</a>
                                        <a class="float-left text-white text-center w-100" href="index.php?universe=anime&content=news&calendar=">Agenda</a>
                                    </div>
                                </li>                            
                            </ul>
                        </div> 
                    </nav>
                    <nav class="navbar float-left col-3 col-lg-2 justify-content-center" id="userMenu">
                        <a type="button" data-toggle="collapse" data-target="#userMenuContent" class="navbar-toggler float-left" href="#">
                            <img id="userImage" class="img-fluid" src="<?= (isset($_SESSION['logedIn']) && $_SESSION['logedIn']) ? $_SESSION['userInfo']->image : 'assets/img/iconUser.png' ?>" title="Menu utilisateur" alt="Menu utilisateur">
                        </a>
                        <div class="collapse navbar-collapse" id="userMenuContent">
                            <ul id="userMenuList" class="navbar-nav"><?php
                            if(isset($_SESSION['logedIn']) && $_SESSION['logedIn']) { ?>
                                <li class="nav-item d-flex"><a class="text-white text-center w-100" href="index.php?universe=anime&content=profile">Mon profil</a></li>
                                <li class="nav-item d-flex"><a class="text-white text-center w-100" href="index.php?universe=anime&content=lists">Mes Listes</a></li>
                                <li class="nav-item d-flex"><a class="text-white text-center w-100" href="<?= $link . '&logOut='; ?>">Déconnexion</a></li><?php
                            }else { ?>
                                <li class="nav-item d-flex"><a class="text-white text-center w-100" href="index.php?universe=anime&content=subscrib">S'inscrire</a></li>
                                <li class="nav-item d-flex"><a class="text-white text-center w-100" data-toggle="modal" data-target="#login" href="#">Connexion</a></li><?php
                            } ?>
                            </ul>
                        </div>
                    </nav>
                </div>   
            </header>
            
            