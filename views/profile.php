<?php 
include 'controllers/profileController.php'; ?>
<div class="content col-12 d-flex align-items-center justify-content-center" id="profile"><?php
    if(isset($_SESSION['userProfile'])){ ?>
        <div class="col-10 col-lg-6 jumbotron">
            <h1 class="text-center display-4"><?= $_SESSION['userProfile']['username']; ?></h1>
            <div class="text-center">
                <img id="userProfileImage" src="<?= $_SESSION['userProfile']['image']; ?>"></img>
            </div>
            <hr class="my-4">
            <p class="ml-5">Adresse mail : <?= $_SESSION['userProfile']['mail']; ?></p>
            <hr class="my-4">
            <p class="ml-5">Date de naissance : <?= $_SESSION['userProfile']['birthDate']; ?></p>
            <hr class="my-4">
            <p class="ml-5">Date d'inscription : <?= $_SESSION['userProfile']['subscribDate']; ?></p>
            <hr class="my-4">
            <div class="w-100 text-center">
                <button class="btn btn-primary"><a class="text-white" href="index.php?universe=<?= $universe ?>&content=editProfile">Modifier mon profil</a></button>
                <button class="btn btn-danger" data-toggle="modal" data-target="#userAction">Supprimer mon profil</button>
            </div>
        </div><?php
    }else { ?>
        <div class="col-10 col-lg-6 jumbotron">
            <h1 class="text-center display-4">Vous devez être connecté pour accéder à cette page</h1>
        </div><?php
    } ?>
    <div class="modal" id="userAction">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <p class="h4 modal-title" id="actionTitle">Supprimer mon compte</p>
                </div>
                <form id="actionContent" method="POST" action="<?= $link ?>" class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <p>
                                Êtes vous sure de vouloir supprimmer votre compte? 
                                Cela le desactivera et toutes vos informations seront 
                                supprimées ultérieurement.
                            </p>
                        </div>
                        <div class="form-group text-center col-12">
                            <button type="submit" id="userActionBtn" name="userDelete" class="btn btn-primary">Confirmer</button>
                            <button class="btn btn-danger" data-dismiss="modal">Annuler</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>