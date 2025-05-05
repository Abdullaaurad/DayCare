<?php

    namespace Controller;

    defined('ROOTPATH') or exit('Access denied');

    class Privacy{
        use MainController;
        public function index(){
            $this->view('main/Privacy');
        }
    }
?>