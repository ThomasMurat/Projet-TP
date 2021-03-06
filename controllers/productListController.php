<?php
if(isset($_SESSION['userProfile']) && $_SESSION['userProfile']['role'] == 'administrateur'){
    $producer = new producers();
    $categories = new producerTypes();
    //---------------------Vérification des actions----------------------------//

    //---------------------Suppression----------------------------//
    if(isset($_POST['deletePresentation'])){
        $havePresentation = false;
        $isLicense = false;
        if(!empty($_POST['presId'])){
            $presentations->id = htmlspecialchars($_POST['presId']);
            $presentationProfile = $presentations->getLicenseProfile();
            $havePresentation = true;  
        }
        if(!empty($_POST['licId'])){
            $licenses->id = htmlspecialchars($_POST['licId']);
            $isLicense = true;
        }
        if($isLicense){
            if($havePresentation){
                if($presentations->deletePresentation()) {
                    if(!empty($presentationProfile->image)){
                        unlink($presentationProfile->image);
                    }
                    $message = 'La présentation a bien été supprimée.'; 
                }else {
                    $message = 'La présentation n\'a pas pu être supprimée.';
                }
            }else {
                if($licenses->deleteLicense()){
                    $message = 'La license a bien été supprimé';
                }else {
                    $message = 'La license n\'a pas pu être supprimée.';
                }
            }
        }else {
            $message = 'Cette license n\'existe pas.';
        } 
    }
    //-------------------Fin vérification des actions-------------------//

    //-------------------------Paramètres de pagination-----------------------//
    if (isset($_GET['page'])){
        $page = $_GET['page'];
    }else {
        unset($_SESSION['search']['producersList']);
        $page = 1;
    }
    $pageParam['limit'] = 10;
    $pageParam['offset'] = ($page - 1) * $pageParam['limit'];
    //------------------------Fin paramètres de pagination-------------------//
    $categoriesList = $categories->getProducerTypesList();
    //----------------------------Vérification de la recherche----------------------//
    $searchInput = array();
    if(isset($_POST['searchPrroducers'])){
        if(!empty($_POST['name'])){
            $searchInput['name'] = '%' . htmlspecialchars($_POST['name']) . '%';
        }
        if(isset($_POST['categorie'])){
            $searchInput['id_42pmz96_producerTypes'] = htmlspecialchars($_POST['categorie']);
        }
        //On stock notre tableau de recherche dans un paramètre de session 
        //pour pouvoir y accéder s'il y a plusieurs page de résultats
        $_SESSION['search']['producersList'] = $searchInput;
    }
    //------------------------Fin vérification de la recherche-----------------//

    //------------------------Affichage de la liste des licenses------------//
    if(!empty($_SESSION['search']['producersList'])){
        $producersList = $producer->getProducersList($_SESSION['search']['producersList'], $pageParam);
        $resultsNb = count($producer->getProducersList($_SESSION['search']['producersList']));
    }else {
        $producersList = $producer->getProducersList($searchInput, $pageParam);
        $resultsNb = count($producer->getProducersList($searchInput));
    }
    $pageNb = ceil($resultsNb / $pageParam['limit']);
    //-----------------------Fin de l'affichage de la liste--------------------//
}