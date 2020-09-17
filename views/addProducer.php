<?php 
include_once 'models/producerTypes.php';
include_once 'models/producers.php';
include 'controllers/addProducerController.php'; ?>
<div id="addLicense" class="content col-12 d-flex align-items-center justify-content-center">
    <div class="row  justify-content-center"><?php
    if(isset($_SESSION['userProfile']) && $_SESSION['userProfile']['role'] == 'administrateur'){ 
        if(isset($message)){ ?>
            <div class="col-10 col-lg-8 text-center jumbotron">
                <h1 class="text-center display-4"><?= $message; ?></h1>
                <a class="text-center w-100" href="<?= $universeLink ?>&content=producersList">Retour vers la liste des Producteurs</a>
            </div><?php
        }else {?>
            <form class="offset-1 border border-black col-10" action="<?= $universeLink ?>&content=addProducer" method="POST" enctype="multipart/form-data">
                <h2 class="text-center">Ajouter un Producteur</h2>
                <div id="addLicenseFormContent" class="row">
                    <div class="form-group col-12">
                        <label for="name">Nom :</label>
                        <input id="name" name="name" type="text" class="form-control" />
                        <p id="nameError" class="text-danger"><?= (!empty($addProducerFormErrors['name'])) ? $addProducerFormErrors['name'] : '' ;?></p>
                    </div>
                    <div class="form-group col-12">
                        <label for="categorie">Catégorie :</label>
                        <select id="categorie" name="categorie" class="form-control">
                            <option selected disabled>Choisir une categorie</option><?php
                            foreach($categoriesList as $categorie){ ?>
                                <option value="<?= $categorie->id ?>"><?= $categorie->name ?></option><?php
                            } ?>
                        </select>
                        <p id="universeError" class="text-danger"><?= (!empty($addProducerFormErrors['universe'])) ? $addProducerFormErrors['universe'] : '' ;?></p>
                    </div>
                    <div class="form-group col-12">
                        <label for="file">Image :</label>
                        <input id="file" name="file" type="file" class="form-control" />
                        <p id="fileError" class="text-danger"><?= (!empty($addProducerFormErrors['file'])) ? $addProducerFormErrors['file'] : '' ;?></p>
                    </div>
                    <div class="form-group col-12">
                        <label for="description">Description :</label>
                        <textarea id="description" name="description" class="form-control" rows="10" cols="100"></textarea>
                        <p id="description" class="text-danger"><?= (!empty($addProducerFormErrors['description'])) ? $addProducerFormErrors['description'] : '' ;?></p>
                    </div>
                    <div class="form-group text-center col-12">
                        <input type="submit" class="btn btn-primary" name="addProducer" value="Ajouter" />
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