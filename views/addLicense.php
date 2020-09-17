<?php 
include_once 'models/licenses.php';
include_once 'models/presentations.php';
include 'controllers/addLicenseController.php'; ?>
<div id="addLicense" class="content col-12 d-flex align-items-center justify-content-center">
    <div class="row  justify-content-center"><?php
    if(isset($_SESSION['userProfile']) && $_SESSION['userProfile']['role'] == 'administrateur'){ 
        if(isset($message)){ ?>
            <div class="col-10 col-lg-8 text-center jumbotron">
                <h1 class="text-center display-4"><?= $message; ?></h1>
                <a class="text-center w-100" href="<?= $universeLink ?>&content=licensesList">Retour vers la liste des licenses</a>
            </div><?php
        }else {?>
            <form class="offset-1 my-4 border border-black col-10" action="<?= $universeLink ?>&content=addLicense" method="POST">
                <h2 class="text-center">Ajouter une license</h2>
                <div id="addLicenseFormContent" class="row">
                    <div class="form-group col-12">
                        <label for="name">Titre :</label>
                        <input type="text" class="form-control <?= (isset($_POST['addPresentations'])) ? (!empty($addPresentationsFormErrors['name'])) ? 'is-invalid' : 'is-valid'  : '' ; ?>" id="name" name="name" value="<?= (!empty($_POST['name'])) ? $_POST['name'] : '' ; ?>" />
                        <p id="nameError" class="text-danger"><?= (!empty($addPresentationsFormErrors['name'])) ? $addPresentationsFormErrors['name'] : '' ;?></p>
                    </div>
                    <div class="form-group col-12">
                        <label for="creationDate">Date de création :</label>
                        <input type="date" class="form-control <?= (isset($_POST['addPresentations'])) ? (!empty($addPresentationsFormErrors['creationDate'])) ? 'is-invalid' : 'is-valid'  : '' ; ?>" id="creationDate" name="creationDate" value="<?= (!empty($_POST['creationDate'])) ? $_POST['creationDate'] : '' ; ?>" />
                        <p id="creationDateError" class="text-danger"><?= (!empty($addPresentationsFormErrors['creationDate'])) ? $addPresentationsFormErrors['creationDate'] : '' ;?></p>
                    </div>
                    <div class="form-group text-center col-12">
                        <input type="submit" class="btn btn-primary" name="addLicense" value="Ajouter" />
                    </div>
                </div>
            </form>
            <form class="offset-1 border border-black col-10" action="<?= $universeLink ?>&content=addLicense" method="POST" enctype="multipart/form-data">
                <h2 class="text-center">Ajouter une Présentation</h2>
                <div id="addLicenseFormContent" class="row">
                    <div class="form-group col-12">
                        <label for="name">License :</label>
                        <select id="name" name="name" class="form-control">
                            <option selected disabled>Choisir une license</option><?php
                            foreach($licensesList as $license){ ?>
                                <option value="<?= $license->id ?>"><?= $license->name ?></option><?php
                            } ?>
                        </select>
                        <p id="nameError" class="text-danger"><?= (!empty($addPresentationsFormErrors['name'])) ? $addPresentationsFormErrors['name'] : '' ;?></p>
                    </div>
                    <div class="form-group col-12">
                        <label for="universe">Univer :</label>
                        <select id="universe" name="universe" class="form-control">
                            <option selected disabled>Choisir un univer</option>
                            <option value="1">Manga</option>
                            <option value="2">Anime</option>
                        </select>
                        <p id="universeError" class="text-danger"><?= (!empty($addPresentationsFormErrors['universe'])) ? $addPresentationsFormErrors['universe'] : '' ;?></p>
                    </div>
                    <div class="form-group col-12">
                        <label for="file">Image :</label>
                        <input id="file" name="file" type="file" class="form-control" />
                        <p id="fileError" class="text-danger"><?= (!empty($addPresentationsFormErrors['file'])) ? $addPresentationsFormErrors['file'] : '' ;?></p>
                    </div>
                    <div class="form-group col-12">
                        <label for="presentation">Texte de présentation :</label>
                        <textarea id="presentation" name="presentation" class="form-control" rows="10" cols="100"></textarea>
                        <p id="presentation" class="text-danger"><?= (!empty($addPresentationsFormErrors['presentation'])) ? $addPresentationsFormErrors['presentation'] : '' ;?></p>
                    </div>
                    <div class="form-group text-center col-12">
                        <input type="submit" class="btn btn-primary" name="addPresentation" value="Ajouter" />
                    </div>
                </div>
            </form><?php
        }
    }else { ?>
        <div class="col-10 col-lg-8 jumbotron">
            <h1 class="text-center display-4">Vous n'avez pas le droit d'accéder à cette page</h1>
        </div><?php
    } ?>
    </div>
</div>
