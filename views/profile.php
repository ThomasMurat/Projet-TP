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
                <button class="btn btn-danger">Supprimer mon profil</button>
            </div>
        </div><?php
    }else { ?>
        <div class="col-10 col-lg-6 jumbotron">
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