<?php 
include_once 'models/posts.php';
include 'controllers/welcomeController.php'; 
?>
<div class="col-12 content d-flex align-items-center" id="welcome">
    <div class="row flex-fill justify-content-center"><?php
            //-------------------AFFICHAGE DES DEUX UNIVERS---------------------//
                if(!isset($_GET['universe'])){ ?>
                    <a class="col-xl-6 col-12" id="universAnime" href="index.php?universe=anime&content=welcome"><div class="row"><img class="img-fluid" id="animeWelcomeImage" src="/assets/img/anime/fond.jpg" /></div></a>
                    <a class="col-xl-6 col-12" id="universManga" href="index.php?universe=manga&content=welcome"><div class="row"><img class="img-fluid" id="mangaWelcomeImage" src="/assets/img/manga/fond.jpg" /></div></a><?php  
            //-------------------------------FIN------------------------------->

            //-------------------AFFICHAGE DU FOND CORRESPONDANT A L'UNIVERS CHOISI-------------->
                }else { ?>
                    <img class="img-fluid w-100" id="<?= $universe ?>WelcomeImage" src="/assets/img/<?= $universe ?>/fond.jpg" /><?php
                } ?>
            <!----------------------------------FIN---------------------------------------------->
        
    <!-------------------AFFICHAGE DU TEXTE DE BIENVENUE CELON L'UNIVERS SELECTIONNER------------------->
        <div class="col-10 col-lg-4 align-self-center" id="welcomeContainer">
            <h2 class="text-center">Bienvenue</h2>
            <p class="mx-3 text-justify"><?= $welcome->getWelcomeContent() ?></p>
        </div>
    <!------------------------------------------FIN----------------------------------------------------->
    </div>
</div>