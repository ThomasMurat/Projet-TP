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
                        if($licenses->checkLicensesValueUnavailability('name')){
                            $updatelicenseFormErrors['name'] = 'Ce titre est déjà utilisé';
                        }
                    }else{
                        $updatelicenseFormErrors['name'] = 'Vous n\'avez pas choisi de titre';
                    }
                }else {
                    $licenses->name = $presentationProfile->name;
                }
                //----------------------Fin Vérification du titre---------------//
            
                //---------------------Vérification de l'image-------------------//
                if (!empty($_FILES['file']) && $_FILES['file']['error'] == 0) {
                    $fileInfos = pathinfo($_FILES['file']['name']);
                    $fileExtension = ['jpg', 'jpeg', 'png', 'svg'];
                    if (in_array(strtolower($fileInfos['extension']), $fileExtension)) {
                        $path = 'assets/img/' . $presentationProfile->universe . '/licenses/';
                        $fileNewName = $presentationProfile->name;
                        $fileFullPath = $path . $fileNewName . '.' . $fileInfos['extension'];
                        if (move_uploaded_file($_FILES['file']['tmp_name'], $fileFullPath)) {
                            chmod($fileFullPath, 0644);
                            $presentation->image = $fileFullPath;
                            if($presentation->image != $presentationProfile->image){
                                unlink($presentationProfile->image);
                            }
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
                if(empty($updatelicenseFormErrors)){
                    if($presentationProfile->name != $_POST['name'] && $licenses->checkLicensesValueUnavailability('name')){
                        $updatelicenseFormErrors['name'] = 'Ce titre existe déjà';
                    }else{
                        $transaction = new transaction();
                        try {
                            $transaction->beginTransaction();
                            $presentation->updatePresentation();
                            $licenses->updateLicense();
                            $transaction->commit();
                            $message = 'La licence a bien été mise à jour.';
                        }catch(Exception $e) {
                            $transaction->rollBack();
                            $message = 'La licence n\'a pas pu être mise à jour.';
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