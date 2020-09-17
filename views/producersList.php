<?php
include_once 'models/producers.php';
include_once 'models/producerTypes.php';
include 'controllers/producersListController.php';
?>
<div id="producersList" class="content col-12 d-flex align-items-center justify-content-center"><?php
    if(isset($_SESSION['userProfile']) && $_SESSION['userProfile']['role'] == 'administrateur'){ ?>
        <div class="row justify-content-center">
            <form class="col-10 mb-1 border border-dark text-center" method="POST" action="<?= $link ?>">
                <div class="mt-4">
                    <label for="name">Nom :</label>
                    <input type="text" id="name" name="name" />
                    <label for="categorie">Catégorie :</label>
                    <select name="categorie">
                        <option selected disabled>Choisir une catégorie</option><?php
                        foreach($categoriesList as $categorie){ ?>
                            <option value="<?= $categorie->id ?>"><?= $categorie->name ?></option><?php
                        } ?>
                    </select>
                </div>
                <div class="form-group text-center col-12">
                    <input type="submit" class="btn btn-primary" name="searchProducers" value="Rechercher" />
                </div>
                <p class="text-center"><?= $resultsNb ?> Résultats</p>
            </form><?php
            if($resultsNb == 0){?>
                <div class="col-10 col-lg-6 jumbotron">
                    <h1 class="text-center display-4">Aucun résultats pour cette recherche</h1>
                </div><?php
            }else { ?>
                <table class="table col-10 table-striped text-center container">
                    <title>Liste des Utilisateur</title>
                    <thead>
                        <th>Nom</th>
                        <th>Catégorie</th>
                        <th>Actions</th>
                    </thead>
                    <tbody><?php
                        foreach($producersList as $producer){ ?>
                            <tr>
                                <td><?= $producer->prodName ?></td>
                                <td><?= $producer->typName ?></td>
                                <td>
                                    <button  type="button" class="btn btn-primary btn-sm"><a class="text-white" href="<?= $universeLink ?>&content=updateProducer&id=<?= $producer->prodId ?>">modifier</a></button>
                                    <button onclick="fillModalId(<?= $producer->prodId ?>);" data-toggle="modal" data-target="#producerAction" type="button" id="producerDelete" class="btn btn-danger btn-sm">Supprimer</button>
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
        <div class="modal" id="producerAction">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <p class="h4 modal-title" id="actionTitle">Supprimer le Producteur</p>
                        </div>
                        <form id="actionContent" method="POST" action="<?= $link ?>" class="modal-body">
                            <div class="row">
                                <div class="col-12">
                                    <p id="producerActionText">Êtes-vous certain de vouloir supprimer ce producteur? toutes les relations avec les produits seront aussi supprimé.</p>
                                </div>
                                <input type="hidden" id="deleteId" name="prodId" />
                                <div class="form-group text-center col-12">
                                    <button type="submit" id="userActionBtn" name="deleteProducer" class="btn btn-primary">Confirmer</button>
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