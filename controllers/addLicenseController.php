<?php
if(isset($_SESSION['userProfile']) && $_SESSION['userProfile']['role'] == 'administrateur'){
    $license = new licenses();
    $addLicenseErrorForm = array();
    if(isset($_POST['addLicense']))
        if(!empty($_POST['name'])){
            $license->name = htmlspecialchars($_POST['name']);
        }else {
            $addLicenseErrorForm['name'] = 'Vous devez entrez un titre';
        }
        if(!empty($_POST['creationDate'])){
            if(validateDate($_POST['creationDate'])){
                $license->creationDate = htmlspecialchars($_POST['creationDate']);
            }else {
                $addLicenseErrorForm['creationDate'] = ''; 
            }
        }else{
            $addLicenseErrorForm['creationDate'] = '';
        }
    }
}