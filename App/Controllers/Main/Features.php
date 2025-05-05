<?php

    namespace Controller;

    defined('ROOTPATH') or exit('Access denied');

    class Features{
        use MainController;
        public function index(){
            $this->view('main/Features');
        }
    }
?>