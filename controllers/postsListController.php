<?php
if(isset($_SESSION['userProfile']) && $_SESSION['userProfile']['role'] == 'administrateur'){
    $univer = new universes();
    $universesList = $univer->getUniversesList();
    $categorie = new postsTypes();
    $categoriesList = $categorie->getCategoriesList();
    $user = new users();
    $post = new posts();
    //---------------------Vérification des actions----------------------------//

    //---------------------Suppression----------------------------//
    if(isset($_POST['deletePost'])){
        if(!empty($_POST['deleteId'])){
            $post->id = htmlspecialchars($_POST['deleteId']);
            if($post->checkPostExist()){
                $postInfo = $post->getPostInfo();
                if($post->deletePost()){
                    $message = 'L\'article a bien été supprimé.';
                    unlink($postInfo->postImg);
                }else {
                    $message = 'L\'article n\'a pas pu être supprimé.';
                }
            }else {
                $message = 'Cet article n\'éxiste pas.';
            }
        }else {
            $message = 'Aucun article sélectionné.';
        } 
    }
    //-------------------Fin vérification des actions-------------------//

    //-------------------------Paramètres de pagination-----------------------//
    if (isset($_GET['page'])){
        $page = $_GET['page'];
    }else {
        unset($_SESSION['search']['PostsList']);
        $page = 1;
    }
    $pageParam['limit'] = 10;
    $pageParam['offset'] = ($page - 1) * $pageParam['limit'];
    //------------------------Fin paramètres de pagination-------------------//

    //----------------------------Vérification de la recherche----------------------//
    $searchInput = array();
    if(isset($_POST['searchPosts'])){
        if(!empty($_POST['title'])){
            $searchInput['title'] = '%' . htmlspecialchars($_POST['title']) . '%';
        }
        if(!empty($_POST['username'])){
            $searchInput['username'] = '%' . htmlspecialchars($_POST['username']) . '%';
        }
        if(!empty($_POST['categorie'])){
            $searchInput['id_42pmz96_postsTypes'] =  htmlspecialchars($_POST['categorie']);
        }
        if(!empty($_POST['universe'])){
            $searchInput['id_42pmz96_universes'] =  htmlspecialchars($_POST['universe']);
        }
        if(!empty($_POST['lastEditDate'])){
            $searchInput['lastEditDate'] = htmlspecialchars($_POST['lastEditDate']) . '-01-01';
        }
        //On stock notre tableau de recherche dans un paramètre de session 
        //pour pouvoir y accéder s'il y a plusieurs page de résultats
        $_SESSION['search']['postsList'] = $searchInput;
    }
    //------------------------Fin vérification de la recherche-----------------//

    //------------------------Affichage de la liste des licenses------------//
    if(!empty($_SESSION['search']['postsList'])){
        $postsList = $post->getPostsList($_SESSION['search']['postsList'], $pageParam);
        $resultsNb = count($post->getPostsList($_SESSION['search']['postsList']));
    }else {
        $postsList = $post->getPostsList($searchInput, $pageParam);
        $resultsNb = count($post->getPostsList($searchInput));
    }
    $pageNb = ceil($resultsNb / $pageParam['limit']);
    //-----------------------Fin de l'affichage de la liste--------------------//
}