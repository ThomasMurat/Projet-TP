<?php
if(isset($_POST['userDelete']) && isset($_SESSION['userProfile'])){
    $users = new users();
    $users->id = $_SESSION['userProfile']['id'];
    $users->statu = 0;
    $users->desactivationDate = date('Y-m-d H:i:s');
    if($users->checkUserValueUnavailability('id')){
        if($users->updateUser(['statu', 'desactivationDate'], 'id')){
            $message = 'Le compte a bien été desactivé';
        }else {
            $message = 'Le compte n\'a pas pu être desactivé';
        }
    }
}