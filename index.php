<?php 
session_start();
//---------------------Inclusion du controller et des models associé à la page index 
include 'config.php';
include_once 'models/dataBase.php';
include_once 'models/transaction.php';
include_once 'models/universes.php';
include_once 'models/users.php';
include 'controllers/indexController.php'; 
//----------------------FIN-----------------------------//
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />    
        <title>AnyManga: <?= isset($universe) ? 'Univer ' . $universe . '-' : '' ?><?= $title ?></title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" />
        <link rel="stylesheet" media="screen" type="text/css" href="assets/css/style.css" />
    </head>
    <body onresize="pageResize();<?=($contentName == 'welcome' && isset($universe)) ? 'welcomeAdapt();': ''; ?>" 
          onload="pageResize();<?=($contentName == 'welcome' && isset($universe)) ? 'welcomeAdapt();': ''; ?><?= (isset($_SESSION['userProfile']) && $_SESSION['userProfile']['role'] == 'administrateur') ? 'follow();' : '' ; ?>"  
          class="container-fluid <?= isset($universe) ? $universe : 'manga'; ?>Universe">
        <div class="row">
            <!---------------------------------------MENU DE NAVIGATION----------------------------------------->
            <header id="topMenu" class="float-left fixed-top col-12">
                <div id="menu" class="row">
                <!-------------------------Button SWITCH UNIVERSE --------------------------->
                    <div class="float-left d-flex align-content-center col-3 col-lg-2 text-center" id="switchUniverseButton">
                        <a class="mx-auto my-auto" href="http://anymanga.fr/index.php?universe=<?= (isset($universe) && $universe == 'anime') ? 'manga' : 'anime' ;?>&content=<?= $contentName ?><?= isset($_GET['title']) ? '&title=' . $_GET['title'] : ''; ?>"><img src="assets/img/<?= isset($_GET['universe']) ? $universe : 'manga'; ?>/switchButton.png" title="Changer d'univers" alt=""></a>
                    </div>
                <!-------------------------FIN----------------------------------------------->

                <!-------------------------BARRE DE NAVIGATION PRINCIPALE------------------------>
                    <nav class="navbar navbar-expand-lg float-left col-6 col-lg-8 justify-content-center" id="mainMenu">
                        <h1 id="menuTitle"><a href="#" data-toggle="collapse" data-target="#mainMenuContent" class="navbar-toggler row float-left text-white text-center w-100">AnyManga</a></h1>
                        <div class="collapse navbar-collapse col-12" id="mainMenuContent">
                            <ul id="mainMenuList" class="navbar-nav row">
                            <!--------------------Sous menu pour les produits----------------->
                                <li class="nav-item col-lg-3 text-center">
                                    <div class="float-left w-100">
                                        <a class="text-white text-center w-100" href="#productsSubMenu" data-toggle="collapse"><?= (isset($universe) && $universe == 'anime') ? 'Animés' : 'Manga' ?></a>
                                    </div>
                                    <div class="collapse hide float-left w-100" id="productsSubMenu">
                                        <a class="float-left text-white text-center w-100" href="<?= $universeLink ?>&content=liste-licences">Licenses</a>
                                        <a class="float-left text-white text-center w-100" href="<?= $universeLink ?>&content=productList&products=">Oeuvres</a>
                                    </div>
                                </li> 
                            <!-------------------FIN du sous menu pour les produits----------------->

                            <!-------------------Sous menu pour les producteurs--------------------->
                                <li class="nav-item col-lg-3 d-flex"><a class="text-white text-center w-100" href="<?= $universeLink ?>&content=producerList">Studios</a></li>
                            <!-------------------Fin du sous menu des producteur-------------------->

                            <!-------------------Sous menu pour les listes Découverte--------------->
                                <li class="nav-item col-lg-3 d-flex"><a class="text-white text-center w-100" href="<?= $universeLink ?>&content=discover">Découverte</a></li>
                            <!-------------------FIN du sous menue des listes découverte------------>

                            <!-------------------Sous menu des Actualités--------------------------->
                                <li class="nav-item col-lg-3 text-center">
                                    <div class="float-left w-100">
                                        <a class="text-white text-center w-100" href="#newsSubMenu" data-toggle="collapse">Actualités</a>
                                    </div>
                                    <div class="collapse hide float-left w-100" id="newsSubMenu">
                                        <a class="float-left text-white text-center w-100" href="<?= $universeLink ?>&content=news&articles=">Articles</a>
                                        <a class="float-left text-white text-center w-100" href="<?= $universeLink ?>&content=news&calendar=">Agenda</a>
                                    </div>
                                </li> 
                            <!------------------FIN du sous menu des Actualités--------------------->                           
                            </ul>
                        </div> 
                    </nav>
                <!------------------------FIN DE LA BARRE DE NAVIGATION PRINCIPALE-------------------->

                <!------------------------MENU DE NAVIGATION UTILISATEUR------------------------------>
                    <nav class="navbar float-left col-3 col-lg-2 justify-content-center" id="userMenu">
                        <a type="button" data-toggle="collapse" data-target="#userMenuContent" class="navbar-toggler float-left" href="#">
                            <img id="userImage" class="img-fluid" src="<?= (isset($_SESSION['userProfile'])) ? $_SESSION['userProfile']['image'] : 'assets/img/iconUser.png' ?>" title="Menu utilisateur" alt="Menu utilisateur">
                        </a>
                        <div class="collapse navbar-collapse" id="userMenuContent">
                            <ul id="userMenuList" class="navbar-nav"><?php
                            //------------------MENU DE NAVIGATION UTILISATEURS CONNECTER-------------------->
                            if(isset($_SESSION['userProfile'])) { ?>
                                <li class="nav-item d-flex"><a class="text-white text-center w-100" href="<?= $universeLink ?>&content=profile">Mon profil</a></li>
                                <li class="nav-item d-flex"><a class="text-white text-center w-100" href="<?= $universeLink ?>&content=lists">Mes Listes</a></li>
                                <li class="nav-item d-flex"><a class="text-white text-center w-100" href="<?= $link . '&logOut='; ?>">Déconnexion</a></li><?php
                            //------------------FIN DU MENU DE NAVIGATION UTILISATEUR CONNECTER-------------->

                            //------------------MENU DE NAVIGATION UTILISATEUR NON-CONNECTER----------------->
                            }else { ?>
                                <li class="nav-item d-flex"><a class="text-white text-center w-100" href="<?= $universeLink ?>&content=subscrib">S'inscrire</a></li>
                                <li class="nav-item d-flex"><a class="text-white text-center w-100" data-toggle="modal" data-target="#login" href="#">Connexion</a></li><?php
                            } ?>
                            <!-----------------FIN DU MENU DE NAVIGATION UTILISATEUR NON-CONNECTER----------->
                            </ul>
                        </div>
                    </nav>
                <!-----------------------FIN DU MENU DE NAVIGATION UTILISATEUR------------------------->
                </div>   
            </header>
            <!---------------------------------------FIN DU MENU DE NAVIGATION-----------------------------------------> 

            <!--------------------Fenêtre modal de connexion ------------------>
            <div class="modal" id="login">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Connexion</h4>
                        </div>
                        <div id="loginContent" class="modal-body">
                            <div class="row">
                                <div class="form-group col-12">
                                    <label for="username">Pseudo :</label>
                                    <input type="texte" id="username" class="form-control" name="username" />
                                </div>
                                <div class="form-group col-12">
                                    <label for="password">Mot de passe :</label>
                                    <input type="password" id="password" class="form-control" name="password" />
                                </div>
                                <div class="form-group text-center col-12">
                                    <button type="submit" id="loginBtn" class="btn btn-primary" onclick="sendLogin()">Se connecter</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!------------------------FIN MODAL CONNEXION------------------------------->

            <!------------------------Gestion du contenue principal de la page ------------>
            <div class="col-12 d-flex"><?php
                //------------------------Menu d'administration---------------------------------------------//
                if(isset($_SESSION['userProfile']) && $_SESSION['userProfile']['role'] == 'administrateur'){ ?>
                    <nav id="sidebar" class="row align-self-stretch float-left">
                        <div id="sidebarContent">
                            <div class="sidebar-header">
                                <p class="h4 text-center my-5">ADMINISTRATEUR</p>
                            </div>
                            <ul class="list-unstyled text-center">
                                <li>
                                    <a href="#usersSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle text-white">Utilsateurs</a>
                                    <ul class="collapse list-unstyled" id="usersSubmenu">
                                        <li>
                                            <a href="index.php?content=subscrib" class="text-white">ajouter</a>
                                        </li>
                                        <li>
                                            <a href="index.php?content=usersList" class="text-white">Liste</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#postsSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle text-white">Article</a>
                                    <ul class="collapse list-unstyled" id="postsSubmenu">
                                        <li>
                                            <a href="<?= $universeLink ?>&content=addPost" class="text-white">ajouter</a>
                                        </li>
                                        <li>
                                            <a href="<?= $universeLink ?>&content=postsList" class="text-white">Liste</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#licensesSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle text-white">Licenses</a>
                                    <ul class="collapse list-unstyled" id="licensesSubmenu">
                                        <li>
                                            <a href="<?= $universeLink ?>&content=addLicense" class="text-white">ajouter</a>
                                        </li>
                                        <li>
                                            <a href="<?= $universeLink ?>&content=licensesList" class="text-white">Liste</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#producersSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle text-white">Producteurs</a>
                                    <ul class="collapse list-unstyled" id="producersSubmenu">
                                        <li>
                                            <a href="<?= $universeLink ?>&content=addProducer" class="text-white">ajouter</a>
                                        </li>
                                        <li>
                                            <a href="<?= $universeLink ?>&content=producersList" class="text-white">Liste</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#productsSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle text-white">Produits</a>
                                    <ul class="collapse list-unstyled" id="productsSubmenu">
                                        <li>
                                            <a href="<?= $universeLink ?>&content=addProduct" class="text-white">ajouter</a>
                                        </li>
                                        <li>
                                            <a href="#" class="text-white">Liste</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </nav>
                    <button type="button" id="sidebarCollapse" class="float-left btn btn-info">-></button><?php
                } ?>
                <!--------------------------------------Fin Menu d'administration--------------------->

                <!----------------------------Inclusion de la vue------------------------->
                <div class="row flex-fill"><?php 
                    include 'views/' . $contentName . '.php'; ?>
                </div>
                <!----------------------FIN D'Inclusion de la vue------------------------->
            </div>
            <!----------------------Fin Du CONTENU PRINCIPAL---------------------------------------->
            
            <footer id="footer" class="w-100">
                
            </footer>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <script src="assets/js/script.js"></script>
    </body>
</html>
