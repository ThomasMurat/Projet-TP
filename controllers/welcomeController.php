<?php
if($universe == 'global'){
    $welcomeBackground = '<a class="col-xl-6 col-12" id="universAnime" href="index.php?universe=anime&content=welcome"><div class="row"><img id="animeWelcomeImage" class="img-fluid" src="/assets/img/anime/fond.jpg" /></div></a>
    <a class="col-xl-6 col-12" id="universManga" href="index.php?universe=manga&content=welcome"><div class="row"><img class="img-fluid" id="mangaWelcomeImage" src="/assets/img/manga/fond.jpg" /></div></a>';
}else {
    $welcomeBackground = '<img class="img-fluid w-100" id="' . $universe . 'WelcomeImage" src="/assets/img/' . $universe . '/fond.jpg" />';
}

$welcome = new posts();
$welcome->universe = $universe;
$welcome->getWelcomeContent();