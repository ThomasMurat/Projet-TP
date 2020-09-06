<?php
if(isset($_SESSION['userProfile'])) {
    $user = new users();
    $user->username = $_SESSION['userProfile']['username'];
    $editProfileFormErrors = array();
    $inputArray = array();

    //---------------------------------Formulaire modification image------------------------------//
    if(isset($_POST['editImage'])){
        if (!empty($_FILES['file']) && $_FILES['file']['error'] == 0) {
            // On stock dans $fileInfos les informations concernant le chemin du fichier.
            $fileInfos = pathinfo($_FILES['file']['name']);
            // On crée un tableau contenant les extensions autorisées.
            $fileExtension = ['jpg', 'jpeg', 'png', 'svg'];
            // On verifie si l'extension de notre fichier est dans le tableau des extension autorisées.
            if (in_array(strtolower($fileInfos['extension']) , $fileExtension)) {
                //On définit le chemin vers lequel uploader le fichier
                $path = 'assets/img/users/';
                //On crée une date pour différencier les fichiers
                $date = date('Y-m-d_H-i-s');
                //On crée le nouveau nom du fichier (celui qu'il aura une fois uploadé)
                $fileNewName = $_SESSION['userProfile']['username'] . '_' . $date;
                //On stocke dans une variable le chemin complet du fichier (chemin + nouveau nom + extension une fois uploadé) Attention : ne pas oublier le point
                $fileFullPath = $path . $fileNewName . '.' . $fileInfos['extension'];
                //move_uploaded_files : déplace le fichier depuis son emplacement temporaire ($_FILES['file']['tmp_name']) vers son emplacement définitif ($fileFullPath)
                if (move_uploaded_file($_FILES['file']['tmp_name'], $fileFullPath)) {
                    //On définit les droits du fichiers uploadé (Ici : écriture et lecture pour l'utilisateur apache, lecture uniquement pour le groupe et tout le monde)
                    chmod($fileFullPath, 0644);
                    $user->image = $fileFullPath;
                    if($user->updateUser(['image'])){
                        unlink($_SESSION['userProfile']['image']);
                        $_SESSION['userProfile']['image'] = $fileFullPath;
                        $message = 'Votre image de profil a bien été mis à jour';
                    }else {
                        $message = 'La mise à jour de votre image de profil a échoué';
                    }
                } else {
                    $editProfileFormErrors['file'] = 'Votre fichier ne s\'est pas téléversé correctement';
                }
            } else {
            $editProfileFormErrors['file'] = 'Votre fichier n\'est pas du format attendu';
            }
        } else {
            $user->image = 'assets/img/iconUser.png';
        }
    }
    //---------------------------------------------------Fin formulaire modification image-----------------------//

    //----------------------------------Formulaire Edition de mail---------------------------------//
    if(isset($_POST['editMail'])){
        $ismailOk = true;
        if(!empty($_POST['mail'])){
            if(!filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)){
                $editProfileFormErrors['mail'] = 'Adresse mail non valide';
                $ismailOk = false;
            }
        }else {
            $editProfileFormErrors['mail'] = 'Veuillez renseigner votre adresse mail';
            $ismailOk = false;
        }
        if(empty($_POST['mailConfirm'])){
            $editProfileFormErrors['mailConfirm'] = 'Vous n\'avez pas confirmé votre adresse mail';
            $ismailOk = false;
        }
        //Si les vérifications des mails sont ok
        if($ismailOk){
            if($_POST['mailConfirm'] == $_POST['mail']){
                //On hash le mot de passe avec la méthode de PHP
                $user->mail = htmlspecialchars($_POST['mail']);
            }else{
                $editProfileFormErrors['mail'] = $editProfileFormErrors['mailConfirm'] = 'Votre adresse mail et l\'adresse mail de confirmation ne correspondes pas';
            }
        }
        if(empty($editProfileFormErrors)){
            if($user->checkUserValueUnavailability('mail')){
                if($user->updateUser(['mail'])){
                    $message = 'Votre mail a bien était mis à jour';
                }else {
                    $message = 'votre mail n\'a pas pu être mis à jour';
                }
            }
        }
    }
    //-----------------------------------Fin formulaire edition de mail--------------------------//

    //-------------------------------Formulaire édition mot de passe-----------------------------//
    if(isset($_POST['editPassword'])) {
        if(!empty($_POST['oldPassword'])){
            if($user->getUserPassword()) {
                $hash = $user->getUserPassword();
                if(!password_verify($_POST['oldPassword'], $hash)){
                    $editProfileFormErrors['oldPassword'] = 'Votre mot de passe actuel n\'est pas bon';
                }
            }else {
                $editProfileFormErrors['oldPassword'] = 'Erreur de récupération du mot de passe';
            }
        }else{
            $editProfileFormErrors['oldPassword'] = 'Vous n\'avez pas renseigné votre mot de passe actuel';
        }
        $isPasswordOk = true;
        if(!empty($_POST['password'])){
            if(strlen($_POST['password']) < 8){
                $editProfileFormErrors['password'] = 'Le mot de passe doit contenir au moins 8 caractères';
            }
        }else{
            $editProfileFormErrors['password'] = 'Veuillez renseigner votre mot de passe';
            $isPasswordOk = false;
        }
        if(empty($_POST['passwordConfirm'])){
            $editProfileFormErrors['passwordConfirm'] = 'Vous n\'avez pas confirmé votre mot de passe';
            $isPasswordOk = false;
        }
        //Si les vérifications des mots de passe sont ok
        if($isPasswordOk){
            if($_POST['passwordConfirm'] == $_POST['password']){
                //On hash le mot de passe avec la méthode de PHP
                $user->password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            }else{
                $editProfileFormErrors['password'] = $editProfileFormErrors['passwordConfirm'] = 'Votre mot de passe et le mot de passe de confirmation ne correspondes pas';
            }
        }
        if(empty($editProfileFormErrors)) {
            if($user->updateUser(['password'])) {
                $message = 'votre mot de passe a bien été mis à jour';
            }else {
                $message = 'Votre mot de passe n\'a pas pu être mis à jour';
            }
        }
    }
    //---------------------------------Fin formulaire éfition mot de passe------------------------//
}