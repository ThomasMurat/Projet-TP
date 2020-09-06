<?php
include_once 'models/users.php';
include_once 'models/roles.php';
include 'controllers/usersListController.php';
?>
<div id="usersList" class="content col-12 d-flex align-items-center justify-content-center"><?php
    if(isset($_SESSION['userProfile']) && $_SESSION['userProfile']['role'] == 'administrateur'){ ?>
    <div class="row">
        <form class="col-12 mb-5 border border-dark text-center" method="POST" action="<?= $link ?>">
            <div class="mt-2">
                <label for="username">Pseudo :</label>
                <input type="text" id="username" name="username" />
                <label for="mail">Mail :</label>
                <input type="email" id="mail" name="mail" />
                <label for="age">Âge :</label>
                <input type="number" id="age" name="age" />
                <label for="role">Rang</label>
                <select id="role" name="role">
                    <option selected disabled>Choisir le rang</option><?php
                    foreach($rolesList as $role){ ?>
                        <option value="<?= $role->id ?>"><?= $role->role ?></option><?php
                    } ?>
                </select>
            </div>
            <div class="form-group text-center col-12">
                <input type="submit" class="btn btn-primary" name="searchUser" value="Rechercher" />
            </div>
        </form>
        <table class="table col-10 table-striped text-center container">
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
                        <td><?= formatDateFr($user->birthDate) ?></td>
                        <td><?= formatDateFr($user->subscribDate) ?></td>
                        <td><?= $user->role ?></td>
                        <td>
                            <button type="button" class="btn btn-primary btn-sm"><a class="text-white" href="<?= $universeLink ?>&content=updateUser&id=<?= $user->id ?>">modifier</a></button>
                            <button type="button" class="btn btn-danger btn-sm"><a class="text-white" href="#">Supprimer</a></button>
                        </td>
                    </tr><?php
                } ?>  
            </tbody>
        </table>
    </div><?php
    }else { ?>
        <div class="col-10 col-lg-6 jumbotron">
            <h1 class="text-center display-4">Vous n'avez pas le droit d'accéder à cette page</h1>
        </div><?php
    } ?>
</div>