<?php
if(!empty($_GET['title'])){
    $licenses = new licenses();
    $search['universe'] = $universe;
    $licenses->name = htmlspecialchars($_GET['title']);
    if($licenses->checkLicensesValueUnavailability('name')){
        $search['name'] = $licenses->name;
        $presentation = $licenses->getLicensesList($search)[0];
    }else {
        $message = 'Aucune licence trouvée.';
    }
}else {
    $message = 'Aucune licence sélectionnée.';
}