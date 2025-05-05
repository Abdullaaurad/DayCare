<?php

    namespace Controller;

    // defined('ROOTPATH') or exit('Access denied');

    class Responsive{
        use MainController;
        public function index(){
            $this->view('Parent/Responsive');
        }
    }
?>