<?php 
include 'models/posts.php';
include 'controllers/welcomeController.php'; 
?>
<div class="col-12 <?= ($universe == 'global')? 'd-flex': '' ?>" onload="welcomeAdapt()" id="welcome">
    <div class="row d-flex align-self-center">
        <?= $welcomeBackground ?>
        <div class="offset-lg-4 offset-1 col-10 col-lg-4 align-self-center" id="welcomeContainer">
            <h2 class="text-center">Bienvenue</h2>
            <p class="mx-3 text-justify"><?= $welcome->content ?></p>
        </div>
    </div>
</div>