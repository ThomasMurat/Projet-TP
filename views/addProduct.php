<?php 
include_once 'models/products.php';
include_once 'models/licenses.php';
include_once 'models/producers.php';
include_once 'models/productTypes.php';
include_once 'models/status.php';
include_once 'models/genres.php';
include_once 'models/targets.php';
include_once 'models/producerRoles.php';
include 'controllers/addProductController.php'; ?>
<div id="addLicense" class="content col-12 d-flex align-items-center justify-content-center">
    <div class="row  justify-content-center"><?php
    if(isset($_SESSION['userProfile']) && $_SESSION['userProfile']['role'] == 'administrateur'){ 
        if(isset($message)){ ?>
            <div class="col-10 col-lg-8 text-center jumbotron">
                <h1 class="text-center display-4"><?= $message; ?></h1>
                <a class="text-center w-100" href="<?= $universeLink ?>&content=producersList">Retour vers la liste des Produits</a>
            </div><?php
        }else {?>
            <form class="offset-1 border border-black col-10" action="<?= $universeLink ?>&content=addProduct" method="POST" enctype="multipart/form-data">
                <h2 class="text-center">Ajouter une Oeuvre</h2>
                <div id="addLicenseFormContent" class="row">
                    <div class="form-group col-12">
                        <label for="name">titre :</label>
                        <input id="name" name="name" type="text" class="form-control" />
                        <p id="nameError" class="text-danger"><?= (!empty($addProductFormErrors['name'])) ? $addProductFormErrors['name'] : '' ;?></p>
                    </div>
                    <hr>
                    <p class="ml-3">Informations spécifique</p>
                    <hr>
                    <div class="form-group col-12">
                        <p>Univer :</p>
                            <label for="manga">Manga</label>
                            <input class="mr-5" type="radio" id="manga" name="universe[1]" value="1" />
                            <label for="anime">Anime</label>
                            <input type="radio" id="anime" name="universe[2]" value="2" />
                        <p id="universeError" class="text-danger"><?= (!empty($addProductFormErrors['universe'])) ? $addProductFormErrors['universe'] : '' ;?></p>
                    </div>
                    <div class="form-group col-12">
                        <label for="license">Licence :</label>
                        <select id="license" name="license" class="form-control">
                            <option selected disabled>Choisir une licence</option><?php
                            foreach($licensesList as $license){ ?>
                                <option value="<?= $license->id ?>"><?= $license->name ?></option><?php
                            } ?>
                        </select>
                        <p id="licenseError" class="text-danger"><?= (!empty($addProductFormErrors['license'])) ? $addProductFormErrors['license'] : '' ;?></p>
                    </div>
                    <div class="form-group col-12">
                        <label for="type">Type :</label>
                        <select id="type" name="type" class="form-control">
                            <option selected disabled>Choisir un type</option><?php
                            foreach($typesList as $type){ ?>
                                <option value="<?= $type->id ?>"><?= $type->name ?></option><?php
                            } ?>
                        </select>
                        <p id="typeError" class="text-danger"><?= (!empty($addProductFormErrors['type'])) ? $addProductFormErrors['type'] : '' ;?></p>
                    </div>
                    <div class="form-group col-12">
                        <label for="statu">Statu :</label>
                        <select id="statu" name="statu" class="form-control">
                            <option selected disabled>Choisir un statu</option><?php
                            foreach($statusList as $statu){ ?>
                                <option value="<?= $statu->id ?>"><?= $statu->name ?></option><?php
                            } ?>
                        </select>
                        <p id="statuError" class="text-danger"><?= (!empty($addProductFormErrors['statu'])) ? $addProductFormErrors['statu'] : '' ;?></p>
                    </div>
                    <div class="form-group col-12">
                        <label for="startDate">Date de début :</label>
                        <input type="date" id="startDate" name="startDate" class="form-control" />
                        <p id="startDateError" class="text-danger"><?= (!empty($addProductFormErrors['startDate'])) ? $addProductFormErrors['startDate'] : '' ;?></p>
                    </div>
                    <div class="form-group col-12">
                        <label for="endDate">Date de Fin :</label>
                        <input type="date" id="endDate" name="endDate" class="form-control" />
                        <p id="endDateError" class="text-danger"><?= (!empty($addProductFormErrors['endDate'])) ? $addProductFormErrors['endDate'] : '' ;?></p>
                    </div>
                    <div class="form-group col-12">
                        <label for="file">Image :</label>
                        <input id="file" name="file" type="file" class="form-control" />
                        <p id="fileError" class="text-danger"><?= (!empty($addProductFormErrors['file'])) ? $addProductFormErrors['file'] : '' ;?></p>
                    </div>
                    <div class="form-group col-12">
                        <label for="itemNumber">Nombre de volume (ou épisode) :</label>
                        <input id="itemNumber" name="itemNumber" type="number" class="form-control" />
                        <p id="itemNumberError" class="text-danger"><?= (!empty($addProductFormErrors['itemNumber'])) ? $addProductFormErrors['itemNumber'] : '' ;?></p>
                    </div>
                    <div class="form-group col-12">
                        <label for="description">Description :</label>
                        <textarea id="description" name="description" class="form-control" rows="10" cols="100"></textarea>
                        <p id="descriptionError" class="text-danger"><?= (!empty($addProductFormErrors['description'])) ? $addProductFormErrors['description'] : '' ;?></p>
                    </div>
                    <hr>
                    <p class="ml-3">Informations générales</p>
                    <hr>
                    <div class="form-group col-12">
                        <label for="target">Public cible :</label>
                        <select id="target" name="target" class="form-control">
                            <option selected disabled>Choisir une cible</option><?php
                            foreach($targetsList as $target){ ?>
                                <option value="<?= $target->id ?>"><?= $target->target ?></option><?php
                            } ?>
                        </select>
                        <p id="targetError" class="text-danger"><?= (!empty($addProductFormErrors['target'])) ? $addProductFormErrors['target'] : '' ;?></p>
                    </div>
                    <div class="form-group col-12">
                        <p>Genres :</p><?php
                        foreach($genresList as $genre){ ?>
                            <label for="genres[<?= $genre->id ?>]"><?= $genre->name ?></label>
                            <input type="checkbox" class="mr-5" name="genres[<?= $genre->id ?>]" /><?php
                        } ?>
                        <p id="genreError" class="text-danger"><?= (!empty($addProductFormErrors['genre'])) ? $addProductFormErrors['genre'] : '' ;?></p>
                    </div>
                    <div class="form-group col-12">
                        <p>auteur1 :</p>
                        <label for="producerName1">Nom :</label>
                        <input class="mr-5 form-control" type="texte" list="producersNameList" id="producerName1" name="producerName[1]" />
                        <label for="producerRole">Role :</label>
                        <select id="producerRole1" class="form-control" name="producerRole[1]">
                            <option selected disabled>Choisir un role</option><?php
                            foreach($rolesList as $role){ ?>
                                <option value="<?= $role->id ?>"><?= $role->role ?></option><?php
                            } ?>
                        </select>
                        <p id="producerName1Error" class="text-danger"><?= (!empty($addProductFormErrors['producerName1'])) ? $addProductFormErrors['producerName1'] : '' ;?></p>
                    </div>
                    <div class="form-group col-12">
                    <p>auteur2 :</p>
                        <label for="producerName2">Nom :</label>
                        <input class="mr-5 form-control" type="texte" list="producersNameList" id="producerName2" name="producerName[2]" />
                        <datalist id="producersNameList"><?php
                            foreach($producersNameList as $producerName){ ?>
                                <option value="<?= $producerName->prodId ?>"><?= $producerName->prodName ?></option><?php
                            } ?>
                        </datalist>
                        <label for="producerRole">Role :</label>
                        <select id="producerRole2" class="form-control" name="producerRole[2]">
                            <option selected disabled>Choisir un role</option><?php
                            foreach($rolesList as $role){ ?>
                                <option value="<?= $role->id ?>"><?= $role->role ?></option><?php
                            } ?>
                        </select>
                        <p id="producerName2Error" class="text-danger"><?= (!empty($addProductFormErrors['producerName2'])) ? $addProductFormErrors['producerName2'] : '' ;?></p>
                    </div>
                    
                    <div class="form-group col-12">
                        <label for="publicator">Publication :</label>
                        <select id="publicator" name="publicator" class="form-control">
                            <option disabled selected>Choisissez un publicateur</option><?php
                                foreach($publicatorsList as $publicator){ ?>
                                    <option value="<?= $publicator->id ?>"><?= $publicator->name ?></option><?php
                                } ?>
                        </select>
                        <p id="publicatorError" class="text-danger"><?= (!empty($addProductFormErrors['publicator'])) ? $addProductFormErrors['publicator'] : '' ;?></p>
                    </div>
                    <div class="form-group text-center col-12">
                        <input type="submit" class="btn btn-primary" name="addProduct" value="Ajouter" />
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