<?php
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
if(isset($contentList[$_GET['content']])) {
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
            if(password_verify($_POST['password'], $logedUser->password)){

            }else {
                $loginFormErrors['login'] = 'Votre mot de passe ou votre pseudo est incorrect';
            }
        }else {
            $loginFormErrors['login'] = 'Votre mot de passe ou votre pseudo est incorrect'; 
        }
    }else {
        $loginFormErrors['login'] = 'Vous n\'avez pas rempli tous les champs';
    }
}