<?php
if(isset($_SESSION['userProfile']) && $_SESSION['userProfile']['role'] == 'administrateur'){
    $license = new licenses();
    $presentation = new presentations();
    $univers = new universes();
    $licensesList = $license->getLicensesNameList();
    //-------------------Vérification ajout license-----------------------//
    $addLicenseErrorForm = array();
    if(isset($_POST['addLicense'])){
        //-----------------Vérification du titre------------------------//
        if(!empty($_POST['name'])){
            $license->name = htmlspecialchars($_POST['name']);
            if($license->checkLicensesValueUnavailability('name')){
                $addLicenseErrorForm['name'] = 'Ce titre éxiste déjà.'; 
            }
        }else {
            $addLicenseErrorForm['name'] = 'Vous devez entrez un titre.';
        }
        //------------------Fin vérification du titre--------------------//

        //------------------Vérification de la date de création--------------//
        if(!empty($_POST['creationDate'])){
            if(validateDate($_POST['creationDate'])){
                $license->creationDate = htmlspecialchars($_POST['creationDate']);
            }else {
                $addLicenseErrorForm['creationDate'] = 'Cette date n\'est pas valide.'; 
            }
        }else{
            $addLicenseErrorForm['creationDate'] = 'Vous n\'avez pas renseigné de date.';
        }
        //---------------Fin vérification date de création--------------------//

        //-------------------Validation du formulaire------------------------//
        if(empty($addLicenseErrorForm)){
            if($license->addLicense()){
                $message = 'La license a bien été ajouté.';
            }else {
                $message = 'La license n\'a pas pu être ajouté.';
            }
        }
        //-------------------Fin validation du formulaire--------------------//
    }
    //-------------------Fin vérification ajout license------------------------//

    //-----------------Vérification ajout présentation-------------------------//
    $addPresentationErrorForm = array();
    if(isset($_POST['addPresentation'])){
        //--------------------Vérification de la license-----------------------//
        $isLicense = false;
        if(!empty($_POST['name'])){
            $license->id = htmlspecialchars($_POST['name']);
            if($license->checkLicensesValueUnavailability()){
                $presentation->id_42pmz96_licenses = $license->id;
                $licenseName = $license->getLicenseName();
                $isLicense = true;
            }else {
                $addPresentationErrorForm['name'] = 'Cette license n\'éxiste pas.';
            }
        }else {
            $addPresentationErrorForm['name'] = 'Aucune license sélectionnée.';
        }
        //------------------------Fin vérification license----------------------//

        //------------------------Vérification de l'univer----------------------//
        $isUniver = false;
        if(!empty($_POST['universe'])){
            $universe->id = htmlspecialchars($_POST['universe']);
            if($universe->universeExist()){
                $presentation->id_42pmz96_universes = $universe->id;
                $universeName = $univers->getUniverseName()->universe;
                $isUniver = true;
            }else {
                $addPresentationErrorForm['universe'] = 'Cette univer n\'éxiste pas.';
            }
        }else {
            $addPresentationErrorForm['universe'] = 'Vous n\'avez pas sélectionné d\'univer.';
        }
        //------------------------Fin vérification de l'univer--------------------//
    
        //-------------------------Vérification de l'image------------------------//
        if($isUniver && $isLicense){
            if (!empty($_FILES['file']) && $_FILES['file']['error'] == 0) {
                $fileInfos = pathinfo($_FILES['file']['name']);
                $fileExtension = ['jpg', 'jpeg', 'png', 'svg'];
                if (in_array(strtolower($fileInfos['extension']), $fileExtension)) {
                    $path = 'assets/img/' . $universeName . '/licenses/';
                    $fileNewName = $licenseName;
                    $fileFullPath = $path . $fileNewName . '.' . $fileInfos['extension'];
                    if (move_uploaded_file($_FILES['file']['tmp_name'], $fileFullPath)) {
                        chmod($fileFullPath, 0644);
                        $presentation->image = $fileFullPath;
                    } else {
                        $addPresentationErrorForm['file'] = 'Votre fichier ne s\'est pas téléversé correctement.';
                    }
                } else {
                $addPresentationErrorForm['file'] = 'Les fomats autorisés sont jpg,jpeg,png ou svg.';
                }
            } else {
                $presentation->image = 'assets/img/noImage.jpg';
            }
        }
        //-----------------------Fin Vérification de l'image---------------------//

        //----------------------Vérification du texte----------------------------//
        if(!empty($_POST['presentation'])){
            $presentation->presentation = htmlspecialchars($_POST['presentation']);
        }else {
            $addPresentationErrorForm['presentation'] = 'Vous n\'avez pas remplis le texte de présentation.';
        }
        //------------------------Fin vérification du texte----------------------//
        
        //------------------------Validation du Formulaire-----------------------//
        if(empty($addPresentationErrorForm)){
            if($presentation->addPresentation()){
                $message = 'La présentation a bien été ajoutée.';
            }else {
                if($presentation->image != 'assets/img/noImage.jpg'){
                    unlink($presentation->image);
                }
                $message = 'La présentation n\'a pas pu être ajoutée.';
            }
        }
        //-----------------------Fin validation du formulaire--------------------//

    }
    //-------------------Fin vérification ajout présentation-------------------//
}