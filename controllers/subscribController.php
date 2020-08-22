<?php 
$nameRegex = '%^([\p{L}][^0-9]){1}[\' \-\p{L}]+$%';
$passwordRegex = '%^[0-9a-zA-Z]+$%';
$subscribFormErrors = array();
if(isset($_POST['postSubscribe'])) {
    $newUser = new users();
    if(!empty($_POST['pseudo'])){
        if(preg_match($nameRegex,$_POST['pseudo'])){
            $newUser->username = htmlspecialchars($_POST['pseudo']);
            ($newUser->checkUserExist()) ? $subscribFormErrors['pseudo'] = 'Ce pseudo est déjà utilisé': '';
        }else{
            $subscribFormErrors['pseudo'] = 'Votre pseudo doit être de la forme : ';
        }
    }else{
        $subscribFormErrors['pseudo'] = 'Vous n\'avez pas choisi de pseudo';
    }
    if(!empty($_POST['birthDate'])){
        if(validateDate($_POST['birthDate'])){
            $newUser->birthDate = htmlspecialchars($_POST['birthDate']);
        }else{
            $subscribFormErrors['birthDate'] = 'Cette date n\'est pas valide ';
        }
    }else{
        $subscribFormErrors['birthDate'] = 'Vous n\'avez renseigner votre date de naissance';
    }
    if(!empty($_POST['email'])){
        if(filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
            $email = htmlspecialchars($_POST['email']);
            $newUser->mail = $email;
            if($newUser->checkMailExist()){
                $subscribFormErrors['email'] = 'Cette adresse mail est déjà utilisé';
            }else{
                (isset($_POST['emailConfirm']) && $_POST['emailConfirm'] == $email )? '': $subscribFormErrors['emailConfirm'] = 'l\'e-mail de confirmation ne correspond pas à votre e-mail';
            }
        }else{
            $subscribFormErrors['email'] = 'Cette adresse n\'est pas valide ';
        }
    }else{
        $subscribFormErrors['email'] = 'Vous n\'avez indiqué votre adresse e-mail';
    }
    if(!empty($_POST['password'])){
        if(preg_match($passwordRegex,$_POST['password'])){
            $password = htmlspecialchars($_POST['password']);
            if(isset($_POST['passwordConfirm']) && $_POST['passwordConfirm'] == $password){
                $newUser->password = password_hash($password, PASSWORD_DEFAULT);
            }else {
                $subscribFormErrors['passwordConfirm'] = 'Le mot de passe de confirmation ne correspond pas à votre mot de passe';
            }
        }else{
            $subscribFormErrors['password'] = 'Votre mot de passe doit être de la forme : ';
        }
    }else{
        $subscribFormErrors['password'] = 'Vous n\'avez pas choisi de mot de passe';
    }
    if(count($subscribFormErrors) == 0){
        $newUser->subscribDate = date('Y-m-d H:i:s');
        if($newUser->registerNewUser()){
            $message = 'Votre compte a bien été enregistré vous pouvez desormais vous connecter';
        }else{
            $message = 'Une erreur est survenue lors de l\'enregistrement veuillez réessayer ultérieurement. Si le problème persiste veuillez contacter le staff technique';
        }
    }
}