<?php

    namespace Controller;

    defined('ROOTPATH') or exit('Access denied');

    class FAQ{
        use MainController;
        public function index(){
            $this->view('main/faq');
        }
    }
?>