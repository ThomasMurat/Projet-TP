<?php
if(isset($_SESSION['userProfile']) && $_SESSION['userProfile']['role'] == 'administrateur'){
    $categorie = new producerTypes();
    $categoriesList = $categorie->getProducerTypesList();
    $producer = new producers();
    $addProducerFormErrors = array();
    if(isset($_POST['addProducer'])){
        //------------------------Vérification du Nom-----------------------//
        $isName = false;
        if(!empty($_POST['name'])){
            $producer->name = htmlspecialchars($_POST['name']);
            $isName = true;
        }else {
            $addProducerFormErrors['name'] = 'Veillez remplir le nom';
        }
        //------------------------Fin vérification Nom----------------------//

        //------------------------Vérification de lu type----------------------//
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
            // On stock dans $fileInfos les informations concernant le chemin du fichier.
            $fileInfos = pathinfo($_FILES['file']['name']);
            // On crée un tableau contenant les extensions autorisées.
            $fileExtension = ['jpg', 'jpeg', 'png', 'svg'];
            // On verifie si l'extension de notre fichier est dans le tableau des extension autorisées.
            if (in_array(strtolower($fileInfos['extension']), $fileExtension)) {
                //On définit le chemin vers lequel uploader le fichier
                $path = 'assets/img/producers/';
                //On crée le nouveau nom du fichier (celui qu'il aura une fois uploadé)
                $fileNewName = $producer->name;
                //On stocke dans une variable le chemin complet du fichier (chemin + nouveau nom + extension une fois uploadé) Attention : ne pas oublier le point
                $fileFullPath = $path . $fileNewName . '.' . $fileInfos['extension'];
                //move_uploaded_files : déplace le fichier depuis son emplacement temporaire ($_FILES['file']['tmp_name']) vers son emplacement définitif ($fileFullPath)
                if (move_uploaded_file($_FILES['file']['tmp_name'], $fileFullPath)) {
                    //On définit les droits du fichiers uploadé (Ici : écriture et lecture pour l'utilisateur apache, lecture uniquement pour le groupe et tout le monde)
                    chmod($fileFullPath, 0644);
                    $producer->picture = $fileFullPath;
                } else {
                    $addProducerFormErrors['file'] = 'Votre fichier ne s\'est pas téléversé correctement';
                }
            } else {
            $addProducerFormErrors['file'] = 'Votre fichier n\'est pas du format attendu';
            }
        } else {
            $producer->picture = '';
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
                $message = 'le producteur a bien été ajouté';
            }else {
                $message = 'le producteur n\'a pas pu être ajouté';
            }
        }
        //-----------------------Fin validation du formulaire--------------------//

    }
}