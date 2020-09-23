<?php
include_once 'models/presentations.php';
include_once 'models/licenses.php';
include 'controllers/licensesListController.php';
?>
<div id="licensesList" class="content col-12 d-flex align-items-center justify-content-center"><?php
    if(isset($_SESSION['userProfile']) && $_SESSION['userProfile']['role'] == 'administrateur'){ ?>
        <div class="row justify-content-center">
            <form class="col-10 mb-1 border border-dark text-center" method="POST" action="<?= $link ?>">
                <div class="mt-4">
                    <label for="name">titre :</label>
                    <input type="text" id="name" name="name" />
                    <label for="universe">univers :</label>
                    <select name="universe">
                        <option selected disabled>Choisir un univer</option>
                        <option value="1">Manga</option>
                        <option value="2">Anime</option>
                        <option value="">Pas de presentation</option>
                    </select>
                    <label for="creationDate">Depuis :</label>
                    <input type="number" id="creationDate" name="creationDate" placeholder="YYYY" />
                </div>
                <div class="form-group text-center col-12">
                    <input type="submit" class="btn btn-primary" name="searchLicenses" value="Rechercher" />
                </div>
                <p class="text-center"><?= $resultsNb ?> Résultats</p>
            </form><?php
            if($resultsNb == 0){?>
                <div class="col-10 col-lg-6 jumbotron">
                    <h1 class="text-center display-4">Aucun résultats pour cette recherche</h1>
                </div><?php
            }else { ?>
                <table class="table col-10 table-striped text-center container">
                    <title>Liste des Licences</title>
                    <thead>
                        <th>Titre</th>
                        <th>Date de création</th>
                        <th>Univer</th>
                        <th>Actions</th>
                    </thead>
                    <tbody><?php
                        foreach($licensesList as $license){ ?>
                            <tr>
                                <td><?= $license->name ?></td>
                                <td><?= formatDateFr($license->creationDate) ?></td>
                                <td><?= $license->universe ?></td>
                                <td><?php
                                    if(!is_null($license->presId)){ ?>
                                        <button  type="button" class="btn btn-primary btn-sm"><a class="text-white" href="<?= $universeLink ?>&content=updateLicenses&id=<?= $license->presId ?>">modifier</a></button><?php
                                    } ?>
                                    <button onclick="fillLicenseModal(<?= $license->licId ?>, <?= $license->presId ?>);" data-toggle="modal" data-target="#licensesAction" 
                                    type="button" id="licenseDelete" class="btn btn-danger btn-sm">Supprimer</button>
                                </td>
                            </tr><?php
                        }  ?>  
                    </tbody>
                </table>
                <div class="col-10 text-center"><?php 
                    //affiche le numero des page
                    $startPage = $page - 3;
                    if($startPage < 1){
                        $startPage = 1;
                    }
                    if ($page != 1){ ?>
                        <a href="<?= $link ?>&page=1" class="btn"><<</a>
                        <a href="<?= $link ?>&page=<?=($page - 1)?>" class="btn"><</a><?php
                    }
                    if ($page > 4){ ?>
                        <span>...</span><?php
                    }
                    $endPage = $page + 3;
                    if($endPage > $pageNb) {
                        $endPage = $pageNb;
                    }
                    for ($i = $startPage; $i <= $endPage; $i++) { 
                        if(isset($_GET['page'])) {?>
                            <a href="<?= $link ?>&page=<?= $i ?>" class="btn <?= $i == $_GET['page'] ? 'btn-primary' : ''; ?>"><?= $i ?></a><?php
                        }else { ?>
                            <a href="<?= $link ?>&page=<?= $i ?>" class="btn <?= $i == 1 ? 'btn-primary' : ''; ?>"><?= $i ?></a><?php
                        }
                    } 
                    if ($page < $pageNb - 3){ ?>
                        <span>...</span><?php
                    }
                    if ($page != $pageNb){ ?>
                        <a href="<?= $link ?>&page=<?=($page + 1) ?>" class="btn">></a>
                        <a href="<?= $link ?>&page=<?= $pageNb ?>" class="btn">>></a><?php
                    } ?>
                </div><?php
            } ?>
        </div>
        <div class="modal" id="licensesAction">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <p class="h4 modal-title" id="actionTitle">Supprimer la licenses</p>
                        </div>
                        <form id="actionContent" method="POST" action="<?= $link ?>" class="modal-body">
                            <div class="row">
                                <div class="col-12">
                                    <p id="userActionText">Êtes-vous certain de vouloir supprimer cette présentation? S'il n'y a aucune présentation pour cette license celle-ci sera supprimée.</p>
                                </div>
                                <input type="hidden" id="presId" name="presId" />
                                <input type="hidden" id="licId" name="licId" />
                                <div class="form-group text-center col-12">
                                    <button type="submit" id="userActionBtn" name="deletePresentation" class="btn btn-primary">Confirmer</button>
                                    <button class="btn btn-danger" data-dismiss="modal">Annuler</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div><?php
    }else { ?>
        <div class="col-10 col-lg-6 jumbotron">
            <h1 class="text-center display-4">Vous n'avez pas le droit d'accéder à cette page</h1>
        </div><?php
    } ?>
</div>