<?php

    namespace Controller;

    defined('ROOTPATH') or exit('Access denied');

    class Help{
        use MainController;
        public function index(){
            $this->view('main/Help');
        }
    }
?>