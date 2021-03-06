<?php
include_once 'models/users.php';
include_once 'models/roles.php';
include 'controllers/usersListController.php';
?>
<div id="usersList" class="content col-12 d-flex align-items-center justify-content-center"><?php
    if(isset($_SESSION['userProfile']) && $_SESSION['userProfile']['role'] == 'administrateur'){ ?>
        <div class="row justify-content-center">
            <form class="col-10 mb-1 border border-dark text-center" method="POST" action="<?= $link ?>">
                <div class="mt-5">
                    <label for="username">Pseudo :</label>
                    <input type="text" id="username" name="username" />
                    <label for="mail">Mail :</label>
                    <input type="text" id="mail" name="mail" />
                    <label for="age">Âge :</label>
                    <input type="number" id="age" name="age" />
                    <label for="role">Rang :</label>
                    <select id="role" name="role">
                        <option selected disabled>Choisir le rang</option><?php
                        foreach($rolesList as $role){ ?>
                            <option value="<?= $role->id ?>"><?= $role->role ?></option><?php
                        } ?>
                    </select>
                    <label for="statu">Statu :</label>
                    <select id="statu" name="statu">
                        <option selected disabled>Choisir un statu</option>
                        <option value="0">Desactivé</option>
                        <option value="1">Activé</option>
                    </select>
                </div>
                <div class="form-group text-center col-12">
                    <input type="submit" class="btn btn-primary" name="searchUser" value="Rechercher" />
                </div>
                <p class="text-center"><?= $resultsNb ?> Résultats</p>
            </form><?php
            if($resultsNb == 0){?>
                <div class="col-10 col-lg-6 jumbotron">
                    <h1 class="text-center display-4">Aucun résultats pour cette recherche</h1>
                </div><?php
            }else { ?>
                <table class="table col-12 table-striped text-center container">
                    <title>Liste des Utilisateur</title>
                    <thead>
                        <th>Pseudo</th>
                        <th>Mail</th>
                        <th>Date de naissance</th>
                        <th>Date d'inscription</th>
                        <th>Rang</th>
                        <th>Date de desactivation</th>
                        <th>Statu</th>
                        <th>Actions</th>
                    </thead>
                    <tbody><?php
                        foreach($usersList as $user){ ?>
                            <tr>
                                <td><?= $user->username ?></td>
                                <td><?= $user->mail ?></td>
                                <td><?= formatDateFr($user->birthDate) ?></td>
                                <td><?= formatDateFr($user->subscribDate) ?></td>
                                <td><?= $user->role ?></td>
                                <td><?= ($user->desactivationDate == null) ? '' : formatDateFr($user->desactivationDate); ?></td>
                                <td><?= ($user->statu) ? 'activé' : 'Desactivé' ; ?></td>
                                <td>
                                    <button  type="button" class="btn btn-primary btn-sm"><a class="text-white" href="<?= $universeLink ?>&content=updateUser&id=<?= $user->id ?>">modifier</a></button>
                                    <button onclick="fillmodal(this,<?= $user->id ?>);" data-toggle="modal" data-target="#userAction" type="button" id="user<?= ($user->statu) ? 'Desactivate' : 'Activate'; ?>" class="btn btn-<?= ($user->statu) ? 'warning' : 'success' ?> btn-sm"><?= ($user->statu) ? 'Desactiver' : 'Activer'; ?></button>
                                    <button onclick="fillmodal(this,<?= $user->id ?>);" data-toggle="modal" data-target="#userAction" type="button" id="userDelete" class="btn btn-danger btn-sm">Supprimer</button>
                                </td>
                            </tr><?php
                        } ?>  
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
        <div class="modal" id="userAction">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <p class="h4 modal-title" id="actionTitle"></p>
                        </div>
                        <form id="actionContent" method="POST" action="<?= $link ?>" class="modal-body">
                            <div class="row">
                                <div class="col-12">
                                    <p id="userActionText"></p>
                                </div>
                                <input type="hidden" id="userId" name="userId" />
                                <div class="form-group text-center col-12">
                                    <button type="submit" id="userActionBtn" name="" class="btn btn-primary">Confirmer</button>
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