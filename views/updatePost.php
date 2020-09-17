<?php 
include_once 'models/posts.php';
include_once 'models/postsTypes.php';
include 'controllers/updatePostController.php'; ?>
<div id="addLicense" class="content col-12 d-flex align-items-center justify-content-center">
    <div class="row  justify-content-center"><?php
    if(isset($_SESSION['userProfile']) && $_SESSION['userProfile']['role'] == 'administrateur'){ 
        if(isset($message)){ ?>
            <div class="col-10 col-lg-8 text-center jumbotron">
                <h1 class="text-center display-4"><?= $message; ?></h1>
                <a class="text-center w-100" href="<?= $universeLink ?>&content=postsList">Retour vers la liste des Producteurs</a>
            </div><?php
        }else {?>
            <form class="offset-1 border border-black col-10" action="<?= $universeLink ?>&content=updatePost&id=<?= $postInfo->postId ?>" method="POST" enctype="multipart/form-data">
                <h2 class="text-center">Modifier un Article</h2>
                <div id="updatePostFormContent" class="row">
                <div class="form-group col-12">
                        <label for="title">Titre :</label>
                        <input id="title" name="title" type="text" class="form-control" value="<?= $postInfo->title ?>" />
                        <p id="titleError" class="text-danger"><?= (!empty($addPostFormErrors['title'])) ? $addPostFormErrors['title'] : '' ;?></p>
                    </div>
                    <div class="form-group col-12">
                        <label for="username">Auteur :</label>
                        <input id="username" name="username" type="text" class="form-control" value="<?= $postInfo->username ?>" />
                        <p id="titleError" class="text-danger"><?= (!empty($addPostFormErrors['username'])) ? $addPostFormErrors['username'] : '' ;?></p>
                    </div>
                    <div class="form-group col-12">
                        <label for="universe">Univer :</label>
                        <select id="universe" name="universe" class="form-control">
                            <option selected disabled>Choisir un Univer</option><?php
                            foreach($universesList as $universe){ ?>
                                <option value="<?= $universe->id ?>" <?= ($postInfo->universe == $universe->universe) ? 'selected' : ''; ?>><?= $universe->universe ?></option><?php
                            } ?>
                        </select>
                        <p id="universeError" class="text-danger"><?= (!empty($addPostFormErrors['universe'])) ? $addPostFormErrors['universe'] : '' ;?></p>
                    </div>
                    <div class="form-group col-12">
                        <label for="categorie">Catégorie :</label>
                        <select id="categorie" name="categorie" class="form-control">
                            <option selected disabled>Choisir une categorie</option><?php
                            foreach($categoriesList as $categorie){ ?>
                                <option value="<?= $categorie->id ?>" <?= ($postInfo->name == $categorie->name) ? 'selected' : ''; ?>><?= $categorie->name ?></option><?php
                            } ?>
                        </select>
                        <p id="universeError" class="text-danger"><?= (!empty($addPostFormErrors['universe'])) ? $addPostFormErrors['universe'] : '' ;?></p>
                    </div>
                    <div class="text-center w-100">
                        <img src="<?= $postInfo->postImg ?>"></img>
                    </div>
                    <div class="form-group col-12">
                        <label for="file">Image :</label>
                        <input id="file" name="file" type="file" class="form-control" />
                        <p id="fileError" class="text-danger"><?= (!empty($addPostFormErrors['file'])) ? $addPostFormErrors['file'] : '' ;?></p>
                    </div>
                    <div class="form-group col-12">
                        <label for="content">Contenue de l'article :</label>
                        <textarea id="content" name="content" class="form-control" rows="10" cols="100"><?= $postInfo->content ?></textarea>
                        <p id="content" class="text-danger"><?= (!empty($addPostFormErrors['content'])) ? $addPostFormErrors['content'] : '' ;?></p>
                    </div>
                    <div class="form-group text-center col-12">
                        <input type="submit" class="btn btn-primary" name="updatePost" value="Modifier" />
                    </div>
                </div>
            </form><?php
        }
    }else { ?>
        <div class="col-10 col-lg-8 jumbotron">
            <h1 class="text-center display-4">Vous n'avez pas le droit d'accéder à cette page</h1>
        </div><?php
    } ?>
    </div>
</div>