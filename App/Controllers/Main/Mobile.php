<?php

    namespace Controller;

    defined('ROOTPATH') or exit('Access denied');

    class Mobile{
        use MainController;
        public function index(){
            $this->view('main/Mobile');
        }
    }
?>