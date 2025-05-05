<?php

    namespace Controller;

    defined('ROOTPATH') or exit('Access denied');

    class AboutUs{
        use MainController;
        public function index(){
            $this->view('main/AboutUs');
        }
    }
?>