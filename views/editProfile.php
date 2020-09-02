<?php
include_once 'models/users.php';
include 'controllers/editProfileController.php'; 
?>
<?php 
if((isset($_POST['editImage']) || isset($_POST['editMail']) || isset($_POST['editPassword'])) && empty($editProfileFormErrors)){ ?>
    <div class="content d-flex align-items-center w-100" id="editProfile">
        <div class="w-50 text-center mx-auto jumbotron">
            <h1 class="display-4"><?= $message ?></h1>
            <a href="index.php?universe=<?= $universe ?>&content=profile">Retour vers mon profil</a>
        </div>
    </div><?php
}else if(isset($_SESSION['logedIn']) && $_SESSION['logedIn']) { ?>
    <div class="content w-100" id="editProfile">
        <h1 class="text-center"><?= $title ?></h1>
        <form class="offset-1 my-5 border border-dark col-10" action="index.php?universe=<?= $universe ?>&content=editProfile" method="POST" enctype="multipart/form-data">
            <h2>Modifier mon image de profil</h2>
            <div id="subscribFormContent" class="row">
                <div class="ml-5">
                    <img src="<?= $_SESSION['userInfo']->image; ?>" />
                </div>
                <div class="form-group col-12">
                    <label for="file">Nouvelle image Profile :</label>
                    <input class="form-control" type="file" name="file" id="file" />
                    <p class="text-danger"><?= (!empty($editProfileFormErrors['file'])) ? $editProfileFormErrors['file'] : '' ;?></p>
                </div>
                <div class="form-group text-center col-12">
                    <input type="submit" class="btn btn-primary" name="editImage" value="Confirmer" />
                </div>
            </div>
        </form>
        <form class="offset-1 my-5 border border-dark col-10" action="index.php?universe=<?= $universe ?>&content=editProfile" method="POST">
            <h2>Modifié mon adresse mail</h2>
            <div id="subscribFormContent" class="row">
                <div class="form-group col-12">
                    <label for="email">Adresse e-mail :</label>
                    <input type="email" class="form-control <?=(isset($_POST['editMail'])) ? (!empty($editProfileFormErrors['email']))? 'is-invalid' : 'is-valid'  : '' ; ?>" id="email" name="email" value="<?= (!empty($_POST['email'])) ? $_POST['email'] : $_SESSION['userInfo']->mail ; ?>" />
                    <p class="text-danger"><?= (!empty($editProfileFormErrors['email'])) ? $editProfileFormErrors['email'] : '' ;?></p>
                </div>
                <div class="form-group col-12">
                    <label for="emailConfirm">Confirmer adresse e-mail :</label>
                    <input type="email" class="form-control <?=(isset($_POST['editProfile'])) ? (!empty($editProfileFormErrors['emailConfirm']))? 'is-invalid' : 'is-valid'  : '' ; ?>" id="emailConfirm" name="emailConfirm" />
                    <p class="text-danger"><?= (!empty($editProfileFormErrors['emailConfirm'])) ? $editProfileFormErrors['emailConfirm'] : '' ;?></p>
                </div>
                <div class="form-group text-center col-12">
                    <input type="submit" class="btn btn-primary" name="editMail" value="Confirmer" />
                </div>
            </div>
        </form>
        <form class="offset-1 my-5 border border-dark col-10" action="index.php?universe=<?= $universe ?>&content=editProfile" method="POST">
            <h2>Modifier mon mot de passe</h2>
            <div id="subscribFormContent" class="row">
            <div class="form-group col-12">
                    <label for="oldPassword">Ancien mot de passe :</label>
                    <input type="password" class="form-control <?=(isset($_POST['editPassword'])) ? (!empty($editProfileFormErrors['oldPassword']))? 'is-invalid' : 'is-valid'  : '' ; ?>" id="oldPassword" name="oldPassword" />
                    <p class="text-danger"><?= (!empty($editProfileFormErrors['oldPassword'])) ? $editProfileFormErrors['oldPassword'] : '' ;?></p>
                </div>
                <div class="form-group col-12">
                    <label for="password">Nouveau mot de passe :</label>
                    <input type="password" class="form-control <?=(isset($_POST['editPassword'])) ? (!empty($editProfileFormErrors['password']))? 'is-invalid' : 'is-valid'  : '' ; ?>" id="password" name="password" value="<?= (!empty($_POST['password'])) ? $_POST['password'] : '' ; ?>" />
                    <p class="text-danger"><?= (!empty($editProfileFormErrors['password'])) ? $editProfileFormErrors['password'] : '' ;?></p>
                </div>
                <div class="form-group col-12">
                    <label for="passwordConfirm">Confirmer nouveau mot de passe :</label>
                    <input type="password" class="form-control <?=(isset($_POST['editPassword'])) ? (!empty($editProfileFormErrors['passwordConfirm']))? 'is-invalid' : 'is-valid'  : '' ; ?>" id="passwordConfirm" name="passwordConfirm" />
                    <p class="text-danger"><?= (!empty($editProfileFormErrors['passwordConfirm'])) ? $editProfileFormErrors['passwordConfirm'] : '' ;?></p>
                </div>
                <div class="form-group text-center col-12">
                    <input type="submit" class="btn btn-primary" name="editPassword" value="Confirmer" />
                </div>
            </div>
        </form>
    </div><?php
}else { ?>
    <div class="content d-flex align-items-center w-100" id="editProfile">
        <div class="w-50 text-center mx-auto jumbotron">
            <h1 class="display-4">Vous devez être connecté pour accéder à cette page</h1>
            <a href="index.php?universe=<?= $universe ?>&content=welcome">Retour vers la page d'accueil</a>
        </div>
    </div><?php
} ?>