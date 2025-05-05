<?php

    namespace Controller;

    defined('ROOTPATH') or exit('Access denied');

    class CreatePost{
        use MainController;
        public function index(){
            $this->view('Parent/CreatePost');
        }
    }
?>