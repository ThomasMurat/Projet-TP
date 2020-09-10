<?php 
include_once 'models/users.php';
include_once 'models/roles.php';
include 'controllers/updateUserController.php'; ?>
<div id="updateUser" class="content col-12 d-flex align-items-center justify-content-center"><?php
    if(isset($_POST['updateUser']) && count($updateUserFormErrors) == 0){ ?>
        <div class="col-10 col-lg-6 text-center mx-auto jumbotron">
            <h1 class="text-center display-4"><?= $message; ?></h1>
            <a class="text-center" href="<?= $universeLink ?>&content=usersList">Retour vers la liste des utilisateurs</a>
        </div><?php
    }else if(isset($error)){ ?>
        <div class="col-10 col-lg-6 text-center mx-auto jumbotron">
            <h1 class="text-center display-4"><?= $error ?></h1>
        </div><?php
    }else { ?>
        <form class="offset-1 col-10" action="<?= $universeLink ?>&content=updateUser&id=<?= $user->id ?>" method="POST" enctype="multipart/form-data">
            <h2 class="text-center">Modifier le profile</h2>
            <div id="updateUserFormContent" class="row">
                <div class="form-group col-12">
                    <label for="username">Pseudo :</label>
                    <input onblur="checkFieldValidity(this);" type="text" class="form-control <?= (isset($_POST['updateUser'])) ? (!empty($updateUserFormErrors['username'])) ? 'is-invalid' : 'is-valid'  : '' ; ?>" id="username" name="username" value="<?= (!empty($_POST['username'])) ? $_POST['username'] : $userProfile->username ; ?>" />
                    <p id="usernameError" class="text-danger"><?= (!empty($updateUserFormErrors['username'])) ? $updateUserFormErrors['username'] : '' ;?></p>
                </div>
                <div class="form-group col-12">
                    <label for="file">Image Profile : (optionnel)</label>
                    <input class="form-control" type="file" name="file" id="file" />
                    <p class="text-danger"><?= (!empty($updateUserFormErrors['file'])) ? $updateUserFormErrors['file'] : '' ;?></p>
                </div>
                <div class="form-group col-12">
                    <label for="birthDate">Date de naissance :</label>
                    <input onblur="checkFieldValidity(this);" type="date" class="form-control <?=(isset($_POST['updateUser'])) ? (!empty($updateUserFormErrors['birthDate']))? 'is-invalid' : 'is-valid'  : '' ; ?>" id="birthDate" name="birthDate" value="<?= (!empty($_POST['birthDate'])) ? $_POST['birthDate'] : $userProfile->birthDate ; ?>" />
                    <p id="birthDateError" class="text-danger"><?= (!empty($updateUserFormErrors['birthDate'])) ? $updateUserFormErrors['birthDate'] : '' ;?></p>
                </div>
                <div class="form-group col-12">
                    <label for="mail">Adresse e-mail :</label>
                    <input onblur="checkFieldValidity(this);" type="email" class="form-control <?=(isset($_POST['updateUser'])) ? (!empty($updateUserFormErrors['mail']))? 'is-invalid' : 'is-valid'  : '' ; ?>" id="mail" name="mail" value="<?= (!empty($_POST['mail'])) ? $_POST['mail'] : $userProfile->mail ; ?>" />
                    <p id="mailError" class="text-danger"><?= (!empty($updateUserFormErrors['mail'])) ? $updateUserFormErrors['mail'] : '' ;?></p>
                </div>
                <div class="form-group col-12">
                    <label for="mailConfirm">Confirmer adresse e-mail :</label>
                    <input type="email" class="form-control <?=(isset($_POST['updateUser'])) ? (!empty($updateUserFormErrors['mailConfirm']))? 'is-invalid' : 'is-valid'  : '' ; ?>" id="mailConfirm" name="mailConfirm" />
                    <p class="text-danger"><?= (!empty($updateUserFormErrors['mailConfirm'])) ? $updateUserFormErrors['mailConfirm'] : '' ;?></p>
                </div>
                <div class="form-group col-12">
                    <label for="role">Rang :</label>
                    <select type="password" class="form-control" id="role" name="role">
                        <option selected disabled>Choisir le rang</option><?php
                        foreach($rolesList as $role){ ?>
                            <option value="<?= $role->id ?>" <?= ($role->role == $userProfile->role) ? 'selected' : ''; ?>><?= $role->role ?></option><?php
                        } ?>
                    </select>
                    <p class="text-danger"><?= (!empty($updateUserFormErrors['role'])) ? $updateUserFormErrors['role'] : '' ;?></p>
                </div>
                <div class="form-group text-center col-12">
                    <input type="submit" class="btn btn-primary" name="updateUser" value="Mettre à jour" />
                </div>
            </div>
        </form><?php
    } ?>
</div>