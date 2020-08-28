<?php
include 'controllers/profileController.php'; ?>
<div class="content w-100 d-flex align-items-center" id="profile"><?php
    if(isset($_SESSION['logedIn']) && $_SESSION['logedIn']){ ?>
        <div class="w-50 mx-auto jumbotron">
            <h1 class="text-center display-4"><?= $_SESSION['userInfo']->username; ?></h1>
            <div class="text-center">
                <img src="<?= $_SESSION['userInfo']->image; ?>"></img>
            </div>
            <hr class="my-4">
            <p class="ml-5">Adresse mail : <?= $_SESSION['userInfo']->mail; ?></p>
            <hr class="my-4">
            <p class="ml-5">Date de naissance : <?= $_SESSION['userInfo']->birthDate; ?></p>
            <hr class="my-4">
            <p class="ml-5">Date d'inscription : <?= $_SESSION['userInfo']->subscribDate; ?></p>
            <hr class="my-4">
            <div class="w-100 text-center">
                <button class="btn btn-primary"><a class="text-white" href="index.php?universe=<?= $universe ?>&content=editProfile">Modifier mon profil</a></button>
                <button class="btn btn-danger">Supprimer mon profil</button>
            </div>
        </div><?php
    }else { ?>
        <div class="w-50 mx-auto jumbotron">
            <h1 class="text-center display-4">Vous devez être connecté pour accéder à cette page</h1>
        </div><?php
    } ?>
    <div class="modal" id="userDelete">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Connexion</h4>
                </div>
                <!-- Modal body -->
                <div id="loginContent" class="modal-body">
                    <div class="row">
                        <p>
                            Êtes vous sure de vouloir supprimmer votre compte? 
                            Cela supprimera tout vos commentaires ainsi que vos listes.
                        </p>
                        <button class="btn btn-primary">Oui</button>
                        <button class="btn btn-danger">Non</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>