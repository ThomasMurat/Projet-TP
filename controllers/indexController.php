<?php
$univerList = array('AU', 'MU');
$noSwitchableContentList = array('subscrib');
$switchableContentList = array('welcome', 'productList', 'producerList');


if(isset($_GET['univer']) && in_array($_GET['univer'], $univerList)) {
    $univer = htmlspecialchars($_GET['univer']);
}else {
    $univer = 'MU';
} 
$header = 'views/parts/'. $univer . 'header.php';

if(isset($_GET['content'])) {
    if(in_array($_GET['content'], $noSwitchableContentList)) {
        $contentName = htmlspecialchars($_GET['content']);
        $content = 'views/parts/' . $contentName . '.php';
    }else if(in_array($_GET['content'], $switchableContentList)) {
        $contentName = htmlspecialchars($_GET['content']);
        $content = 'views/parts/'. $univer . $contentName . '.php';
    }else {
        $contentName = 'welcome';
        $content = 'views/parts/' . $univer . 'welcome.php';
    }  
}else {
    $contentName = 'welcome';
    $content = 'views/parts/welcome.php';
}


