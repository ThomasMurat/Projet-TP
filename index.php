<?php 
session_start();
//---------------------Inclusion du controller et des models associé à la page index 
include_once 'models/dataBase.php';
include_once 'models/users.php';
include 'controllers/indexController.php';
//----------------------FIN

//-------------------------Inclusion du menu de navigation celon l'univers sélectionné: anime,manga,global
include $header; ?>
<!-------------------------FIN--->

<!--------------------Fenêtre modal de connexion ------------------>
<div class="modal" id="login">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Connexion</h4>
            </div>
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
</div>
<!------------------------FIN------------------------------->

<!------------------------Gestion du contenue principal de la page ------------>
<div class="col-12 d-flex"><?php
    //------------------------Inclusion du menue d'administration
    if(isset($_SESSION['userProfile']) && $_SESSION['userProfile']['role'] == 'administrateur'){
        include 'views/adminMenu.php';
    } ?>
    <div class="row flex-fill"><?php 
    //------------------------Inclusion de la vue correspondant à la page sélectionné 
        include $content; ?>
    </div><?php
//----------------------Fin----------------------------------------

//Inclusion du footer
include 'views/footer.php'; 
