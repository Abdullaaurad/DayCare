<?php

    namespace Controller;

    defined('ROOTPATH') or exit('Access denied');

    class Home{
        use MainController;
        public function index(){
            $this->view('main/home');
        }
    }
?>