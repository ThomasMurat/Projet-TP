<?php 
include_once 'models/licenses.php';
include_once 'models/presentations.php';
include 'controllers/subscribController.php'; ?>
    <div id="addLicense" class="content"><?php
    if(isset($_POST['postSubscribe']) && count($subscribFormErrors) == 0){ ?>
        <div class="w-50 mx-auto jumbotron">
            <h1 class="text-center display-4"><?= $message; ?></h1>
        </div><?php
    }else { ?>
        <form class="offset-1 border border-black col-10" action="<?= $universeLink ?>&content=addLicense" method="POST" enctype="multipart/form-data">
            <h2 class="text-center">Ajouter une license</h2>
            <div id="addLicenseFormContent" class="row">
                <div class="form-group col-12">
                    <label for="name">Titre :</label>
                    <input type="text" class="form-control <?= (isset($_POST['postSubscribe'])) ? (!empty($subscribFormErrors['username'])) ? 'is-invalid' : 'is-valid'  : '' ; ?>" id="username" name="username" value="<?= (!empty($_POST['username'])) ? $_POST['username'] : '' ; ?>" />
                    <p id="usernameError" class="text-danger"><?= (!empty($subscribFormErrors['username'])) ? $subscribFormErrors['username'] : '' ;?></p>
                </div>
                <div class="form-group col-12">
                    <label for="name">Date de création :</label>
                    <input type="date" class="form-control <?= (isset($_POST['postSubscribe'])) ? (!empty($subscribFormErrors['username'])) ? 'is-invalid' : 'is-valid'  : '' ; ?>" id="username" name="username" value="<?= (!empty($_POST['username'])) ? $_POST['username'] : '' ; ?>" />
                    <p id="usernameError" class="text-danger"><?= (!empty($subscribFormErrors['username'])) ? $subscribFormErrors['username'] : '' ;?></p>
                </div>
                <div class="form-group text-center col-12">
                    <input type="submit" class="btn btn-primary" name="addLicenses" value="Ajouter" />
                </div>
            </div>
        </form>
        <form class="offset-1 border border-black col-10" action="<?= $universeLink ?>&content=addLicense" method="POST" enctype="multipart/form-data">
            <h2 class="text-center">Ajouter une Présentation</h2>
            <div id="addLicenseFormContent" class="row">
                <div class="form-group col-12">
                    <label for="username">Pseudo :</label>
                    <input onblur="checkFieldValidity(this);" type="text" class="form-control <?= (isset($_POST['postSubscribe'])) ? (!empty($subscribFormErrors['username'])) ? 'is-invalid' : 'is-valid'  : '' ; ?>" id="username" name="username" value="<?= (!empty($_POST['username'])) ? $_POST['username'] : '' ; ?>" />
                    <p id="usernameError" class="text-danger"><?= (!empty($subscribFormErrors['username'])) ? $subscribFormErrors['username'] : '' ;?></p>
                </div>
                
                <div class="form-group text-center col-12">
                    <input type="submit" class="btn btn-primary" name="addPrésentations" value="Ajouter" />
                </div>
            </div>
        </form><?php
    } ?>
    </div>
