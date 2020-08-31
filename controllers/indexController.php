<?php
//----------------PARTIE GERANT LES PARAMETRE GLOBAUX----------------------//
$nameRegex = '%^([\p{L}\-0-9]){8,}$%';
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
    $header = 'views/' . $universe . 'Header.php'; // $header contient le liens vers le fichier header de l'univers sélectionner.
}else {
    $universe = 'global';
    $header = 'views/mangaHeader.php';
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
    include_once '../models/users.php';
}

//----------------------Vérification du formulaire de connexion
//On vérifie qu'une demanda de connexion a été envoyé
if(isset($_POST['login'])){
    // on crée une instance de la classe users pour utilisé ses méthodes permettant de faire le liens avec la DB
    $logedUser = new users(); 
    if(!empty($_POST['username']) && !empty($_POST['password'])){ 
        //On stock le pseudo envoyé dans l'attribut username pour appellé la méthode permettant de vérifier son existance
        $logedUser->username = htmlspecialchars($_POST['username']);
        if($logedUser->checkUserExist()){
            // Si le pseudo existe on récupére le pw hashé de la DB à fin de le comparer au pw envoyer
            if($logedUser->getUserPassword()) {
                $password = $logedUser->getUserPassword();
                if(password_verify($_POST['password'], $password->password)){ ?>
                    <p>Vous êtes connecté</p><?php
                    unset($_SESSION['logedIn']);
                    unset($_SESSION['userInfo']);
                    $_SESSION['logedIn'] = TRUE;
                    $_SESSION['userInfo'] = $logedUser->getUserInfoByUsername();
                }else { ?>
                    <p>Votre mot de passe ou votre pseudo est incorrect</p><?php
                }
            }else { ?>
                <p>Erreur de récupération du mot de passe</p><?php
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
    session_destroy();
    header('Location:' . $link);
    exit; 
}
//-----------------------FIN DE PARTIE---------------------------------------//