<?php

    namespace Controller;

    defined('ROOTPATH') or exit('Access denied');

    class Visit{
        use MainController;
        public function index(){
            $this->view('main/Visit');
        }
    }
?>