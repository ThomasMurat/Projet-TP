<?php
if(isset($_SESSION['userProfile']) && $_SESSION['userProfile']['role'] == 'administrateur'){
    $producer = new producers();
    $categories = new producerTypes();
    //---------------------Vérification des actions----------------------------//

    //---------------------Suppression----------------------------//
    if(isset($_POST['deleteProducer'])){
        if(!empty($_POST['prodId'])){
            $producer->id = htmlspecialchars($_POST['prodId']);
            if($producer->checkProducerExist()){
                $producerProfile = $producer->getProducerProfile();
                if($producer->deleteProducer()){
                    unlink($producerProfile->picture);
                    $message = 'Le producteur a bien été supprimé.';
                }else {
                    $message = 'Le producteur n\'a pas pu être supprimé.';
                }
            }else {
                $message = 'Ce producteur n\'éxiste pas.';
            } 
        }else {
            $message = 'aucun producteur sélectionné';
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
    if(isset($_POST['searchProducers'])){
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