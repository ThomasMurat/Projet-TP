<?php 
$nameRegex = '%^([\p{L}][^0-9]){1}[\' \-\p{L}]+$%';
$passwordRegex = '%^[0-9]+$%';
$subscribFormErrors = array();
if(isset($_POST['postSubscribe'])) {
    if(!empty($_POST['pseudo'])){
        if(preg_match($nameRegex,$_POST['pseudo'])){
            $pseudo = htmlspecialchars($_POST['pseudo']);
        }else{
            $subscribFormErrors['pseudo'] = 'Votre pseudo doit être de la forme : ';
        }
    }else{
        $subscribFormErrors['pseudo'] = 'Vous n\'avez pas choisi de pseudo';
    }
    if(!empty($_POST['email'])){
        if(filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
            $email = htmlspecialchars($_POST['email']);
        }else{
            $subscribFormErrors['email'] = 'Votre pseudo doit être de la forme : ';
        }
    }else{
        $subscribFormErrors['email'] = 'Vous n\'avez indiqué votre adresse e-mail';
    }
    if(!empty($_POST['emailConfirm'])){
        if(filter_var($_POST['emailConfirm'],FILTER_VALIDATE_EMAIL)){
            $emailConfirm = htmlspecialchars($_POST['emailConfirm']);
            if(!empty($_POST['email']) && $_POST['email'] != $_POST['emailConfirm']) {
                $subscribFormErrors['emailConfirm'] = 'l\'e-mail de confirmation ne correspond pas à votre e-mail';
            }
        }else{
            $subscribFormErrors['emailConfirm'] = 'Votre e-mail n\'est pas valide. ';
        }
    }else{
        $subscribFormErrors['emailConfirm'] = 'Veuillez confirmer votre adresse e-mail';
    }
    if(!empty($_POST['password'])){
        if(preg_match($passwordRegex,$_POST['password'])){
            $password = htmlspecialchars($_POST['password']);
        }else{
            $subscribFormErrors['password'] = 'Votre mot de passe doit être de la forme : ';
        }
    }else{
        $subscribFormErrors['password'] = 'Vous n\'avez pas choisi de mot de passe';
    }
    if(!empty($_POST['passwordConfirm'])){
        if(preg_match($passwordRegex,$_POST['passwordConfirm'])){
            $passwordConfirm = htmlspecialchars($_POST['passwordConfirm']);
            if(!empty($_POST['password']) && $_POST['password'] != $_POST['passwordConfirm']) {
                $subscribFormErrors['passwordConfirm'] = 'Le mot de passe de confirmation ne correspond pas à votre mot de passe';
            }
        }else{
            $subscribFormErrors['passwordConfirm'] = 'Votre pseudo doit être de la forme : ';
        }
    }else{
        $subscribFormErrors['passwordConfirm'] = 'Veuillez confirmer votre mot de passe';
    }
}