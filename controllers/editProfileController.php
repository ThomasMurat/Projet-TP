<?php
if(isset($_SESSION['userProfile'])) {
    $user = new users();
    $user->username = $_SESSION['userProfile']['username'];
    $editProfileFormErrors = array();
    $inputArray = array();

    //---------------------------------Formulaire modification image------------------------------//
    if(isset($_POST['editImage'])){
        //-------------------------Vérification de l'image---------------------------//
        if (!empty($_FILES['file']) && $_FILES['file']['error'] == 0) {
            $fileInfos = pathinfo($_FILES['file']['name']);
            $fileExtension = ['jpg', 'jpeg', 'png', 'svg'];
            if (in_array(strtolower($fileInfos['extension']) , $fileExtension)) {
                $path = 'assets/img/users/';
                $date = date('Y-m-d_H-i-s');
                $fileNewName = $_SESSION['userProfile']['username'] . '_' . $date;
                $fileFullPath = $path . $fileNewName . '.' . $fileInfos['extension'];
                if (move_uploaded_file($_FILES['file']['tmp_name'], $fileFullPath)) {
                    chmod($fileFullPath, 0644);
                    $user->image = $fileFullPath;
                } else {
                    $editProfileFormErrors['file'] = 'Votre fichier ne s\'est pas téléversé correctement.';
                }
            } else {
            $editProfileFormErrors['file'] = 'Les fomats autorisés sont jpg,jpeg,png ou svg.';
            }
        } else {
            $user->image = 'assets/img/iconUser.png';
        }
        //---------------------------Fin vérification de l'image-------------------//
        
        //---------------------------Validation du formulaire----------------------//
        if(empty($editProfileFormErrors)){
            if($user->updateUser(['image'])){
                if($_SESSION['userProfile']['image'] != 'assets/img/iconUser.png'){
                    unlink($_SESSION['userProfile']['image']);
                }
                $_SESSION['userProfile']['image'] = $user->image;
                $message = 'Votre image de profil a bien été mis à jour.';
            }else {
                if($user->image != 'assets/img/iconUser.png'){
                    unlink($user->image); 
                }
                $message = 'La mise à jour de votre image de profil a échoué.';
                
            }         
        }
        //-------------------------Fin validation du formulaire--------------------//
    }
    //------------------------Fin formulaire modification image------------------------------------//

    //----------------------------------Formulaire Edition de mail---------------------------------//
    if(isset($_POST['editMail'])){
        $ismailOk = true;
        //--------------------Vérification du mail--------------------//
        if(!empty($_POST['mail'])){
            if(!filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)){
                $editProfileFormErrors['mail'] = 'Adresse mail non valide.';
                $ismailOk = false;
            }
        }else {
            $editProfileFormErrors['mail'] = 'Veuillez renseigner votre adresse mail.';
            $ismailOk = false;
        }
        //-------------------Fin vérification du mail------------------//

        //--------------------Vérification du mail de confirmation--------------------//
        if(empty($_POST['mailConfirm'])){
            $editProfileFormErrors['mailConfirm'] = 'Vous n\'avez pas confirmé votre adresse mail.';
            $ismailOk = false;
        }
        //-------------------Fin vérification mail de confirmation--------------------//

        //------------------Vérification correspondance des mails---------------------//
        if($ismailOk){
            if($_POST['mailConfirm'] == $_POST['mail']){
                $user->mail = htmlspecialchars($_POST['mail']);
            }else{
                $editProfileFormErrors['mail'] = $editProfileFormErrors['mailConfirm'] = 'Votre adresse mail et l\'adresse mail de confirmation ne correspondes pas.';
            }
        }
        //-----------------------Fin vérification des mails--------------------------//

        //-----------------------Validation du formulaire----------------------------//
        if(empty($editProfileFormErrors)){
            if($user->checkUserValueUnavailability('mail')){
                if($user->updateUser(['mail'])){
                    $message = 'Votre mail a bien était mis à jour.';
                    $_SESSION['userProfile']['mail'] = $user->mail;
                }else {
                    $message = 'votre mail n\'a pas pu être mis à jour.';
                }
            }
        }
        //---------------------Fin validation du formulaire--------------------------//
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