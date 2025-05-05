<?php

    namespace Controller;

    defined('ROOTPATH') or exit('Access denied');

    class ChildEditPackage{
        use MainController;
        public function index(){
            $this->view('Child/ChildEditPackage');
        }
    }
?>