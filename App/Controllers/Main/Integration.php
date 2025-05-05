<?php

    namespace Controller;

    defined('ROOTPATH') or exit('Access denied');

    class Integration{
        use MainController;
        public function index(){
            $this->view('main/Integration');
        }
    }

?>