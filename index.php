<?php 
    include 'controllers/indexController.php';
    include $header; ?>
    <div class="modal" id="login">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Connexion</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <form method="POST" action="<?= $univer . '-' . $contentName . '.html' ?>">
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="username">Pseudo :</label>
                                <input type="texte" id="username" class="form-control" name="username" />
                            </div>
                            <div class="form-group col-12">
                                <label for="userPassword">Mot de passe :</label>
                                <input type="password" id="userPassword" class="form-control" name="userPassword" />
                            </div>
                            <div class="form-group text-center col-12">
                                <input type="submit" class="btn btn-primary" value="Se connecter" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div><?php       
    include $content;
    include 'views/parts/footer.php' 
?>