<?php

    namespace Controller;

    defined('ROOTPATH') or exit('Access denied');

    class Featurespop{
        use MainController;
        public function index(){
            $this->view('main/Featurespop');
        }
    }
?>