<?php

    namespace Controller;

    defined('ROOTPATH') or exit('Access denied');

    class Profile{
        use MainController;
        public function index(){
            $this->view('main/profile');
        }
    }
?>