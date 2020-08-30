<?php
//On instancie l'objet welcome de classe posts
$welcome = new posts();
//On stock la valeur correspondant à l'univers sélectionné dans l'attribut universe de notre objet
$welcome->universe = $universe;
//On appelle la méthode getWelcomeContent qui va stocker le texte d'accueil dans l'attribut content de notre objet 
$welcome->getWelcomeContent();