<?php

    namespace Controller;

    defined('ROOTPATH') or exit('Access denied');

    class Fullvideo{
        use MainController;
        public function index(){
            $this->view('Parent/fullvideo');
        }
    }
?>