<?php
if(isset($_SESSION['userProfile']) && $_SESSION['userProfile']['role'] == 'administrateur'){
    $universe = new universes();
    $universesList = $universe->getUniversesList();
    $categorie = new postsTypes();
    $categoriesList = $categorie->getCategoriesList();
    $post = new posts();
    $user = new users();
    $updatePostFormErrors = array();

    if(!empty($_GET['id'])){
        $post->id = htmlspecialchars($_GET['id']);
        if($post->checkPostExist()){
            $postInfo = $post->getPostInfo();
        }else {
            $message = 'Ce producteur n\'éxiste pas';
        }
    }else {
        $message = 'Aucun producteur sélectionné';
    }

    if(isset($_POST['updatePost'])){
        //------------------------vérification du titre--------------------------//
        $isName = false;
        if(!empty($_POST['title'])){
            $post->title = htmlspecialchars($_POST['title']);
            $isName = true;
        }else {
            $updatePostFormErrors['title'] = 'Vous devez renseigner un titre.';
        }
        //------------------------Fin Vérification Titre-------------------------//

        //------------------------Vérification de l'auteur-----------------------//
        if(!empty($_POST['username'])){
            $user->username = htmlspecialchars($_POST['username']);
            if($user->checkUserValueUnavailability()){
                $post->id_42pmz96_users = $user->getUserProfile()->userId;
            }else {
                $updatePostFormErrors['username'] = 'Ce pseudo n\'existe pas.';
            }  
        }else {
            $updatePostFormErrors['username'] = 'Veillez indiquer l\'auteur.';
        }
        //------------------------Fin vérification auteur----------------------//

        //------------------------Vérification de la Categorie----------------------//
        if(!empty($_POST['categorie'])){
            $categorie->id = htmlspecialchars($_POST['categorie']);
            if($categorie->checkPostTypesExist()){
                $post->id_42pmz96_postsTypes = $categorie->id;
            }else {
                $updatePostFormErrors['categorie'] = 'Cette categorie n\'éxiste pas.';
            }
        }else {
            $updatePostFormErrors['categorie'] = 'Vous n\'avez pas sélectionné de catégorie.';
        }
        //------------------------Fin vérification categorie--------------------//

        //------------------------Vérification de l'univer----------------------//
        $isUniverse = false;
        if(!empty($_POST['universe'])){
            $universe->id = htmlspecialchars($_POST['universe']);
            if($universe->universeExist()){
                $post->id_42pmz96_universes = $universe->id;
                $isUniverse = true;
            }else {
                $updatePostFormErrors['universe'] = 'Cet univer n\'éxiste pas.';
            }
        }else {
            $updatePostFormErrors['universe'] = 'Vous n\'avez pas sélectionné d\'univer.';
        }
        //------------------------Fin vérification univer--------------------//
    
        //-------------------------Vérification de l'image------------------------//
        if($isName && $isUniverse){
            if (!empty($_FILES['file']) && $_FILES['file']['error'] == 0) {
                // On stock dans $fileInfos les informations concernant le chemin du fichier.
                $fileInfos = pathinfo($_FILES['file']['name']);
                // On crée un tableau contenant les extensions autorisées.
                $fileExtension = ['jpg', 'jpeg', 'png', 'svg'];
                // On verifie si l'extension de notre fichier est dans le tableau des extension autorisées.
                if (in_array(strtolower($fileInfos['extension']), $fileExtension)) {
                    //On définit le chemin vers lequel uploader le fichier
                    $path = 'assets/img/' . (($universe->getUniverseName() == 'global') ? '': $universe->getUniverseName() . '/') . 'posts/';
                    $date = date('Y-m-d');
                    //On crée le nouveau nom du fichier (celui qu'il aura une fois uploadé)
                    $fileNewName = $post->title . '_' . $date;
                    //On stocke dans une variable le chemin complet du fichier (chemin + nouveau nom + extension une fois uploadé) Attention : ne pas oublier le point
                    $fileFullPath = $path . $fileNewName . '.' . $fileInfos['extension'];
                    //move_uploaded_files : déplace le fichier depuis son emplacement temporaire ($_FILES['file']['tmp_name']) vers son emplacement définitif ($fileFullPath)
                    if (move_uploaded_file($_FILES['file']['tmp_name'], $fileFullPath)) {
                        //On définit les droits du fichiers uploadé (Ici : écriture et lecture pour l'utilisateur apache, lecture uniquement pour le groupe et tout le monde)
                        chmod($fileFullPath, 0644);
                        $post->image = $fileFullPath;
                        unlink($postInfo->postImg);
                    } else {
                        $updatePostFormErrors['file'] = 'Votre fichier ne s\'est pas téléversé correctement';
                    }
                } else {
                $updatePostFormErrors['file'] = 'Votre fichier n\'est pas du format attendu';
                }
            } else {
                if($postInfo->title != $post->title || $postInfo->universe != $universe->getUniverseName($post->id_42pmz96_universes)){
                    strtok($postInfo->postImg, '.');
                    $post->image = 'assets/img/' . (($universe->getUniverseName() == 'global') ? '': $universe->getUniverseName() . '/') . 'posts/' . $post->title . '_' . date('Y-m-d') . '.' . strtok('.');
                    rename($postInfo->postImg, $post->image);
                }else {
                    $post->image = $postInfo->postImg;
                }
            }
        }else {
            $updatePostFormErrors['file'] = 'Pour ajouter une image le nom et l\'univers doivent être définis.';
        }
        //-----------------------Fin Vérification de l'image---------------------//

        //----------------------Vérification du Contenue----------------------------//
        if(!empty($_POST['content'])){
            $post->content = htmlspecialchars($_POST['content']);
        }else {
            $updatePostFormErrors['content'] = 'Vous n\'avez pas remplis le contenue';
        }
        //------------------------Fin vérification du texte----------------------//
        
        //------------------------Validation du Formulaire-----------------------//
        if(empty($addPostFormErrors)){
            $now = date('Y-m-d H:i:s');
            $post->lastEditDate = $now;
            if($post->updatePost()){
                $message = 'l\'article a bien été ajouté';
            }else {
                $message = 'l\'article n\'a pas pu être ajouté';
            }
        }
        //-----------------------Fin validation du formulaire--------------------//

    }
}