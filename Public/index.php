<?php

    session_start();

    $minPHPVersion = '8.0';
    if(phpversion() < $minPHPVersion){
        die("Your PHP version must be {$minPHPVersion} or higher to run this app. your current version is" . phpversion());
    }

    define ('ROOTPATH', __DIR__ . DIRECTORY_SEPARATOR);

    require "../App/core/init.php";

    if(DEBUG){
        ini_set('display_errors',1);
    }
    else{
        ini_set('display_errors',0);
    }
    
    $app = new App;
    $app->loadController();

?>