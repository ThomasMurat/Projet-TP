<?php
if(isset($_SESSION['userProfile']) && $_SESSION['userProfile']['role'] == 'administrateur'){ 
    $presentation = new presentations();
    $licenses = new licenses();  
    if(!empty($_GET['id'])){
        $presentation->id = htmlspecialchars($_GET['id']);
        if($presentation->checkPresentationValueUnavailability()){          
            $presentationProfile = $presentation->getLicenseProfile();
            $licenses->id = $presentationProfile->id_42pmz96_licenses;
            $updatelicenseFormErrors = array();
            if(isset($_POST['updatelicense'])) {
                //----------------------Vérification du titre------------------//
                if($presentationProfile->name != $_POST['name']){
                    if(!empty($_POST['name'])){
                        $licenses->name = htmlspecialchars($_POST['name']);
                    }else{
                        $updatelicenseFormErrors['name'] = 'Vous n\'avez pas choisi de titre';
                    }
                }else {
                    $licenses->name = $presentationProfile->name;
                }
                //----------------------Fin Vérification du titre---------------//
            
                //---------------------Vérification de l'image-------------------//
                if (!empty($_FILES['file']) && $_FILES['file']['error'] == 0 && $newpresentation->presentationname != '') {
                    // On stock dans $fileInfos les informations concernant le chemin du fichier.
                    $fileInfos = pathinfo($_FILES['file']['name']);
                    // On crée un tableau contenant les extensions autorisées.
                    $fileExtension = ['jpg', 'jpeg', 'png', 'svg'];
                    // On verifie si l'extension de notre fichier est dans le tableau des extension autorisées.
                    if (in_array(strtolower($fileInfos['extension']), $fileExtension)) {
                        //On définit le chemin vers lequel uploader le fichier
                        $path = 'assets/img/' . $presentation->universe . '/licenses/';
                        //On crée une date pour différencier les fichiers
                        $date = date('Y-m-d_H-i-s');
                        //On crée le nouveau nom du fichier (celui qu'il aura une fois uploadé)
                        $fileNewName = $presentation->name . '_' . $date;
                        //On stocke dans une variable le chemin complet du fichier (chemin + nouveau nom + extension une fois uploadé) Attention : ne pas oublier le point
                        $fileFullPath = $path . $fileNewName . '.' . $fileInfos['extension'];
                        //move_uploaded_files : déplace le fichier depuis son emplacement temporaire ($_FILES['file']['tmp_name']) vers son emplacement définitif ($fileFullPath)
                        if (move_uploaded_file($_FILES['file']['tmp_name'], $fileFullPath)) {
                            //On définit les droits du fichiers uploadé (Ici : écriture et lecture pour l'utilisateur apache, lecture uniquement pour le groupe et tout le monde)
                            chmod($fileFullPath, 0644);
                            $presentation->image = $fileFullPath;
                            unlink($presentationProfile->image);
                        } else {
                            $updatelicenseFormErrors['file'] = 'Votre fichier ne s\'est pas téléversé correctement';
                        }
                    } else {
                    $updatelicenseFormErrors['file'] = 'Votre fichier n\'est pas du format attendu';
                    }
                } else {
                    $presentation->image = $presentationProfile->image;
                }
                //-----------------------------Fin vérification image-------------------//
            
                //---------------------Vérification de la date de création-------------//
                if(!empty($_POST['creationDate'])){
                    if(validateDate($_POST['creationDate'])){
                        $licenses->creationDate = htmlspecialchars($_POST['creationDate']);
                    }else{
                        $updatelicenseFormErrors['creationDate'] = 'Cette date n\'est pas valide ';
                    }
                }else{
                    $updatelicenseFormErrors['creationDate'] = 'Vous n\'avez pas renseigner la date de création';
                }
                //---------------------Fin vérification date de création----------------//
            
                //-------------------Vérification de la presentation-------------------------//
                if($presentationProfile->presentation != $_POST['presentation'])
                    if(!empty($_POST['presentation'])){
                        $presentation->presentation = htmlspecialchars($_POST['presentation']);
                    }else {
                        $updatelicenseFormErrors['presentation'] = 'Veuillez renseigner une description';
                    }
                else {
                    $presentation->presentation = $presentationProfile->presentation;
                }
                //-------------------Fin vérification du mail----------------------//
            
                //----------------------Validation du formulaire---------------------//
                var_dump($updatelicenseFormErrors);
                if(empty($updatelicenseFormErrors)){
                    if($presentationProfile->name != $_POST['name'] && $licenses->checkLicensesValueUnavailability('name')){
                        $updatelicenseFormErrors['name'] = 'Ce titre existe déjà';
                    }else{
                        $transaction = new transaction();
                        try {
                            var_dump($updatelicenseFormErrors);
                            $transaction->beginTransaction();
                            $presentation->updatePresentation();
                            $licenses->updateLicense();
                            $transaction->commit();
                            $message = 'Le profile a bien été mis à jour';
                        }catch(Exception $e) {
                            $transaction->rollBack();
                        }
                    }
                }
                //--------------------Fin Validation-------------------------------//
            }
        }else {
            $error = 'Cet Licenses n\'existe pas';
        }  
    }else {
        $error = 'Aucune License n\'a été sélectionnée';
    }
}else {
    $error = 'Vous n\'avez pas le droit d\'accéder à cette page';
}