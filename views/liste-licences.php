<?php
include_once 'models/licenses.php';
include_once 'models/presentations.php';
include_once 'controllers/liste-licencesController.php';
?>
<div class="col-12 content d-flex align-items-center" id="liste-licences">
    <div class="row"><?php
        foreach($licensesList as $license){ ?>
            <div class="col-12 col-sm-6 col-lg-4 col-xl-3 my-3">
                <div class="card col-12">
                    <div class="card-header <?= ($universe == 'anime')? 'animecolor2' : 'mangacolor2' ?> text-white justify-content-center row"><?= $license->name ?></div>
                    <div class="card-body"><a href="<?= $universeLink ?>&content=presentation&title=<?= $license->name ?>"><img id="licImg" class="img-fluid w-100" src="<?= $license->image ?>" /></a></div>
                    <div class="card-footer justify-content-center row"><?= formatDateFr($license->creationDate) ?></div>
                </div>
            </div><?php
        } ?>
    </div>   
</div>