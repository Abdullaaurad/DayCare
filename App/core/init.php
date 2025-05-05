<?php 
    defined('ROOTPATH') or exit('Access denied');
    date_default_timezone_set('Asia/Kolkata');

    spl_autoload_register(function($classname) {
        $classnameParts = explode("\\", $classname);
        $classname = end($classnameParts);

        $directories = [
            'C:/xampp/htdocs/KiddoVille-UI_UX/App/Modals/',
            'C:/xampp/htdocs/KiddoVille-UI_UX/App/core/',
            'C:/xampp/htdocs/KiddoVille-UI_UX/App/Controllers/',
            'C:/xampp/htdocs/KiddoVille-UI_UX/App/Helper/',
        ];
    
        foreach ($directories as $directory) {
            $filename = $directory . ucfirst($classname) . ".php";
            if (file_exists($filename)) {
                require $filename;
                return;
            }
        }
        trigger_error("Unable to load class: $classname", E_USER_ERROR);
    });

    #so it will be easier to include all the files inside core without requiring one by one 
    require 'config.php';
    require 'functions.php';
    require 'Database.php';
    require 'Modal.php';
    require 'Controller.php';
    require 'App.php';
    require 'Mailer.php';
    $GLOBALS['env'] = require 'C:\xampp\htdocs\KiddoVille-UI_UX\App\env.php';
?>