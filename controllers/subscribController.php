<?php 
$subscribFormErrors = array();
if(isset($_SESSION['userProfile']) && $_SESSION['userProfile']['role'] == 'administrateur'){
    $roles = new roles();
    $rolesList = $roles->getRolesList();  
}
if(isset($_POST['field'])){
    include '../models/dataBase.php';
    include '../models/users.php';
    function validateDate($date, $format = 'Y-m-d'){
        $dt = DateTime::createFromFormat($format, $date);
        return $dt && $dt->format($format) === $date;
    }
}
if(isset($_POST['postSubscribe'])) {
    $newUser = new users();
    //----------------------Vérification du pseudo------------------//
    if(!empty($_POST['username'])){
        if(strlen($_POST['username']) >= 6){
            $newUser->username = htmlspecialchars($_POST['username']);
        }else{
            $subscribFormErrors['username'] = 'Votre pseudo doit contenir au moins 6 caractères';
        }
    }else{
        $subscribFormErrors['username'] = 'Vous n\'avez pas choisi de pseudo';
    }
    //----------------------Fin Vérification du pseudo---------------//

    //---------------------Vérification de l'image-------------------//
    if (!empty($_FILES['file']) && $_FILES['file']['error'] == 0 && $newUser->username != '') {
        // On stock dans $fileInfos les informations concernant le chemin du fichier.
        $fileInfos = pathinfo($_FILES['file']['name']);
        // On crée un tableau contenant les extensions autorisées.
        $fileExtension = ['jpg', 'jpeg', 'png', 'svg'];
        // On verifie si l'extension de notre fichier est dans le tableau des extension autorisées.
        if (in_array($fileInfos['extension'], $fileExtension)) {
            //On définit le chemin vers lequel uploader le fichier
            $path = 'assets/img/users/';
            //On crée une date pour différencier les fichiers
            $date = date('Y-m-d_H-i-s');
            //On crée le nouveau nom du fichier (celui qu'il aura une fois uploadé)
            $fileNewName = $newUser->username . '_' . $date;
            //On stocke dans une variable le chemin complet du fichier (chemin + nouveau nom + extension une fois uploadé) Attention : ne pas oublier le point
            $fileFullPath = $path . $fileNewName . '.' . $fileInfos['extension'];
            //move_uploaded_files : déplace le fichier depuis son emplacement temporaire ($_FILES['file']['tmp_name']) vers son emplacement définitif ($fileFullPath)
            if (move_uploaded_file($_FILES['file']['tmp_name'], $fileFullPath)) {
                //On définit les droits du fichiers uploadé (Ici : écriture et lecture pour l'utilisateur apache, lecture uniquement pour le groupe et tout le monde)
                chmod($fileFullPath, 0644);
                $newUser->image = $fileFullPath;
            } else {
                $subscribFormErrors['file'] = 'Votre fichier ne s\'est pas téléversé correctement';
            }
        } else {
        $subscribFormErrors['file'] = 'Votre fichier n\'est pas du format attendu';
        }
    } else {
        $newUser->image = 'assets/img/iconUser.png';
    }
    //-----------------------------Fin vérification image-------------------//

    //---------------------Vérification de la date de naissance-------------//
    if(!empty($_POST['birthDate'])){
        if(validateDate($_POST['birthDate'])){
            $newUser->birthDate = htmlspecialchars($_POST['birthDate']);
        }else{
            $subscribFormErrors['birthDate'] = 'Cette date n\'est pas valide ';
        }
    }else{
        $subscribFormErrors['birthDate'] = 'Vous n\'avez renseigner votre date de naissance';
    }
    //---------------------Fin vérification date de naissance----------------//

    //-------------------Vérification du mail-------------------------//
    $ismailOk = true;
    if(!empty($_POST['mail'])){
        if(!filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)){
            $subscribFormErrors['mail'] = 'Adresse mail non valide';
            $ismailOk = false;
        }
    }else {
        $subscribFormErrors['mail'] = 'Veuillez renseigner votre adresse mail';
        $ismailOk = false;
    }
    if(empty($_POST['mailConfirm'])){
        $subscribFormErrors['mailConfirm'] = 'Vous n\'avez pas confirmé votre adresse mail';
        $ismailOk = false;
    }
    //Si les vérifications des mails sont ok
    if($ismailOk){
        if($_POST['mailConfirm'] == $_POST['mail']){
            //On hash le mot de passe avec la méthode de PHP
            $newUser->password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        }else{
            $subscribFormErrors['mail'] = $subscribFormErrors['mailConfirm'] = 'Votre adresse mail et l\'adresse mail de confirmation ne correspondes pas';
        }
    }
    //-------------------Fin vérification du mail----------------------//

    //-----------------Vérification pour le mot de passe---------------//
    $isPasswordOk = true;
    if(!empty($_POST['password'])){
        if(strlen($_POST['password']) < 8){
            $subscribFormErrors['password'] = 'Le mot de passe doit contenir au moins 8 caractères';
        }
    }else{
        $subscribFormErrors['password'] = 'Veuillez renseigner votre mot de passe';
        $isPasswordOk = false;
    }
    if(empty($_POST['passwordConfirm'])){
        $subscribFormErrors['passwordConfirm'] = 'Vous n\'avez pas confirmé votre mot de passe';
        $isPasswordOk = false;
    }
    //Si les vérifications des mots de passe sont ok
    if($isPasswordOk){
        if($_POST['passwordConfirm'] == $_POST['password']){
            //On hash le mot de passe avec la méthode de PHP
            $newUser->password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        }else{
            $subscribFormErrors['password'] = $subscribFormErrors['passwordConfirm'] = 'Votre mot de passe et le mot de passe de confirmation ne correspondes pas';
        }
    }
    //---------------------Fin vérification du mot de passe-------------//

    //---------------------Vérification pour le rôle--------------------//
    if(!empty($_POST['role'])){
        $roles->id = htmlspecialchars($_POST['role']);
        if($roles->checkRoleExistByID()){
            $newUser->id_42pmz96_roles = $roles->id;
        }else {
            $subscribFormErrors['role'] = 'Le rang choisie n\'existe pas';
        }
    }else {
        $newUser->id_42pmz96_roles = 2;
    }
    //----------------------Fin vérification du rôle---------------------//

    //----------------------Validation du formulaire---------------------//
    if(empty($subscribFormErrors)){
        $newUser->subscribDate = date('Y-m-d H:i:s');
        $isOk = true;
        //On vérifie si le pseudo est libre
        if($newUser->checkUserValueUnavailability()){
            $subscribFormErrors['username'] = 'Ce pseudo est déjà utilisé';
            $isOk = false;
        }
        //On vérifie si le mail est libre
        if($newUser->checkUserValueUnavailability('mail')){
            $subscribFormErrors['mail'] = 'Ce mail est déjà utilisé';
            $isOk = false;
        }
        //Si c'est bon on ajoute l'utilisateur
        if($isOk){
            $newUser->addUser();
        }
    }
    //----------------------Fin de validation----------------------------//

    //--------------------------AJAX----------------------------//
    if(isset($_POST['field'])){
        $field = $_POST['field'];
        $newUser->$field = $_POST[$_POST['field']];
        if($_POST['field'] == 'username' && $newUser->checkUserValueUnavailability()){
            $subscribFormErrors['username'] = 'Ce pseudo est déjà utilisé';
        }
        //On vérifie si le mail est libre
        if($_POST['field'] == 'mail' && $newUser->checkUserValueUnavailability('mail')){
            $subscribFormErrors['mail'] = 'Ce mail est déjà utilisé';
        } 
        if(isset($subscribFormErrors[$_POST['field']])){
            echo $subscribFormErrors[$_POST['field']];
        }
    }
    //----------------------FIN AJAX-----------------------------//
}
