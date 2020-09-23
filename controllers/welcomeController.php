<?php
//On instancie l'objet welcome de classe posts
$welcome = new posts();
$univer = new universes();
$univer->universe = $universe;
//On stock la valeur correspondant à l'univers sélectionné dans l'attribut universe de notre objet
$welcome->id_42pmz96_universes = $univer->getUniverseName('universe')->id;
//On appelle la méthode getWelcomeContent qui va stocker le texte d'accueil dans l'attribut content de notre objet 
$welcome->getWelcomeContent();