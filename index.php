<?php 
session_start();
include_once 'models/users.php';
include 'controllers/indexController.php';
include $header; ?>
<div class="modal" id="login">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Connexion</h4>
            </div>
            <!-- Modal body -->
            <div id="loginContent" class="modal-body">
                <div class="row">
                    <div class="form-group col-12">
                        <label for="username">Pseudo :</label>
                        <input type="texte" id="username" class="form-control" name="username" />
                    </div>
                    <div class="form-group col-12">
                        <label for="password">Mot de passe :</label>
                        <input type="password" id="password" class="form-control" name="password" />
                    </div>
                    <div class="form-group text-center col-12">
                        <button id="loginBtn" class="btn btn-primary" onclick="sendLogin()">Se connecter</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><?php   
include $content;
include 'views/footer.php'; 
