<?php
if(isset($_SESSION['userProfile']) && $_SESSION['userProfile']['role'] == 'administrateur'){
    $users = new users();
    $roles = new roles();
    $rolesList = $roles->getRolesList();
    //---------------------Vérification des actions----------------------------//
    //---------------------Activation---------------------------------------//
    if(isset($_POST['userActivate']) && !empty($_POST['userId'])){
        $users->id = htmlspecialchars($_POST['userId']);
        $users->statu = 1;
        $users->desactivationDate = null;
        if($users->checkUserValueUnavailability('id')){
            if($users->updateUser(['statu', 'desactivationDate'], 'id')){
                $message = 'Le compte a bien été activé';
            }else {
                $message = 'Le compte n\'a pas pu être activé';
            }
        }
    }
    //--------------------Desactivation-----------------------------------//
    if(isset($_POST['userDesactivate']) && !empty($_POST['userId'])){
        $users->id = htmlspecialchars($_POST['userId']);
        $users->statu = 0;
        $users->desactivationDate = date('Y-m-d H:i:s');
        if($users->checkUserValueUnavailability('id')){
            if($users->updateUser(['statu', 'desactivationDate'], 'id')){
                $message = 'Le compte a bien été desactivé';
            }else {
                $message = 'Le compte n\'a pas pu être desactivé';
            }
        }
    }
    //---------------------Suppression----------------------------//
    if(isset($_POST['userDelete']) && !empty($_POST['userId'])){
        $users->id = htmlspecialchars($_POST['userId']);
        if($users->checkUserValueUnavailability('id')){
            if($users->deleteUser()){
                unlink($users->getUserProfile('id')->image);
                $message = 'Le compte a bien été supprimé';
            }else {
                $message = 'Le compte n\'a pas pu être supprimé';
            }
        }
    }
    //-------------------Fin vérification des actions-------------------//
    
    //-------------------------Paramètres de pagination-----------------------//
    if (isset($_GET['page'])){
        $page = $_GET['page'];
    }else {
        unset($_SESSION['search']['userList']);
        $page = 1;
    }
    $pageParam['limit'] = 10;
    $pageParam['offset'] = ($page - 1) * $pageParam['limit'];
    //------------------------Fin paramètres de pagination-------------------//

    //----------------------------Vérification de la recherche----------------------//
    $searchInput = array();
    if(isset($_POST['searchUser'])){
        if(!empty($_POST['username'])){
            $searchInput['username'] = '%' . htmlspecialchars($_POST['username']) . '%';
        }
        if(!empty($_POST['mail'])){
            $searchInput['mail'] = '%' . htmlspecialchars($_POST['mail']) . '%';
        }
        if(!empty($_POST['age'])){
            $searchInput['birthDate'] = date('Y-m-d', strtotime('-' . htmlspecialchars($_POST['age']) . ' years'));
        }
        if(!empty($_POST['role'])){
            $searchInput['id_42pmz96_roles'] = htmlspecialchars($_POST['role']);
        }
        if(isset($_POST['statu'])){
            $searchInput['statu'] = htmlspecialchars($_POST['statu']);
        }
        //On stock notre tableau de recherche dans un paramètre de session 
        //pour pouvoir y accéder s'il y a plusieurs page de résultats
        $_SESSION['search']['userList'] = $searchInput;
    }
    //------------------------Fin vérification de la recherche-----------------//

    //------------------------Affichage de la liste des utilisateur------------//
    if(!empty($_SESSION['search']['userList'])){
        $usersList = $users->getUsersList($_SESSION['search']['userList'], $pageParam);
        $resultsNb = count($users->getUsersList($_SESSION['search']['userList']));
    }else {
        $usersList = $users->getUsersList($searchInput, $pageParam);
        $resultsNb = count($users->getUsersList($searchInput));
    }
    $pageNb = ceil($resultsNb / $pageParam['limit']);
    //-----------------------Fin de l'affichage de la liste--------------------//
}
