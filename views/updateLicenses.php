<?php 
include_once 'models/licenses.php';
include_once 'models/presentations.php';
include 'controllers/updatelicenseController.php'; ?>
<div id="updatelicense" class="content col-12 d-flex align-items-center justify-content-center"><?php
    if(isset($_POST['updatelicense']) && count($updatelicenseFormErrors) == 0){ ?>
        <div class="col-10 col-lg-6 text-center jumbotron">
            <h1 class="text-center display-4"><?= $message; ?></h1>
            <a class="text-center" href="<?= $universeLink ?>&content=licensesList">Retour vers la liste des Licenses</a>
        </div><?php
    }else if(isset($error)){ ?>
        <div class="col-10 col-lg-6 text-center jumbotron">
            <h1 class="text-center display-4"><?= $error ?></h1>
        </div><?php
    }else { ?>
        <form class="offset-1 col-10" action="<?= $universeLink ?>&content=updateLicenses&id=<?= $presentationProfile->presId ?>" method="POST" enctype="multipart/form-data">
            <h2 class="text-center">Modifier le profile</h2>
            <div id="updatelicenseFormContent" class="row">
                <div class="form-group col-12">
                    <label for="name">Titre :</label>
                    <input type="text" class="form-control <?= (isset($_POST['updatelicense'])) ? (!empty($updatelicenseFormErrors['name'])) ? 'is-invalid' : 'is-valid'  : '' ; ?>" id="name" name="name" value="<?= (!empty($_POST['licensename'])) ? $_POST['name'] : $presentationProfile->name ; ?>" />
                    <p id="nameError" class="text-danger"><?= (!empty($updatelicenseFormErrors['name'])) ? $updatelicenseFormErrors['name'] : '' ;?></p>
                </div>
                <div class="col-12 text-center">
                    <img id="licenseImage" src="<?= $presentationProfile->image ?>"></img>
                </div>
                <div class="form-group col-12">
                    <label for="file">Image Licenses : (optionnel)</label>
                    <input class="form-control" type="file" name="file" id="file" />
                    <p class="text-danger"><?= (!empty($updatelicenseFormErrors['file'])) ? $updatelicenseFormErrors['file'] : '' ;?></p>
                </div>
                <div class="form-group col-12">
                    <label for="creationDate">Date de création :</label>
                    <input type="date" class="form-control <?=(isset($_POST['updatelicense'])) ? (!empty($updatelicenseFormErrors['creationDate']))? 'is-invalid' : 'is-valid'  : '' ; ?>" id="creationDate" name="creationDate" value="<?= (!empty($_POST['creationDate'])) ? $_POST['creationDate'] : $presentationProfile->creationDate ; ?>" />
                    <p id="creationDateError" class="text-danger"><?= (!empty($updatelicenseFormErrors['creationDate'])) ? $updatelicenseFormErrors['creationDate'] : '' ;?></p>
                </div>
                <div class="form-group col-12">
                    <label for="presentation">Presentation :</label>
                    <textarea id="presentation" name="presentation" class="form-control" rows="10" cols="100"><?= (!empty($_POST['presentation'])) ? $_POST['presentation'] : $presentationProfile->presentation ; ?></textarea>
                    <p id="contentError" class="text-danger"><?= (!empty($updatelicenseFormErrors['presentation'])) ? $updatelicenseFormErrors['presentation'] : '' ;?></p>
                </div>
                <div class="form-group text-center col-12">
                    <input type="submit" class="btn btn-primary" name="updatelicense" value="Mettre à jour" />
                </div>
            </div>
        </form><?php
    } ?>
</div>