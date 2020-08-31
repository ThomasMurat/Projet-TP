<?php
include_once 'models/users.php';
include 'controllers/usersListController.php';
?>
<div id="usersList" class="content"><?php
    if(isset($_SESSION['userInfo']) && $_SESSION['userInfo']->role == 'administrateur'){ ?>
        <table>
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
                        <td><?= $user->id ?></td>
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