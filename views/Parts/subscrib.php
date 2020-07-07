<?php include 'controllers/subscribController.php'; 
if(isset($_POST['postSubscribe']) && count($subscribFormErrors) == 0){
    ?><p><?= 'Félicitation vous vous êtes inscrit avec succès' ?></p><?php
}else { ?>
    <div class="offset-1 col-10 content" id="subscrib">
        <form action="<?= $univer ?>-subscrib.html" method="POST" class="w-100">
            <h1 class="text-center">Veuillez remplir tous les champs pour vous inscrire.</h1>
            <div id="subscribFormContent" class="row">
                <div class="form-group col-12">
                    <label for="pseudo">Pseudo :</label>
                    <input type="text" class="form-control <?=(isset($_POST['postSubscribe'])) ? (!empty($subscribFormErrors['pseudo']))? 'is-invalid' : 'is-valid'  : '' ; ?>" id="pseudo" name="pseudo" value="<?= (!empty($_POST['pseudo'])) ? $_POST['pseudo'] : '' ; ?>" />
                    <p class="text-danger"><?= (!empty($subscribFormErrors['pseudo'])) ? $subscribFormErrors['pseudo'] : '' ;?></p>
                </div>
                <div class="form-group col-12">
                    <label for="email">Adresse e-mail :</label>
                    <input type="email" class="form-control <?=(isset($_POST['postSubscribe'])) ? (!empty($subscribFormErrors['email']))? 'is-invalid' : 'is-valid'  : '' ; ?>" id="email" name="email" value="<?= (!empty($_POST['email'])) ? $_POST['email'] : '' ; ?>" />
                    <p class="text-danger"><?= (!empty($subscribFormErrors['email'])) ? $subscribFormErrors['email'] : '' ;?></p>
                </div>
                <div class="form-group col-12">
                    <label for="emailConfirm">Confirmer adresse e-mail :</label>
                    <input type="email" class="form-control <?=(isset($_POST['postSubscribe'])) ? (!empty($subscribFormErrors['emailConfirm']))? 'is-invalid' : 'is-valid'  : '' ; ?>" id="emailConfirm" name="emailConfirm" value="<?= (!empty($_POST['emailConfirm'])) ? $_POST['emailConfirm'] : '' ; ?>" />
                    <p class="text-danger"><?= (!empty($subscribFormErrors['emailConfirm'])) ? $subscribFormErrors['emailConfirm'] : '' ;?></p>
                </div>
                <div class="form-group col-12">
                    <label for="password">Mot de passe :</label>
                    <input type="password" class="form-control <?=(isset($_POST['postSubscribe'])) ? (!empty($subscribFormErrors['password']))? 'is-invalid' : 'is-valid'  : '' ; ?>" id="password" name="password" value="<?= (!empty($_POST['password'])) ? $_POST['password'] : '' ; ?>" />
                    <p class="text-danger"><?= (!empty($subscribFormErrors['password'])) ? $subscribFormErrors['password'] : '' ;?></p>
                </div>
                <div class="form-group col-12">
                    <label for="passwordConfirm">Confirmer mot de passe :</label>
                    <input type="password" class="form-control <?=(isset($_POST['postSubscribe'])) ? (!empty($subscribFormErrors['passwordConfirm']))? 'is-invalid' : 'is-valid'  : '' ; ?>" id="passwordConfirm" name="passwordConfirm" value="<?= (!empty($_POST['passwordConfirm'])) ? $_POST['passwordConfirm'] : '' ; ?>" />
                    <p class="text-danger"><?= (!empty($subscribFormErrors['passwordConfirm'])) ? $subscribFormErrors['passwordConfirm'] : '' ;?></p>
                </div>
                <div class="form-group text-center col-12">
                    <input type="submit" class="btn btn-primary" name="postSubscribe" value="Confirmer" />
                </div>
            </div>
        </form>
    </div><?php
} ?>