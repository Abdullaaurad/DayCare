<?php

    namespace Controller;

    defined('ROOTPATH') or exit('Access denied');

    class Blog{
        use MainController;
        public function index(){
            $this->view('main/blog');
        }
    }
?>