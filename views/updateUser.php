<?php 
include_once 'models/users.php';
include_once 'models/roles.php';
include 'controllers/subscribController.php'; ?>
    <div id="subscrib" class="content"><?php
    if(isset($_POST['postSubscribe']) && count($subscribFormErrors) == 0){ ?>
        <div class="col-10 col-lg-6 mx-auto jumbotron">
            <h1 class="text-center display-4"><?= $message; ?></h1>
        </div><?php
    }else { ?>
        <form class="offset-1 col-10" action="index.php?universe=<?= isset($universe) ? $universe : 'manga'; ?>&content=subscrib" method="POST" enctype="multipart/form-data" class="w-100">
            <h2 class="text-center"><?= (isset($_SESSION['userProfile']) && $_SESSION['userProfile']['role'] == 'administrateur') ? 'Ajouter un Utilisateur' : 'Veuillez remplir tous les champs pour vous inscrire.' ?></h2>
            <div id="subscribFormContent" class="row">
                <div class="form-group col-12">
                    <label for="username">Pseudo :</label>
                    <input onblur="checkFieldValidity(this);" type="text" class="form-control <?= (isset($_POST['postSubscribe'])) ? (!empty($subscribFormErrors['username'])) ? 'is-invalid' : 'is-valid'  : '' ; ?>" id="username" name="username" value="<?= (!empty($_POST['username'])) ? $_POST['username'] : '' ; ?>" />
                    <p id="usernameError" class="text-danger"><?= (!empty($subscribFormErrors['username'])) ? $subscribFormErrors['username'] : '' ;?></p>
                </div>
                <div class="form-group col-12">
                    <label for="file">Image Profile : (optionnel)</label>
                    <input class="form-control" type="file" name="file" id="file" />
                    <p class="text-danger"><?= (!empty($subscribFormErrors['file'])) ? $subscribFormErrors['file'] : '' ;?></p>
                </div>
                <div class="form-group col-12">
                    <label for="birthDate">Date de naissance :</label>
                    <input onblur="checkFieldValidity(this);" type="date" class="form-control <?=(isset($_POST['postSubscribe'])) ? (!empty($subscribFormErrors['birthDate']))? 'is-invalid' : 'is-valid'  : '' ; ?>" id="birthDate" name="birthDate" value="<?= (!empty($_POST['birthDate'])) ? $_POST['birthDate'] : '' ; ?>" />
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
                    <label for="role">Rang :</label>
                    <select type="password" class="form-control" id="role" name="role">
                        <option selected disabled>Choisir le rang</option><?php
                        foreach($rolesList as $role){ ?>
                            <option value="<?= $role->id ?>"><?= $role->role ?></option><?php
                        } ?>
                    </select>
                    <p class="text-danger"><?= (!empty($subscribFormErrors['role'])) ? $subscribFormErrors['role'] : '' ;?></p>
                </div>
                <div class="form-group text-center col-12">
                    <input type="submit" class="btn btn-primary" name="updateUser" value="Confirmer" />
                </div>
            </div>
        </form><?php
    } ?>
    </div>