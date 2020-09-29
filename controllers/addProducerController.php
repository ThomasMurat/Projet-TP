<?php
if(isset($_SESSION['userProfile']) && $_SESSION['userProfile']['role'] == 'administrateur'){
    $categorie = new producerTypes();
    $categoriesList = $categorie->getProducerTypesList();
    //--------------------------Vérification du formulaire d'ajout--------------------//
    $producer = new producers();
    $addProducerFormErrors = array();
    if(isset($_POST['addProducer'])){
        //------------------------Vérification du Nom-----------------------//
        $isName = false;
        if(!empty($_POST['name'])){
            $producer->name = htmlspecialchars($_POST['name']);
            $isName = true;
        }else {
            $addProducerFormErrors['name'] = 'Veuillez remplir le nom.';
        }
        //------------------------Fin vérification Nom----------------------//

        //------------------------Vérification du type----------------------//
        if(!empty($_POST['categorie'])){
            $categorie->id = htmlspecialchars($_POST['categorie']);
            if($categorie->checkProducerTypesExistByID()){
                $producer->id_42pmz96_producerTypes = $categorie->id;
            }else {
                $addProducerFormErrors['categorie'] = 'Cette categorie n\'éxiste pas.';
            }
        }else {
            $addProducerFormErrors['categorie'] = 'Vous n\'avez pas sélectionné de catégorie.';
        }
        //------------------------Fin vérification type--------------------//
    
        //-------------------------Vérification de l'image------------------------//
        if (!empty($_FILES['file']) && $_FILES['file']['error'] == 0 && $isName) {
            $fileInfos = pathinfo($_FILES['file']['name']);
            $fileExtension = ['jpg', 'jpeg', 'png', 'svg'];
            if (in_array(strtolower($fileInfos['extension']), $fileExtension)) {
                $path = 'assets/img/producers/';
                $fileNewName = $producer->name;
                $fileFullPath = $path . $fileNewName . '.' . $fileInfos['extension'];
                if (move_uploaded_file($_FILES['file']['tmp_name'], $fileFullPath)) {
                    chmod($fileFullPath, 0644);
                    $producer->picture = $fileFullPath;
                } else {
                    $addProducerFormErrors['file'] = 'Votre fichier ne s\'est pas téléversé correctement.';
                }
            } else {
            $addProducerFormErrors['file'] = 'Les fomats autorisés sont jpg,jpeg,png ou svg.';
            }
        } else {
            $producer->picture = 'assets/img/noImage.jpg';
        }
        //-----------------------Fin Vérification de l'image---------------------//

        //----------------------Vérification du texte----------------------------//
        if(!empty($_POST['description'])){
            $producer->description = htmlspecialchars($_POST['description']);
        }else {
            $producer->description = '';
        }
        //------------------------Fin vérification du texte----------------------//
        
        //------------------------Validation du Formulaire-----------------------//
        if(empty($addProducerFormErrors)){
            if($producer->addProducer()){
                $message = 'Le producteur a bien été ajouté.';
            }else {
                if($producer->picture != 'assets/img/noImage.jpg'){
                    unlink($producer->picture);
                }
                $message = 'Le producteur n\'a pas pu être ajouté.';
            }
        }
        //-----------------------Fin validation du formulaire--------------------//
    }
    //------------------------Fin vérification du formulaire d'ajout------------------------//
}