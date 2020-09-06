<?php
if(isset($_SESSION['userProfile']) && $_SESSION['userProfile']['role'] == 'administrateur'){
    $users = new users();
    $roles = new roles();
    $rolesList = $roles->getRolesList();
    if(isset($_POST['searchUser'])){
        $searchInput = array();
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
        if(!empty($searchInput)){
            $users->getUsersList($searchInput);
        }else{
            $usersList = $users->getUsersList();
        }
    }else{
        $usersList = $users->getUsersList();
    }
}