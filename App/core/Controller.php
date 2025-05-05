<?php

    namespace Controller;

    defined('ROOTPATH') or exit('Access denied');
    #how we check if a file exit and load it if it exists
    trait MainController{
        public function view($name, $data=[]){
            if(!empty($data)){
                extract($data);
            }
            $filename = "../App/Views/".$name."view.php";
            if(file_exists($filename)){
                require $filename;
            }
            else{
                $filename = "../App/Views/404view.php";
                require $filename;
            }
        }
    }