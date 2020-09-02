<?php
if(isset($_SESSION['logedIn']) && $_SESSION['logedIn']) {
    $user = new users();
    $user->username = $_SESSION['userInfo']->username;
    $editProfileFormErrors = array();
}

if(isset($_POST['editImage'])){
    if (!empty($_FILES['file']) && $_FILES['file']['error'] == 0) {
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
            $fileNewName = $_SESSION['userInfo']->username . '_' . $date;
            //On stocke dans une variable le chemin complet du fichier (chemin + nouveau nom + extension une fois uploadé) Attention : ne pas oublier le point
            $fileFullPath = $path . $fileNewName . '.' . $fileInfos['extension'];
            //move_uploaded_files : déplace le fichier depuis son emplacement temporaire ($_FILES['file']['tmp_name']) vers son emplacement définitif ($fileFullPath)
            if (move_uploaded_file($_FILES['file']['tmp_name'], $fileFullPath)) {
                //On définit les droits du fichiers uploadé (Ici : écriture et lecture pour l'utilisateur apache, lecture uniquement pour le groupe et tout le monde)
                chmod($fileFullPath, 0644);
                $inputArray['image'] = $fileFullPath;
                if($user->updateUserByUsername($inputArray)){
                    unlink($_SESSION['userInfo']->image);
                    $_SESSION['userInfo']->image = $fileFullPath;
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

if(isset($_POST['editMail'])){
    if(!empty($_POST['email'])){
        if(filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
            $inputArray['mail'] = htmlspecialchars($_POST['email']);
            if($user->checkMailExist()){
                $editProfileFormErrors['email'] = 'Cette adresse mail est déjà utilisé';
            }else{
                if(isset($_POST['emailConfirm']) && $_POST['emailConfirm'] == $inputArray['mail'] ){
                    if($user->updateUserByUsername($inputArray)) {
                        $_SESSION['userInfo']->mail = $inputArray['mail'];
                        $message = 'Votre adresse mail a bien été mis à jour';
                    }else {
                        $message = 'Votre adresse mail n\'a pas pu être mis à jour';
                    }
                 }else { 
                    $editProfileFormErrors['emailConfirm'] = 'l\'e-mail de confirmation ne correspond pas à votre e-mail';
                 }
            }
        }else{
            $editProfileFormErrors['email'] = 'Cette adresse n\'est pas valide ';
        }
    }else{
        $editProfileFormErrors['email'] = 'Vous n\'avez indiqué votre adresse e-mail';
    }
}

if(isset($_POST['editPassword'])) {
    if(!empty($_POST['oldPassword'])){
        if($user->getUserPassword()) {
            $oldPassword = $user->getUserPassword();
            if(!password_verify($_POST['oldPassword'], $oldPassword->password)){
                $editProfileFormErrors['oldPassword'] = 'Votre mot de passe actuel n\'est pas bon';
            }
        }else {
            $editProfileFormErrors['oldPassword'] = 'Erreur de récupération du mot de';
        }
    }else{
        $editProfileFormErrors['oldPassword'] = 'Vous n\'avez pas renseigné votre mot de passe actuel';
    }
    if(!empty($_POST['password'])){
        if(preg_match($passwordRegex,$_POST['password'])){
            $password = htmlspecialchars($_POST['password']);
            if(isset($_POST['passwordConfirm']) && $_POST['passwordConfirm'] == $password){
                $inputArray['password'] = password_hash($password, PASSWORD_DEFAULT);
            }else {
                $editProfileFormErrors['passwordConfirm'] = 'Le mot de passe de confirmation ne correspond pas à votre mot de passe';
            }
        }else{
            $editProfileFormErrors['password'] = 'Votre mot de passe doit être de la forme : ';
        }
    }else{
        $editProfileFormErrors['password'] = 'Vous n\'avez pas choisi de mot de passe';
    }
    if(empty($editProfileFormErrors)) {
        if($user->updateUserByUsername($inputArray)) {
            $message = 'votre mot de passe a bien été mis à jour';
        }else {
            $message = 'Votre mot de passe n\'a pas pu être mis à jour';
        }
    }
}