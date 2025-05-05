<?php

    namespace Controller;

    defined('ROOTPATH') or exit('Access denied');

    class Terms{
        use MainController;
        public function index(){
            $this->view('main/terms');
        }
    }
?>