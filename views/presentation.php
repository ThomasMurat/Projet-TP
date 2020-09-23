<?php
include_once 'models/licenses.php';
include 'controllers/presentationController.php';
?>
<div class="col-12 content d-flex align-items-center" id="presentation">
    <div class="row w-100 justify-content-center"><?php
        if(isset($message)){ ?>
            <div class="col-10 col-lg-6 jumbotron">
                <h1 class="text-center display-4"><?= $message ?></h1>
                <a href="<?= $universeLink ?>&content=liste-licences">Retour vers la liste des licences</a>
            </div><?php
        }else{ ?>
            <div class="col-9 my-4 border">
                <div class="row">
                    <div class="col-6 text-center"><img class="img-fluid w-100 my-3" src="<?= $presentation->image ?>" /></div>
                    <div class="col-6">
                        <hr>
                        <p><?= $presentation->name ?></p>
                        <hr>
                        <p><?= formatDateFr($presentation->creationDate) ?></p>
                        <hr>
                        <p class="text-justify"><?= $presentation->presentation ?></p>
                        <hr>
                    </div>
                </div>
            </div><?php
        } ?>
    </div>
</div>