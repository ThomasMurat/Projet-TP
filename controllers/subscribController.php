<?php 
$subscribFormErrors = array();
if(isset($_SESSION['userInfo']) && $_SESSION['userInfo']->role == 'administrateur'){
    $roles = new roles();
    $rolesList = $roles->getRolesList();  
}
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
            $mail = htmlspecialchars($_POST['email']);
            $newUser->mail = $mail;
            if($newUser->checkMailExist()){
                $subscribFormErrors['email'] = 'Cette adresse mail est déjà utilisé';
            }else{
                (isset($_POST['emailConfirm']) && $_POST['emailConfirm'] == $mail )? '': $subscribFormErrors['emailConfirm'] = 'l\'e-mail de confirmation ne correspond pas à votre e-mail';
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
    if(empty($subscribFormErrors)){
        $newUser->subscribDate = date('Y-m-d H:i:s');
        if($newUser->registerNewUser()){
            $message = 'Votre compte a bien été enregistré vous pouvez desormais vous connecter';
        }else{
            $message = 'Une erreur est survenue lors de l\'enregistrement veuillez réessayer ultérieurement. Si le problème persiste veuillez contacter le staff technique';
        }
    }
}
