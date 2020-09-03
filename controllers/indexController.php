<?php
//----------------PARTIE GERANT LES PARAMETRE GLOBAUX----------------------//
$nameRegex = '%^([\p{L}\-0-9]){6,}$%';
$passwordRegex = '%^[0-9a-zA-Z]+$%';
//fonction permettant de vérifié la validité d'une date. à utiliser dans les vérification des différents formulaires.
function validateDate($date, $format = 'Y-m-d'){
    $dt = DateTime::createFromFormat($format, $date);
    return $dt && $dt->format($format) === $date;
}

//----------------------FIN DE PARTIE--------------------------------//

//---------------PARTIE GERANT LA NAVIGATION---------------//
//----Liste des univers:
$univerList = array('manga', 'anime');
//----Liste des pages: nom du fichier => nom d'affichage
$contentList = array('subscrib' => 'Inscription', 'welcome' => 'Bienvenue', 'productList' => 'Liste des Oeuvres', 'producerList' => 'Liste des auteurs', 'profile' => 'Mon Profil', 'discover' => 'Liste Découverte', 'news' => 'Actualités', 'editProfile' => 'Modifier Mon Profil'
                    ,'usersList' => 'Liste des Utilisateurs');

// On définit l'univer dans lequel l'utilisateur se trouve pour définir quel header doit être inclut.
if(isset($_GET['universe']) && in_array($_GET['universe'], $univerList)) {
    $universe = htmlspecialchars($_GET['universe']);  // $universe contient le nom de l'univers sélectionner.
}else {
    $universe = 'global';
} 

// On cherche ensuite quel page est demandé pour déterminé quel contenue(vue) doit être inclut.
if(isset($_GET['content']) && isset($contentList[$_GET['content']])) {
    $contentName = htmlspecialchars($_GET['content']); // $contentName contient le nom de fichier(sans l'extention) correspondant au contenue(vue) sélectionné.
    $title = $contentList[$contentName];  // $title contient le nom d'affichage(titre) associé au contenue(vue) sélectionné.
}else {
    $contentName = 'welcome';
    $title = 'Bienvenue';
}

$content = 'views/' . $contentName . '.php'; // $content contient le liens vers le fichier correspondant au contenue sélectionné.
$link = 'index.php?universe=' . $universe . '&content=' . $contentName; // $link contient le lien vers la page sélectionné
//-----------------FIN DE PARTIE------------------//

//-------------------------PARTIE GERANT LA CONNEXION----------------------//

// inclusion du model et lancement de session pour la requête faite directement au controlleur avec la fonction ajax sendLogin().
if(isset($_POST['login'])){
    session_start();
    include_once '../models/dataBase.php';
    include_once '../models/users.php';
}

//----------------------Vérification du formulaire de connexion
//On vérifie qu'une demanda de connexion a été envoyé
if(isset($_POST['login'])){
    $user = new users();
    $formErrors = array();
    if(!empty($_POST['username'])){
        //J'hydrate mon instance d'objet user
        $user->username = htmlspecialchars($_POST['username']);
    }else{
        $formErrors['username'] = 'Veuillez renseigner votre pseudo';
    }
    if(empty($_POST['password'])){        
        $formErrors['password'] = 'Veuillez renseigner votre mot de passe';
    }
    if(empty($formErrors)){
        //On récupère le hash de l'utilisateur
       $hash = $user->getUserPassword();
       //Si le hash correspond au mot de passe saisi
       if(password_verify($_POST['password'], $hash)){
           //On récupère son profil
            $userProfile = $user->getUserProfile();
            //On met en session ses informations
            $_SESSION['userProfile']['id'] = $userProfile->userId;
            $_SESSION['userProfile']['username'] = $userProfile->username;
            $_SESSION['userProfile']['mail'] = $userProfile->mail;
            $_SESSION['userProfile']['birthDate'] = $userProfile->birthDate;
            $_SESSION['userProfile']['subscribDate'] = $userProfile->subscribDate;
            $_SESSION['userProfile']['image'] = $userProfile->image;
            $_SESSION['userProfile']['role'] = $userProfile->role;
       }else{
           $formErrors['password'] = $formErrors['username'] = 'Votre mail ou votre mot de passe est incorrect';
       }
    } ?>
    <p><?= isset($formErrors['password']) ? $formErrors['password'] : 'Vous êtes bien connecté'; ?></p>
    <button type="button" class="btn btn-danger" onclick="location.reload();" data-dismiss="modal">fermer</button><?php
}

//Vérification du formulaire de Déconnexion
if(isset($_GET['logOut'])){
    session_destroy();
    header('Location:' . $link);
    exit; 
}

//-----------------------FIN DE PARTIE---------------------------------------//