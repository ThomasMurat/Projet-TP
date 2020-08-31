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
            <h2 class="text-center"><?= (isset($_SESSION['userInfo']) && $_SESSION['userInfo']->role == 'administrateur') ? 'Ajouter un Utilisateur' : 'Veuillez remplir tous les champs pour vous inscrire.' ?></h1>
            <div id="subscribFormContent" class="row">
                <div class="form-group col-12">
                    <label for="pseudo">Pseudo :</label>
                    <input type="text" class="form-control <?=(isset($_POST['postSubscribe'])) ? (!empty($subscribFormErrors['pseudo']))? 'is-invalid' : 'is-valid'  : '' ; ?>" id="pseudo" name="pseudo" value="<?= (!empty($_POST['pseudo'])) ? $_POST['pseudo'] : '' ; ?>" />
                    <p class="text-danger"><?= (!empty($subscribFormErrors['pseudo'])) ? $subscribFormErrors['pseudo'] : '' ;?></p>
                </div>
                <div class="form-group col-12">
                    <label for="file">Image Profile :</label>
                    <input class="form-control" type="file" name="file" id="file" />
                    <p class="text-danger"><?= (!empty($subscribFormErrors['file'])) ? $subscribFormErrors['file'] : '' ;?></p>
                </div>
                <div class="form-group col-12">
                    <label for="birthDate">Date de naissance :</label>
                    <input type="date" class="form-control <?=(isset($_POST['postSubscribe'])) ? (!empty($subscribFormErrors['birthDate']))? 'is-invalid' : 'is-valid'  : '' ; ?>" id="birthDate" name="birthDate" value="<?= (!empty($_POST['birthDate'])) ? $_POST['birthDate'] : '' ; ?>" />
                    <p class="text-danger"><?= (!empty($subscribFormErrors['birthDate'])) ? $subscribFormErrors['birthDate'] : '' ;?></p>
                </div>
                <div class="form-group col-12">
                    <label for="email">Adresse e-mail :</label>
                    <input type="email" class="form-control <?=(isset($_POST['postSubscribe'])) ? (!empty($subscribFormErrors['email']))? 'is-invalid' : 'is-valid'  : '' ; ?>" id="email" name="email" value="<?= (!empty($_POST['email'])) ? $_POST['email'] : '' ; ?>" />
                    <p class="text-danger"><?= (!empty($subscribFormErrors['email'])) ? $subscribFormErrors['email'] : '' ;?></p>
                </div>
                <div class="form-group col-12">
                    <label for="emailConfirm">Confirmer adresse e-mail :</label>
                    <input type="email" class="form-control <?=(isset($_POST['postSubscribe'])) ? (!empty($subscribFormErrors['emailConfirm']))? 'is-invalid' : 'is-valid'  : '' ; ?>" id="emailConfirm" name="emailConfirm" />
                    <p class="text-danger"><?= (!empty($subscribFormErrors['emailConfirm'])) ? $subscribFormErrors['emailConfirm'] : '' ;?></p>
                </div>
                <div class="form-group col-12">
                    <label for="password">Mot de passe :</label>
                    <input type="password" class="form-control <?=(isset($_POST['postSubscribe'])) ? (!empty($subscribFormErrors['password']))? 'is-invalid' : 'is-valid'  : '' ; ?>" id="password" name="password" value="<?= (!empty($_POST['password'])) ? $_POST['password'] : '' ; ?>" />
                    <p class="text-danger"><?= (!empty($subscribFormErrors['password'])) ? $subscribFormErrors['password'] : '' ;?></p>
                </div>
                <div class="form-group col-12">
                    <label for="passwordConfirm">Confirmer mot de passe :</label>
                    <input type="password" class="form-control <?=(isset($_POST['postSubscribe'])) ? (!empty($subscribFormErrors['passwordConfirm']))? 'is-invalid' : 'is-valid'  : '' ; ?>" id="passwordConfirm" name="passwordConfirm" />
                    <p class="text-danger"><?= (!empty($subscribFormErrors['passwordConfirm'])) ? $subscribFormErrors['passwordConfirm'] : '' ;?></p>
                </div><?php
                if(isset($_SESSION['userInfo']) && $_SESSION['userInfo']->role == 'administrateur') { ?>
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
