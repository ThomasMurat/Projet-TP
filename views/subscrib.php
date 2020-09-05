<?php 
include_once 'models/users.php';
include_once 'models/roles.php';
include 'controllers/subscribController.php'; ?>
    <div id="subscrib" class="content"><?php
    if(isset($_POST['postSubscribe']) && count($subscribFormErrors) == 0){ ?>
        <div class="w-50 mx-auto jumbotron">
            <h1 class="text-center display-4"><?= $message; ?></h1>
        </div><?php
    }else { ?>
        <form class="offset-1 col-10" action="index.php?universe=<?= $universe ?>&content=subscrib" method="POST" enctype="multipart/form-data" class="w-100">
            <h2 class="text-center"><?= (isset($_SESSION['userProfile']) && $_SESSION['userProfile']['role'] == 'administrateur') ? 'Ajouter un Utilisateur' : 'Veuillez remplir tous les champs pour vous inscrire.' ?></h2>
            <div id="subscribFormContent" class="row">
                <div class="form-group col-12">
                    <label for="username">Pseudo :</label>
                    <input onblur="checkFieldValidity(this);" type="text" class="form-control <?= (isset($_POST['postSubscribe'])) ? (!empty($subscribFormErrors['username']))? 'is-invalid' : 'is-valid'  : '' ; ?>" id="username" name="username" value="<?= (!empty($_POST['username'])) ? $_POST['username'] : '' ; ?>" />
                    <p id="usernameError" class="text-danger"><?= (!empty($subscribFormErrors['username'])) ? $subscribFormErrors['username'] : '' ;?></p>
                </div>
                <div class="form-group col-12">
                    <label for="file">Image Profile : (optionnel)</label>
                    <input class="form-control" type="file" name="file" id="file" />
                    <p class="text-danger"><?= (!empty($subscribFormErrors['file'])) ? $subscribFormErrors['file'] : '' ;?></p>
                </div>
                <div class="form-group col-12">
                    <label for="birthDate">Date de naissance :</label>
                    <input onblur="checkFieldValidity(this);" type="text" class="form-control <?=(isset($_POST['postSubscribe'])) ? (!empty($subscribFormErrors['birthDate']))? 'is-invalid' : 'is-valid'  : '' ; ?>" id="birthDate" name="birthDate" value="<?= (!empty($_POST['birthDate'])) ? $_POST['birthDate'] : '' ; ?>" />
                    <p id="birthDateError" class="text-danger"><?= (!empty($subscribFormErrors['birthDate'])) ? $subscribFormErrors['birthDate'] : '' ;?></p>
                </div>
                <div class="form-group col-12">
                    <label for="mail">Adresse e-mail :</label>
                    <input onblur="checkFieldValidity(this);" type="email" class="form-control <?=(isset($_POST['postSubscribe'])) ? (!empty($subscribFormErrors['mail']))? 'is-invalid' : 'is-valid'  : '' ; ?>" id="mail" name="mail" value="<?= (!empty($_POST['mail'])) ? $_POST['mail'] : '' ; ?>" />
                    <p id="mailError" class="text-danger"><?= (!empty($subscribFormErrors['mail'])) ? $subscribFormErrors['mail'] : '' ;?></p>
                </div>
                <div class="form-group col-12">
                    <label for="mailConfirm">Confirmer adresse e-mail :</label>
                    <input type="email" class="form-control <?=(isset($_POST['postSubscribe'])) ? (!empty($subscribFormErrors['mailConfirm']))? 'is-invalid' : 'is-valid'  : '' ; ?>" id="mailConfirm" name="mailConfirm" />
                    <p class="text-danger"><?= (!empty($subscribFormErrors['mailConfirm'])) ? $subscribFormErrors['mailConfirm'] : '' ;?></p>
                </div>
                <div class="form-group col-12">
                    <label for="password">Mot de passe :</label>
                    <input onblur="checkFieldValidity(this);" type="password" class="form-control <?=(isset($_POST['postSubscribe'])) ? (!empty($subscribFormErrors['password']))? 'is-invalid' : 'is-valid'  : '' ; ?>" id="password" name="password" value="<?= (!empty($_POST['password'])) ? $_POST['password'] : '' ; ?>" />
                    <p id="passwordError" class="text-danger"><?= (!empty($subscribFormErrors['password'])) ? $subscribFormErrors['password'] : '' ;?></p>
                </div>
                <div class="form-group col-12">
                    <label for="passwordConfirm">Confirmer mot de passe :</label>
                    <input type="password" class="form-control <?=(isset($_POST['postSubscribe'])) ? (!empty($subscribFormErrors['passwordConfirm']))? 'is-invalid' : 'is-valid'  : '' ; ?>" id="passwordConfirm" name="passwordConfirm" />
                    <p class="text-danger"><?= (!empty($subscribFormErrors['passwordConfirm'])) ? $subscribFormErrors['passwordConfirm'] : '' ;?></p>
                </div><?php
                if(isset($_SESSION['userProfile']) && $_SESSION['userProfile']['role'] == 'administrateur') { ?>
                    <div class="form-group col-12">
                        <label for="role">Rang :</label>
                        <select type="password" class="form-control" id="role" name="role">
                            <option selected disabled>Choisir le rang</option><?php
                            foreach($rolesList as $role){ ?>
                                <option value="<?= $role->id ?>"><?= $role->role ?></option><?php
                            } ?>
                        </select>
                        <p class="text-danger"><?= (!empty($subscribFormErrors['role'])) ? $subscribFormErrors['role'] : '' ;?></p>
                    </div><?php
                } ?>
                <div class="form-group text-center col-12">
                    <input type="submit" class="btn btn-primary" name="postSubscribe" value="Confirmer" />
                </div>
            </div>
        </form><?php
    } ?>
    </div>
