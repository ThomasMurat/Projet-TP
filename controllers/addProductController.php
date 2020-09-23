<?php
$types = new productTypes();
$typesList = $types->getProductTypesList();
$status = new status();
$statusList = $status->getStatusList();
$genres = new genres();
$genresList = $genres->getGenresList();
$license = new licenses();
$licensesList = $license->getLicensesNameList();
$targets = new targets();
$targetsList = $targets->getTargetsList();
$producers = new producers();
$producersNameList = $producers->getProducersList(array());
$producersRoles = new producerRoles();
$rolesList = $producersRoles->getProducerRolesList();