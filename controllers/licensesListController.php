<?php
if(isset($_SESSION['userProfile']) && $_SESSION['userProfile']['role'] == 'administrateur'){
    $presentations = new presentations();
    $licenses = new licenses();
    //-------------------------Paramètres de pagination-----------------------//
    if (isset($_GET['page'])){
        $page = $_GET['page'];
    }else {
        unset($_SESSION['search']['licensesList']);
        $page = 1;
    }
    $pageParam['limit'] = 10;
    $pageParam['offset'] = ($page - 1) * $pageParam['limit'];
    //------------------------Fin paramètres de pagination-------------------//

    //----------------------------Vérification de la recherche----------------------//
    $searchInput = array();
    if(isset($_POST['searchLicenses'])){
        if(!empty($_POST['name'])){
            $searchInput['name'] = '%' . htmlspecialchars($_POST['name']) . '%';
        }
        if(!empty($_POST['creationDate'])){
            $searchInput['creationDate'] = htmlspecialchars($_POST['creationDate']) . '-01-01';
        }
        if(isset($_POST['universe'])){
            $searchInput['id_42pmz96_universes'] = htmlspecialchars($_POST['universe']);
        }
        //On stock notre tableau de recherche dans un paramètre de session 
        //pour pouvoir y accéder s'il y a plusieurs page de résultats
        $_SESSION['search']['licensesList'] = $searchInput;
    }
    //------------------------Fin vérification de la recherche-----------------//

    //------------------------Affichage de la liste des licenses------------//
    if(!empty($_SESSION['search']['licensesList'])){
        $licensesList = $licenses->getLicensesList($_SESSION['search']['licensesList'], $pageParam);
        $resultsNb = count($licenses->getLicensesList($_SESSION['search']['licensesList']));
    }else {
        $licensesList = $licenses->getLicensesList($searchInput, $pageParam);
        $resultsNb = count($licenses->getLicensesList($searchInput));
    }
    $pageNb = ceil($resultsNb / $pageParam['limit']);
    //-----------------------Fin de l'affichage de la liste--------------------//

    //---------------------Vérification des actions----------------------------//
    //---------------------Suppression----------------------------//
    if(isset($_POST['deletePresentation'])){
        $havePresentation = false;
        $isLicense = false;
        if(!empty($_POST['presId'])){
            $presentations->id = htmlspecialchars($_POST['presId']);
            $havePresentation = true;  
        }
        if(!empty($_POST['licId'])){
            $licenses->id = htmlspecialchars($_POST['licId']);
            $isLicense = true;
        }
        if($isLicense){
            if($havePresentation){
                if($presentations->deletePresentation()) {
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
}