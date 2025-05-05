<?php

    namespace Controller;

    defined('ROOTPATH') or exit('Access denied');

    class Landing{
        use MainController;

        public function index(){
            
            $this->view('Main/Landing');
        }
    }
?>