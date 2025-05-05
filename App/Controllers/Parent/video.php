<?php

    namespace Controller;

    defined('ROOTPATH') or exit('Access denied');

    class Video{
        use MainController;
        public function index(){
            $this->view('Parent/video');
        }
    }
?>