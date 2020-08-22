<?php

if(isset($_POST['login'])){
    session_start();
    include_once '../models/users.php';
}
$univerList = array('manga', 'anime');
$contentList = array('subscrib' => 'inscription', 'welcome' => 'Bienvenue', 'productList' => 'Liste des Oeuvres', 'producerList' => 'Liste des auteurs');
// On définit l'univer dans lequel l'utilisateur se trouve pour définir quel header doit être inclut.
if(isset($_GET['universe']) && in_array($_GET['universe'], $univerList)) {
    $universe = htmlspecialchars($_GET['universe']);
    $header = 'views/' . $universe . 'Header.php';
}else {
    $universe = 'global';
    $header = 'views/mangaHeader.php';
} 

// On cherche à savoir quel page est demandé par l'utilisateur pour l'inclure dans la page index.php.
if(isset($_GET['content']) && isset($contentList[$_GET['content']])) {
    $contentName = htmlspecialchars($_GET['content']);
    $title = $contentList[$contentName]; 
}else {
    $contentName = 'welcome';
    $title = 'Bienvenue';
}
$content = 'views/' . $contentName . '.php';

//fonction permettant de vérifié la validité d'une date. à utiliser dans les vérification des différents formulaires.
function validateDate($date, $format = 'Y-m-d'){
    $dt = DateTime::createFromFormat($format, $date);
    return $dt && $dt->format($format) === $date;
}

//Vérification du formulaire de connexion
$loginFormErrors = array();
if(isset($_POST['login'])){
    $logedUser = new users();
    if(!empty($_POST['username']) && !empty($_POST['password'])){
        $logedUser->username = htmlspecialchars($_POST['username']);
        if($logedUser->checkUserExist()){
            $logedUser->getUserPassword();
            if(password_verify($_POST['password'], $logedUser->password)){ ?>
                <p>Vous êtes connecté</p><?php
                unset($_SESSION['logedIn']);
                $_SESSION['logedIn'] = 1;
                $_SESSION['username'] = $logedUser->username;
            }else { ?>
                <p>Votre mot de passe ou votre pseudo est incorrect</p><?php
            }
        }else { ?>
            <p>Votre mot de passe ou votre pseudo est incorrect</p><?php
        }
    }else { ?>
        <p>Vous n\'avez pas rempli tous les champs</p><?php
    } ?>
    <button type="button" class="btn btn-danger" onclick="location.reload();" data-dismiss="modal">fermer</button><?php
}

//Vérification du formulaire de Déconnexion
if(isset($_GET['logOut'])){
    unset($_SESSION['logedIn']);
    $_SESSION['logedIn'] = 0;
}