<?php
if(isset($_SESSION['userProfile']) && $_SESSION['userProfile']['role'] == 'administrateur'){ 
    $user = new users();  
    if(!empty($_GET['id'])){
        $user->id = htmlspecialchars($_GET['id']);
        if($user->checkUserValueUnavailability('id')){
            $roles = new roles();
            $rolesList = $roles->getRolesList();          
            $userProfile = $user->getUserProfile('id');
            $inputList = array('username', 'image', 'birthDate', 'mail', 'id_42pmz96_roles');
            $updateUserFormErrors = array();
            if(isset($_POST['updateUser'])) {
                //----------------------Vérification du pseudo------------------//
                if($userProfile->username != $_POST['username']){
                    if(!empty($_POST['username'])){
                        if(strlen($_POST['username']) >= 6){
                            $user->username = htmlspecialchars($_POST['username']);
                        }else{
                            $updateUserFormErrors['username'] = 'Votre pseudo doit contenir au moins 6 caractères';
                        }
                    }else{
                        $updateUserFormErrors['username'] = 'Vous n\'avez pas choisi de pseudo';
                    }
                }else {
                    $user->username = $userProfile->username;
                }
                //----------------------Fin Vérification du pseudo---------------//
            
                //---------------------Vérification de l'image-------------------//
                if (!empty($_FILES['file']) && $_FILES['file']['error'] == 0 && $newUser->username != '') {
                    // On stock dans $fileInfos les informations concernant le chemin du fichier.
                    $fileInfos = pathinfo($_FILES['file']['name']);
                    // On crée un tableau contenant les extensions autorisées.
                    $fileExtension = ['jpg', 'jpeg', 'png', 'svg'];
                    // On verifie si l'extension de notre fichier est dans le tableau des extension autorisées.
                    if (in_array(strtolower($fileInfos['extension']), $fileExtension)) {
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
                            $user->image = $fileFullPath;
                        } else {
                            $updateUserFormErrors['file'] = 'Votre fichier ne s\'est pas téléversé correctement';
                        }
                    } else {
                    $updateUserFormErrors['file'] = 'Votre fichier n\'est pas du format attendu';
                    }
                } else {
                    $user->image = $userProfile->image;
                }
                //-----------------------------Fin vérification image-------------------//
            
                //---------------------Vérification de la date de naissance-------------//
                if(!empty($_POST['birthDate'])){
                    if(validateDate($_POST['birthDate'])){
                        if(birthDateLimit($_POST['birthDate'])){
                            $user->birthDate = htmlspecialchars($_POST['birthDate']);
                        }else {
                            $updateUserFormErrors['birthDate'] = 'Vous devez avoir entre 0 et 100 ans pour vous inscrire';
                        }
                    }else{
                        $updateUserFormErrors['birthDate'] = 'Cette date n\'est pas valide ';
                    }
                }else{
                    $updateUserFormErrors['birthDate'] = 'Vous n\'avez renseigner votre date de naissance';
                }
                //---------------------Fin vérification date de naissance----------------//
            
                //-------------------Vérification du mail-------------------------//
                if($_POST['mail'] != $userProfile->mail){
                    $ismailOk = true;
                    if(!empty($_POST['mail'])){
                        if(!filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)){
                            $updateUserFormErrors['mail'] = 'Adresse mail non valide';
                            $ismailOk = false;
                        }
                    }else {
                        $updateUserFormErrors['mail'] = 'Veuillez renseigner votre adresse mail';
                        $ismailOk = false;
                    }
                    if(empty($_POST['mailConfirm'])){
                        $updateUserFormErrors['mailConfirm'] = 'Vous n\'avez pas confirmé votre adresse mail';
                        $ismailOk = false;
                    }
                    //Si les vérifications des mails sont ok
                    if($ismailOk){
                        if($_POST['mailConfirm'] == $_POST['mail']){
                            //On hash le mot de passe avec la méthode de PHP
                            $user->mail = htmlspecialchars($_POST['mail']);
                        }else{
                            $updateUserFormErrors['mail'] = $updateUserFormErrors['mailConfirm'] = 'Votre adresse mail et l\'adresse mail de confirmation ne correspondes pas';
                        }
                    }
                }else {
                    $user->mail = $userProfile->mail;
                }
                //-------------------Fin vérification du mail----------------------//
            
                
                //---------------------Vérification pour le rôle--------------------//
                if(!empty($_POST['role'])){
                    $roles->id = htmlspecialchars($_POST['role']);
                    if($roles->checkRoleExistByID()){
                        $user->id_42pmz96_roles = $roles->id;
                    }else {
                        $updateUserFormErrors['role'] = 'Le rang choisie n\'existe pas';
                    }
                }else {
                    $user->id_42pmz96_roles = 2;
                }
                //----------------------Fin vérification du rôle---------------------//
            
                //----------------------Validation du formulaire---------------------//
                if(empty($updateUserFormErrors)){
                    $isOk = true;
                    //On vérifie si le pseudo est libre
                    if($userProfile->username != $_POST['username'] && $user->checkUserValueUnavailability()){
                        $updateUserFormErrors['username'] = 'Ce pseudo est déjà utilisé';
                        $isOk = false;
                    }
                    //On vérifie si le mail est libre
                    if($userProfile->mail != $_POST['mail'] && $user->checkUserValueUnavailability('mail')){
                        $updateUserFormErrors['mail'] = 'Ce mail est déjà utilisé';
                        $isOk = false;
                    }
                    //Si c'est bon on ajoute l'utilisateur
                    if($isOk){
                        $user->updateUser($inputList, 'id');
                        $message = 'Le profile a bien été mis à jour';
                    }
                }
            }
        }else {
            $error = 'Cet utilisateur n\'existe pas';
        }  
    }else {
        $error = 'Aucun utilisateur n\'a été sélectionné';
    }
}else {
    $error = 'Vous n\'avez pas le droit d\'accéder à cette page';
}