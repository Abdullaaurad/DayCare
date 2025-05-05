<?php

    namespace Controller;

    defined('ROOTPATH') or exit('Access denied');

    class Funzone{
        use MainController;
        public function index(){
            $this->view('main/Funzone');
        }
    }
?>