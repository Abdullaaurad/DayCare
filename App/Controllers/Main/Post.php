<?php

    namespace Controller;

    defined('ROOTPATH') or exit('Access denied');

    class Post{
        use MainController;
        public function index(){
            $this->view('main/post');
        }
    }
?>