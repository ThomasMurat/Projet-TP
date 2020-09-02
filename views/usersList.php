<?php
include_once 'models/users.php';
include 'controllers/usersListController.php';
?>
<div id="usersList" class="content col-12 d-flex align-items-center justify-content-center"><?php
    if(isset($_SESSION['userInfo']) && $_SESSION['userInfo']->role == 'administrateur'){ ?>
        <table class="table table-striped text-center container">
            <title>Liste des Utilisateur</title>
            <thead>
                <th>Pseudo</th>
                <th>Mail</th>
                <th>Date de naissance</th>
                <th>Date d'inscription</th>
                <th>Rang</th>
                <th>Actions</th>
            </thead>
            <tbody><?php
                foreach($usersList as $user){ ?>
                    <tr>
                        <td><?= $user->username ?></td>
                        <td><?= $user->mail ?></td>
                        <td><?= $user->birthDate ?></td>
                        <td><?= $user->subscribDate ?></td>
                        <td><?= $user->role ?></td>
                        <td>
                            <button type="button" class="btn btn-primary btn-sm"><a class="text-white" href="#">chnager le rang</a></button>
                            <button type="button" class="btn btn-danger btn-sm"><a class="text-white" href="#">Supprimer</a></button>
                        </td>
                    </tr><?php
                } ?>  
            </tbody>
        </table><?php
    }else { ?>
        <div class="col-6 jumbotron">
            <h1 class="text-center display-4">Vous n'avez pas le droit d'accéder à cette page</h1>
        </div><?php
    } ?>
</div>