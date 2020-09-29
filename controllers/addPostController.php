<?php
if(isset($_SESSION['userProfile']) && $_SESSION['userProfile']['role'] == 'administrateur'){
    $univers = new universes();
    $universesList = $univers->getUniversesList();
    $categorie = new postsTypes();
    $categoriesList = $categorie->getCategoriesList();
    //--------------------Vérification du formulaire d'ajout-----------------------//
    $post = new posts();
    $user = new users();
    $addPostFormErrors = array();
    if(isset($_POST['addPost'])){
        //------------------------Vérification du Titre-----------------------//
        $isName = false;
        if(!empty($_POST['title'])){
            $post->title = htmlspecialchars($_POST['title']);
            $isName = true;
        }else {
            $addPostFormErrors['title'] = 'Veillez entrez un titre.';
        }
        //------------------------Fin vérification titre----------------------//

        //------------------------Vérification de l'auteur-----------------------//
        if(!empty($_POST['username'])){
            $user->username = htmlspecialchars($_POST['username']);
            if($user->checkUserValueUnavailability()){
                $post->id_42pmz96_users = $user->getUserProfile()->userId;
            }else {
                $addPostFormErrors['username'] = 'Ce pseudo n\'existe pas.';
            }
            
        }else {
            $addPostFormErrors['username'] = 'Veuillez indiquer l\'auteur de l\'article.';
        }
        //------------------------Fin vérification auteur----------------------//

        //------------------------Vérification de la Categorie----------------------//
        if(!empty($_POST['categorie'])){
            $categorie->id = htmlspecialchars($_POST['categorie']);
            if($categorie->checkPostTypesExist()){
                $post->id_42pmz96_postsTypes = $categorie->id;
            }else {
                $addPostFormErrors['categorie'] = 'Cette categorie n\'éxiste pas.';
            }
        }else {
            $addPostFormErrors['categorie'] = 'Vous n\'avez pas sélectionné de catégorie.';
        }
        //------------------------Fin vérification categorie--------------------//

        //------------------------Vérification de l'univer----------------------//
        $isUniverse = false;
        if(!empty($_POST['universe'])){
            $univers->id = htmlspecialchars($_POST['universe']);
            if($univers->universeExist()){
                $post->id_42pmz96_universes = $univers->id;
                $universeName = $univers->getUniverseName()->universe;
                $isUniverse = true;
            }else {
                $addPostFormErrors['universe'] = 'Cet univer n\'éxiste pas.';
            }
        }else {
            $addPostFormErrors['universe'] = 'Vous n\'avez pas sélectionné d\'univer.';
        }
        //------------------------Fin vérification univer--------------------//
    
        //-------------------------Vérification de l'image------------------------//
        if($isName && $isUniverse){
            if (!empty($_FILES['file']) && $_FILES['file']['error'] == 0) {
                $fileInfos = pathinfo($_FILES['file']['name']);
                $fileExtension = ['jpg', 'jpeg', 'png', 'svg'];
                if (in_array(strtolower($fileInfos['extension']), $fileExtension)) {
                    $path = 'assets/img/' . (($universeName == 'global') ? '' : $universeName . '/') . 'posts/';
                    $date = date('Y-m-d');
                    $fileNewName = $post->title . '_' . $date;
                    $fileFullPath = $path . $fileNewName . '.' . $fileInfos['extension'];
                    if (move_uploaded_file($_FILES['file']['tmp_name'], $fileFullPath)) {
                        chmod($fileFullPath, 0644);
                        $post->image = $fileFullPath;
                    } else {
                        $addPostFormErrors['file'] = 'Votre fichier ne s\'est pas téléversé correctement.';
                    }
                } else {
                $addPostFormErrors['file'] = 'Les fomats autorisés sont jpg,jpeg,png ou svg.';
                }
            } else {
                $presentation->picture = 'assets/img/noImage.jpg';
            }
        }else {
            $addPostFormErrors['file'] = 'Pour ajouter une image le nom et l\'univers doivent être définis.';
        }
        //-----------------------Fin Vérification de l'image---------------------//

        //----------------------Vérification du Contenue----------------------------//
        if(!empty($_POST['content'])){
            $post->content = htmlspecialchars($_POST['content']);
        }else {
            $addPostFormErrors['content'] = 'Vous n\'avez pas remplis le contenue.';
        }
        //------------------------Fin vérification du texte----------------------//
        
        //------------------------Validation du Formulaire-----------------------//
        if(empty($addPostFormErrors)){
            $now = date('Y-m-d H:i:s');
            $post->postDate = $post->lastEditDate = $now;
            if($post->addPost()){
                $message = 'L\'article a bien été ajouté.';
            }else {
                if($post->image != 'assets/img/noImage.jpg'){
                    unlink($post->image);
                }
                $message = 'L\'article n\'a pas pu être ajouté.';
            }
        }
        //-----------------------Fin validation du formulaire--------------------//
    }
    //----------------------Fin vérifications du formulaire d'ajout-----------------------//
}